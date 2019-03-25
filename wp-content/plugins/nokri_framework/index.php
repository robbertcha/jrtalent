<?php 
 /**
 * Plugin Name: Nokri Framework
 * Plugin URI: https://themeforest.net/user/scriptsbundle
 * Description: This plugin is essential for the proper theme funcationality.
 * Version: 1.1.0
 * Author: scriptsbundle
 * Author URI: https://themeforest.net/user/scriptsbundle
 * License: GPL2
 * Text Domain: redux-framework
 */
 
	 $my_theme = wp_get_theme();
 	 $myTheme  = strtolower( $my_theme->get( 'Name' ));
     if( $myTheme != 'nokri' && $myTheme != 'nokri child' ) return;
	define('nokri_PLUGIN_FRAMEWORK_PATH', plugin_dir_path(__FILE__));	
	define('nokri_PLUGIN_PATH', plugin_dir_path(__FILE__));	
	define('nokri_PLUGIN_URL', plugin_dir_url(__FILE__));
	define( 'nokri_THEMEURL_PLUGIN', get_template_directory_uri () . '/' );
	define( 'nokri_IMAGES_PLUGIN', nokri_THEMEURL_PLUGIN . 'images/');
	define( 'nokri_CSS_PLUGIN', nokri_THEMEURL_PLUGIN . 'css/');
	
	define('SB_PLUGIN_PATH', plugin_dir_path(__FILE__));	
	
	/* Including CPT*/
	require nokri_PLUGIN_PATH . 'cpt/job-board.php';
	
	/* For Metaboxes  User profile*/
	require nokri_PLUGIN_PATH . 'user_profile/index.php';
	
	/* ------------------------------------------------ */
	/* Plugin Function File */ 
	/* ------------------------------------------------ */
	require nokri_PLUGIN_PATH . 'functions.php';
	
	/* For Redux Framework */
	require nokri_PLUGIN_FRAMEWORK_PATH . '/admin-init.php';

	

add_action( 'admin_enqueue_scripts', 'nokri_framework_scripts' );
function nokri_framework_scripts()
{
	wp_enqueue_style( 'nokri-plugin-css',  plugin_dir_url( __FILE__ ) . 'css/plugin.css' );
	wp_register_script( 'nokriplugin-js',  plugin_dir_url( __FILE__ ) . 'js/plugin.js', false, false, true );
	wp_enqueue_script( 'nokriplugin-js');
}

add_action( 'wp_enqueue_scripts', 'nokri_theme_scripts' );
function nokri_theme_scripts()
{
	wp_register_script( 'nokri-theme-js',  plugin_dir_url( __FILE__ ) . 'js/theme.js', false, false, true );
	wp_enqueue_script( 'nokri-theme-js');
}
// Load text domain
add_action( 'plugins_loaded', 'nokri_framework_load_plugin_textdomain' );
function nokri_framework_load_plugin_textdomain()
{
    load_plugin_textdomain( 'redux-framework', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}

if( get_option( 'nokri' ) == "" )
{
$nokri_option_name	=	'nokri';




/* ====================== */
/*  General Settings */
/* ====================== */






/* ====================== */
/* Header Settings */
/* ====================== */

/* Header Selection */
Redux::setOption($nokri_option_name, 'main_header_style', '1');
/* Top Bar */
Redux::setOption($nokri_option_name, 'top_main_page_bar', false);
/* Top Bar Contact Sorter */
Redux::setOption($nokri_option_name, 'top_bar_sorter1', array('Email'   => 'Support@domain.com','Phone Number' => '+921234567',) );
/* Top Bar Quick Pages*/																
Redux::setOption($nokri_option_name, 'opt_multi_select_top_bar_pages', array('2'));
/* Header 3 Quick Links */ 
Redux::setOption($nokri_option_name, 'opt_multi_select_header_pages', array('2'));
/* Logo Settings */ 
Redux::setOption($nokri_option_name, 'header_logo', array( 'url' => nokri_THEMEURL_PLUGIN . '/images/logo.png')); 





/* ====================== */
/*  Blog Settings         */
/* ====================== */

Redux::setOption($nokri_option_name, 'main_blog_style', 'grid');







/* ====================== */
/* Footer Settings */
/* ====================== */

Redux::setOption($nokri_option_name, 'footer_settings', '');
/* Main Footer Switch */ 
Redux::setOption($nokri_option_name, 'footer_full', false);
/* Footer Selection */
Redux::setOption($nokri_option_name, 'select_footer_layout', '1');
/* Footer Style*/
Redux::setOption($nokri_option_name, 'footer_class', '1');
/* Footer BG Image*/
Redux::setOption($nokri_option_name, 'footer_bg_img',array(
											'background-image'  => get_template_directory_uri () . '/images/bg-patteren.png',
											'background-repeat'  => 'no-repeat', 
											'background-size'    => 'cover', 
											'background-position' => 'center center',
											'background-attachment' => 'fixed') );
/* Footer Logo*/
Redux::setOption($nokri_option_name, 'footer_bg', array( 'url' => nokri_THEMEURL_PLUGIN . '/images/logo.png'));
/* Footer Text Area*/
Redux::setOption($nokri_option_name, 'footer_textarea', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.');
/* Footer Social Icons*/
Redux::setOption($nokri_option_name, 'footer_social_sorter', array(
                   'Face Book'   => 'www.facebook.com',
					'Twitter' => 'www.twitter.com',
					'Instagram' => 'www.Instagram.com',
					'LinkedIn' => 'www.LinkedIn.com',
					'Behance' => 'www.Behance.com',
					'Pintrest' => 'www.Pintrest.com',   											));
/* Main Footer Switch */ 
Redux::setOption($nokri_option_name, 'footer_hot_links_switch', true); 
/* Main Footer Switch */ 
Redux::setOption($nokri_option_name, 'footer_hot_links', 'Hot Links');
/* Footer Hot Links */ 
Redux::setOption($nokri_option_name, 'opt_multi_select_footer_hot_Links', array('2'));
/* Footer Contact Details */ 
Redux::setOption($nokri_option_name, 'foot_contact_section_title', 'Contact Detail');
/* Footer Contact Sorter*/ 
Redux::setOption($nokri_option_name, 'footer_contact_us_sorter', array(
																  'Adress'   => esc_html__( '3rd Floor,Link Arcade BBL, USA.','nokri' ),
                 												  'Email'   => esc_html__('Support@domain.com ','nokri' ),
				 												  'Phone Number' => '+921234567',
                 												  'Time' =>      esc_html__( 'Mon - Sat, 8:00 AM - 6:00 PM','nokri' ), ) );
/* Small Footer Social Sorter*/ 
Redux::setOption($nokri_option_name, 'footer_contact_us_sorter', array(
																  'Face Book'   => 'www.facebook.com',
																  'Twitter' => 'www.twitter.com',
																  'LinkedIn' => 'www.LinkedIn.com',
																  'Google+' => 'www.Google+.com', ) );  

}

function nokri_encodestring($string = '')
{

		$r = urldecode (base64_decode( $string) );	
		return $r;
}


function nokri_add_code( $id, $func )
{
	add_shortcode( $id, $func );
	
}
function nokri_decode( $html )
{
 return base64_decode ( $html ); 
}



// Register metaboxes for Products
add_action( 'add_meta_boxes', 'nokri_meta_box_add' );
function nokri_meta_box_add()
{
    add_meta_box( 'nokri_metaboxes', __('Package Essentials','redux-framework' ), 'nokri_render_meta_product', 'product', 'normal', 'high' );
}
function nokri_render_meta_product( $post )
{
 // We'll use this nonce field later on when saving.
   wp_nonce_field( 'my_meta_box_nonce_product', 'meta_box_nonce_product' );

/* Getting All Job Class*/
$terms = get_terms(array(
'taxonomy' => 'job_class',
'hide_empty' => false,
'parent' => 0,
));
$job_class = '';
foreach ( $terms as $term ) {
$param_name =  'package_job_class_' . $term->term_id;
$job_class .= '<p>'. esc_html($term->name). '&nbsp;' . __('job','redux-framework') .'</p><input type="number" name="'.esc_attr($param_name).'" class="project_meta" placeholder="'.esc_attr__('Must be an integer value.', 'redux-framework' ).'"  value="'.esc_attr( get_post_meta($post->ID, $param_name, true) ).'" id="'.esc_attr($param_name).'" spellcheck="true" autocomplete="off">';



}
 $is_free_val = get_post_meta($post->ID, 'op_pkg_typ',true );
 $is_candidates_search = get_post_meta($post->ID, 'is_candidates_search',true );
?>
<div class="margin_top">
<h3><?php echo __('Is Package Free','redux-framework' ); ?></h3>
<div class="form-field">
    <label for="emp_class_check"><?php echo __("Select Option For Package", "redux-framework"); ?></label>
    <select class="form-control" id="is_pkg_free" name="op_is_pkg_free">
        <option value="1" <?php if($is_free_val == 1) { echo "selected"; } ?> ><?php echo __("Yes", "redux-framework"); ?></option>
        <option value="0" <?php if($is_free_val == 0) { echo "selected"; } ?> ><?php echo __("No", "redux-framework"); ?></option>
     </select>
</div>
</div>
<div class="margin_top">
<p><?php 
echo __('Package Expiry','redux-framework' ); ?></p>
	<input type="text" name="package_expiry_days" class="project_meta" placeholder="<?php echo esc_attr__('Like 30, 40 or 50 but must be an integer value.', 'redux-framework' ); ?>" size="30" value="<?php echo esc_attr( get_post_meta($post->ID, "package_expiry_days", true) ); ?>" id="package_expiry_days" spellcheck="true" autocomplete="off">
    <div><?php echo __( 'Expiry in days, -1 means never experied unless used it.', 'redux-framework' ); ?></div>
</div>
<div class="margin_top">
<?php echo "".($job_class); ?>
</div>


<?php global $nokri; if( isset( $nokri['cand_search_mode'] ) && $nokri['cand_search_mode'] == "2" ) { ?>
<!-- Candidate search feilds Starts -->

<div class="margin_top">
<h3><?php echo __('Is Candidate Search','redux-framework' ); ?></h3>
<div class="form-field">
    <label for="is_candidates_search"><?php echo __("Select Option For Candidate Search", "redux-framework"); ?></label>
    <select class="form-control" id="is_candidates_search" name="is_candidates_search">
        <option value="1" <?php if($is_candidates_search == 1) { echo "selected"; } ?> ><?php echo __("Yes", "redux-framework"); ?></option>
        <option value="0" <?php if($is_candidates_search == 0) { echo "selected"; } ?> ><?php echo __("No", "redux-framework"); ?></option>
     </select>
</div>
</div>



<div class="margin_top">
<h4><?php 
echo __('Number Of Candidate Searches','redux-framework' ); ?></h4>
	<input type="text" name="candidate_search_values" class="project_meta" placeholder="<?php echo esc_attr__('Like 30, 40 or 50 but must be an integer value.', 'redux-framework' ); ?>" size="30" value="<?php echo esc_attr( get_post_meta($post->ID, "candidate_search_values", true) ); ?>" id="candidate_search_values" spellcheck="true" autocomplete="off">
    <div><?php echo __( '-1 means unlimited searches', 'redux-framework' ); ?></div>
</div>

<!-- Candidate search feilds End -->

<?php } ?>

<?php
}
// Saving Metabox data 
add_action( 'save_post', 'nokri_themes_meta_save_product' );
function nokri_themes_meta_save_product( $post_id )
{
  // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
// if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce_product'] ) || !wp_verify_nonce( $_POST['meta_box_nonce_product'], 'my_meta_box_nonce_product' ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;
	
	if( isset( $_POST['package_expiry_days'] ) )
    	 update_post_meta( $post_id, 'package_expiry_days', $_POST['package_expiry_days'] );
		 
		 if( isset( $_POST['op_is_pkg_free'] ) )
    	 update_post_meta( $post_id, 'op_pkg_typ', $_POST['op_is_pkg_free'] );
		
		
			if( isset( $_POST['is_candidates_search'] ) )
    	 update_post_meta( $post_id, 'is_candidates_search', $_POST['is_candidates_search'] );
		 
		 if( isset( $_POST['candidate_search_values'] ) )
    	 update_post_meta( $post_id, 'candidate_search_values', $_POST['candidate_search_values'] );
		
		
		
		
	$terms = get_terms(array( 'taxonomy' => 'job_class', 'hide_empty' => false, 'parent' => 0, ));
	
	$job_class = '';
	foreach ( $terms as $term )
	{
		$param_name =  'package_job_class_' . $term->term_id;
		if( $_POST[$param_name] != "" )
		{
			update_post_meta( $post_id, $param_name, $_POST[$param_name] );	
		}
		
	}

}