<div class="ja-slidewrap" id="ja-slide-<?php echo $module->id;?>" style="visibility:hidden">
  <div class="ja-slide-main-wrap">
    <div class="ja-slide-main">
      <?php for ($i=0;$i<count($images); $i++) {?>
      <div class="ja-slide-item"><img src="<?php echo $folder.$images[$i];?>" alt="<?php echo $images[$i];?>"/>
      <?php if ($showdescwhen == 'always' && $captionsArray[$i]):?><span class="ja-slide-desc"><?php echo $captionsArray[$i];?></span><?php endif; ?>
      </div>						
      <?php }?>
    </div>		
  <?php if ($animation=='move' && $container) :?>  
    <div class="but_prev ja-slide-prev"></div>
    <div class="but_next ja-slide-next"></div>
  <?php endif; ?>
  <div class="maskDesc"><div class="inner"><?php if ($showDescription=='desc-readmore'){?><a class="readon" title=""><span><?php echo $readmoretext;?></span></a><?php }?></div></div>
  </div>
  
  <?php if($showDescription && $showdescwhen!='always'){?>
  <div class="ja-slide-descs" style="width:">
    <?php foreach($captionsArray as $desc) {?>
      <div class="ja-slide-desc"><?php echo $desc?></div>					
    <?php }?>					
  </div>
  <?php }?>
  
  <?php if ($navigation): ?>
  <div class="ja-slide-mask">
  </div>
  <?php if ($control): ?>
  <div class="ja-slide-buttons clearfix">
  	<span class="ja-slide-prev">&laquo;</span>
      <div class="ja-slide-thumbs-wrap">
        <div class="ja-slide-thumbs">
          <?php for ($i=0;$i<count($images); $i++) {?>
            <div class="ja-slide-thumb">
            <?php if ($navigation=='thumbs'){?><img src="<?php echo $thumbArray[$i]?>" alt="Photo Thumb" />
            <?php }else{?><span><?php echo ($i+1);?></span><?php } ?>
            </div>
          <?php }?>							
        </div>
        <div class="ja-slide-thumbs-mask"><span class="ja-slide-thumbs-mask-left">&nbsp;</span><span class="ja-slide-thumbs-mask-center">&nbsp;</span><span class="ja-slide-thumbs-mask-right">&nbsp;</span></div>
        <p class="ja-slide-thumbs-handles">
          <?php for ($i=0;$i<count($images); $i++) {?>
            <span>&nbsp;</span>
          <?php }?>						
        </p>
  </div>
    <span class="ja-slide-next">&raquo;</span>
  </div>
  <?php endif; ?>
  <?php endif; ?>
</div>
