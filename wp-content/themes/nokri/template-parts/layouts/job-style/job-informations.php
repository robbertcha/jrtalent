<?php global $nokri;
$job_deadline = $job_type = $job_level = $job_shift = $job_experience = $job_skills = $job_salary = $job_qualifications = $job_currency = $ad_mapLocation = $ad_map_lat  = $post_apply_status =  $ad_map_long = $job_phone = $cats = $project = $web = $company_name = $single_job_badges  = $box_class  = '';
$job_skills   = array();
$job_id	=	get_the_ID();
 nokri_display_adLocation($job_id);
$current_user    =  wp_get_current_user();
$user_id         =  get_current_user_id();
$post_author_id  = get_post_field( 'post_author', $job_id );
$company_name    = get_the_author_meta( 'display_name' , $post_author_id );
$resume_exist    =  get_post_meta( $job_id, '_job_applied_status_'.$user_id,true);
$job_categories  =  wp_get_object_terms( $job_id,  array('job_category'), array('orderby' => 'term_group') );
/* Getting Job Details */ 
$job_type        		   =      wp_get_post_terms($job_id, 'job_type', array("fields" => "ids"));
$job_type	     		   =	  isset( $job_type[0] ) ? $job_type[0] : '';
$job_qualifications        =      wp_get_post_terms($job_id, 'job_qualifications', array("fields" => "ids"));
$job_qualifications	       =	  isset( $job_qualifications[0] ) ? $job_qualifications[0] : '';
$job_level        		   =      wp_get_post_terms($job_id, 'job_level', array("fields" => "ids"));
$job_level	               =	  isset( $job_level[0] ) ? $job_level[0] : '';
$job_salary       		   = 	  wp_get_post_terms($job_id, 'job_salary', array("fields" => "ids"));
$job_salary	      		   =	  isset( $job_salary[0] ) ? $job_salary[0] : '';
$job_salary_type           =      wp_get_post_terms($job_id, 'job_salary_type', array("fields" => "ids"));
$job_salary_type	       =	  isset( $job_salary_type[0] ) ? $job_salary_type[0] : '';
$job_experience   		   =      wp_get_post_terms($job_id, 'job_experience', array("fields" => "ids"));
$job_experience	  		   =	  isset( $job_experience[0] ) ? $job_experience[0] : '';
$job_currency              =      wp_get_post_terms($job_id, 'job_currency', array("fields" => "ids"));
$job_currency	           =	  isset( $job_currency[0] ) ? $job_currency[0] : '';
$job_shift                 =      wp_get_post_terms($job_id, 'job_shift', array("fields" => "ids"));
$job_shift	               =	  isset( $job_shift[0] ) ? $job_shift[0] : '';
$job_skills                 =      wp_get_post_terms($job_id, 'job_skills', array("fields" => "ids"));
$ad_mapLocation	 =     get_post_meta($job_id, '_job_address', true);
$ad_map_lat	     =     get_post_meta($job_id, '_job_lat', true);
$ad_map_long	 =     get_post_meta($job_id, '_job_long', true);
$job_phone	     =     get_post_meta($job_id, '_job_phone', true);
$job_vacancy	 =     get_post_meta($job_id, '_job_posts', true);
$cats	         =	   nokri_get_ad_cats ( $job_id, 'ID' );
$post_date       =     get_the_date(' M j ,Y' ); 
/* Jobs aplly with */
$job_apply_with	     =     get_post_meta($job_id, '_job_apply_with', true);
$job_apply_url	     =     get_post_meta($job_id, '_job_apply_url', true);
/* Jobs tags */
$tags_html       = '';
$jobs_tags       = get_the_terms( $job_id, 'job_tags');
if(!empty($jobs_tags) && count((array)  $jobs_tags ) > 0)
{
	foreach($jobs_tags as $tag) 
	{
		$tags_html .= '<a href="'.esc_url( get_tag_link($tag->term_id) ).'">#'.esc_attr( $tag->name ).'</a>';
	}
}
/* Calling Funtion Job Class For Badges */ 
$single_job_badges	=	nokri_job_class_badg($job_id);
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
/* Setting job Expiration */
$job_deadline_n     =  get_post_meta($job_id, '_job_date', true);
$job_deadline       =  date_i18n(get_option('date_format'), strtotime($job_deadline_n));
$today              =  date("m/d/Y");
$expiry_date_string =  strtotime($job_deadline_n);
$today_string 		=  strtotime($today);
if($today_string > $expiry_date_string)
{
	update_post_meta($job_id, '_job_status', 'inactive');
}
/* Getting job Aplly Expiration Status */
 $post_apply_status = get_post_meta($job_id, '_job_status', true);
/* Getting Last Child Value*/
$job_categories  = array();
$project         =  '';
$job_categories  =  wp_get_object_terms( $job_id,  array('job_category'), array('orderby' => 'term_group') );
if ( ! empty( $job_categories ) ) { 
	$last_cat        =  '';
	foreach($job_categories as $c)
	{
	   $project = $c->name;
	}
}
/* Getting Last Country Value*/
$job_countries_last = array();
$countries_last         =  '';
$job_countries_last  =  wp_get_object_terms( $job_id,  array('ad_location'), array('orderby' => 'term_group') );
if ( ! empty( $job_countries_last ) ) { 
	$last_cat        =  '';
	foreach($job_countries_last as $c)
	{
	   $countries_last = $c->name;
	}
}
/* Getting Job Skills  */
$skill_tags      =  '';
if(is_array($job_skills))
 {
	$taxonomies = get_terms('job_skills', array('hide_empty' => false , 'orderby'=> 'id', 'order' => 'ASC' ,  'parent'   => 0  ));
	if(count($taxonomies) > 0)
	   {
		 foreach($taxonomies as $taxonomy)
				{
					if (in_array( $taxonomy->term_id, $job_skills ))
					$skill_tags .= '<a href="'.get_the_permalink($nokri['sb_search_page']).'?job_skills='.esc_attr($taxonomy->term_id).'">'." ".esc_html($taxonomy->name)." ".'</a>';
				}
	  }
}
/* Opening */
$opening_text  = esc_html__('opening', 'nokri' );
if($job_vacancy > 1)
{
	$opening_text = esc_html__('openings', 'nokri' );
}
/* Getting Profile Photo */
$image_link[0] =  get_template_directory_uri(). '/images/candidate-dp.jpg';
if( isset( $nokri['nokri_user_dp']['url'] ) && $nokri['nokri_user_dp']['url'] != "" )
{
	$image_link = array($nokri['nokri_user_dp']['url']);	
}
if( get_user_meta($post_author_id, '_sb_user_pic', true ) != "" )
{
	$attach_id  =	get_user_meta($post_author_id, '_sb_user_pic', true );
	$image_link =   wp_get_attachment_image_src( $attach_id, 'nokri_job_post_single' );
} 
$emp_postal_code	= get_user_meta($post_author_id, '_emp_postal_address', true);
$emp_fb        		= get_user_meta($post_author_id, '_emp_fb', true);
$emp_google    		= get_user_meta($post_author_id, '_emp_google', true);
$emp_twitter   		= get_user_meta($post_author_id, '_emp_twitter', true);
$emp_linkedin  		= get_user_meta($post_author_id, '_emp_linked', true); 
$web 		   		= get_user_meta($post_author_id, '_emp_web', true); 
/* section bg */
$bg_url = '';
if ( isset( $nokri['section_bg_img'] ) )
{
	$bg_url = nokri_getBGStyle('section_bg_img');
}
/* Calling Funtion Job Class For Badges */ 
$job_badge_ul =   nokri_premium_job_class_badges($job_id);
/* Advertisement Module */
$advert_up = $advert_down = '';
if( isset( $nokri['single_job_advert_switch']) && $nokri['single_job_advert_switch'] == "1" )
{
	/*Above job desc */
	if(isset( $nokri['single_job_advert_up']) && $nokri['single_job_advert_up'] != "")
	{
		$advert_up = '<div class="n-advert-box">'.$nokri['single_job_advert_up'].'</div>';
	}
	/*Below job desc */
	if(isset( $nokri['single_job_advert_down']) && $nokri['single_job_advert_down'] != "")
	{
		$advert_down = '<div class="n-advert-box">'.$nokri['single_job_advert_down'].'</div>';
	}
	
}
/* Check author profile status*/
$emp_profile_status	= get_user_meta($post_author_id, '_user_profile_status', true);
$is_public = false;
if($emp_profile_status == 'pub' || $user_id == $post_author_id)
{
	$is_public = true;
}