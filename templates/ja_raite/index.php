<?php
/*

# ------------------------------------------------------------------------
# JA Raite template for Joomla 1.5
# ------------------------------------------------------------------------
# Copyright (C) 2004-2010 JoomlArt.com. All Rights Reserved.
# @license - PHP files are GNU/GPL V2. CSS / JS are Copyrighted Commercial,
# bound by Proprietary License of JoomlArt. For details on licensing,
# Please Read Terms of Use at http://www.joomlart.com/terms_of_use.html.
# Author: JoomlArt.com
# Websites:  http://www.joomlart.com -  http://www.joomlancers.com
# Redistribution, Modification or Re-licensing of this file in part of full,
# is bound by the License applied.
# ------------------------------------------------------------------------

*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

include_once (dirname(__FILE__).DS.'ja_vars_1.5.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>"><head>
<jdoc:include type="head" />
<?php JHTML::_('behavior.mootools'); ?>
<link rel="stylesheet" href="<?php echo $tmpTools->baseurl(); ?>templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $tmpTools->baseurl(); ?>templates/system/css/general.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $tmpTools->templateurl(); ?>/css/typo.css" type="text/css" />

<script language="javascript" type="text/javascript" src="<?php echo $tmpTools->templateurl(); ?>/js/ja.script.js"></script>

<?php if ($tmpTools->getParam('usertool_modfunc')) : ?>
<script language="javascript" type="text/javascript">
	var siteurl = '<?php echo $tmpTools->baseurl();?>';
	var tmplurl = '<?php echo $tmpTools->templateurl();?>';
</script>

<?php endif; ?>

<!-- Menu head -->

<?php if ($jamenu) { $jamenu->genMenuHead(); } ?>
<link rel="stylesheet" href="<?php echo $tmpTools->templateurl(); ?>/css/addons.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $tmpTools->templateurl(); ?>/css/template.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $tmpTools->templateurl(); ?>/css/ja.newsflash.css" type="text/css" />

<link href="<?php echo $tmpTools->templateurl(); ?>/css/colors/<?php echo strtolower ($tmpTools->getParam(JA_TOOL_COLOR)); ?>.css" rel="stylesheet" type="text/css" />
<?php if ($tmpTools->isIE()) { ?>
	<link href="<?php echo $tmpTools->templateurl(); ?>/css/ie.php" rel="stylesheet" type="text/css" />
    <link href="<?php echo $tmpTools->templateurl(); ?>/css/colors/<?php echo strtolower ($tmpTools->getParam(JA_TOOL_COLOR)); ?>-ie.php" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
		window.addEvent ('load', makeTransBG);
		function makeTransBG() {
			makeTransBg($$('img'));
		}
	</script>
	<script type="text/javascript">
		var siteurl = '<?php echo $tmpTools->baseurl();?>';
	</script>
<?php }?>

<?php if ($tmpTools->isOP()) { ?>
<link href="<?php echo $tmpTools->templateurl(); ?>/css/op.css" rel="stylesheet" type="text/css" />
<?php } ?>

<!--[if IE]>
	<style type="text/css">
	.article_separator, .leading_separator  {
		line-height: 20px;
		height: 20px;
		background-position: bottom;
	}
	</style>
<![endif]-->

</head>

<body id="bd" class="<?php echo $tmpTools->getParam(JA_TOOL_LAYOUT);?> <?php echo $tmpTools->getParam(JA_TOOL_SCREEN);?> fs<?php echo $tmpTools->getParam(JA_TOOL_FONT);?>">
<a name="Top" id="Top"></a>
<!-- HEADER -->
<div id="ja-header" class="wrap">
<div class="main clearfix">

	<?php
	$siteName = $tmpTools->sitename();
	if ($tmpTools->getParam('logoType')=='image') { ?>
	<h1 class="logo"><a href="index.php" title="<?php echo $siteName; ?>"><?php echo $siteName; ?></a></h1>
	<?php } else {
	$logoText = (trim($tmpTools->getParam('logoText'))=='') ? $config->sitename : $tmpTools->getParam('logoText');
	$sloganText = (trim($tmpTools->getParam('sloganText'))=='') ? JText::_('SITE SLOGAN') : $tmpTools->getParam('sloganText');	?>
	<div class="logo-text">
		<h1><a href="index.php" title="<?php echo $siteName; ?>"><span><?php echo $logoText; ?></span></a></h1>
		<p class="site-slogan"><?php echo $sloganText;?></p>
	</div>
	<?php } ?>

	<?php if($this->countModules('user4')) : ?>
	<div id="ja-search">
		<jdoc:include type="modules" name="user4" />
	</div>
	<?php endif; ?>

</div>
</div>
<!-- //HEADER -->

<?php
	$slide = $this->countModules('ja-newsflash');
?>

<!-- MAIN NAVIGATION -->
<div id="ja-mainnav" class="wrap <?php if($slide) { echo ' hasslide'; } else { echo ' noslide'; } ?>">
<div class="main clearfix">
	<?php if ($jamenu) $jamenu->genMenu (0); ?>
  	<ul class="no-display">
  		<li><a href="<?php echo $tmpTools->getCurrentURL();?>#ja-content" title="<?php echo JText::_("Skip to content");?>"><?php echo JText::_("Skip to content");?></a></li>
  	</ul>
</div>
</div>
<!-- //MAIN NAVIGATION -->

<!-- //JA SLIDESHOW -->
<?php if($slide) { ?>
<div id="ja-newsflash" class="wrap">
	<div class="main">
		<jdoc:include type="modules" name="ja-newsflash" style="xhtml"/>
	</div>
</div>
<?php } ?>
<!-- //JA SLIDESHOW -->

<div id="ja-container<?php echo $divid; ?>" class="wrap">
<div class="main clearfix">

  	<!-- CONTENT -->
  	<div id="ja-content">

		<jdoc:include type="message" />

		<?php
		  $spotlight = array ('user1','user2','user5');
		  $sl = $tmpTools->calSpotlight ($spotlight,$tmpTools->isOP()?100:99.9);
		  if ($sl) {
		?>
		<div id="ja-topsl" class="clearfix">
			<?php if ( $this->countModules('user1') ) { ?>
			<div class="ja-box<?php echo $sl['user1']['class']; ?>" style="width: <?php echo $sl['user1']['width']; ?>;">
			  <jdoc:include type="modules" name="user1" style="xhtml" />
			</div>
			<?php } ?>

			<?php if ( $this->countModules('user2') ) { ?>
			<div class="ja-box<?php echo $sl['user2']['class']; ?>" style="width: <?php echo $sl['user2']['width']; ?>;">
			  <jdoc:include type="modules" name="user2" style="xhtml" />
			</div>
			<?php } ?>

			<?php if ( $this->countModules('user5') ) { ?>
			<div class="ja-box<?php echo $sl['user5']['class']; ?>" style="width: <?php echo $sl['user5']['width']; ?>;">
			  <jdoc:include type="modules" name="user5" style="xhtml" />
			</div>
			<?php } ?>
		</div>
		<?php } ?>

		<div id="ja-current-content" class="clearfix">
			<jdoc:include type="component" />
		</div>

	</div>
  	<!-- //CONTENT -->

	 <!-- COLUMN -->
	<?php if ( $ja_left || $ja_right || $hasSubnav ): ?>
	<div id="ja-col">
	<div class="ja-innerpad clearfix">
		<?php if ($hasSubnav) : ?>
		<div id="ja-subnav" class="moduletable">
			<h3><span>On this page</span></h3>
			<?php if ($jamenu) $jamenu->genMenu (1,1);	?>
		</div>
		<?php endif; ?>
		<jdoc:include type="modules" name="left" style="jamodule" />
		<jdoc:include type="modules" name="right" style="jamodule" />
	</div>
	</div>
	<?php endif; ?>
	<!-- //COLUMN -->

</div>
</div>
<div id="ja-pathway" class="wrap">
	<div class="main clearfix">
		<strong>&gt;</strong> <jdoc:include type="module" name="breadcrumbs" />
	</div>
</div>

<?php
  $spotlight = array ('user6','user7','user8');
  $sl = $tmpTools->calSpotlight ($spotlight,$tmpTools->isOP()?100:99.9);
  if ($sl) {
 ?>
<!-- BOTTOM SPOTLIGHT -->
<div id="ja-botsl" class="wrap">
<div class="main clearfix">
	<?php if ( $this->countModules('user6') ) { ?>
	<div class="ja-box<?php echo $sl['user6']['class']; ?>" style="width: <?php echo $sl['user6']['width']; ?>;">
	  <jdoc:include type="modules" name="user6" style="xhtml" />
	</div>
	<?php } ?>

	<?php if ( $this->countModules('user7') ) { ?>
	<div class="ja-box<?php echo $sl['user7']['class']; ?>" style="width: <?php echo $sl['user7']['width']; ?>;">
	  <jdoc:include type="modules" name="user7" style="xhtml" />
	</div>
	<?php } ?>

	<?php if ( $this->countModules('user8') ) { ?>
	<div class="ja-box<?php echo $sl['user8']['class']; ?>" style="width: <?php echo $sl['user8']['width']; ?>;">
	  <jdoc:include type="modules" name="user8" style="xhtml" />
	</div>
	<?php } ?>
</div>
</div>
<!-- //BOTTOM SPOTLIGHT -->
<?php } ?>

<!-- FOOTER -->
<div id="ja-footer" class="wrap">
<div class="main">
 <span>Copyright &#169; 2010 Kraj Vyso&#269;ina | RMEDIA. V&#353;echna pr&#225;va vyhrazena. Web-support<a href="http://dwpstudio.ic.cz/"
title="Kreativn&#237; my&#353;len&#237; pro V&#225;&#353; Web umo&#382;n&#237; dobr&#253; Graficky zpracovan&#253; layout. V&#225;&#353; prohl&#237;&#382;e&#269; si n&#225;&#353; Design zamiluje. Na&#353;e str&#225;nky jsou Vid&#283;t. Bu&#271;t&#283; vid&#283;t na internetu.
I internetov&#233; str&#225;nky mohou b&#253;t um&#283;leck&#233; d&#237;lo, kter&#233; si obl&#237;b&#237;te spole&#269;n&#283; s obchodn&#237;mi partnery, se kter&#253;mi pr&#225;v&#283; zde,  m&#367;&#382;ete b&#253;t za kr&#225;tko p&#345;&#225;teli.
Internetov&#233; &#345;e&#353;en&#237;, profesion&#225;ln&#237; design na m&#237;ru ka&#382;d&#233;mu. On-line store ve kter&#233;m se prodej Va&#353;ich produkt&#367; stane hra&#269;kou. Corporate identity. Because we'can. Worth'it - Trust'it.
Copyright © 2009 :: E :: D :: F :: W :: J :: P :: M :: Q ::. V&#353;echna pr&#225;va vyhrazena. Designed by JoomlArt.com." target="blank">Dwp.Studio</a></span>
</div>
</div>
<!-- //FOOTER -->

<jdoc:include type="modules" name="debug" />
<script type="text/javascript">
	addSpanToTitle();
	jaAddFirstItemToTopmenu();
	//jaRemoveLastContentSeparator();
	//jaRemoveLastTrBg();
	//moveReadmore();
	//addIEHover();
	//slideshowOnWalk ();
	//apply png ie6 main background
</script>
</body>

</html>