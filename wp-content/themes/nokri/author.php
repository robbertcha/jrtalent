<?php
/* Author Page */ 
get_header();
global $nokri;
$author_id = get_query_var( 'author' );
$author    = get_user_by( 'ID', $author_id );
$current_user_id 	  = get_current_user_id();
$registered        =  $author->user_registered;
/* Getting User Type */
if ( get_user_meta($author_id, '_sb_reg_type', true) == '1')
{
$author_id = get_query_var( 'author' );
$author    = get_user_by( 'ID', $author_id );
global $wpdb;
$query = "SELECT count(umeta_id) FROM $wpdb->usermeta WHERE `meta_key` like '_cand_follow_company_%' AND `meta_value` = '".$author_id."'";
$followings     = $wpdb->get_var( $query );
$comp_followers = (count((array)$followings));
$comp_followers_txt = esc_html__('Follower','nokri');
if($comp_followers > 1)
{
   $comp_followers_txt = esc_html__('Followers','nokri');
}
$user_post_count    = count_user_posts( $author_id , 'job_post' ); 
$user_id            = get_query_var( 'author' );
$ad_mapLocation		= '';
$ad_mapLocation 	= get_user_meta($author_id, '_emp_map_location', true);
$headline 			= get_user_meta($author_id, '_user_headline', true);
$ad_map_lat			= get_user_meta($author_id, '_emp_map_lat', true);
$ad_map_long		= get_user_meta($author_id, '_emp_map_long', true);
/* Getting Profile Photo */
$image_link[0] =  get_template_directory_uri(). '/images/candidate-dp.jpg';
if( isset( $nokri['nokri_user_dp']['url'] ) && $nokri['nokri_user_dp']['url'] != "" )
{
   	$image_link = array($nokri['nokri_user_dp']['url']);	
}

if( get_user_meta($user_id, '_sb_user_pic', true ) != "" )
{
	$attach_id  =	get_user_meta($user_id, '_sb_user_pic', true );
	$image_link =   wp_get_attachment_image_src( $attach_id, '' );
}
/* Getting Employer Skills  */
$emp_skills = get_user_meta($user_id, '_emp_skills', true);
$skill_tags  = '';
if((array)$emp_skills  && $emp_skills > 0) 
  {
	$taxonomies = get_terms('job_skills', array('hide_empty' => false , 'orderby'=> 'id', 'order' => 'ASC' ,  'parent'   => 0  ));
	if(count((array) $taxonomies) > 0) {
		foreach($taxonomies as $taxonomy)
			{
				if (in_array( $taxonomy->term_id, $emp_skills ))
				$skill_tags .=   '<a href="javascript:void(0)">'.esc_html($taxonomy->name).'</a>';
			}
		}

	}
$emp_establish = '';	
$emp_establish = get_user_meta($user_id, '_emp_est', true);
$emp_headline  = get_user_meta($user_id, '_user_headline', true);
$emp_address   = get_user_meta($user_id, '_emp_map_location', true);
$emp_fb        = get_user_meta($user_id, '_emp_fb', true);
$emp_google    = get_user_meta($user_id, '_emp_google', true);
$emp_twitter   = get_user_meta($user_id, '_emp_twitter', true);
$emp_linkedin  = get_user_meta($user_id, '_emp_linked', true);
$emp_cntct     = get_user_meta($user_id, '_sb_contact', true);
$emp_web       = get_user_meta($user_id, '_emp_web', true);
$emp_size      = get_user_meta($user_id, '_emp_nos', true);
$emp_profile_status	= get_user_meta($author_id, '_user_profile_status', true);
$rtl_class     =  $bg_url = '';
$bg_url        = nokri_section_bg_url();
/*email/phone hide/show*/
$is_public = isset($nokri['user_phone_email']) ? $nokri['user_phone_email']  : false;
/*contact form hide/show*/
$is_public_contact = isset($nokri['user_contact_form']) ? $nokri['user_contact_form']  : false;
if($emp_profile_status == 'priv' & $author_id != $current_user_id ) { $image_link[0] =  get_template_directory_uri(). '/images/candidate-dp.jpg'; };
/*profile private txt*/
$user_private_txt = isset($nokri['user_private_txt']) ? $nokri['user_private_txt']  : '';
/*Social links hide/show*/
$social_links = isset($nokri['user_contact_social']) ? $nokri['user_contact_social']  : true;
?> 
<section class="n-breadcrumb-big resume-3-brreadcrumb" <?php echo "".($bg_url); ?>>
         <div class="container">
            <div class="row">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               </div>
            </div>
         </div>
      </section>
<section class="user-resume-3">
         <div class="container">
            <div class="row">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="n-candidate-info">
                     <div class="n-candidate-img-box">
                        <img src="<?php echo esc_url($image_link[0]); ?>" class="img-responsive" alt="<?php echo esc_attr__('company profile image','nokri'); ?>">
                     </div>
                     <?php if($emp_profile_status == 'pub' || $author_id == $current_user_id) { ?>
                     <div class="n-candidate-meta-box">
                     	<?php if($emp_profile_status == 'pub') { ?>
                        <h4><?php echo the_author_meta( 'display_name', $user_id ); ?></h4>
                        <?php } if($emp_headline) { ?>
                        <p><?php echo esc_html($emp_headline); ?></p>
                        <?php } if($social_links && $author_id == $current_user_id ) { ?>
                        <ul class="social-links list-inline">
                     <?php if($emp_fb) { ?>
                        <li> <a href="<?php echo esc_url($emp_fb); ?>" target="_blank"><img src="<?php echo get_template_directory_uri();?>/images/icons/006-facebook.png" alt="<?php echo esc_attr__( 'icon', 'nokri' ); ?>"></a></li>
						<?php } if($emp_google) { ?>
                        <li> <a href="<?php echo esc_url($emp_google); ?>" target="_blank"><img src="<?php echo get_template_directory_uri();?>/images/icons/003-google-plus.png" alt="<?php echo esc_attr__( 'icon', 'nokri' ); ?>" target="_blank"></a></li>
                        <?php } if($emp_twitter) { ?>
                        <li> <a href="<?php echo esc_url($emp_twitter); ?>" target="_blank"><img src="<?php echo get_template_directory_uri();?>/images/icons/004-twitter.png" alt="<?php echo esc_attr__( 'icon', 'nokri' ); ?>"></a></li>
                        <?php } if($emp_linkedin) { ?>
                        <li> <a href="<?php echo esc_url($emp_linkedin); ?>" target="_blank"><img src="<?php echo get_template_directory_uri();?>/images/icons/005-linkedin.png" alt="<?php echo esc_attr( 'icon', 'nokri' ); ?>"></a></li>
                        <?php }  ?>
                     </ul>
                     	<?php } ?>
                     </div>
                     <?php } ?>
                  </div>
               </div>
            </div>
         </div>
      </section>
<section class="n-candidate-detail">
         <div class="container">
            <div class="row">
             <?php if($emp_profile_status == 'pub' || $author_id == $current_user_id) { ?>
               <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                	<aside class="resume-3-sidebar">
                    	<div class="n-candidate-info">
                            <h4 class="widget-heading"><?php echo esc_html__( 'Employer detail ', 'nokri' ); ?> </h4>
                            <ul>
                               <li>
                                  <i class="la la-calendar la-3x"></i>
                                  <div class="resume-detail-meta"><small><?php echo esc_html__( 'Member since:', 'nokri' ); ?></small> <strong><?php echo date_i18n(get_option('date_format'), strtotime($registered)); ?></strong></div>
                               </li>
                               <?php  if($emp_address) { ?>
                               <li>
                                  <i class="la la-map-marker la-3x "></i> 
                                  <div class="resume-detail-meta"><small><?php echo esc_html__( 'Location:', 'nokri' ); ?></small> <strong><?php echo esc_html($emp_address); ?> </strong></div>
                               </li>
                               <?php }  if($emp_size) { ?>
                               <li>
                                  <i class="la la-users la-3x"></i> 
                                  <div class="resume-detail-meta"><small><?php echo esc_html__( 'Employees ', 'nokri' ); ?></small><strong><?php echo esc_html($emp_size); ?></strong></div>
                               </li>
                               <?php } if($is_public || $author_id == $current_user_id) {  ?>
                               <li>
                                  <i class="la la-envelope la-3x"></i> 
                                  <div class="resume-detail-meta"><a href="mailto:<?php echo esc_attr($author->user_email); ?>"><small><?php echo esc_html__( 'Email Address ', 'nokri' ); ?></small><strong><?php echo esc_html($author->user_email); ?></strong></a></div>
                               </li>
                               <?php  } if($emp_web) { ?>
                               <li>
                                  <i class="la la-globe la-3x"></i> 
                                  <div class="resume-detail-meta"><a href="<?php echo esc_url($emp_web); ?>" target="_blank"><small><?php echo esc_html__( 'Website URL ', 'nokri' ); ?></small><strong><?php echo esc_html($emp_web); ?></strong></a></div>
                               </li>
                               <?php }  if($emp_cntct && $is_public || $author_id == $current_user_id) { ?>
                               <li>
                                  <i class="la la-mobile la-3x"></i>
                                  <div class="resume-detail-meta"><a href="tel:<?php echo esc_attr($emp_cntct); ?>"> <small><?php echo esc_html__( 'Contact Number ', 'nokri' ); ?> </small><strong><?php echo esc_html($emp_cntct); ?></strong></a></div>
                               </li>
                               <?php } 
								if(get_user_meta($current_user_id, '_sb_reg_type', true) == 0) { 
								$comp_follow = get_user_meta( $current_user_id, '_cand_follow_company_'.$user_id,true);
								 if ( $comp_follow ) { 
							   ?>
                              <li><a class="btn n-btn-flat btn-block"><?php echo esc_html__('Followed','nokri'); ?></a></li>
                               <?php } else { ?>
					<li><a  data-value="<?php echo esc_attr( $author_id );?>"  class="btn n-btn-flat btn-block follow_company"><?php echo " ".esc_html__('Follow','nokri'); ?></a></li>
					<?php } } ?>
                            </ul>
                     </div>
                     <?php  if( $is_public_contact || $author_id == $current_user_id) {   ?>
                     	<div class="widget">
                            <h4 class="widget-heading"><?php echo esc_html__( 'Contact ', 'nokri' );  echo the_author_meta( 'display_name', $user_id ); ?></h4>
                            <form id="contact_form_email" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                   <input type="text" name="contact_name" data-parsley-required="true" data-parsley-error-message="<?php echo esc_html__( 'Please enter name', 'nokri' ); ?>" class="form-control" placeholder="<?php echo esc_html__( 'Full name', 'nokri' ); ?>">
                                </div>
                                <div class="form-group">
                                   <input type="email" name="contact_email" class="form-control" data-parsley-required="true" data-parsley-error-message="<?php echo esc_html__( 'Please enter email', 'nokri' ); ?>"  placeholder="<?php echo esc_html__( 'Email address', 'nokri' ); ?>">
                                </div>
                                <div class="form-group">
                                   <input type="text" class="form-control" data-parsley-required="true" data-parsley-error-message="<?php echo esc_html__( 'Please enter subject', 'nokri' ); ?>" name="contact_subject"   placeholder=" <?php echo esc_html__( 'Subject', 'nokri' ); ?>">
                                </div>
                                <input type="hidden" name="receiver_id" value="<?php echo esc_attr($author_id); ?>" />
                                <div class="form-group">
                                   <textarea name="contact_message" class="form-control"  rows="5"></textarea>
                                </div>
                                <button type="submit" class="btn n-btn-flat btn-mid btn-block contact_me"><?php echo esc_html__( 'Message', 'nokri' ); ?></button>
                             </form>
                        </div>
                          <?php  } ?>
                    </aside>
                </div>
               <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
               <div class="resume-3-detail">
                <?php if (get_user_meta( $user_id, '_emp_intro',true) != '' ) { ?>
                    	<div class="resume-3-box">
                     <h4><?php echo esc_html__('About Company','nokri'); ?></h4>
                     <?php
					$intro 	=	get_user_meta( $user_id, '_emp_intro', true);
					if (!preg_match('%(<p[^>]*>.*?</p>)%i', $intro, $regs))
					{
						echo '<p>' .  get_user_meta( $user_id, '_emp_intro', true) . '</p>';
					}
					else
					{
						echo get_user_meta( $user_id, '_emp_intro', true);	
					}
					   ?>
                        </div>
                        <?php } ?>
                            <?php
							$args = array(
									'post_type'  	=> 'job_post',
									'orderby'    	=> 'id',
									'order'      	=> 'DESC',
									'author' 	  	=> $author_id,
									'post_status' 	=> 'publish',
									'meta_query' 	=> 	array(array('key'     => '_job_status','value'   => 'active','compare' => '=',
														     ),
													      ), 
									 			);
						$results = new WP_Query( $args );
						?>
      <div class="n-related-jobs">
       <?php  if ($results->have_posts() ) { ?>
         <div class="heading-title left">
            <h4><?php echo esc_html__('Open positions', 'nokri' ); ?></h4>
         </div>
         <div class="n-search-listing n-featured-jobs">
            <div class="n-featured-job-boxes">
				<?php
    			while ( $results->have_posts() ) {
        $results->the_post();
        $rel_post_id          =  get_the_id();
        $rel_post_author_id   =  get_post_field( 'post_author', $rel_post_id );
         /* Getting Company  Profile Photo */
        $comp_img_html = '';
        $rel_image_link[0]   =   get_template_directory_uri(). '/images/candidate-dp.jpg';
     if( isset( $nokri['nokri_user_dp']['url'] ) && $nokri['nokri_user_dp']['url'] != "" )
        {
            $rel_image_link = array($nokri['nokri_user_dp']['url']);
        }
        if( get_user_meta($rel_post_author_id, '_sb_user_pic', true ) != "" )
        {
            $attach_id       =	 get_user_meta($rel_post_author_id, '_sb_user_pic', true );
            $rel_image_link  =   wp_get_attachment_image_src( $attach_id, 'nokri_job_post_single');
        }
        if($rel_image_link[0] != '')
        {
            $comp_img_html = '<div class="n-job-img"><img src="'.esc_url($rel_image_link[0]).'" alt="'.esc_attr__('logo', 'nokri').'" class="img-responsive img-circle"></div>';
        }	

$job_deadline_n     	   =  	  get_post_meta($rel_post_id, '_job_date', true);
$job_deadline       	   =      date_i18n(get_option('date_format'), strtotime($job_deadline_n));
$job_salary       		   = 	  wp_get_post_terms($rel_post_id, 'job_salary', array("fields" => "ids"));
$job_salary	      		   =	  isset( $job_salary[0] ) ? $job_salary[0] : '';
$job_salary_type           =      wp_get_post_terms($rel_post_id, 'job_salary_type', array("fields" => "ids"));
$job_salary_type	       =	  isset( $job_salary_type[0] ) ? $job_salary_type[0] : '';
$job_experience   		   =      wp_get_post_terms($rel_post_id, 'job_experience', array("fields" => "ids"));
$job_experience	  		   =	  isset( $job_experience[0] ) ? $job_experience[0] : '';
$job_currency              =      wp_get_post_terms($rel_post_id, 'job_currency', array("fields" => "ids"));
$job_currency	           =	  isset( $job_currency[0] ) ? $job_currency[0] : '';
$job_type        		   =      wp_get_post_terms($rel_post_id, 'job_type', array("fields" => "ids"));
$job_type	     		   =	  isset( $job_type[0] ) ? $job_type[0] : '';
/* Calling Funtion Job Class For Badges */ 
$single_job_badges	=	nokri_job_class_badg($rel_post_id);
$job_badge_text     =   '';
if( count((array)  $single_job_badges ) > 0) 
{	
    foreach( $single_job_badges as $job_badge => $val )
        {
            $term_vals =  get_term_meta($val);
            $bg_color  =  get_term_meta( $val, '_job_class_term_color_bg', true );
             $color    =  get_term_meta( $val, '_job_class_term_color', true );
            
            $style_color = '';
            if($color != "" )
            {
                $style_color = 'style=" background-color: '.$bg_color.' !important; color: '.$color.' !important;"';
            }
            $job_badge_text .= '<li><a href="'.get_the_permalink($nokri['sb_search_page']).'?job_class='.$val.'" class="job-class-tags-anchor" '.$style_color.'><span>'.esc_html(ucfirst($job_badge)).'</span></a></li>';
        }  
}

if(is_user_logged_in())
{
    $user_id         =  get_current_user_id();
}
else
{
    $user_id = '';
}
$job_bookmark = get_post_meta( $rel_post_id, '_job_saved_value_'.$user_id, true);

if ( $job_bookmark == '' ) 
{
    $save_job = '<a class="n-job-saved save_job" href="javascript:void(0)" data-value = "'.$rel_post_id.'"><i class="ti-heart"></i></a> ';
}
else
{
    $save_job = '<a class="n-job-saved saved" href="javascript:void(0)"><i class="fa fa-heart"></i></a>';
}
        ?>
        <div class="n-job-single">
                  <?php echo ($comp_img_html); ?>
                  <div class="n-job-detail">
                     <ul class="list-inline">
                        <li class="n-job-title-box">
                           <h4><a href="<?php echo the_permalink($rel_post_id); ?>" class="job-title"><?php echo the_title(); ?></a></h4>
                           <p><i class="ti-location-pin"></i><?php echo " ".nokri_job_country($rel_post_id); ?></p>
                        </li>
                        <li class="n-job-short">
                           <span> <strong><?php echo esc_html__(' Type:', 'nokri' ); ?></strong><?php echo nokri_job_post_single_taxonomies('job_type', $job_type); ?></span>
                           <span> <strong><?php echo esc_html__('Last Date:', 'nokri' ); ?> </strong><?php echo  " ".($job_deadline); ?></span>
                        </li>
                        <li class="n-job-btns">
                        <a href="javascript:void(0)" class="btn n-btn-rounded apply_job" data-job-id="<?php echo esc_attr( $rel_post_id );?>" data-toggle="modal" data-target="#myModal"><?php echo esc_html__('Apply now', 'nokri' ); ?></a>
                        </li>
                     </ul>
                  </div>
               </div>
<?php } ?>
				</div>
         </div>
         <?php } else { ?>
         <div class="heading-title left">
            <h4><?php echo esc_html__('No open positions', 'nokri' ); ?></h4>
         </div>
         <?php } ?>
      </div>
  </div>
               </div>
               <?php  } else { ?>
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                	<div class="locked-profile alert alert-danger fade in" role="alert">
                      <i class="la la-lock"></i><?php echo "".( $user_private_txt ); ?>
                   </div>
                </div>
               <?php } ?>
            </div>
         </div>
      </section>      
<?php } 
else
{
	$resume_style = '';
	if((isset($nokri['cand_resume_style'])) && $nokri['cand_resume_style']  != '' )
	{
		 $resume_style =  ($nokri['cand_resume_style']);
	}
	if($resume_style == 1)
	{
		get_template_part( 'template-parts/profiles/candidate', 'resume1' );
	}
	else
	{
		
		get_template_part( 'template-parts/profiles/candidate', 'resume2' );
	} 
	
}
get_footer();