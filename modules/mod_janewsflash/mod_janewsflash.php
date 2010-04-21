<?php
/*
 * # ------------------------------------------------------------------------
# JA News Flash module for Joomla 1.5
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
defined('_JEXEC') or die('Restricted access');
require_once (dirname(__FILE__).DS.'helper.php');
JPluginHelper::importPlugin('content', null, false);


JHTML::script('script.js','modules/'.$module->module.'/ja_newsflash/');

$helper = new modJAnewsFlashHelper();
// asign variables
$moduleID     = 'janflh-modid' . $module->id;
$xheight = $params->get('xheight');
$delaytime 		= intval( $params->get( 'delaytime', 10 ) );
$order =  $params->get( 'sort_order_field' ,'created' );
$cache = (bool) $params->get('enable_cache',1);
// get list of articles.
$source = $helper->getList( $params ); 
$total = count($source); 
// sort articles without sql query
$list = $cache &&  $total > 0 && trim($order) == 'rand' ? array_flip(array_rand($source, $total)) : array_keys($source);
// render for layout.
require( JModuleHelper::getLayoutPath( $module->module ) ) ;

unset($list);
unset($source);
?>
<script type="text/javascript">	
	$(window).addEvent( 'domready', function(){
	
		var options = {
			wrapper:$("ja-newsflash-<?php echo $moduleID; ?>"),
			mode:'<?php echo $params->get('animation', 'scroll_left'); ?>',
			interval:<?php echo (int)$params->get('animationtime', 1000); ?>,
			delayTime:<?php echo (int)$delaytime * 1000; ?>,
			fxOptions : { duration: <?php echo $params->get('animation_speed', 1000);?>,
									  transition: <?php echo $params->get('animation_transition', 'Fx.Transitions.linear'); ?> ,
									  wait: false }	
		}
		var jaNewsFlashModid<?php echo $module->id; ?> = new JANewsFlash( options );
	} );
</script>