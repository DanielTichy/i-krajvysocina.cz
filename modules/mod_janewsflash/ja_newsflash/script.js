/**
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
JANewsFlash = new Class( {
						
	/**
	 * constructor.
	 */
	initialize: function( options ){
		// options setting.
		this.options = Object.extend({
			mode	  : 'scroll_left',
			direction : 'right',
			wrapper	  : null,
			duration  : 1000,
			interval  : 3000,
			delayTime : 10,		
			auto	  : 1,
			itemClass : '.ja-newsflash-items',
			startItem : 0
		}, options || {} );

		this.modes 			= { scroll_left:['left','width'],
								scroll_right:['left','width'], 
								scroll_up:['top','height'], 
								scroll_down:['top','height'] };
		this.currentIndex 	= 0;
		this.previousIndex 	= null;
		this.nextIndex 		= null;
		this.fx 			= new Array();
		this.runner 		= false;
		this.cacheItems 	= new Array();
		this.maxHeight 		= this.options.wrapper.offsetHeight; 
		this.maxWidth 		= this.options.wrapper.offsetWidth ; 
		
		// if the wrapper is  defined in the layout, and looking for items, re-set css style for each item.
		if( $defined(this.options.wrapper) ){
			switch( this.options.mode ){
				case "effect_fade":		
					this._setFXOpacity();
					break;
				case "effect_replace":
					this._setReplaceSlide();
					break;
				default:
					this._setFXSlide();
					break;
			}
		}
		this.play( this.options.delayTime, 'next', true );
	},
	
	/**
	 * Using for effect face mode.
	 * find items in the wrapper and reset css style them if they were found.
	 */
	_setFXOpacity:function(){
		this.options.wrapper.getElements( this.options.itemClass ).each( function(item, index){
			item.setStyles( {"z-index" : index+1,  
						   	 "width"   : this.maxWidth,
							 "display" : "block" } );
			this.fx[index] = new Fx.Style( item, 'opacity', this.options.fxOptions||{duration:500,wait:false} );		
			if( index != 0 ) {
				this.fx[index].hide();
			}
		}.bind(this) );		
	},
	
	/**
	 * Using for Sider UP|DOWN and RIGHT|LEFT
	 * find items in the wrapper and reset css style them if they were found.
	 */
	_setFXSlide:function(){
		var mode = this.modes[this.options.mode][0]; 
		this.options.wrapper.getElements( this.options.itemClass ).each( function(item, index){
			if( mode == 'left' ){																	  
				item.setStyles( { "z-index" : index+1, 
							   	  "left"	: index * this.maxWidth, 
								  "width"	: this.maxWidth,
								  "display" : "block"} );
			} else { 
				item.setStyles( { "z-index" : index+1, 
							   	  "top"		: index * this.maxHeight, 
								  "width"	: this.maxWidth,
								  "display" : "block"} );
			}
			this.fx[index] = new Fx.Style( item, mode, this.options.fxOptions || {duration:500,wait:false} );		  											 
		}.bind(this) );	
	},
	
	/**
	 * Using for Replace slide mode
	 * find items in the wrapper and reset css style them if they were found.
	 */
	_setReplaceSlide:function(){
		this.options.wrapper.getElements( this.options.itemClass ).each( function(item, index){
			item.setStyles( {"z-index" : index+1, 
						   	 "width"   : this.maxWidth,
							 "display" : "block"} );
			if( index !=0 ){
				item.setStyle( "display", "none" );
			}
			this.fx[index] = item;		  											 
		}.bind(this) );	
	},
	
	/**
	 * next direction
	 */
	next:function(){
		this.currentIndex += (this.currentIndex < this.fx.length-1) ? 1 : (1 - this.fx.length);	
		this.run();
	},
	
	/**
	 * previous direction
	 */
	previous:function(){
		this.currentIndex += this.currentIndex > 0 ? -1 : this.fx.length - 1;	
		this.run();
	},
	
	/**
	 * whether to play automatic.
	 */
	play: function( delay, direction, wait ){
		this.stop(); 
		if(!wait){
			this[direction](false);
		}
		this.runner = this[direction].periodical( delay, this, false );
	},
	
	/**
	 * stop direction.
	 */
	stop:function(){
		$clear( this.runner );			
	},
	
	/**
	 * run direction
	 */
	run:function(){
		// re set index of previous item and next item.
		this.previousIndex = this.currentIndex + ( this.currentIndex>0 ? -1 : this.fx.length - 1 );
		this.nextIndex = this.currentIndex + ( this.currentIndex < this.fx.length-1 ? 1 : 1 - this.fx.length );	
		// run direction bacse on mode.
		switch( this.options.mode ){
			case "effect_fade":		
				// change display item with other by using opacity effect.
				this.fx[this.previousIndex].start( 1, 0 );			
				this.fx[this.currentIndex].start( 0, 1 );	
				break;
			case "effect_replace":
				// replace previour item by current item.
				this.fx[this.previousIndex].setStyle( "display", "none" );
				this.fx[this.currentIndex].setStyle( "display", "block" );
				break;
			case "scroll_up":
				this.fx[this.previousIndex].start( 0, -this.maxHeight );			
				this.fx[this.currentIndex].start( this.maxHeight, 0 );
				// from down to up
				break;	
			case "scroll_down":
				this.fx[this.previousIndex].start( 0, this.maxHeight );			
				this.fx[this.currentIndex].start( -this.maxHeight, 0 );
				// from up to down
				break;
			case "scroll_right":
				this.fx[this.previousIndex].start( 0, -this.maxWidth );			
				this.fx[this.currentIndex].start( this.maxWidth, 0 );
				// from left to right
				break;		
			default:
				// from right to left.
				this.fx[this.previousIndex].start( 0, this.maxWidth );			
				this.fx[this.currentIndex].start( -this.maxWidth, 0 );
				break;
		}
	}
} );