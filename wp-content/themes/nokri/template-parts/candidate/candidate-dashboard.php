<?php
/*  Candidate Dashboard */ 
global $nokri;
$user_info    = wp_get_current_user();
$user_crnt_id = $is_candidate = $user_info->ID;
$ad_mapLocation      =  '';
$ad_mapLocation      =  get_user_meta($user_crnt_id, '_cand_address', true);
$ad_map_lat	         =  get_user_meta($user_crnt_id, '_cand_map_lat', true);
$ad_map_long	     =  get_user_meta($user_crnt_id, '_cand_map_long', true); 
$cand_video	         =  get_user_meta($user_crnt_id, '_cand_video', true); 
$job_qualifications	 =  get_user_meta($user_crnt_id, '_cand_last_edu', true);
nokri_load_search_countries(1);
/* Getting Candidate Dp */
$image_dp_link[0] =  get_template_directory_uri(). '/images/candidate-dp.jpg';
if( isset( $nokri['nokri_user_dp']['url'] ) && $nokri['nokri_user_dp']['url'] != "" )
	{
		$image_dp_link = array($nokri['nokri_user_dp']['url']);	
	}
if( get_user_meta($user_crnt_id, '_cand_dp', true ) != "" )
{
	$attach_dp_id    =	get_user_meta($user_crnt_id, '_cand_dp', true );
	$image_dp_link   =  wp_get_attachment_image_src( $attach_dp_id, 'nokri_job_hundred');
}
$candidate_page  = '';
if( isset( $_GET['candidate-page'] ) && $_GET['candidate-page'] != "" )
{
	 $candidate_page  =  $_GET['candidate-page'];
} 
 else
 {
 }
 /* Getting Profile Percentage*/
$profile_percent = 10;
$cand_pesonal 	 = get_user_meta($user_crnt_id, '_cand_intro', true);
if ($cand_pesonal )
{
	 $profile_percent = $profile_percent + 23;
}
$cand_education = get_user_meta($user_crnt_id, '_cand_education', true); 
if ( $cand_education  && $cand_education[0]['degree_name'] != '' ) 
{
	$profile_percent = 33 + $profile_percent;
}
$cand_profession	= get_user_meta($user_crnt_id, '_cand_profession', true);
if ( $cand_profession  && $cand_profession[0]['project_organization'] != '' )
{
	$profile_percent = 34 + $profile_percent;
}
if($profile_percent != '')
{
	update_user_meta( $user_crnt_id, '_cand_profile_percent', $profile_percent);
}
/* Candidate Job Notifiactions */
$query            = array('post_type' => 'job_post','post_status' => 'publish','posts_per_page' => 3,'orderby' => 'date','order' => 'DESC');  
$loop             = new WP_Query($query);
$notification     = '';
while ( $loop->have_posts() ) 
{ 
	$loop->the_post();
	$job_id         =  	get_the_ID();
	$post_author_id =  	get_post_field( 'post_author', $job_id );
	$company_name   = 	get_the_author_meta( 'display_name', $post_author_id ); 
	$job_skills     =   wp_get_post_terms($job_id, 'job_skills', array("fields" => "ids"));
	$cand_skills	= 	get_user_meta($user_crnt_id, '_cand_skills', true);
	if (is_array($job_skills) && is_array($cand_skills))
	{
		$final_array = array_intersect($job_skills, $cand_skills);
		if (count($final_array) > 0) 
		{
			
			$notification .= '<li>
								<div class="notif-single">
									<a href="'. esc_url(get_author_posts_url(get_the_author_meta('ID'))).'">'.esc_html($company_name). " " .'</a>'.esc_html__('Posted','nokri').'<a href="'.get_the_permalink($job_id).'" class="notif-job-title">'." ".get_the_title().'</a>
								</div>
								<span class="notif-timing"><i class="icon-clock"></i>'.nokri_time_ago().'</span>
							</li>'; 
		}
	}
}
wp_reset_postdata();
/* Candidate Job Notifiactions End */
if( isset( $_GET['candidate-page'] ) && $_GET['candidate-page'] == "my-profile" )
{
	$dashboardclass  = 'candidate-resume-page';
	$conatainerclass = '';
}
else
{
	$dashboardclass = 'dashboard-new candidate-dashboard';
	$conatainerclass = '-fluid';
}
 /* Transparent header dashboard class */
  $transparent_header_class = '';
 $stick_right_bar =  'id="dashboard-bar-right"';
if((isset($nokri['main_header_style'])) && $nokri['main_header_style']  == '2' || $nokri['main_header_style']  == '4' )
{
	 $transparent_header_class =  'dashboard-transparent-header';
	 $stick_right_bar =  '';
}
/* Cand basic info */
$dob      =  get_user_meta($user_crnt_id, '_cand_dob', true);
$phone    =  get_user_meta($user_crnt_id, '_sb_contact', true);
$email    =  $user_info->user_email;
$address  =  get_user_meta($user_crnt_id, '_cand_address', true);
/* Cand dashboard text */
$user_profile_dashboard_txt = ( isset($nokri['user_profile_dashboard_txt']) && $nokri['user_profile_dashboard_txt'] != ""  ) ? $nokri['user_profile_dashboard_txt'] : "";
/* Low profile txt*/
$user_low_profile_txt_btn = ( isset($nokri['user_low_profile_txt_btn']) && $nokri['user_low_profile_txt_btn'] != ""  ) ? $nokri['user_low_profile_txt_btn'] : false;
$profile_percent = get_user_meta($user_crnt_id, '_cand_profile_percent', true);
$user_low_profile_txt = ( isset($nokri['user_low_profile_txt']) && $nokri['user_low_profile_txt'] != ""  ) ? $nokri['user_low_profile_txt'] : ""; 
 ?>
 <section class="dashboard-new candidate-dashboard">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                    <?php
					if( isset( $_GET['candidate-page'] ) && $_GET['candidate-page'] == "my-profile" )
					{
						get_template_part( 'template-parts/candidate/candidate', $candidate_page );
					}
					else
					{
					?>
                        <div class="col-lg-2 col-md-3 col-sm-2 col-xs-12 nopadding">
                             <div class="profile-menu">
                             <div class="menu-avtr-box">
                                	<div class="user-img">
                                     <img src="<?php echo esc_url($image_dp_link[0]); ?>" id="candidate_dp" class="img-responsive" alt="<?php echo esc_html__('candidate profile image','nokri'); ?>">
                                    </div>
                                    <div class="user-text">
                                    	<h4><?php echo esc_html__($user_profile_dashboard_txt); ?></h4>
                                        <p><?php echo esc_html__( 'Welcome back', 'nokri' ); ?></p>
                                    </div>
                                </div>
                             	<a href="javascript:void(0)" class="menu-dashboard"> <i class="ti-menu-alt"></i></a>
                                <ul id="accordion" class="accordion">
                                  <li>
                                     <a href="<?php echo get_the_permalink(); ?>"> <span class="fa fa-dashboard"></span><?php echo esc_html__('Dashboard','nokri'); ?></a>
                                  </li>
                                  <li>
                                    <a href="<?php echo get_the_permalink(); ?>?candidate-page=edit-profile"> <span class="fa fa-edit"></span><?php echo esc_html__('Update Profile','nokri'); ?></a>
                                  </li>
                                  <li>
                                    <a href="<?php echo esc_url(get_author_posts_url($user_crnt_id)); ?>"> <span class="fa fa-user"></span><?php echo esc_html__( 'View My Profile', 'nokri' ); ?></a>
                                  </li>
                                  <li>
                                    <a href="<?php echo get_the_permalink(); ?>?candidate-page=resumes-list"> <span class="fa fa-file-archive-o"></span><?php echo esc_html__('My Resumes','nokri'); ?></a>
                                  </li>
                                  <li>
                                    <a href="<?php echo get_the_permalink(); ?>?candidate-page=jobs-applied"> <span class="fa fa-newspaper-o"></span><?php echo esc_html__('Jobs Applied','nokri'); ?></a>
                                  </li>
                                  
                                  <li>
                                    <a href="<?php echo get_the_permalink(); ?>?candidate-page=saved-jobs"> <span class="fa fa-heart-o"></span><?php echo esc_html__('Saved Jobs','nokri'); ?></a>
                                  </li>
                                   <li>
                                    <a href="<?php echo get_the_permalink(); ?>?candidate-page=followed-companies"> <span class="fa fa-briefcase"></span><?php echo esc_html__('Followed Companies','nokri'); ?></a>
                                  </li>
                                  <li>
                                    <a href="<?php echo wp_logout_url( home_url() ); ?>"><span class="fa fa-sign-out"></span><?php echo esc_html__('Logout','nokri'); ?></a>
                                  </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-9 col-sm-12 col-xs-12 col-lg-push-7 nopadding ">
                         <div class="theiaStickySidebar">
                            <div class="main-profile-card">
                            	<div class="contact-box">
                                    <div class="contact-img">
                                        <img src="<?php echo esc_url($image_dp_link[0]); ?>" id="candidate_dp" class="img-responsive img-circle" alt="<?php echo esc_html__('candidate profile image','nokri'); ?>">
                                    </div>
                                    <div class="contact-caption">
                                        <h4><?php echo esc_html($user_info->display_name); ?></h4>
                                        <span><?php echo get_user_meta($user_crnt_id, '_user_headline', true); ?></span>
                                    </div>
                                    <ul class="social-links list-inline">
                                    	<?php if(get_user_meta($user_crnt_id, '_cand_fb', true) != '') { ?>
                                        <li> <a href="<?php echo nokri_candidate_user_meta('_cand_fb'); ?>" target="_blank"><img src="<?php echo get_template_directory_uri();?>/images/resume-detail-icons/006-facebook.png" alt="<?php echo esc_html__( 'icon', 'nokri' ); ?>"></a></li>
                                        <?php } if(get_user_meta($user_crnt_id, '_cand_twiter', true) != '') { ?>
                                        <li> <a href="<?php echo nokri_candidate_user_meta('_cand_twiter'); ?>" target="_blank"><img src="<?php echo get_template_directory_uri();?>/images/resume-detail-icons/004-twitter.png" alt="<?php echo esc_html__( 'icon', 'nokri' ); ?>"></a></li>
                                        <?php } if(get_user_meta($user_crnt_id, '_cand_google', true) != '') { ?>
                                        <li> <a href="<?php echo nokri_candidate_user_meta('_cand_google'); ?>" target="_blank"><img src="<?php echo get_template_directory_uri();?>/images/resume-detail-icons/003-google-plus.png" alt="<?php echo esc_html__( 'icon', 'nokri' ); ?>"></a></li>
                                        <?php } if(get_user_meta($user_crnt_id, '_cand_linked', true) != '') { ?>
                                        <li> <a href="<?php echo nokri_candidate_user_meta('_cand_linked'); ?>" target="_blank"><img src="<?php echo get_template_directory_uri();?>/images/resume-detail-icons/005-linkedin.png" alt="<?php echo esc_html__( 'icon', 'nokri' ); ?>"></a></li>
                                        <?php } ?>
                                    </ul>
                                    <div class="progress-bar-section">
                                        <div class="progress">
                                            <div class="progress-bar"> <span data-percent="<?php echo esc_attr($profile_percent); ?>" class="profile<?php echo esc_attr($profile_percent); ?>"></span> </div>
                                        </div>
                                        <div class="progress-bar-title">
                                        	<h5><?php echo esc_html__('Profile Percent','nokri'); ?></h5>
                                        	<span class="progress-percentage"><?php echo esc_attr($profile_percent); ?>%</span>
                                        </div>
                                        <?php 
										if($profile_percent < 40 && $user_low_profile_txt_btn ) { ?>                  
    			  						<div class="alert alert-danger alert-dismissible" role="alert">
  					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  					<strong><?php echo esc_html__('Alert ! ', 'nokri' ); ?></strong><?php echo esc_html($user_low_profile_txt); ?>
				</div>
										<?php } ?>
                                    </div>
                                </div>
                                <div class="resume-detail">
                                        <ul>
                                        <?php if($dob) { ?>
                                            <li> <i class="ti-calendar"></i><?php echo esc_html__('Date of Birth: ','nokri'); ?><strong><?php echo date_i18n(get_option('date_format'), strtotime($dob)); ?></strong></li>
                                            <?php  } if( $phone ) { ?>
                                            <li> <i class="ti-mobile"></i><?php echo esc_html($phone);?></li>
                                            <?php  } if( $email ) { ?>
                                            <li> <i class="ti-email"></i> <?php echo esc_html($email);?></li>
                                            <?php  } if( $address ) { ?>
                                            <li> <i class="ti-location-arrow"></i><?php echo esc_html($address);?></li>
                                            <?php  } ?>
                                        </ul>
                                    </div>
                                <div class="notification-area">
                                	<h4><?php echo esc_html__('These jobs match your skills','nokri'); ?></h4>
                                    <div class="notif-box">
                                    	<ul>
                                        	<?php echo "".$notification; ?>
                                            <li>
                                            <?php if($notification) { ?>
                                            	<div class="notif-single">
                                                	<a href="<?php echo get_the_permalink(); ?>?candidate-page=jobs-notification"><?php echo esc_html__('View all notifications','nokri'); ?></a>
                                                </div>
                                                <?php } else { ?>
                                                <div class="notif-single">
                                                	<a href="javascript:void(0)"><?php echo esc_html__('Set your skills for job notifications','nokri'); ?></a>
                                                </div>
                                                <?php } ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-9 col-sm-12 col-xs-12 col-lg-pull-3 col-lg-offset-0 col-md-offset-3">
                        <?php  
							if( $candidate_page != "" )
							{
								get_template_part( 'template-parts/candidate/candidate', $candidate_page );
							}
							else
							{
								get_template_part( 'template-parts/candidate/index', $candidate_page );
							}
						?>
                        </div>
                        <?php } ?>
                   </div>
              </div>
          </div>
</section>