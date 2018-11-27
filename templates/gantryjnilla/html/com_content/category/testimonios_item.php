<?php
defined('_JEXEC') or die;

$params = $this->item->params;
$item = $this->item;
$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
?>
<div class="testimonio-item" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
	<i class="fa fa-quote-left"></i>
	<div class="row-fluid">
		<div class="span3">
			<div class="client-image">
				<?php echo JLayoutHelper::render('jnilla.article-intro-image',
				array(
						'params' => $params,
						'item' => $this->item,
						'attr' => 'class="jn-holder jn-holder-block" data-ratio="box"')); ?>
			</div>
		</div>
		<div class="span9">
			<div class="testimonio-content">
				<?php echo $item->introtext; ?>
				<h4 class="testimonio-title">
					<?php echo $item->title; ?>
				</h4>
			</div>
		</div>
	</div>
	<i class="fa fa-quote-right"></i>
</div>