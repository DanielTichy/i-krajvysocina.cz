<div id="ja-newsflash-<?php echo $moduleID; ?>" style="position:relative; width:100%;height:<?php echo $xheight; ?>px; overflow:hidden;">		
		<?php if( $total > 0 ) : ?>
		<?php foreach( $list as $key => $item ) : ?>
		<div style="overflow: hidden; height:<?php echo $xheight; ?>px; position:absolute; display:none;" class="ja-newsflash-items-<?php echo $moduleID; ?> ja-newsflash-items">
			 <?php echo $helper->outputNewsFlash( $source[$key], $params ); ?>
		</div>
	<?php  endforeach; ?>
	<?php else: ?>
	<div><?php echo JTEXT::_("COULD NOT FOUND ANY ARTICLES");?></div>
	<?php endif; ?>
</div>