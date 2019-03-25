<?php
/*
  * Make theme available for translation.
  * Translations can be filed in the /languages/ directory.
  * If you're building a theme based on nokri, use a find and replace
  * to change ''rane to the name of your theme in all the template files.
  */
load_theme_textdomain( 'nokri', trailingslashit( get_template_directory() ) . 'languages/' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( "title-tag" );
if ( ! isset( $content_width ) ) $content_width = 900;
$args1 = $args2 = array();
add_theme_support( "custom-background", $args1 );
add_theme_support( "custom-header", $args2 );
define( 'NOKRI_ALLOW_EDITING', true );
 posts_nav_link();
 paginate_comments_links();

/* Customize  Excerpt Word Count Lenght */

function nokri_excerpt_length() 
{
	return 20;
}
add_filter('excerpt_length','nokri_excerpt_length');

/* ========================= */
/* Add  Theme Support */
/* ========================= */
add_theme_support('post-thumbnails');
/* 2 coloumn Blog Thumbnail Size */
add_image_size( 'nokri_job_post_single',150,150,true );
/* 100 Thumbnail Size */
add_image_size( 'nokri_job_hundred',100,100,true );
/* Shortcode Home Slider Size */
add_image_size( 'nokri_home_slider',1583,620,true );
/* Shortcode About Us Pic */
add_image_size( 'nokri_about_pic',500,338,true );
/* Candidate Portfolio Small */
add_image_size( 'nokri_cand_small',300,300,true );
/* Candidate Portfolio Large */
add_image_size( 'nokri_cand_large',1000,1000,true );
/* Candidate Portfolio Large */
add_image_size( 'nokri_blog_author',45,45,true );
/* Candidate Portfolio Large */
add_image_size( 'nokri_jobs_map',80,80,true );



// Add Feature Image  Theme Support
add_theme_support('post-formats',array( 'aside', 'gallery', 'link','image','quote ','status','video','audio','chat' ));
add_action( 'after_setup_theme', 'nokri_child_theme_posts_formats', 11 );
function nokri_child_theme_posts_formats(){
 add_theme_support( 'post-formats', array(
    'aside',
    'audio',
    'chat',
    'gallery',
    'image',
    'link',
    'quote',
    'status',
    'video',
    ) );
}	
/* ========================= */
/* Registering Side Bar */
/* ========================= */

function nokri_widgets_init()
{
	register_sidebar(array(
		'name' => esc_html__('Blog sidebar', 'nokri') ,
		'id' => 'blog_sidebar',
		'description' => esc_html__('Widgets in this area will be shown on all posts and pages.', 'nokri') ,
		'before_widget' => '<div id="%1$s" class="widget  search-blog">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-heading">',
		'after_title' => '</div>',
	));
	

	register_sidebar(array(
		'name' => esc_html__('Search sidebar', 'nokri') ,
		'id' => 'search_sidebar',
		'description' => esc_html__('Widgets in this area will be shown on search pages.', 'nokri') ,
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
	
	register_sidebar(array(
		'name' => esc_html__('Candidates sidebar', 'nokri') ,
		'id' => 'candidates_sidebar',
		'description' => esc_html__('Widgets in this area will be shown on search pages.', 'nokri') ,
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
	
	register_sidebar(array(
		'name' => esc_html__('Employer sidebar', 'nokri') ,
		'id' => 'employers_sidebar',
		'description' => esc_html__('Widgets in this area will be shown on search pages.', 'nokri') ,
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
	
	
	
}
add_action('widgets_init', 'nokri_widgets_init');

/*** Registers an editor stylesheet for the theme ****/
function nokri_theme_add_editor_styles() {
    add_editor_style( 'editor.css' );
}
add_action( 'admin_init', 'nokri_theme_add_editor_styles' );

/* register nav menu and footer nav */
register_nav_menus(
    array(
        'main-nav'   => 'Main Navigation',
		'small-nav'  => 'Small Navigation (Support Level 1)',
    )
);