<?php
// Override with custom fields
// get some custom fields
$phone = $params->get('phone');
$address = $params->get('address');
$url_address = $params->get('url_address');

?>

<div class='phone-header'>
    <span class='phone'><a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a></span>
    <?php if($address): ?>
        <span class='address'><address><a href="<?php echo $url_address; ?>" target="_blank" rel="noopener noreferrer"><?php echo $address; ?></a></address></span>
    <?php endif; ?>
</div>
