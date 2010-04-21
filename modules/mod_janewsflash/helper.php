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
  // no direct access
defined('_JEXEC') or die('Restricted access');

require_once (JPATH_SITE . '/components/com_content/helpers/route.php');
/**
 * modJASildeNews class.
 */
class modJAnewsFlashHelper {

	/**
	 * @var string $condition;
	 *
	 * @access private
	 */
	var $conditons = '';
	
	/**
	 * @var string $order 
	 *
	 * @access private
	 */
	var $order = 'ordering';
	
	/**
	 * @var string $limit
	 *
	 * @access private
	 */
	var $limit  = '';
	
	/**
	 * get listing items from rss link or from list of categories.
	 *
	 * @param JParameter $params
	 * @return array
	 */
	function getList( $params ){
		$rows = array();

		// check cache was endable ?
		if ( $params->get('enable_cache',1) ) {
			$cache =& JFactory::getCache();
			$cache->setCaching( true );
			$cache->setLifeTime( $params->get( 'cache_time', 30 ) * 60 );	
			$rows = $cache->get( array( $this , 'getArticles' ), array( $params ) ); 
		} else {
			$rows = $this->getArticles( $params );
		}					

		return $rows;
	}
	
	/**
	 * get articles from list of categories and follow up owner paramer.
	 *
	 * @param JParameter $params.
	 * @return array list of articles
	 */
	function getArticles( $params ){
		$order =  $params->get('sort_order_field' ,'created');
		if( trim($order) != "rand" ) {
			$this->setOrder("a.". $order, $params->get('sort_order','DESC') );
		}else {
			$this->setOrder( "RAND()", "" );
		} 
		$this->setLimit( $params->get('max_items', 5) );
		$rows = $this->getListArticles( $params );
		return $rows;							
	}
		
	/**
	 * get list articles follow setting configuration.
	 *
	 * @param JParameter $param
	 * @return array 
	 */ 
	function getListArticles( $params ){
	
		global $mainframe; 
		
	 	$db	    = &JFactory::getDBO();
		
		$my = &JFactory::getUser();

		$aid	= $my->get( 'aid', 0 );
		$date =& JFactory::getDate();
		$now  = $date->toMySQL();
		
		$query 	= 	'SELECT a.*,cc.description as catdesc, cc.title as cattitle,s.description as secdesc, s.title as sectitle,' .
					' CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(":", a.id, a.alias) ELSE a.id END as slug,'.
					' CASE WHEN CHAR_LENGTH(cc.alias) THEN CONCAT_WS(":",cc.id,cc.alias) ELSE cc.id END as catslug,'.
					' CASE WHEN CHAR_LENGTH(s.alias) THEN CONCAT_WS(":", s.id, s.alias) ELSE s.id END as secslug'
					. "\n FROM #__content AS a".
					' INNER JOIN #__categories AS cc ON cc.id = a.catid' .
					' INNER JOIN #__sections AS s ON s.id = a.sectionid'
					. "\n WHERE a.state = 1"
					. "\n AND ( a.publish_up = " . $db->Quote( $db->getNullDate() ) . " OR a.publish_up <= " . $db->Quote( $now  ) . " )"
					. "\n AND ( a.publish_down = " . $db->Quote( $db->getNullDate() ) . " OR a.publish_down >= " . $db->Quote( $now  ) . " )"
					. ( ( !$mainframe->getCfg( 'shownoauth' ) ) ? "\n AND a.access <= " . (int) $aid : '' )
					;
		
		$query .=  $this->getCondition( $params );
		$query .= ' ORDER BY ' . $this->order;

		if( $this->limit ) {
			$query .=  ' LIMIT ' . $this->limit;
		}	
		$db->setQuery($query);
		$data = $db->loadObjectlist();
	
		return $data;
	}
	
	/**
	 * get condition from setting configuration.
	 *
	 * @param JParameter $params
	 * @return string.
	 */
	function getCondition( $params ){
		
		$condition = '';
		$categories = $params->get( 'catid' , '' );	
		
		if( $categories != '' ) {
			$ids = $this->getIds( $categories );		
			$condition = " AND cc.id IN($ids)";
		}
		return $condition;
	}
	
	/**
	 * parser options, helper for clause where sql.
	 *
	 * @string array $options
	 * @return string.
	 */
	function getIds( $options ){
		if( !is_array($options) ){
			return (int)$options;
		} else {
			return "'".implode( "','", $options  )."'";
		}		
	}
	
	/**
	 * add sort order sql
	 *
	 * @param string $order is article's field.
	 * @param string $mode is DESC or ASC
	 * @return .
	 */
	function setOrder( $order, $mode ){
		$this->order = $order . ' '. $mode;
		return $this;
	}
	
	/**
	 * add set limit sql
	 * 
	 * @param integer $limit.
	 * @return .
	 */
	function setLimit( $limit ){
		$this->limit = $limit; 
		return $this;
	}
	
	/**
	 * trim string with max specify
	 *  
	 * @param string $title
	 * @param integer $max.
	 */
	function trimString( $title, $max=60  ){

		if( strlen($title) > $max ){
			return substr( $title, 0, $max ) . '...';
		} 
		return $title;
	}
	
	/**
	 * detect and get link with each resource
	 *
	 * @param string $item
	 * @param bool $useRSS.
	 * @return string.
	 */
	function getLink( $item ){
		return  JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catslug, $item->sectionid));
	}
	
	/**
	 *
	 *
	 */
	function replaceImage( &$row, $autoresize, $maxchars, $width = 0, $height = 0 ) {
		global $database, $_MAMBOTS, $current_charset;
		$image = "";
		//Get image
		$regex = "/\<img.*\/\>/";
		preg_match ($regex, $row->introtext, $matches);
		$row->text = preg_replace ($regex, '', $row->introtext);
		
		$row->introtext = preg_replace( $regex, '', $row->introtext );
		$row->introtext = trim($row->introtext);
		
		$image  = count($matches) ? $matches[0] : "";
		// clean up globals
		return $image;
	}
	
	/**
	 * output html form custom layout which put in the template of configuration.
	 */
	function outputNewsFlash( &$row, &$params ) {
		
		global $mainframe;

		$row->text 		= $row->introtext;
		$row->readmore 	= (trim( $row->fulltext ) != '') && ($params->get( 'readmore' ));


		$params->set('image', 1);

		
		$results = $mainframe->triggerEvent( 'onPrepareContent', array( &$row, &$params, null ), true );
		
		$html = "";
		$newTitle = "";
		if ($params->get('link_titles')) $newTitle .= "<a href=\"".$this->getLink( $row )."\" title=\"".$row->title."\">".$row->title."</a>";
		else $newTitle .= "".$row->title."";

		//Get image
		$regex = "/\<img.*\/\>/";

		preg_match ($regex, $row->text, $matches);
		$row->text = preg_replace ($regex, '', $row->text);

		$newReadmore 	=	"<a href=\"".$this->getLink( $row )."\" title=\"".$row->title."\">".JText::_('READ MORE...')."</a>";
		$html = str_replace( "##TITLE##",$newTitle,$params->get("templates",'<div style="overflow:hidden; height:323px;" ><div class="nfimages">##IMAGE##</div><div class="nftitle">##TITLE##</div><div class="nfcontent">##CONTENT##</div></div>') );
		$html = str_replace("##CONTENT##",$row->text,$html);
		
		$img  = count($matches) ? $matches[0] : "";
		if( $img && ($params->get('link_images',0)) ) {
			$img =  "<a href=\"".$this->getLink( $row )."\" title=\"".$row->title."\">".$img."</a>";
		}
		$html = str_replace("##IMAGE##", $img, $html);
		$html =	str_replace("##READMORE##",$newReadmore,$html );
	
		return $html;
	}
}
?>