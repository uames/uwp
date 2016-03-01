<?php

class WDWT_general_settings_page_class{
  
  public $options;

  
  
  function __construct(){
  
    $this->options = array( 

      'custom_css_enable' => array( 
        'name' => 'custom_css_enable', 
        'title' => __( 'Custom CSS', "business-world" ), 
        'type' => 'checkbox_open', 
        'description' => __( 'Custom CSS will change the visual style of the website. The CSS code provided here can be applied to any page or post.', "business-world" ), 
        'show' => array('custom_css_text'),
        'hide' => array(),
        'section' => 'general_main', 
        'tab' => 'general', 
        'default' => false,
        'customizer' => array()
      ), 
      'custom_css_text' => array( 
        'name' => 'custom_css_text', 
        'title' => '', 
        'type' => 'textarea', 
        'sanitize_type' => 'css', 
        'description' => __( 'Provide the custom CSS code below.', "business-world" ), 
        'section' => 'general_main',  
        'tab' => 'general', 
        'default' => '',
        'customizer' => array()      
      ),
      'logo_type' => array(
        "name" => "logo_type", 
        "title" => __("Logo type", "business-world"), 
        'type' => 'radio_open', 
        "description" => "", 
        'valid_options' => array(
              'none' => __('None', "business-world" ), 
              'image' => __('Image', "business-world" ), 
              'text' => __('Site Title', "business-world" ), 
        ),
        'show' => array('image'=>'logo_img'),
        'hide' => array(),
        'section' => 'general_main', 
        'tab' => 'general', 
        'default' => 'image',
        'customizer' => array()  
      ),
      'logo_img' => array(
        'name' => 'logo_img', 
        'title' => __( 'Logo', "business-world" ), 
        "sanitize_type" => "esc_url_raw",
        'type' => 'upload_single', 
        'description' => __( 'Upload custom logo image.', "business-world" ), 
        'section' => 'general_main',  
        'tab' => 'general', 
        'default' => WDWT_IMG.'logo.png' ,
        'customizer' => array()           
      ),
      'display_tagline' => array( 
        "name" => "display_tagline", 
        "title" => __("Display site tagline", "business-world"), 
        'type' => 'checkbox', 
        "description" => "",
        'section' => 'general_main',  
        'tab' => 'general', 
        'default' => false,
        'customizer' => array()  
      ),
         
      'blog_style' => array(
        'name' => 'blog_style', 
        'title' =>  __( 'Blog Style post format', "business-world" ), 
        'type' => 'checkbox', 
        'description' => __( 'Show only excerpts of posts in index page.', "business-world" ), 
        'section' => 'general_main', 
        'tab' => 'general', 
        'default' => true,
        'customizer' => array()           
      ), 
      'grab_image' => array(
        'name' => 'grab_image', 
        'title' =>  __( 'Grab the first post image', "business-world" ), 
        'type' => 'checkbox', 
        'description' => __( 'Enable this option if you want to use the images that are already in your post to create a thumbnail without using custom fields. In this case thumbnail images will be generated automatically using the first image of the post. Note that the image needs to be hosted on your own server.', "business-world" ), 
        'section' => 'general_main',  
        'tab' => 'general', 
        'default' => false,
        'customizer' => array()          
      ),  
      
      'date_enable' => array(
        "name" => "date_enable", 
        "title" => __("Display post meta information","business-world"), 
        'type' => 'checkbox',
        "description" => __("Choose whether to display the post meta information such as date, author and etc.", "business-world"),
        'section' => 'general_main',  
        'tab' => 'general', 
        'default' => true,
        'customizer' => array()         
      ),
      'footer_text_enable' => array(
        "name" => "footer_text_enable", 
        "title" => __("Information in the Footer", "business-world"), 
        'type' => 'checkbox_open', 
        "description" => __("Check the box to display custom HTML for the footer.", "business-world"),
        'section' => 'general_main',  
        'show' => array('footer_text'),
        'hide' => array(),
        'tab' => 'general', 
        'default' => true,
        'customizer' => array()  
      ),
      'footer_text' => array( 
        "name" => "footer_text", 
        "title" =>"", 
        'type' => 'textarea', 
        "sanitize_type" => "sanitize_footer_html_field", 
        'width' => '450',
        'height' => '200',
        "description" => __("Here you can provide the HTML code to be inserted in the footer of your web site.", "business-world"),
        
        'section' => 'general_main', 
        'tab' => 'general', 
        'default' => 'Copyright &copy; 2015. WordPress Themes by <a href="'.WDWT_HOMEPAGE.'"  target="_blank" title="Web-Dorado">Web-Dorado</a>',
        'customizer' => array()  
      ),
      'twitter_icon_show' => array(
        "name" => "twitter_icon_show", 
        "title" => __("Show Twitter Icon", "business-world"), 
        'type' => 'checkbox_open', 
        "description" => "",
        'show' => array('twitter_url'),
        'hide' => array(),
        'section' => 'general_links',  
        'tab' => 'general', 
        'default' => true ,
        'customizer' => array()    
      ),      
      'twitter_url' => array( 
        "name" => "twitter_url", 
        "title" => __("Enter your Twitter profile URL below.", "business-world"), 
        'type' => 'text', 
        "sanitize_type" => "esc_url_raw", 
        "description" => "", 
        'section' => 'general_links', 
        'tab' => 'general',
        'default' => '#' ,
        'customizer' => array()     
      ),   
      
      'facebook_icon_show' => array(
        "name" => "facebook_icon_show", 
        "title" => __("Show Facebook Icon", "business-world"), 
        'type' => 'checkbox_open', 
        "description" => "",
        'show' => array('facebook_url'),
        'hide' => array(),
        'section' => 'general_links', 
        'tab' => 'general', 
        'default' => true ,
        'customizer' => array()  
      ),      
      'facebook_url' => array(
        "name" => "facebook_url", 
        "title" => __("Enter your Facebook Profile URL.", "business-world"), 
        'type' => 'text', 
        "sanitize_type" => "esc_url_raw",         
        'section' => 'general_links', 
        'tab' => 'general', 
        'default' => '#' ,
        'customizer' => array()  
      ),      
      'google_icon_show' => array( 
        "name" => "google_icon_show", 
        "title" => __("Show Google+ Icon", "business-world"), 
        'type' => 'checkbox_open', 
        "description" => "", 
        'section' => 'general_links', 
        'show' => array('google_url'),
        'hide' => array(),
        'tab' => 'general', 
        'default' => true ,
        'customizer' => array()  
      ), 
      'google_url' => array( 
        "name" => "google_url", 
        "title" => __("Enter your Google+ Profile URL.", "business-world"), 
        'type' => 'text', 
        "sanitize_type" => "esc_url_raw", 
        'section' => 'general_links', 
        'tab' => 'general', 
        'default' => '#',
        'customizer' => array()
      ),      
      'show_rss_icon' => array( 
        "name" => "show_rss_icon", 
        "title" => __("Show RSS Icon", "business-world"), 
        'type' => 'checkbox_open', 
        "description" => "", 
        'section' => 'general_links', 
        'show' => array('rss_url'),
        'hide' => array(),
        'tab' => 'general', 
        'default' => true ,
        'customizer' => array()  
      ), 
      'rss_url' => array( 
        "name" => "rss_url", 
        "title" => __("Enter your RSS URL.", "business-world"), 
        'type' => 'text', 
        "sanitize_type" => "esc_url_raw", 
        'section' => 'general_links', 
        'tab' => 'general', 
        'default' => '#',
        'customizer' => array()
      ), 
    );


    if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {

        $this->options['favicon_enable'] = array(
          'name' => 'favicon_enable',
          'title' => __( 'Show Favicon', "business-world" ),
          'type' => 'checkbox_open',
          'show' => array("favicon_img"),
          'hide' => array(),
          'description' => __( 'Check the box to display custom favicon if your version of WordPress does not support it.', "business-world" ),
          'section' => 'general_main',
          'tab' => 'general',
          'default' => false,
          'customizer' => array() 
          );

        $this->options['favicon_img'] = array(
          'name' => 'favicon_img',
          'title' => '',
          'type' => 'upload_single',
          "sanitize_type" => "esc_url_raw",
          'valid_options' => '',
          'description' => __( 'Click on the Upload Image button to upload the favicon image.', "business-world" ),
          'section' => 'general_main',
          'tab' => 'general',
          'default' => '',
          'customizer' => array() 
          );
        }

  
    
    
  }

  
  
  

}