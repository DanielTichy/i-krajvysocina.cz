<?php header("Content-type: text/css"); ?>
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
<?php

$template_path = dirname( dirname( $_SERVER['REQUEST_URI'] ) );
global $color;
function ieversion() {
  ereg('MSIE ([0-9]\.[0-9])',$_SERVER['HTTP_USER_AGENT'],$reg);
  if(!isset($reg[1])) {
    return -1;
  } else {
    return floatval($reg[1]);
  }
}
$iev = ieversion();

?>
<?php /*All IE*/ ?>

<?php
/*IE 6*/
if ($iev == 6) {
?>

ul.menu li a {
	width: 200px;
}

p.stickynote {
	filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $template_path;?>/images/icon-sticky.png', sizingMethod='crop');
 	background-image: none;
	width: 89%;
}

p.download {
	filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $template_path;?>/images/icon-download.png', sizingMethod='crop');
 	background-image: none;
	width: 89%;
}

p.error {
	filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $template_path;?>/images/icon-error.png', sizingMethod='crop');
 	background-image: none;
	width: 90%;
}

p.message {
	filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $template_path;?>/images/icon-info.png', sizingMethod='crop');
 	background-image: none;
	width: 90%;
}

p.tips {
	filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $template_path;?>/images/icon-tips.png', sizingMethod='crop');
 	background-image: none;
	width: 90%;
}


<?php
}
?>


<?php
/*IE 7*/
if ($iev == 7) {
?>
.modifydate {
	display: inline;
}

a.readon {
	display: block;
	float: left;
}

#ja-current-content {
	zoom: 1;
}

<?php
}
?>


<?php
/*IE 8*/
if ($iev == 8) {
?>
#ja-wrapper, #ja-topslwrap, #ja-topsl {
	width: 100%;
}
<?php
}
?>
