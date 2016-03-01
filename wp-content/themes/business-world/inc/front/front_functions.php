<?php

/* include  fornt end framework class */
require_once('WDWT_front_functions.php');

class Business_world_frontend_functions extends WDWT_frontend_functions{


  public static function posted_on() {
	printf( __( '<span class="sep date"></span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>', "business-world" ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
  } 

  public static function posted_on_single() {
	printf( __( '<span class="sep date"></span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="by-author"> <span class="sep author"></span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', "business-world" ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', "business-world" ), get_the_author() ) ),
		get_the_author()
	);
 }




  
public static function home_about_us() {

global $wdwt_front;

$hide_about_us = $wdwt_front->get_param('home_middle_description_post_enable');
$home_abaut_us_post = $wdwt_front->get_param('home_middle_description_post');

if(isset($home_abaut_us_post[0]))
   $abaut_us_post=get_post($home_abaut_us_post[0]);

if($abaut_us_post!=NULL)
   $abaut_us_meta_date = get_post_meta($abaut_us_post->ID,WDWT_META,TRUE);
   if($hide_about_us==true && $abaut_us_post!=NULL) 
   { ?>
    <div id="top-page">
      <div class="container">
        <div class="featured-content clear-div">
          <?php
          if($home_abaut_us_post) {           
            $attr_thumb = array(
              'class' => "abaut_us_post",
            );
            if(has_post_thumbnail() || (self::post_image_url() && $wdwt_front->blog_style() && $wdwt_front->grab_image())) { ?>
              <div class="home_about_us-thumb image-thumb">
                 <?php echo self::fixed_thumbnail(300,250,$wdwt_front->grab_image(),$abaut_us_post->ID); ?>
              </div>   
            <?php } ?>
            <h2><a href="<?php echo get_permalink($abaut_us_post->ID) ?>"><?php echo $abaut_us_post->post_title ?></a></h2>
            <p>
               <?php self::the_excerpt_max_charlength(400,$abaut_us_post->post_content);          ?>
            </p>
          <?php } ?>
        </div>      
      </div>
    </div>
  <?php }
}


public static function location_posts($hide_option,$categories,$categ_name,$categ_desc){
$categories = implode(',', $categories);

 if ($hide_option == true && $categories!='') {
?>    
    <div id="top-posts">
    <?php 
        $wp_query = new WP_Query("posts_per_page=4&cat=".$categories."&orderby=date&order=DESC");
        $curent_query_posts=$wp_query->get_posts();
        if(!isset($curent_query_posts[0]))
          $curent_query_posts[0]='';
        
        unset($curent_query_posts);
         ?>
      <div class="">
        <h2><?php echo esc_html($categ_name); ?></h2>
        <p class="top-desc"><?php echo $categ_desc ?></p>
        <div id="top-posts-scroll">
          
    
          <div class="top-posts-wrapper">
            <div class="top-posts-block">
              <ul id="top-posts-list">
                
                <?php if($wp_query->have_posts()) {
                    $i = 0;
                  while ($wp_query->have_posts()) {
                    $i++;
                    $wp_query->the_post();
                    $url = wp_get_attachment_url( get_post_thumbnail_id() );
                if($url!=""){
                  ?>
                <li style="background-image:url(<?php echo $url;?>);" id="top_post_<?php echo $i; ?>">
                  
                    <div class="top-post-img"></div>
                    <div class="top-post-caption">
                       <div class="caption-content">
                      <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                      <p><?php self::the_title_max_charlength(60); ?></p>
                      <a href="<?php the_permalink(); ?>"><p class="caption-more"><?php echo __("more info","business-world"); ?></p></a>
                     </div> 
                    </div>                        
                  
                  
                  
                </li>
                <?php } } } ?>
                
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php }
}



public static function horizontal_tab(){
global $post,$wdwt_front;
$hide_horizontal_tab_posts = $wdwt_front->get_param('hide_horizontal_tab_posts', false);
$horizontal_tab_categories = implode(',', $wdwt_front->get_param('horizontal_tab_categories', false));
$grab_image = $wdwt_front->grab_image();

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
 if ($hide_horizontal_tab_posts  == true && $horizontal_tab_categories!=''){ ?>
<div id="wd-horizontal-tabs" class="">
    <div id="main_img">
        <img src="">
  </div>
  <div id="tabs_div">
      <div id="tabs_left_arrow" class="tabs_arrow"><
    </div>
    <div id="tabs_content">
      <ul class="tabs clear-div">
      <?php $h_tab_wp_query = new WP_Query('posts_per_page=100&cat='.$horizontal_tab_categories);
        while ($h_tab_wp_query->have_posts()) : $h_tab_wp_query->the_post();    ?>
          <li  id="horizontal-tab-<?php echo $post->ID; ?>" class="image-thumb">
            <a href="#<?php echo $post->ID; ?>">
              <?php echo self::fixed_thumbnail(250,230,true); ?>
            </a>
          </li>
        <?php endwhile; ?>
      </ul>
    </div>
    <div id="tabs_right_arrow" class="tabs_arrow">>
    </div>
  </div>
    <div class="cont_horizontal_tab">    
     <ul class="content">
    <?php 
        $i=0;
    while ($h_tab_wp_query->have_posts()) : $h_tab_wp_query->the_post();
      $i++; ?>
      <li  <?php if($i==1) echo "class='active'"; ?> id="horizontal-tabs-content-<?php echo $post->ID; ?>">
          <a href="<?php echo get_permalink(); ?>"><?php echo self::the_excerpt_max_charlength(300); ?></a>
        
      </li>
    <?php endwhile; ?>
    </ul>
    </div>  
</div>
<?php
}

}

public static function content_posts_for_home() {
global $post,$wp_query,$wdwt_front;
$grab_image = $wdwt_front->grab_image();
if(is_home()){    
?><div id="blog" class="blog content-inner-block blog-posts-page">
    
    <div class="blog-post content-posts clear-div">
<?php
   if(have_posts()) { 
      while (have_posts()) {
        the_post();
        $business_world_meta_date = get_post_meta($post->ID,WDWT_META,TRUE); ?>
        
        <div class='content-post'>
            <?php if(has_post_thumbnail() || (self::post_image_url() && $grab_image)) { ?>
            <div class="content-thumb image-thumb">
               <?php echo self::fixed_thumbnail(70,70,$grab_image); ?>
            </div>   
          <?php
            $thumb_class="thumb-class";
          }else{
            $thumb_class="";
          } ?>
          <span class="date <?php echo $thumb_class; ?>"><?php echo get_the_date(); ?></span>
          <h3><a href="<?php echo get_permalink() ?>"><?php the_title(); ?></a></h3>
          <p> 
            <?php self::the_excerpt_max_charlength(200);  ?>
          </p>
          <a class="read_more" href="<?php echo get_permalink(); ?>"><?php echo __('More info',"business-world");?></a>
        </div>
        <?php 
        }
        if( $wp_query->max_num_pages > 1 ){ ?>
          <div class="page-navigation">
            <?php posts_nav_link(); ?>
          </div>     
        <?php }
        
        }
        wp_reset_query(); ?>      
      </div>
    </div>  
 <?php }else{ ?>
         <div>
        <?php  if(have_posts()) : while(have_posts()) : the_post(); ?>
      <div class="single-post">
       <h2  class="page-header"><?php the_title(); ?></h2>
       <div class="entry"><?php the_content(); ?></div>
      </div>
    <?php endwhile; ?>
       <div class="navigation">
        <?php posts_nav_link(" "); ?>
       </div>

    <?php endif;  ?>
     <div class="clear"></div>
     <?php
        if(comments_open())
        {  ?>
          <div class="comments-template">
            <?php echo comments_template(); ?>
          </div>
      
      <?php }  ?> 
       </div>
 
 <?php 
 }
      
}     
      
      
public static function content_posts() {

global $post,$wdwt_front;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$content_posts_enable = $wdwt_front->get_param('content_posts_enable', array(), true); 
if($content_posts_enable){
  $cat_checked = implode(',',$wdwt_front->get_param('content_post_categories', array(), array()));         
}
else{
  $cat_checked  = '';
}

       
$grab_image = $wdwt_front->grab_image();        
$content_post_cat_name = $wdwt_front->get_param('content_post_cat_name');        

$n_of_home_post=get_option( 'posts_per_page', 3 );  ?>
  
    <div class="content-inner-block home-page clear-div">
      
      <?php
      $args = array(
        'posts_per_page'=>$n_of_home_post,
        'cat' => $cat_checked,
        'paged' => $paged,
        'order' => 'DESC'
        );
        $wp_query = new WP_Query($args);  ?>
      <div class="blog-post content-posts">
        <h2><?php echo esc_html($content_post_cat_name); ?></h2>
        <div class="content-posts-container">
      <?php 
         if(have_posts()) { 
          while ($wp_query->have_posts()) {
            $wp_query->the_post();
            $business_world_meta_date = get_post_meta($post->ID,WDWT_META,TRUE);    ?>        
          <div class='content-post'>
            <?php if(has_post_thumbnail() || (self::post_image_url() && $grab_image)) { ?>
              <div class="content-thumb image-thumb">
                 <?php echo self::fixed_thumbnail(70,70,$grab_image); ?>
              </div>   
            <?php
            $thumb_class="thumb-class";
            }else{
              $thumb_class="";
            } ?>
            <span class="date <?php echo $thumb_class; ?>"><?php echo get_the_date(); ?></span>
            <h3><a href="<?php echo get_permalink() ?>"><?php the_title(); ?></a></h3>
            <p> 
              <?php self::the_excerpt_max_charlength(200);  ?>
            </p>
            <a class="read_more" href="<?php echo get_permalink(); ?>"><?php echo __('More info',"business-world");?></a>
          </div>
          <?php } }?>
        </div>
      </div>
     <?php  if( $wp_query->max_num_pages > 1 ){ ?>
        <div class="gallery-page-navigation page-navigation clear-div">
          <div class="navigation-previous">
          <?php previous_posts_link( __('Previous Page',"business-world") , $wp_query->max_num_pages ); ?>
          </div>
          <div class="navigation-next">
          <?php  next_posts_link( __('Next Page',"business-world") , $wp_query->max_num_pages ); ?>
          </div>
        </div>
      <?php }  ?>
     <div class="clear"></div>
    </div>
    <?php 
    
    
    wp_reset_postdata(); 
      
}   



  

  public static function entry_meta() {
	$categories_list = get_the_category_list(', ' );
	echo '<div class="entry-meta-cat">';
	if ( $categories_list ) {
		echo '<span class="categories-links"><span class="sep category"></span> ' . $categories_list . '</span>';
	}
	$tag_list = get_the_tag_list( '', ' , ' );
	if ( $tag_list ) {
		echo '<span class="tags-links"><span class="sep tag"></span>' . $tag_list . '</span>';
	}
	echo '</div>';
  }


  

}



