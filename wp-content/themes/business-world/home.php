<?php get_header(); 
global  $wdwt_front;

$hide_top_posts = $wdwt_front->get_param('hide_top_posts');
$top_post_categories = $wdwt_front->get_param('top_post_categories');
$top_post_cat_name = $wdwt_front->get_param('top_post_cat_name');
$top_post_desc = $wdwt_front->get_param('top_post_desc');
 if( 'posts' == get_option( 'show_on_front' ) ){ 
	  Business_world_frontend_functions::home_about_us();
	  Business_world_frontend_functions::location_posts($hide_top_posts,$top_post_categories,$top_post_cat_name,$top_post_desc);
 } ?>
</header>

<div class="container clear-div">
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
		<aside id="sidebar1" >
			<div class="sidebar-container clear-div">			
				<?php  dynamic_sidebar( 'sidebar-1' ); 	?>
			</div>
		</aside>
	<?php } ?>
	
	<?php
	if( 'posts' == get_option( 'show_on_front' ) ){
		?>
		<div id="blog" class="clear-div">
		<?php
		Business_world_frontend_functions:: horizontal_tab();          
		Business_world_frontend_functions:: content_posts();
		?>
		</div>
		<?php
	}	
	elseif('page' == get_option( 'show_on_front' )){
		
		Business_world_frontend_functions:: content_posts_for_home();
	}	
	?>		
	
   <?php 
	   if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
		<aside id="sidebar2">
			<div class="sidebar-container clear-div">
			  <?php  dynamic_sidebar( 'sidebar-2' ); 	?>
			</div>
		</aside>
   <?php } ?>
</div>

<?php get_footer(); ?>
