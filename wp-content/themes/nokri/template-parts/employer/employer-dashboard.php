<?php 
/*  Employer Dashboard */ 
get_header();
global $nokri;
$user_id            = get_current_user_id();
$user_info          = wp_get_current_user();
$user_check         = get_user_meta($user_id, '_sb_reg_type', true);
/* Getting Company Published Jobs */
$args = array(
	'post_type'   => 'job_post',
	'orderby'     => 'date',
	'order'       => 'DESC',
	'author' 	  => $user_id,
	'post_status' => array('publish'),
);
$query     =  new WP_Query( $args ); 
$job_html  =   '';
if ( $query->have_posts() )
{
    $job_id  = array();
	while ( $query->have_posts()  )
	{ 
	    $job_title = '';
		$query->the_post();
		$job_id[]  =  get_the_ID();
	}
	wp_reset_postdata();
$job_ids    = implode(",", $job_id);
global $wpdb;
$query	=	"SELECT * FROM $wpdb->postmeta WHERE post_id IN ($job_ids) AND meta_key like '_job_applied_resume_%' ORDER BY meta_id DESC LIMIT 3";
$applier_resumes    = 	$wpdb->get_results( $query );
$noti_html 			= 	'';
if ( isset ($applier_resumes) && count($applier_resumes) > 0)
{
	$notijobs = true;
	foreach ( $applier_resumes as $resumes ) 
	 {
		 $user_name     = '';
		 $array_data	=	explode( '|',  $resumes->meta_value );
		 $applier	    =	$array_data[0];
		 $user          =   get_user_by( 'id', $applier );
		 $apply_date    =   get_post_meta($resumes->post_id, '_job_applied_date_'.$applier, true);
		 $apply_date	=   date_i18n(get_option('date_format'), strtotime($apply_date));
		 if($user)
		 {
			 $user_name =  $user->display_name;
		 }
		 $noti_html    .=   '<li>
								<div class="notif-single">
										<a href="'.get_author_posts_url($applier).'">'.$user_name.'</a>'." ". esc_html__('Applied To', 'nokri' ).'<a href="'.get_the_permalink($resumes->post_id).'" class="notif-job-title">'." ".get_the_title($resumes->post_id).'</a>
									</div>
									<span class="notif-timing"><i class="icon-clock"></i> '.($apply_date).'</span>
								</li>';
	}
}
}
else
{
	$notijobs = false;
	$noti_html = esc_html__( 'No Notifications', 'nokri' );
}
/* Getting Profile Photo */
$image_link[0] =  get_template_directory_uri(). '/images/candidate-dp.jpg';
if( isset( $nokri['nokri_user_dp']['url'] ) && $nokri['nokri_user_dp']['url'] != "" )
{
	$image_link = array($nokri['nokri_user_dp']['url']);	
}
if( get_user_meta($user_id, '_sb_user_pic', true ) != "" )
{
	$attach_id =	get_user_meta($user_id, '_sb_user_pic', true );
	$image_link = wp_get_attachment_image_src( $attach_id, '' );
}
$tab_data  = '';
if( isset( $_GET['tab-data'] ) && $_GET['tab-data'] != "" )
{
	$tab_data  =  $_GET['tab-data'];
} 
/* Change Col Size*/	
$is_show_section = true;
if( isset($_GET['tab-data']) && ($_GET['tab-data'] == "active-jobs" || $_GET['tab-data'] == "pending-jobs"  || $_GET['tab-data'] == "inactive-jobs"  ||  $_GET['tab-data']  == "resumes-list")  )
{
	$dashboardclass = 'col-md-10 col-sm-12 col-xs-12';
	$is_show_section = false;
}
else
{
	$dashboardclass = 'col-lg-7 col-md-6 col-sm-12 col-xs-12 col-lg-pull-3 col-md-pull-2';
}
/* top bar class check */
$top_bar_class = 'no-topbar';
if((isset($nokri['header_top_bar'])) && $nokri['header_top_bar']  == 1 )
{
	$top_bar_class = '';
}
/*Socail links */
$emp_fb        = get_user_meta($user_id, '_emp_fb', true);
$emp_google    = get_user_meta($user_id, '_emp_google', true);
$emp_twitter   = get_user_meta($user_id, '_emp_twitter', true);
$emp_linkedin  = get_user_meta($user_id, '_emp_linked', true);
/* Emp dashboard text */
$user_profile_dashboard_txt = ( isset($nokri['user_profile_dashboard_txt']) && $nokri['user_profile_dashboard_txt'] != ""  ) ? $nokri['user_profile_dashboard_txt'] : "";
?> 
<section class="dashboard-new <?php echo esc_attr($top_bar_class); ?>">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                    <div class="col-lg-2 col-md-1 col-sm-2 col-xs-12 nopadding">
                     <div class="profile-menu">
                     <div class="menu-avtr-box">
                                	<div class="user-img">
                                    	<img src="<?php echo esc_url($image_link[0]); ?>" class="img-responsive" alt="<?php echo esc_html__( 'image', 'nokri' ); ?>">
                                    </div>
                                    <div class="user-text">
                                    	<h4><?php echo esc_html( $user_profile_dashboard_txt); ?></h4>
                                        <p><?php echo esc_html__( 'Welcome back', 'nokri' ); ?></p>
                                    </div>
                                </div>
                        <a href="javascript:void(0)" class="menu-dashboard"> <i class="ti-menu-alt"></i></a>
                        <ul id="accordion" class="accordion">
                          <li>
                             <a href="<?php echo get_the_permalink(); ?>"> <span class="fa fa-dashboard"></span><?php echo esc_html__( 'Dashboard', 'nokri' ); ?></a>
                          </li>
                          <li>
                            <a href="<?php echo get_the_permalink(); ?>?tab-data=edit-profile"> <span class="fa fa-list"></span><?php echo esc_html__( 'Update Profile', 'nokri' ); ?></a>
                          </li>
                          <li>
                            <a href="<?php echo esc_url(get_author_posts_url($user_id)); ?>"> <span class="fa fa-user"></span><?php echo esc_html__( 'View My Profile', 'nokri' ); ?></a>
                          </li>
                          <li>
                            <div class="profile-menu-link">
                              <span class="fa fa-file-archive-o"></span><?php echo esc_html__( 'My Jobs', 'nokri' ); ?><i class="fa fa-angle-down"></i>
                            </div>
                            <ul class="submenu">
                              <li><a href="<?php echo get_the_permalink(); ?>?tab-data=active-jobs"><?php echo esc_html__( ' Active Jobs', 'nokri' ); ?></a></li>
                              <li><a href="<?php echo get_the_permalink(); ?>?tab-data=inactive-jobs"><?php echo esc_html__( ' In-Active Jobs', 'nokri' ); ?></a></li>
                              <li><a href="<?php echo get_the_permalink(); ?>?tab-data=pending-jobs"><?php echo esc_html__( 'Pending Jobs', 'nokri' ); ?></a></li>
                            </ul>
                          </li>
                          <li>
                            <div class="profile-menu-link">
                              <span class="fa fa-envelope-o"></span><?php echo esc_html__( 'Email Templates', 'nokri' ); ?><i class="fa fa-angle-down"></i>
                            </div>
                            <ul class="submenu">
                              <li><a href="<?php echo get_the_permalink(); ?>?tab-data=email-templates"><?php echo esc_html__( 'Add Email Template', 'nokri' ); ?></a></li>
                              <li><a href="<?php echo get_the_permalink(); ?>?tab-data=email-templates-list"><?php echo esc_html__( 'Email Templates', 'nokri' ); ?></a></li>
                            </ul>
                          </li>
                          <li>
                            <a href="<?php echo get_the_permalink(); ?>?tab-data=our-followers"> <span class="fa fa-users"></span><?php echo esc_html__( ' Followers', 'nokri' ); ?></a>
                          </li>
                          <li>
                            <a href="<?php echo get_the_permalink(); ?>?tab-data=my-packages"> <span class="fa fa-file-archive-o"></span><?php echo esc_html__( 'My Package', 'nokri' ); ?></a>
                          </li>
                          <li>
                            <a href="<?php echo get_the_permalink(); ?>?tab-data=my-orders"> <span class="fa fa-file-text-o"></span><?php echo esc_html__( 'My Orders', 'nokri' ); ?></a>
                          </li>
                          <li>
                            <a href="<?php echo wp_logout_url( home_url() ); ?>"><span class="fa fa-sign-out"></span><?php echo esc_html__( ' Logout', 'nokri' ); ?></a>
                          </li>
                        </ul>
                    </div>
                </div>
                <?php if( $is_show_section ) { ?>
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-lg-push-7 col-md-push-7 nopadding" id="dashboard-bar-right">
                    <div class="theiaStickySidebar">
                    	<div class="main-profile-card">
                        <div class="contact-box">
                            <div class="contact-img">
                                <img src="<?php echo esc_url($image_link[0]); ?>" id="emp_dp" class="img-responsive" alt="<?php echo esc_html__( 'image', 'nokri' ); ?>">
                            </div>
                            <div class="contact-caption">
                                <h4><?php echo the_author_meta( 'display_name', $user_id ); ?></h4>
                                <span><?php echo get_user_meta($user_id, '_user_headline', true); ?></span>
                            </div>
                            <ul class="social-links list-inline">
                     <?php if($emp_fb) { ?>
                        <li> <a href="<?php echo esc_url($emp_fb); ?>" target="_blank"><img src="<?php echo get_template_directory_uri();?>/images/icons/006-facebook.png" alt="<?php echo esc_html__( 'icon', 'nokri' ); ?>"></a></li>
						<?php } if($emp_google) { ?>
                        <li> <a href="<?php echo esc_url($emp_google); ?>" target="_blank"><img src="<?php echo get_template_directory_uri();?>/images/icons/003-google-plus.png" alt="<?php echo esc_html__( 'icon', 'nokri' ); ?>"></a></li>
                        <?php } if($emp_twitter) { ?>
                        <li> <a href="<?php echo esc_url($emp_twitter); ?>" target="_blank"><img src="<?php echo get_template_directory_uri();?>/images/icons/004-twitter.png" alt="<?php echo esc_html__( 'icon', 'nokri' ); ?>"></a></li>
                        <?php } if($emp_linkedin) { ?>
                        <li> <a href="<?php echo esc_url($emp_linkedin); ?>" target="_blank"><img src="<?php echo get_template_directory_uri();?>/images/icons/005-linkedin.png" alt="<?php echo esc_html__( 'icon', 'nokri' ); ?>"></a></li>
                        <?php }  ?>
                     </ul>
                        </div>
                        <div class="notification-area">
                            <h4> <?php echo esc_html__( 'Recent Notifications', 'nokri' ); ?></h4>
                            <div class="notif-box">
                                <ul>
										<?php echo ($noti_html); ?>
                                    <li>
                                    <?php if(isset($notijobs) && $notijobs) { ?>
                                        <div class="notif-single">
                                            <a href="<?php echo get_the_permalink(); ?>?tab-data=resume-notification"><?php echo esc_html__( 'View all notifications', 'nokri' ); ?> </a>
                                        </div>
                                        <?php } ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
					<?php } ?>
                <div class="<?php echo  esc_attr($dashboardclass); ?>">
                <?php  
                    if( $tab_data != "" )
                    {
                        get_template_part( 'template-parts/employer/employer', $tab_data );
                    }
                    else
                    {
                        get_template_part( 'template-parts/employer/index', $tab_data );
                    }
                 ?>
                </div>
            </div>
        </div>
    </div>
</section>