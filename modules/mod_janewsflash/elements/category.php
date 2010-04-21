<?php 
/*
# ------------------------------------------------------------------------
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
/**
 * 
 */
  // no direct access
defined('_JEXEC') or die('Restricted access');
/**
 * JElementCategory class.
 */
class JElementCategory extends JElement
{
	/*
	 * Category name
	 *
	 * @access	protected
	 * @var		string
	 */
	var	$_name = 'Category';
	
	/*
	 * Control name.
	 *
	 * @access	protected
	 * @var		string
	 */
	var $_controlName = '';
	
	/**
	 * fetch Element 
	 */
	function fetchElement($name, $value, &$node, $control_name){
		$this->_controlName = $name; 
		$db = &JFactory::getDBO();
		$query = 'SELECT * FROM #__sections WHERE published=1';
		$db->setQuery( $query );
		$sections = $db->loadObjectList();
		$categories=array();
		$categories=array();
		$categories[0]->id = '';
		$categories[0]->title = JText::_("Select All");
		
		foreach ($sections as $section) {
			$optgroup = JHTML::_('select.optgroup',$section->title,'id','title');
			$query = 'SELECT id,title FROM #__categories WHERE published=1 AND section='.$section->id;
			$db->setQuery( $query );
			$results = $db->loadObjectList();
			array_push($categories,$optgroup);
			foreach ($results as $result) {
				array_push($categories,$result);
			}
		}
		$optgroup = JHTML::_('select.optgroup',JText::_("Uncategorized"),'id','title');
		array_push($categories,$optgroup);
		$uncategorised=array();
		$uncategorised['id'] = '0';
		$uncategorised['title'] = JText::_("Uncategorized");
		array_push($categories,$uncategorised);
		
		$out = JHTML::_('select.genericlist',  $categories, ''.$control_name.'['.$name.'][]', 'class="inputbox" style="width:95%;" multiple="multiple" size="10"', 'id', 'title', $value );
		
		$out .= $this->renderJSControl();
		return $out;
	}
	
	/**
	 * render javasript to control enable or disable options following system.
	 *
	 * return string.
	 */
	function renderJSControl(){
	}
}

?>
