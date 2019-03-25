<?php
/* Template Name: Job Post */ 
get_header();
global $nokri;
$user_id         =  get_current_user_id();
$rtl_class = $expire_pkg = '';
if(is_rtl())
 {
 	$rtl_class = "flip";
 }
$mapType = nokri_mapType();
if($mapType == 'google_map')
{
	wp_enqueue_script( 'google-map-callback',false);
}
if(get_user_meta($user_id, '_sb_reg_type', true) == '0')
{
	echo nokri_redirect( home_url( '/' ) );
}
/* package Page */
$package_page = '';
if((isset($nokri['package_page'])) && $nokri['package_page']  != '' )
{
 	$package_page =  ($nokri['package_page']);
}

if( !isset( $_GET['id'] ) )
{
	if(!is_super_admin($user_id))
	{
		/* Check Employer Have Free Jobs */
		$job_class_free   		=  nokri_simple_jobs();
		$regular_jobs     		=  get_user_meta($user_id, 'package_job_class_'.$job_class_free,true);
		$expiry_date      		=  get_user_meta($user_id, '_sb_expire_ads',true);
		$today			  		=  date("Y-m-d");
		$expiry_date_string 	=  strtotime($expiry_date);
		$today_string 			=  strtotime($today);
		$expire_jobs 			=  false;
		if($regular_jobs == 0 || $today_string > $expiry_date_string)
		{
			$expire_jobs = true;
			nokri_simple_jobs($expire_jobs );
			echo nokri_redirect( get_the_permalink($package_page) );
		}
	}
}

$job_id = $job_ext_url = $job_apply_with = $job_deadline = $job_type = $job_level = $job_shift = $job_experience = $job_skills =  $job_salary = $job_qualifications = $job_currency = $ad_mapLocation = $ad_map_lat =  $ad_map_long = $level = $cats = $sub_cats_html = $sub_sub_cats_html =  $sub_sub_sub_cats_html = $cats_html =  $tags = $job_phone =  $description = $job_posts = $title = $levelz =  $job_salary_type =   $country_states =   $country_cities =   $country_towns = '';
global $nokri;

if((isset($nokri['sb_default_lat'])) && $nokri['sb_default_lat']  != '' )
{
	$ad_map_lat =  ($nokri['sb_default_lat']);
}
$ad_map_long = '';
if((isset($nokri['sb_default_lat'])) && $nokri['sb_default_lat']  != '' )
{
	$ad_map_long =  ($nokri['sb_default_long']);
}

if( isset( $_GET['id'] ) )
{
$job_id = $_GET['id'];


$expiry_date      		=  get_user_meta($user_id, '_sb_expire_ads',true);
$today			  		=  date("Y-m-d");
$expiry_date_string 	=  strtotime($expiry_date);
$today_string 			=  strtotime($today);
$expire_pkg 			=  false;
if($today_string > $expiry_date_string && !current_user_can('administrator'))
{
	$expire_pkg = true;
}

if( get_post_field( 'post_author', $job_id ) != get_current_user_id() && !is_super_admin( get_current_user_id() ) )
{
	echo nokri_redirect( home_url( '/' ) );
}

/* Getting Post Meta Values For Edit Page */ 

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
$job_skills                =       wp_get_post_terms($job_id, 'job_skills', array("fields" => "ids"));


$job_deadline	=      get_post_meta($job_id, '_job_date', true);
$ad_mapLocation	=      get_post_meta($job_id, '_job_address', true);
$ad_map_lat		=      get_post_meta($job_id, '_job_lat', true);
$ad_map_long	=      get_post_meta($job_id, '_job_long', true);
$job_phone		=      get_post_meta($job_id, '_job_phone', true);
$job_posts		=	   get_post_meta($job_id, '_job_posts', true);
$job_apply_with	=	   get_post_meta($job_id, '_job_apply_with', true);
$job_ext_url	=	   get_post_meta($job_id, '_job_apply_url', true);
$cats	    	=	   nokri_get_jobs_cats ( $job_id );
$level	    	=	  count((array) $cats);
/* Make cats selected on update Job*/
$ad_cats	=	nokri_get_cats('job_category' , 0 );
$cats_html	=	'';
foreach( $ad_cats as $ad_cat )
{
	$selected	=	'';
	if( $level > 0 && $ad_cat->term_id == $cats[0]['id'] )
	{
		$selected	=	'selected="selected"';
	}
	$cats_html	.=	'<option value="'.$ad_cat->term_id.'" '.$selected.'>' . $ad_cat->name .  '</option>';
}
if( $level >= 2 )
{
	$ad_sub_cats	=	nokri_get_cats('job_category' , $cats[0]['id'] );
	$sub_cats_html	=	'';
	foreach( $ad_sub_cats as $ad_cat )
	{
		$selected	=	'';
		if( $level > 0 && $ad_cat->term_id == $cats[1]['id'] )
		{
			$selected	=	'selected="selected"';
		}
		$sub_cats_html	.=	'<option value="'.$ad_cat->term_id.'" '.$selected.'>' . $ad_cat->name .  '</option>';
	}
}
if( $level >= 3 )
{
	$ad_sub_sub_cats	=	nokri_get_cats('job_category' , $cats[1]['id'] );
	$sub_sub_cats_html	=	'';
	foreach( $ad_sub_sub_cats as $ad_cat )
	{
		$selected	=	'';
		if( $level > 0 && $ad_cat->term_id == $cats[2]['id'] )
		{
			$selected	=	'selected="selected"';
		}
		$sub_sub_cats_html	.=	'<option value="'.$ad_cat->term_id.'" '.$selected.'>' . $ad_cat->name .  '</option>';
		
	}
	
}
if( $level >= 4 )
{
	$ad_sub_sub_sub_cats	=	nokri_get_cats('job_category' , $cats[2]['id'] );
	$sub_sub_sub_cats_html	=	'';
	foreach( $ad_sub_sub_sub_cats as $ad_cat )
	{
		$selected	=	'';
		if( $level > 0 && $ad_cat->term_id == $cats[3]['id'] )
		{
			$selected	=	'selected="selected"';
		}
		$sub_sub_sub_cats_html	.=	'<option value="'.$ad_cat->term_id.'" '.$selected.'>' . $ad_cat->name .  '</option>';
		
	}
	
}


//Countries
$countries	=	nokri_get_jobs_cats ($job_id, '',true );
$levelz	    =	count((array) $countries);

/* Make location selected on update ad */
$ad_countries	=	nokri_get_cats('ad_location' , 0 );
$country_html	=	'';
foreach( $ad_countries as $ad_country )
{
	$selected	=	'';
	if( $levelz > 0 && $ad_country->term_id == $countries[0]['id'] )
	{
		$selected	=	'selected="selected"';
	}
	$country_html	.=	'<option value="'.$ad_country->term_id.'" '.$selected.'>' . $ad_country->name .  '</option>';
}

if( $levelz >= 2 )
{

	$ad_states	=	nokri_get_cats('ad_location' , $countries[0]['id'] );
	$country_states	=	'';
	foreach( $ad_states as $ad_state )
	{
		$selected	=	'';
		if( $levelz > 0 && $ad_state->term_id == $countries[1]['id'] )
		{
			$selected	=	'selected="selected"';
		}
		$country_states	.=	'<option value="'.$ad_state->term_id.'" '.$selected.'>' . $ad_state->name .  '</option>';
		
	}
	
}
if( $levelz >= 3 )
{
	$ad_country_cities	=	nokri_get_cats('ad_location' , $countries[1]['id'] );
	$country_cities	=	'';
	foreach( $ad_country_cities as $ad_city )
	{
		$selected	=	'';
		if( $levelz > 0 && $ad_city->term_id == $countries[2]['id'] )
		{
			$selected	=	'selected="selected"';
		}
		$country_cities	.=	'<option value="'.$ad_city->term_id.'" '.$selected.'>' . $ad_city->name .  '</option>';
		
	}
	
}

if( $levelz >= 4 )
{
	$ad_country_town	=	nokri_get_cats('ad_location' , $countries[2]['id'] );
	$country_towns	=	'';
	foreach( $ad_country_town as $ad_town )
	{
		$selected	=	'';
		if( $levelz > 0 && $ad_town->term_id == $countries[3]['id'] )
		{
			$selected	=	'selected="selected"';
		}
		$country_towns	.=	'<option value="'.$ad_town->term_id.'" '.$selected.'>' . $ad_town->name .  '</option>';
		
	}
	
}






/* Displaying Tags */
$tags_array 	= 	wp_get_object_terms( $job_id,  'job_tags', array('fields' => 'names') );
$tags	    	=	implode( ',', $tags_array );
$post       	= 	get_post($job_id);
$description 	= 	$post->post_content;
$title			=	$post->post_title;
}
else 
{
	$ad_cats	=	nokri_get_cats('job_category' , 0 );
	$cats_html	=	'';
	foreach( $ad_cats as $ad_cat )
	{
		$cats_html	.=	'<option value="'.$ad_cat->term_id.'">' . $ad_cat->name .  '</option>';
	}
	
	//Countries
$ad_country	=	nokri_get_cats('ad_location' , 0 );
$country_html	=	'';
foreach( $ad_country as $ad_count )
{
	$country_html	.=	'<option value="'.$ad_count->term_id.'">' . $ad_count->name .  '</option>';
}



}



$user_info    =    wp_get_current_user();
$user_crnt_id =    $user_info->ID;
/* Check Location & Phone Number Updated Or Not */
if ($ad_mapLocation == '')
{
	$ad_mapLocation =  get_user_meta($user_crnt_id, '_emp_map_location', true);
}
if ($ad_map_lat == '')
{
	$ad_map_lat	=      get_user_meta($user_crnt_id, '_emp_map_lat', true);
}
if ($ad_map_long == '')
{
	$ad_map_long	=  get_user_meta($user_crnt_id, '_emp_map_long', true);
}
if ($job_phone == '')
{
	$job_phone	= get_user_meta($user_crnt_id, '_sb_contact', true);
}
$headline 		=  get_user_meta($user_crnt_id, '_user_headline', true);
$job_post_name  =  $user_info->display_name ; 

nokri_user_not_logged_in();
/* For job post note */
$job_note = $nokri['job_post_note'];
$job_post_note = '';
if(isset($job_note) && $job_note != '')
{
	$job_post_note = '<p>'.$job_note.'</p>';
}
/* For job category level text */
$job_cat_level_1 = ( isset($nokri['job_cat_level_1']) && $nokri['job_cat_level_1'] != ""  ) ? $nokri['job_cat_level_1'] : esc_html__( 'Job category', 'nokri' );

$job_cat_level_2 = ( isset($nokri['job_cat_level_2']) && $nokri['job_cat_level_2'] != ""  ) ? $nokri['job_cat_level_2'] : esc_html__( 'Sub category', 'nokri' );

$job_cat_level_3 = ( isset($nokri['job_cat_level_3']) && $nokri['job_cat_level_3'] != ""  ) ? $nokri['job_cat_level_3'] : esc_html__( 'Sub sub category', 'nokri' );

$job_cat_level_4 = ( isset($nokri['job_cat_level_4']) && $nokri['job_cat_level_4'] != ""  ) ? $nokri['job_cat_level_4'] : esc_html__( 'Sub sub sub category', 'nokri' );

/* For job Location level text */
$job_country_level_heading = ( isset($nokri['job_country_level_heading']) && $nokri['job_country_level_heading'] != ""  ) ? $nokri['job_country_level_heading'] : '';
/* For Map  text */
$map_location_txt = ( isset($nokri['job_map_heading_txt']) && $nokri['job_map_heading_txt'] != ""  ) ? $nokri['job_map_heading_txt'] : '';

$job_country_level_1 = ( isset($nokri['job_country_level_1']) && $nokri['job_country_level_1'] != ""  ) ? $nokri['job_country_level_1'] : '';

$job_country_level_2 = ( isset($nokri['job_country_level_2']) && $nokri['job_country_level_2'] != ""  ) ? $nokri['job_country_level_2'] : '';

$job_country_level_3 = ( isset($nokri['job_country_level_3']) && $nokri['job_country_level_3'] != ""  ) ? $nokri['job_country_level_3'] : '';

$job_country_level_4 = ( isset($nokri['job_country_level_4']) && $nokri['job_country_level_4'] != ""  ) ? $nokri['job_country_level_4'] : '';

$bg_url = nokri_section_bg_url();
/*Is map show*/
$is_lat_long = isset($nokri['allow_lat_lon']) ? $nokri['allow_lat_lon']  : false;
/*Job apply with*/
$job_apply_with_option = isset($nokri['job_apply_with']) ? $nokri['job_apply_with']  : false;
?>
<section class="n-pages-breadcrumb" <?php echo ($bg_url); ?>>
 <div class="container">
    <div class="row">
       <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-2">
          <div class="n-breadcrumb-info">
             <h1><?php echo esc_html__( 'Post a Job', 'nokri' ); ?></h1>
             <?php echo "".($job_post_note); ?>
          </div>
       </div>
    </div>
 </div>
</section>
<section class="n-job-pages-section">
 <div class="container">
    <div class="row">
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="row">
             <form class="n-jobpost" method="post" enctype="multipart/form-data" id="emp-job-post">
                 <input id="is_update" name="is_update" value="<?php echo ($job_id); ?>" type="hidden">
                 <input type="hidden" id="country_level" name="country_level" value="<?php echo esc_attr($levelz); ?>" />
                 <input type="hidden" id="is_level" name="is_level" value="<?php echo esc_attr($level); ?>" />
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                   <div class="row">
                      <!-- Job title -->
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                         <div class="post-job-heading">
                            <h3><?php echo esc_html__( 'Basic Information', 'nokri' ); ?></h3>
                         </div>
                      </div>
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                         <div class="form-group">
                         	<label><?php echo esc_html__( 'Job Title*', 'nokri' ); ?></label>
                             <input type="text" placeholder="<?php echo esc_html__( 'Job Title', 'nokri' ); ?>" value="<?php echo esc_html($title); ?>" id="ad_title" data-parsley-required="true" name="job_title" class="form-control">
                         </div>
                      </div>
                      <!--End categories levels -->
                      <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                         <div class="form-group">
                         <label><?php echo esc_html($job_cat_level_1 ); ?></label>
                            <select class="js-example-basic-single" data-allow-clear="true" data-placeholder="<?php echo esc_html($job_cat_level_1 ); ?>" data-parsley-required="true" id="job_cat" name="job_cat">
                               <option value="0"><?php echo esc_html__( 'Select Option', 'nokri' ); ?></option>
                               <?php echo "".$cats_html; ?>
                            </select>
                            <input type="hidden" name="job_cat_id" id="job_cat_id" value="" />
                         </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="second_level">
                         <div class="form-group">
                         <label><?php echo esc_html($job_cat_level_2 ); ?></label>
                            <select class="js-example-basic-single" data-allow-clear="true" data-placeholder="<?php echo esc_html($job_cat_level_2 ); ?>" id="job_cat_second" name="job_cat_second">
                             <option value="0"><?php echo esc_html__( 'Select Option', 'nokri' ); ?></option>
                               <?php echo ($sub_cats_html); ?>
                            </select>
                         </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="third_level">
                         <div class="form-group">
                         <label><?php echo esc_html($job_cat_level_3 ); ?></label>
                            <select class="js-example-basic-single" data-allow-clear="true" data-placeholder="<?php echo esc_html($job_cat_level_3 ); ?>" id="job_cat_third" name="job_cat_third">
                              <option value="0"><?php echo esc_html__( 'Select Option', 'nokri' ); ?></option>
                                <?php echo ($sub_sub_cats_html); ?>
                                 </select>
                             <input type="hidden" name="ad_cat_id" id="ad_cat_id" value="" />
                         </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="forth_level">
                         <div class="form-group">
                         <label><?php echo esc_html($job_cat_level_4 ); ?></label>
                            <select class="js-example-basic-single" data-allow-clear="true" data-placeholder="<?php echo esc_html($job_cat_level_4 ); ?>" id="job_cat_forth" name="job_cat_forth">
                              <option value="0"><?php echo esc_html__( 'Select Option', 'nokri' ); ?></option>
                                <?php echo ($sub_sub_sub_cats_html); ?>
                                 </select>
                             <input type="hidden" name="ad_cat_id" id="ad_cat_id" value="" />
                         </div>
                      </div>
                      <!--Job details -->
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                         <div class="form-group">
                         <label><?php echo esc_html__( 'Job Description', 'nokri' ); ?></label>
                            <textarea name="job_description" id="ad_description" class="jquery-textarea rich_textarea" rows="10" cols="115"><?php echo "".($description); ?></textarea>
                         </div>
                      </div>
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                         <div class="post-job-heading mt30">
                            <h3><?php echo esc_html__( 'Job Details', 'nokri' ); ?></h3>
                         </div>
                      </div>
                      <!--Application deadline -->
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         <div class="form-group">
                          <label><?php echo esc_html__( 'Application deadline', 'nokri' ); ?></label>
                            <input type="text" value="<?php echo esc_html($job_deadline); ?>" class="form-control datepicker-here"  data-language="en" data-parsley-required="true" <?php if($expire_pkg) { echo "disabled"; } ?> name="job_date" placeholder="<?php echo esc_html__( 'Application deadline*', 'nokri' ); ?>">
                         </div>
                      </div>
                      
                       
                       <!--Job qualifications -->
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         <div class="form-group">
                         <label><?php echo esc_html__( 'Job qualifications', 'nokri' ); ?></label>
                            <select class="js-example-basic-single" data-allow-clear="true" data-placeholder="<?php echo esc_html__( 'Job Qualifications', 'nokri' ); ?>" name="job_qualifications" data-parsley-required="true">
                              <option value=""><?php echo esc_html__( 'Select Option', 'nokri' ); ?></option>
                               <?php echo nokri_job_post_taxonomies('job_qualifications', $job_qualifications); ?>
                            </select>
                         </div>
                      </div>
                      <!--Job type -->
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         <div class="form-group">
                         <label><?php echo esc_html__( 'Job type', 'nokri' ); ?></label>
                            <select class="js-example-basic-single" data-allow-clear="true" data-placeholder="<?php echo esc_html__( 'Job Type', 'nokri' ); ?>" name="job_type" data-parsley-required="true">
                               <option value=""><?php echo esc_html__( 'Select Option', 'nokri' ); ?>
                              <?php echo nokri_job_post_taxonomies('job_type',$job_type); ?>
                            </select>
                         </div>
                      </div>
                      <!--Salary type -->
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         <div class="form-group">
                         <label><?php echo esc_html__( 'Salary type', 'nokri' ); ?></label>
                            <select class="js-example-basic-single" data-allow-clear="true" data-placeholder="<?php echo esc_html__( 'Salary Type', 'nokri' ); ?>" name="job_salary_type" data-parsley-required="true">
                               <option value=""><?php echo esc_html__( 'Select Option', 'nokri' ); ?>
                               <?php  echo nokri_job_post_taxonomies('job_salary_type', $job_salary_type); ?>
                            </select>
                         </div>
                      </div>
                      <!--Salary currency -->
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         <div class="form-group">
                         <label><?php echo esc_html__( 'Salary currency', 'nokri' ); ?></label>
                            <select class="js-example-basic-single" data-allow-clear="true" data-placeholder="<?php echo esc_html__( 'Salary Currency', 'nokri' ); ?>" name="job_currency" data-parsley-required="true">
                               <option value=""><?php echo esc_html__( 'Select Option', 'nokri' ); ?></option>
                                <?php echo nokri_job_post_taxonomies('job_currency', $job_currency); ?>
                            </select>
                         </div>
                      </div>
                      <!--Salary offers -->
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         <div class="form-group">
                          <label><?php echo esc_html__( 'Salary range', 'nokri' ); ?></label>
                            <select class="js-example-basic-single" data-allow-clear="true" data-placeholder="<?php echo esc_html__( 'Salary range', 'nokri' ); ?>" name="job_salary" data-parsley-required="true">
                                <option value=""><?php echo esc_html__( 'Select Option', 'nokri' ); ?></option>
                                <?php echo nokri_job_post_taxonomies('job_salary', $job_salary); ?>
                            </select>
                         </div>
                      </div>
                      <!--job experience -->
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         <div class="form-group">
                         <label><?php echo esc_html__( 'Job experience', 'nokri' ); ?></label>
                            <select class="js-example-basic-single" data-allow-clear="true" data-placeholder="<?php echo esc_html__( 'Job Experience', 'nokri' ); ?>" name="job_experience" data-parsley-required="true">
                                <option value=""><?php echo esc_html__( 'Select Option', 'nokri' ); ?></option>
                                <?php echo nokri_job_post_taxonomies('job_experience',$job_experience); ?>
                            </select>
                         </div>
                      </div>
                      <!--job shift -->
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         <div class="form-group">
                         <label><?php echo esc_html__( 'Job shift', 'nokri' ); ?></label>
                            <select class="js-example-basic-single" data-allow-clear="true" data-placeholder="<?php echo esc_html__( 'Job Shift', 'nokri' ); ?>" name="job_shift" data-parsley-required="true">
                                <option value=""><?php echo esc_html__( 'Select Option', 'nokri' ); ?></option>
                                <?php echo nokri_job_post_taxonomies('job_shift', $job_shift); ?>
                            </select>
                         </div>
                      </div>
                      <!--job level -->
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         <div class="form-group">
                         <label><?php echo esc_html__( 'Job level', 'nokri' ); ?></label>
                            <select class="js-example-basic-single" data-allow-clear="true" data-placeholder="<?php echo esc_html__( 'Job Level', 'nokri' ); ?>" name="job_level" data-parsley-required="true">
                                <option value=""><?php echo esc_html__( 'Select Option', 'nokri' ); ?></option>
                                <?php echo nokri_job_post_taxonomies('job_level', $job_level); ?>
                            </select>
                         </div>
                      </div>
                       <!--job vacancies -->
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         <div class="form-group">
                         <label><?php echo esc_html__( 'Number of vacancies', 'nokri' ); ?></label>
                            <input type="text" class="form-control" placeholder="<?php echo esc_html__( 'Number of vacancies', 'nokri' ); ?>" name="job_posts" value="<?php echo esc_attr($job_posts); ?>" data-parsley-required="true">
                         </div>
                      </div>
                      <?php if($job_apply_with_option) { ?>
                      <!--Apply With -->
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         <div class="form-group">
                         <label><?php echo esc_html__( 'Apply With Link', 'nokri' ); ?></label>
                            <select class="js-example-basic-single" data-allow-clear="true" data-placeholder="<?php echo esc_html__( 'Select an option', 'nokri' ); ?>" name="job_apply_with" data-parsley-required="true" id="ad_external">
                              <option value="0"><?php echo esc_html__( 'Select Option', 'nokri' ); ?></option>
                               <option value="exter" <?php if($job_apply_with == "exter" ){ echo 'selected="selected"';}?>><?php echo esc_html__( 'External Link', 'nokri' ); ?></option>
                               <option value="inter" <?php if($job_apply_with == "inter" ){ echo 'selected="selected"'; }?>><?php echo esc_html__( 'Internal Link', 'nokri' ); ?></option>
                            </select>
                         </div>
                      </div>
                      <!--Apply With Extra Feild-->
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="job_external_link_feild" <?php if($job_ext_url == "" ){echo 'style="display: none;"';}?> >
                         <div class="form-group">
                         <label><?php echo esc_html__( 'Put Link Here', 'nokri' ); ?></label>
                            <input type="text" class="form-control" placeholder="<?php echo esc_html__( 'Put Link Here', 'nokri' ); ?>" name="job_external_url" value="<?php echo esc_attr($job_ext_url); ?>"  id="job_external_url" data-parsley-type="url"> 
                         </div>
                      </div>
                      <?php } ?>
                       <!--job skills -->
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                         <div class="form-group">
                         <label><?php echo esc_html__( 'Job skills', 'nokri' ); ?></label>
                            <select class="js-example-basic-single" multiple data-allow-clear="true" data-placeholder="<?php echo esc_html__( 'Job Skills', 'nokri' ); ?>" name="job_skills[]" data-parsley-required="true">
                               <option value=""><?php echo esc_html__( 'Select Options', 'nokri' ); ?></option>
                               <?php echo nokri_job_selected_skills('job_skills','_job_skills',$job_skills); ?>
                            </select>
                         </div>
                      </div>
                      <!--job tags -->
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                         <div class="form-group">
                         <label><?php echo esc_html__( 'Job tags', 'nokri' ); ?></label>
                            <input type="text" id="tags_tag_job" name="job_tags" data-parsley-required="true"  value="<?php echo ($tags); ?>" class="form-control" data-role="tagsinput" />
                         </div>
                      </div>
                   </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                   <div class="post-job-heading">
                      <h3><?php echo esc_html($job_country_level_heading); ?></h3>
                   </div>
                   <!--job country -->
                   <div class="form-group">
                    <label><?php echo esc_html($job_country_level_1 ); ?></label>
                      <select class="js-example-basic-single" data-allow-clear="true" data-placeholder="<?php echo esc_attr($job_country_level_1 ); ?>" id="ad_country" name="ad_country">
                         <option value="0"><?php echo esc_html__( 'Select an option', 'nokri' ); ?></option>
                          <?php echo "".($country_html);?>
                      </select>
                      <input type="hidden" name="ad_country_id" id="ad_country_id" value="" />
                   </div>
                    <!--job state -->
                   <div class="form-group" id="ad_country_sub_div">
                   <label><?php echo esc_html($job_country_level_2 ); ?></label>
                      <select class="js-example-basic-single" data-allow-clear="true" data-placeholder="<?php echo esc_attr($job_country_level_2 ); ?>" id="ad_country_states" name="ad_country_states">
                         <option value="0"><?php echo esc_html__( 'Select an option', 'nokri' ); ?></option>
                          <?php echo "".($country_states);?>
                      </select>
                   </div>
                   <!--job city -->
                   <div class="form-group" id="ad_country_sub_sub_div">
                   <label><?php echo esc_html($job_country_level_3 ); ?></label>
                      <select class="js-example-basic-single" data-allow-clear="true" data-placeholder="<?php echo esc_attr($job_country_level_3 ); ?>" id="ad_country_cities" name="ad_country_cities">
                         <option value="0"><?php echo esc_html__( 'Select an option', 'nokri' ); ?></option>
                          <?php echo "".($country_cities);?>
                      </select>
                   </div>
                    <!--job town -->
                   <div class="form-group" id="ad_country_sub_sub_sub_div">
                    <label><?php echo esc_html($job_country_level_4 ); ?></label>
                      <select class="js-example-basic-single" data-allow-clear="true" data-placeholder="<?php echo esc_attr($job_country_level_4 ); ?>" id="ad_country_towns" name="ad_country_towns">
                         <option value="0"><?php echo esc_html__( 'Select an option', 'nokri' ); ?></option>
                          <?php echo "".($country_towns);?>
                      </select>
                   </div>
				   <?php if($is_lat_long) { ?>
                   <div class="form-group">
                      <div class="post-job-heading mt30">
                         <h3><?php echo ( $map_location_txt); ?> </h3>
                      </div>
                   </div>
                   <div class="form-group">
                   	<label><?php echo esc_html__( 'Select address', 'nokri' ); ?></label>
                   	  <input type="hidden" id="is_post_job" value="1" />	
                      <input type="text" class="form-control" data-parsley-required="true" name="sb_user_address" id="sb_user_address" value="<?php echo esc_attr($ad_mapLocation); ?>" placeholder="<?php echo esc_html__('Enter map address', 'nokri' ); ?>">
                   <?php if($mapType == 'google_map') { ?>
                      <a href="javascript:void(0);" id="your_current_location" title="<?php echo esc_html__('You Current Location', 'nokri' ); ?>"><i class="fa fa-crosshairs"></i></a>
                      <?php } ?>
                   </div>
                   <div class="form-group">
                      <div id="dvMap" style="width:100%; height: 300px"></div>
                   </div>
                   <div class="form-group">
                       <input class="form-control" data-parsley-required="true" name="ad_map_long" id="ad_map_long" value="<?php echo esc_attr($ad_map_long); ?>" type="text">
                      
                   </div>
                   <div class="form-group">
                      <input class="form-control" data-parsley-required="true" type="text" name="ad_map_lat" id="ad_map_lat" value="<?php echo esc_attr($ad_map_lat); ?>">
                   </div>
                   <?php } ?>
                   <?php 
                    /* Employer Purchase Any Package*/	
                    if (get_user_meta( $user_id, '_sb_expire_ads', true ) != '') 
                    { ?>
                    <div class="post-job-section job job-topups">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h4 class="post-job-heading"><?php echo esc_html__( 'Boost your job with addons', 'nokri' ); ?></h4>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <ul>
                            <?php
                            $job_classes = get_terms( array( 'taxonomy' => 'job_class', 'hide_empty' => false, ) );
                            foreach( $job_classes as $job_class )
                            {
                                $term_id 				= $job_class->term_id;
                               $job_class_user_meta 	= get_user_meta($user_crnt_id, 'package_job_class_'.$term_id, true);
                                $emp_class_check     	= get_term_meta($job_class->term_id, 'emp_class_check', true);
                                if( $job_class_user_meta  > 0 && $emp_class_check  != 1)
                                    { ?>
                                <li>
                                    <div class="job-topups-box">
                                        <h4><?php echo esc_html($job_class->name); ?></h4>
                                        <p><b><?php echo "".$job_class_user_meta." "; ?></b><?php echo esc_html__( 'Remaining', 'nokri' ); ?></p>
                                    </div>
                                    <div class="job-topups-checkbox">
                                     <?php 
                                     $job_class_checked = wp_get_post_terms($job_id, 'job_class', array("fields" => "names"));
                                if (in_array($job_class->name, $job_class_checked))
                                  {
                                    echo '<h5>'.esc_html__( 'Already', 'nokri' )." ".$job_class->name.'</h5>';
                                  }
                                else
                                  {
                                     echo '<input type="checkbox" name="class_type_value[]" value="'.$term_id.'" class="input-icheck-others">';
                                  }
                                     ?>
                                    </div>
                                </li>
                                <?php } } ?> 
                            </ul>
                        </div>
                    </div>
                    <?php  } ?>
                   <div class="form-group">
                      <input type="submit" id="job_post" class=" form-control btn n-btn-flat btn-block btn-mid" value="<?php echo esc_html__( 'Submit', 'nokri' ); ?>">
                      <button class="btn n-btn-flat btn-block no-display" type="button" id="job_proc" disabled><?php echo  esc_html__( 'Processing...','nokri' ); ?></button>
		   <button class="btn n-btn-flat btn-block no-display" type="button" id="job_redir" disabled><?php echo  esc_html__( 'Redirecting...','nokri' ); ?></button>
                   </div>
                </div>
             </form>
          </div>
       </div>
    </div>
 </div>
</section>
<?php 
if($mapType == 'leafletjs_map')
{
	echo $lat_lon_script = '<script type="text/javascript">
	var mymap = L.map(\'dvMap\').setView(['.$ad_map_lat.', '.$ad_map_long.'], 13);
		L.tileLayer(\'https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}{r}.png\', {
			maxZoom: 18,
			attribution: \'\'
		}).addTo(mymap);
		var markerz = L.marker(['.$ad_map_lat.', '.$ad_map_long.'],{draggable: true}).addTo(mymap);
		var searchControl 	=	new L.Control.Search({
			url: \'//nominatim.openstreetmap.org/search?format=json&q={s}\',
			jsonpParam: \'json_callback\',
			propertyName: \'display_name\',
			propertyLoc: [\'lat\',\'lon\'],
			marker: markerz,
			autoCollapse: true,
			autoType: true,
			minLength: 2,
		});
		searchControl.on(\'search:locationfound\', function(obj) {
			
			var lt	=	obj.latlng + \'\';
			var res = lt.split( "LatLng(" );
			res = res[1].split( ")" );
			res = res[0].split( "," );
			document.getElementById(\'ad_map_lat\').value = res[0];
			document.getElementById(\'ad_map_long\').value = res[1];
		});
		mymap.addControl( searchControl );
		
		markerz.on(\'dragend\', function (e) {
		  document.getElementById(\'ad_map_lat\').value = markerz.getLatLng().lat;
		  document.getElementById(\'ad_map_long\').value = markerz.getLatLng().lng;
		});
	</script>';
}
if($mapType == 'google_map')
{
	nokri_load_search_countries(1); 		
}
get_footer();