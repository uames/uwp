<?php


class WDWT_homepage_page_class{
	

	public $options;
	
	function __construct(){

		$first_post=array();
		$post_in_array=get_posts( array('posts_per_page' => 1));
		if($post_in_array)
			$first_post=array($post_in_array[0]->ID);
		else
			$first_post=array();
		unset($post_in_array);
		
		$this->options = array(

		"home_middle_description_post_enable" => array(
			"name" => "home_middle_description_post_enable",
			"title" => __("Featured Post", "business-world"),
			'type' => 'checkbox_open',
			"description" => __( "Check box to display featured post", "business-world" ),
			'show' => array("home_middle_description_post"),
			'hide' => array(),
			'section' => 'featured_post', 
			'tab' => 'homepage', 
			'default' => true,
			'customizer'=>array()
			),
		"home_middle_description_post" => array(
			"name" => "home_middle_description_post",
			"title" => __("Featured Post", "business-world"), 
			'type' => 'select',
			"valid_options" => $this->get_posts(),
			"sanitize_type" => "sanitize_text_field",
			"description" => __("Select the single post", "business-world" ),
			'section' => 'featured_post', 
			'tab' => 'homepage', 
			'default' => $first_post,
			'customizer' => array()
			),
		"hide_top_posts" => array(
			"name" => "hide_top_posts",
			"title" => __("Top Posts", "business-world"), 
			'type' => 'checkbox_open',
			"description" => __("Check the box to display top posts section on the homepage.", "business-world"),
			'show' => array("top_post_cat_name", "top_post_desc", "top_post_categories"),
			'hide' => array(),
			'section' => 'top_posts', 
			'tab' => 'homepage', 
			'default' => true,
			'customizer' => array()
		),			
		"top_post_cat_name" => array(
			"name" => "top_post_cat_name",
			"title" => "", 
			'type' => 'text',
			"sanitize_type" => "sanitize_text_field",
			"description" => __("Title of top posts section", "business-world"),
			'section' => 'top_posts', 
			'tab' => 'homepage', 
			'default' => 'Our Location',
			'customizer' => array()
		),
		"top_post_desc" => array(
			"name" => "top_post_desc",
			"title" => "", 
			'type' => 'text',
			"sanitize_type" => "sanitize_text_field",
			"description" => __("Top Posts Description", "business-world"),
			'section' => 'top_posts', 
			'tab' => 'homepage', 
			'default' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames.',
			'customizer' => array()
		),
		"top_post_categories" => array(
			"name" => "top_post_categories",
			"title" => __("Top Posts", "business-world"), 
			'type' => 'select',
			'multiple' => "true",
			"sanitize_type" => "sanitize_text_field",
			"valid_options" => $this->get_categories(),
			"description" => __("Select the categories of top posts.", "business-world"),
			'section' => 'top_posts', 
			'tab' => 'homepage', 
			'default' => array(),
			'customizer' => array()
		),
		"hide_horizontal_tab_posts" => array(
			"name" => "hide_horizontal_tab_posts",
			"title" => __("Horizontal Tab", "business-world"), 
			'type' => 'checkbox_open',
			"description" => __("Check the box to display the horizontal posts tabs section.", "business-world"),
			'show' => array("horizontal_tab_categories"),
			'hide' => array(),
			'section' => 'posts_tabs', 
			'tab' => 'homepage', 
			'default' => true,
			'customizer' => array()
		),	
		"horizontal_tab_categories" => array(
			"name" => "horizontal_tab_categories",
			"title" => "", 
			'type' => 'select',
			'multiple' => "true",
			"sanitize_type" => "sanitize_text_field",
			"valid_options" => $this->get_categories(),
			"description" => __("Select the categories of posts tabs.", "business-world"),
			'section' => 'posts_tabs', 
			'tab' => 'homepage', 
			'default' => array(),
			'customizer' => array()
		),
		"content_posts_enable" => array( 
			"name" => "content_posts_enable",
			"title" => __("Content Posts", "business-world"), 
			'type' => 'checkbox_open',  
			"description" => __("Check the box to display content posts only from specific categories.", "business-world"),
			'show' => array("content_post_categories"),
			'hide' => array(),
			'section' => 'content_posts', 
			'tab' => 'homepage', 
			'default' => true,
			'customizer'=>array()
		),
		"content_post_cat_name" => array(
			"name" => "content_post_cat_name",
			"title" => "", 
			'type' => 'text',
			"sanitize_type" => "sanitize_text_field",
			"description" => __("Title of content posts section", "business-world"),
			'section' => 'content_posts', 
			'tab' => 'homepage', 
			'default' => '',
			'customizer' => array()
		),	
		"content_post_categories" => array(
			"name" => "content_post_categories",
			"title" => "",
			'type' => 'select',
			'multiple' => "true",
			"sanitize_type" => "sanitize_text_field",
			"valid_options" => $this->get_categories(),
			"description" => __("Show posts only from these categories.","business-world"),
			'section' => 'content_posts',
			'tab' => 'homepage',
			'default' => $this->get_categories(),
			'customizer'=>array()
		)
		);
	
	}


	


	private function get_posts(){
		$args= array(
				'posts_per_page'   => 3000,
				'orderby'          => 'post_date',
				'order'            => 'DESC',
				'post_type'        => 'post',
				'post_status'      => 'publish',
				 );

		$posts_array_custom=array();
		$posts_array = get_posts( $args );

		foreach($posts_array as $post){
			$key = $post->ID;
		  $posts_array_custom[$key] = $post->post_title;
		}
		return $posts_array_custom;
	}

	private function get_categories(){
		$args= array(
				'hide_empty' => 0,
				'orderby' => 'name',
				'order' => 'ASC',
			);
		
		$categories_array_custom=array();
		$categories_array = get_categories( $args );

		foreach($categories_array as $category){
		  $categories_array_custom[$category->term_id] = $category->name;
		}
		return $categories_array_custom;
	}

	
}
 