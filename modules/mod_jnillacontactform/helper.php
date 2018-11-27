<?php
/**
 * @copyright   Copyright (C) 2013 jnilla.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */


defined('_JEXEC') or die;

/**
 * Helper for mod_jnillacontactform
 *
 */
class ModJnillaContactFormHelper
{
	/**
	 * handle the operation if a form is submitted
	 *
	 */
	public static function controller($module, $params){
		// declarations
		$app = JFactory::getApplication();
		$input = $app->input;
		$mid = $module->id;
		$prefix = "jnilla-contact-form-$mid";
		$sitename = $app->get('sitename');
		$remoteIp = JFactory::getApplication()->input->server->get('REMOTE_ADDR');

		// data submitted from this module ?
		if($input->get('jnilla-contact-form-id') !== $mid) return;
		// check token
		JSession::checkToken() or die( 'Invalid Token' );
		// get form data
		$data = $input->post->get($prefix, array(), 'array');
		// reCaptcha challenge ?
		if($params->get('enable_recaptcha')){
			$secretKey = $params->get('recaptcha_secret_key');
			require_once 'vendor/autoload.php';
			$recaptcha = new \ReCaptcha\ReCaptcha($secretKey);
			$reCatpchaData = JFactory::getApplication()->input->post->get('g-recaptcha-response');

			if (!$reCatpchaData){
				$app->redirect(
					JFactory::getURI()->toString(),
					JText::_('MOD_JNILLACONTACTFORM_ERROR_RECAPTCHA_CHALLENGE_FAILED'), 'error');
				return;
			}

			$reCatpchaResponse = $recaptcha->verify($reCatpchaData, $remoteIp);

			if(!$reCatpchaResponse->isSuccess()){
				$app->redirect(
						JFactory::getURI()->toString(),
						JText::_('MOD_JNILLACONTACTFORM_ERROR_RECAPTCHA_CHALLENGE_FAILED'), 'error');
				return;
			}
		}

		// list labels
		$labels = $input->post->get("$prefix-label", array(), 'array');
		// list form fields
		foreach($_POST[$prefix] as $key => $value){
			$fields[] = $key;
		}

		// add ip and country info
		$ipdata = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=$remoteIp"));
		$country = $ipdata->geoplugin_countryCode;
		$fields[] = "ip";
		$labels["ip"] = "IP";
		$data["ip"] = "$remoteIp ($country)";

		// filters
		$rejected = false;

		// text filter
		$filters = trim($params->get('text_filters'));
		if($filters !== ""){
			$filters = explode("\n", $filters);
			$dataContent = implode(" ", $data);
			foreach ($filters as $filter){
				$filter = trim($filter);
				if($filter === "") continue;
				if(strpos($dataContent, $filter) !== false){
					$rejected = true;
					break;
				}
			}
		}

		// country filter
		if(!$rejected){
			$filters = trim($params->get('country_filters'));
			if($filters !== ""){
				$filters = explode("\n", $filters);
				foreach ($filters as &$filter){
					$filter = trim($filter);
				}
				$mode = $params->get('country_filter_mode');
				if($mode === "whitelist"){
					if(!(in_array($country, $filters))){
						$rejected = true;
					}
				}else{
					if(in_array($country, $filters)){
						$rejected = true;
					}
				}
			}
		}

		// list recipients
		$recipients = explode("\n", trim($params->get('recipients')));
		// subject
		$subject = trim($params->get('subject'));
		if($subject == "") $subject = JText::sprintf('MOD_JNILLACONTACTFORM_NEW_MESSAGE_FROM', $sitename);
		// compose and send the mail
		if($rejected){
			$txt = date("Y-m-d H:i:s")." - $country - $remoteIp";
			file_put_contents(__DIR__.'/rejection-log.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
			sleep(rand(5,10));
		}else{
			$sent = self::_sendEmail($data, $fields, $labels, $recipients, $subject);
		}
		if (!($sent instanceof Exception) || $isSpam)
		{
			$app->redirect(
				JFactory::getURI()->toString(),
				JText::_('MOD_JNILLACONTACTFORM_MESSAGE_SEND_SUCCESS'), 'info');
			return;
		}
		else
		{
			$app->redirect(
				JFactory::getURI()->toString(),
				$sent->getMessage(), 'error');
			return;
		}
	}


	/**
	 * compose the mail content and send it.
	 *
	 */
	private function _sendEmail($data, $fields, $labels, $recipients, $subject)
	{
		// declarations
		$app = JFactory::getApplication();
		$mailfrom = $app->get('mailfrom');
		$fromname = $app->get('fromname');
		// send copy ?
		if(in_array('copy', $fields) && isset($data['email']) && !empty($data['email']))
		{
			unset($fields[array_search('copy', $fields)]);
			$recipients[]= $data['email'];
		}
		// compose mail body
		$body = array();
		foreach($fields as $field)
		{
			$body[] = $labels[$field].": ".trim($data[$field]);
			if(strlen($data[$field]) > 50) $body[] = "--------------------------------------------------";
			$body[] = "\n";
		}
		$body = implode("\n", $body);
		// send mail to recipients
		foreach($recipients as $recipient)
		{
			if(trim($recipient) == "") continue;
			unset($mail);
			$mail = JFactory::getMailer();
			$mail->addRecipient($recipient);
			$mail->setSender(array($mailfrom, $fromname));
			$mail->setSubject($subject);
			$mail->setBody($body);
			$sent = $mail->Send();
			if(!$sent) return $sent;
		}
		return $sent;
	}
}



