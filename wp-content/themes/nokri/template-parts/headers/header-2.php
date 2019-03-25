<?php
global $nokri;
$rtl_class = '';
if(is_rtl())
{
	$rtl_class = "flip";
}
$current_id = get_current_user_id(); 
/* Getting Either Emp Or Cand */
if (get_user_meta($current_id, '_sb_reg_type', true) == '1')
{
	$dp_key = '_sb_user_pic'; 
}
else
{
	$dp_key = '_cand_dp'; 
}
/* Getting Candidate Dp */
if( get_user_meta($current_id, $dp_key, true ) != "" )
{
	$attach_dp_id =	get_user_meta($current_id, $dp_key, true );
	$image_dp_link = wp_get_attachment_image_src( $attach_dp_id, 'nokri_job_hundred' );
}
else 
{
	$image_dp_link[0] =  get_template_directory_uri(). '/images/candidate-dp.jpg';
}
/* Header Logo */
$headerlogo = '';
$logo = '';
if( isset( $nokri['header_logo']['url'] )  && $nokri['header_logo']['url'] != "")
{
	$logo = ( $nokri['header_logo']['url'] );
}
else
{
	$logo  =  get_template_directory_uri() . '/images/logo.png'; 
}
/* Dashboard Page */
$dashboard_id = '';
if((isset($nokri['sb_dashboard_page'])) && $nokri['sb_dashboard_page']  != '' )
{
 $dashboard_id =  ($nokri['sb_dashboard_page']);
}
/* Search Page */
$search_page_layout = '';
if((isset($nokri['search_page_layout'])) && $nokri['search_page_layout']  != '' )
{
 	$search_page_layout =  ($nokri['search_page_layout']);
}
	
/* Post Job Page */
$page_id = '';
if((isset($nokri['sb_post_ad_page'])) && $nokri['sb_post_ad_page']  != '' )
{
	$page_id =  ($nokri['sb_post_ad_page']);
}
/* All Job Page */
$all_jobs = '';
if((isset($nokri['sb_all_job_page'])) && $nokri['sb_all_job_page']  != '' )
{
$all_jobs =  ($nokri['sb_all_job_page']);
}
/* Signin  Page */
$signin = '';
if((isset($nokri['sb_sign_in_page'])) && $nokri['sb_sign_in_page']  != '' )
{
	$signin =  ($nokri['sb_sign_in_page']);
}
/* Signup  Page */
$signup = '';
if((isset($nokri['sb_sign_up_page'])) && $nokri['sb_sign_up_page']  != '' )
{
	$signup =  ($nokri['sb_sign_up_page']);
}
/* Button text Option */
$btn_text = '';
if((isset($nokri['nav_bar_post_btn'])) && $nokri['nav_bar_post_btn']  != '' )
{
 	$btn_text =  ($nokri['nav_bar_post_btn']);
}
/* Button Icon Option */
$btn_icon = '';
if((isset($nokri['nav_bar_post_btn_icon'])) && $nokri['nav_bar_post_btn_icon']  != '' )
{
 	$btn_icon =  ($nokri['nav_bar_post_btn_icon']);
}
/* Button link */
$job_post = '';
if((isset($nokri['nav_bar_post_btn_link'])) && $nokri['nav_bar_post_btn_link']  != '' )
{
	$job_post =  ($nokri['nav_bar_post_btn_link']);
}
/* Candidate Button text Option */
$cand_btn_text = '';
if((isset($nokri['cand_nav_bar_post_btn'])) && $nokri['cand_nav_bar_post_btn']  != '' )
{
 	$cand_btn_text =  ($nokri['cand_nav_bar_post_btn']);
}
/* Candidate Button Icon Option */
$cand_btn_icon = '';
if((isset($nokri['cand_nav_bar_post_btn_icon'])) && $nokri['cand_nav_bar_post_btn_icon']  != '' )
{
 	$cand_btn_icon =  ($nokri['cand_nav_bar_post_btn_icon']);
}
/* Candidate Button link */
$cand_job_post = '';
if((isset($nokri['cand_nav_bar_post_btn_link'])) && $nokri['cand_nav_bar_post_btn_link']  != '' )
{
	$cand_job_post =  ($nokri['cand_nav_bar_post_btn_link']);
}

/* Job Button Check */
$job_button  =  $job_link = '';
if (get_user_meta($current_id, '_sb_reg_type', true) == '1') 
{
   $job_button = esc_html($btn_text);
   $job_link   = ($job_post) ;  
   $bnt_class  = esc_attr($btn_icon);
   
}
else 
{
   $job_button = esc_html($cand_btn_text);
   $job_link   =  $cand_job_post;
   $bnt_class  = esc_attr($cand_btn_icon);
}
$is_map = false;
if(wp_basename(get_page_template()) == 'page-search.php' &&  $search_page_layout == '3')
{
	$is_map = true;
}

/* Dashboard class check */
if(basename(get_page_template()) == 'page-dashboard.php' || $is_map) 
{
	$dashboard_class = 'n-admin-header';
	$dashboard_fluid = '-fluid'; 
}
else
{
	$dashboard_class = 'mega-menu fa-change-black'; 
	$dashboard_fluid = '';
}

/* Dashboard logo  */
if(basename(get_page_template()) == 'page-dashboard.php')
{
	$headerlogo = '';
	$logo  =  get_template_directory_uri() . '/images/logo-dash.png'; 
	if( isset( $nokri['dashborad_header_logo']['url'] )  && $nokri['dashborad_header_logo']['url'] != "")
	{
		$logo = ( $nokri['dashborad_header_logo']['url'] );
	}
}


 ?>
<nav id="menu-1" class="mega-menu <?php echo esc_attr($dashboard_class); ?>">
	<section class="menu-list-items">
    	<div class="container<?php echo esc_attr($dashboard_fluid); ?>">
            <ul class="menu-logo">
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo '<img  src="'.esc_url($logo).'" class="img-responsive" alt="'.esc_attr__("logo", "nokri").'" >'; ?></a>
                </li>
            </ul>
            <ul class="menu-button">
                <?php 
                if ( is_user_logged_in()) { 
                    /* User Icon And Button */
                   if((isset($nokri['user_bar_switch'])) && $nokri['user_bar_switch']  == '1' )
                    {
                         ?>
                       <li class="profile-pic dropdown">
                                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="<?php echo esc_url($image_dp_link[0]); ?>" alt="<?php echo esc_attr__("image", "nokri") ?>" class="img-circle" width="36"><span class="hidden-xs hidden-sm"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo get_the_permalink($dashboard_id); ?>"><i class="fa fa-user"></i><?php echo esc_html__('Dashboard','nokri'); ?></a></li>
                                        <li><a href="<?php echo wp_logout_url( home_url() ); ?>"><i class="fa fa-power-off"></i><?php echo esc_html__('Logout','nokri'); ?></a></li>
                                    </ul>
                                </li>
                                <?Php } ?>
                             <li><a href="<?php echo get_the_permalink($job_link); ?>" class="btn n-btn-flat"><i class="<?php echo esc_attr($bnt_class); ?>"></i><?php echo esc_html($job_button); ?></a></li>
                    <?php } else { ?>
                    <li><a href="<?php echo get_the_permalink($signin); ?>" class="n-login-header"><i class="fa fa-sign-in"></i><?php echo esc_html__('Login','nokri'); ?></a></li>
                    <li><a href="<?php echo get_the_permalink($signup); ?>" class="n-login-header"><i class="fa fa-user-plus"></i><?php echo esc_html__('Register','nokri'); ?></a></li>
                   <li><a href="<?php echo get_the_permalink($job_link); ?>" class="btn n-btn-rounded"><i class="<?php echo esc_attr($bnt_class); ?>"></i><?php echo esc_html($job_button); ?></a></li>
                   <?php } ?>
            </ul>
            <ul class="menu-links">
                <?php echo nokri_themeMenu( 'main-nav'); ?>
            </ul>
        </div>
	</section>
</nav>
<?php
 if(basename(get_page_template()) == 'page-dashboard.php' || $is_map)
  {
	echo '</div>';  
  }
 ?> 
<div class="clearfix"></div>