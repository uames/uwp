	 var slider={
		element_id:'top-posts-list',
		hovered_width:150,
		standart_with:150,
		unhovered_width:150,
		childeren_count:4,
		animation_duration:200,
		install: function(ul_element_id){
			this.element_id=ul_element_id;
			this.generete_widths(this.element_id);
			this.resize();
			this.initial_start_widths();
			this.set_widths(this.element_id);			
		},
		generete_widths:function(ul_element_id){
			this.main_ul_width=jQuery('#'+ul_element_id).parent().parent().width();
			this.hovered_width=this.main_ul_width/2;
			this.childeren_count=jQuery('#'+ul_element_id).children().length;
			this.standart_with=this.main_ul_width/this.childeren_count;
			this.unhovered_width=(this.hovered_width)/(this.childeren_count-1);
		},
		initial_start_widths:function(){
			this.generete_widths(this.element_id);
			jQuery('#'+this.element_id).width(this.main_ul_width*this.childeren_count);
			jQuery('#'+this.element_id).children().width(this.standart_with);
		},
		set_widths:function(ul_element_id){
			locale_this=this;
			
			jQuery('#'+ul_element_id).children().hover( gag_hover=function() {
					jQuery(this).stop().animate({width:locale_this.hovered_width},locale_this.animation_duration);
					jQuery(this).parent().children().not(this).stop().animate({width:locale_this.unhovered_width},locale_this.animation_duration)
				}, gag_unhover=function() {
					jQuery(this).parent().children().stop().animate({width:locale_this.standart_with},locale_this.animation_duration);					
				}
			);
		},
		resize:function(){
			local_this=this;			
			jQuery(window).resize(gag=function(){local_this.initial_start_widths();});
		},
		unbind:function(){
			jQuery(window).unbind('resize',gag);
			
			jQuery('#'+this.element_id).children().unbind('hover',gag_hover,gag_unhover)
	
		}
		 
	}
slider.install('top-posts-list');
jQuery(document).ready(function(){
   jQuery('embed,object,iframe').wrap("<div class='video-container'></div>");
   if(!jQuery('header').find('.bwg_slideshow_image_wrap').length){
      jQuery('#blog h2.page-header').css({"position":"static", "padding":"0"});
	  jQuery('aside').css("margin-top","15px");
	  jQuery('.home aside').css("margin-top","60px");
   }
		
	if(jQuery('.page-header').html()=="")
	   jQuery('.page-header').addClass("notitle");     	 
	jQuery('#top-nav li:has(> ul)').addClass('haschild');
	
	jQuery("#top-nav > div > ul  li,#top-nav > div > div > ul  li").hover(function(){
		if(jQuery(this).parents(".container").hasClass("phone") ){return false;}
		jQuery(this).parent("ul").children().removeClass("active");
		jQuery(this).addClass("active");
		jQuery(this).find(">ul").slideDown("fast");

		/*horizontall scroll prevention*/
		{
		  if(jQuery(this).find('ul').eq(0).length){
			open_submenu = jQuery(this).find('ul').eq(0);
			sub_left = open_submenu.offset().left;
			sub_width = open_submenu.width();
			current_left = open_submenu.position().left;
			
			parent_class = function(classname) { 
			  return open_submenu.parent().parent().hasClass(classname);
			}
			
			if(current_left + /*parent_left +*/  sub_left + sub_width > jQuery(window).width()-24 ){
				if(parent_class('sub_shift')){
				  /*parent also shifted*/
				  parent_w = open_submenu.parent().parent().width();
				   open_submenu.addClass('sub_d_shift');
				  open_submenu.css({left:current_left + jQuery(window).width()-24 - parent_w- sub_left - sub_width });  
				}
				else{
				  open_submenu.addClass('sub_shift');
				  open_submenu.css({left:current_left + jQuery(window).width()-24 - sub_left - sub_width });
				}
			}
		  }
		}
		
	},function(){
		if(jQuery(this).parents(".container").hasClass("phone")){return false;}
		jQuery(this).parent("ul").children().removeClass("active");
		jQuery(this).find(">ul").slideUp(100);
		jQuery(".opensub").removeClass("opensub");
	});	

	jQuery("#top-nav > div > ul  li.haschild > a,#top-nav > div > div > ul  li.haschild > a").click(function(){
		if(jQuery(this).parents(".container").hasClass("phone") || jQuery(this).parents(".container").hasClass("tablet")){
		if(jQuery(this).parent().hasClass("open")){
			jQuery(this).parent().parent().find(".haschild ul").slideUp(100);
			jQuery(this).parent().removeClass("open");
			return false;
		}
		jQuery(this).parent().parent().find(".haschild ul").slideUp(100);
		jQuery(this).parent().parent().find(".haschild").removeClass("open");
		jQuery(this).next("ul").slideDown("fast");
		jQuery(this).parent().addClass("open");
		return false;}
		
	});
		
	jQuery("#header .phone-menu-block").on("click","#menu-button-block", function(){
		if(jQuery("#top-nav").hasClass("open")){
			jQuery("#header #top-nav").slideUp("fast");
			jQuery("#top-nav").removeClass("open");
		}
		else{
			jQuery("#header #top-nav").slideDown("slow");
			jQuery("#top-nav").addClass("open");
		}
	});
	
	
	/*##############CATEGORIES TABS####################*/
	jQuery("#wd-horizontal-tabs ul.tabs").width(jQuery("#wd-horizontal-tabs ul.tabs li").length*jQuery("#wd-horizontal-tabs ul.tabs li").width());
	jQuery("#tabs_content").width(jQuery("#tabs_div").width()-32);
	
	/*  HIDE SHOW ARROWS   */
	if (jQuery("#wd-horizontal-tabs ul.tabs").width() < jQuery("#tabs_content").width()) {
	  jQuery("#wd-horizontal-tabs #tabs_content").css("left","0px");
	  jQuery("#tabs_left_arrow").hide();
	  jQuery("#tabs_right_arrow").hide();
	}
	else {
	  jQuery("#wd-horizontal-tabs #tabs_content").css("left","16px");
	  jQuery("#tabs_left_arrow").show();
	  jQuery("#tabs_right_arrow").show();
	}
		
	jQuery("#wd-horizontal-tabs ul.content li:last-of-type").addClass("active");
	jQuery("#wd-horizontal-tabs ul.tabs li:last-of-type").addClass("active");
	var last_child_src = jQuery("#wd-horizontal-tabs ul.tabs li:last-of-type img").attr('src');
	jQuery("#main_img img").attr('src',last_child_src);
	
	jQuery("#wd-horizontal-tabs ul.tabs li a").click(function(){
		jQuery("#wd-horizontal-tabs ul.tabs li").removeClass("active");
		var id=jQuery(this).parent().attr("id").replace("horizontal-tab-","");
		var img_src = jQuery(this).children().attr('src');	
		jQuery(this).parent().addClass("active");
		jQuery("#main_img img").attr('src',img_src);			
		jQuery("#wd-horizontal-tabs ul.content > li.active").css("display","none").removeClass("active");
		jQuery("#horizontal-tabs-content-"+id).fadeIn(600).addClass("active");
	return false;
	});
	
	/*  SCROLL   */
	var mousewheelevt = (/Firefox/i.test(navigator.userAgent)) ? "DOMMouseScroll" : "mousewheel";
	jQuery('#tabs_content').on(mousewheelevt, function(e) {
	  var evt = window.event || e;
	  evt = evt.originalEvent ? evt.originalEvent : evt; 
	  var delta = evt.detail ? evt.detail*(-40) : evt.wheelDelta;
	  if (delta > 0) {
		jQuery("#tabs_left_arrow").trigger('click');
	  }
	  else {
		jQuery("#tabs_right_arrow").trigger('click');
	  }
      e.preventDefault();
	});
	
	/*  SWIPE   */
	if (typeof jQuery().swiperight !== 'undefined') {
	   if (jQuery.isFunction(jQuery().swiperight)) {
		jQuery("#tabs_content").swiperight(function () {
			 jQuery("#tabs_left_arrow").trigger('click');
			 return false;
	   });
	  }
	 }      
	 if (typeof jQuery().swipeleft !== 'undefined') {
		if (jQuery.isFunction(jQuery().swipeleft)) {
		  jQuery("#tabs_content").swipeleft(function () {
			jQuery("#tabs_right_arrow").trigger('click');
			return false;
		  });
		}
	 } 
	
	/*   CLICK   */
	jQuery("#tabs_right_arrow").click( function () {
	  jQuery( "#wd-horizontal-tabs ul.tabs" ).stop(true, false);
	  if (jQuery("#wd-horizontal-tabs ul.tabs").position().left >= -(jQuery("#wd-horizontal-tabs ul.tabs").width() - jQuery("#tabs_content").width())) {
		jQuery("#tabs_left_arrow").css({opacity: 1, filter: "Alpha(opacity=100)",pointerEvents: "initial"});
		if (jQuery("#wd-horizontal-tabs ul.tabs").position().left < -(jQuery("#wd-horizontal-tabs ul.tabs").width() - jQuery("#tabs_content").width() - 117)) {
		  jQuery("#wd-horizontal-tabs ul.tabs").animate({left: -(jQuery("#wd-horizontal-tabs ul.tabs").width() - jQuery("#tabs_content").width())}, 500, 'linear');
		}
		else {
		  jQuery("#wd-horizontal-tabs ul.tabs").animate({left: (jQuery("#wd-horizontal-tabs ul.tabs").position().left - 117)}, 500, 'linear');
		}
	  }
	  window.setTimeout(function(){
		if (jQuery("#wd-horizontal-tabs ul.tabs").position().left == -(jQuery("#wd-horizontal-tabs ul.tabs").width() - jQuery("#tabs_content").width())) {
		  jQuery("#tabs_right_arrow").css({opacity: 0.3, filter: "Alpha(opacity=30)",pointerEvents: "none"});
		}
	  }, 500);
	});
	jQuery("#tabs_left_arrow").click( function () {
	  jQuery( "#wd-horizontal-tabs ul.tabs" ).stop(true, false);
	  if (jQuery("#wd-horizontal-tabs ul.tabs").position().left < 0) {
		jQuery("#tabs_right_arrow").css({opacity: 1, filter: "Alpha(opacity=100)",pointerEvents: "initial"});
		if (jQuery("#wd-horizontal-tabs ul.tabs").position().left > - 117) {
		  jQuery("#wd-horizontal-tabs ul.tabs").animate({left: 0}, 500, 'linear');
		}
		else {
		  jQuery("#wd-horizontal-tabs ul.tabs").animate({left: (jQuery("#wd-horizontal-tabs ul.tabs").position().left + 117)}, 500, 'linear');
		}
	  }
	  window.setTimeout(function(){
		if (jQuery("#wd-horizontal-tabs ul.tabs").position().left == 0) {
		  jQuery("#tabs_left_arrow").css({opacity: 0.3, filter: "Alpha(opacity=30)",pointerEvents: "none"});
		}
	  }, 500);
	});
	
				
});
