<?php
global $nokri;
$mapType = nokri_mapType();
if($mapType == 'google_map')
{
	wp_enqueue_script( 'google-map-callback',false);
}
$user_info      = wp_get_current_user();
$user_crnt_id   = $user_info->ID;
$is_candidate   = $user_info->ID;

$ad_map_lat = '';
if((isset($nokri['sb_default_lat'])) && $nokri['sb_default_lat']  != '' )
{
	$ad_map_lat =  ($nokri['sb_default_lat']);
}
$ad_map_long = '';
if((isset($nokri['sb_default_lat'])) && $nokri['sb_default_lat']  != '' )
{
	$ad_map_long =  ($nokri['sb_default_long']);
}
if(get_user_meta($user_crnt_id, '_cand_map_lat', true) != '')
 {
	$ad_map_lat	    = get_user_meta($user_crnt_id, '_cand_map_lat', true);
 }

  if(get_user_meta($user_crnt_id, '_cand_map_long', true) != '')
 {
	$ad_map_long	= get_user_meta($user_crnt_id, '_cand_map_long', true); 
 }
 
$ad_mapLocation     = '';
$ad_mapLocation     = get_user_meta($user_crnt_id, '_cand_address', true);
nokri_load_search_countries(1);
$cand_video	        = get_user_meta($user_crnt_id, '_cand_video', true); 
$job_qualifications	= get_user_meta($user_crnt_id, '_cand_last_edu', true);
$cand_gender	    = get_user_meta($user_crnt_id, '_cand_gender', true);
$cand_profile	    = get_user_meta($user_crnt_id, '_user_profile_status', true);
$cand_type	        = get_user_meta($user_crnt_id, '_cand_type', true);
$cand_level	        = get_user_meta($user_crnt_id, '_cand_level', true);
$cand_experience    = get_user_meta($user_crnt_id, '_cand_experience', true);
$cand_custom_loc    = array();
$cand_custom_loc    = get_user_meta($user_crnt_id, '_cand_custom_location', true);


$levelz	            =	count((array) $cand_custom_loc);

/* Getting Candidate Dp */
$image_dp_link[0] = '';
if( get_user_meta($user_crnt_id, '_cand_dp', true ) != "" )
{

	$attach_dp_id  =   get_user_meta($user_crnt_id, '_cand_dp', true );
	$image_dp_link =   wp_get_attachment_image_src( $attach_dp_id, '' );
}
//Countries
$ad_country	=	nokri_get_cats('ad_location' , 0 );
$country_html	=	'';
foreach( $ad_country as $ad_count )
{
	$country_html	.=	'<option value="'.$ad_count->term_id.'">' . $ad_count->name .  '</option>';
}
$cand_skills_values_get	= get_user_meta($user_crnt_id, '_cand_skills_values', true);
$cand_skills_values = '';
if(!empty($cand_skills_values_get))
{
	foreach ($cand_skills_values_get as $value) 
	{
		$cand_skills_values .= $value.',';
		
	}
}
/*Setting profile option*/
$profile_setting_option = isset($nokri['user_profile_setting_option']) ? $nokri['user_profile_setting_option']  : false;
/*Is map show*/
$is_lat_long = isset($nokri['allow_lat_lon']) ? $nokri['allow_lat_lon']  : false;
/*Is account del option*/
$is_acount_del = isset($nokri['user_profile_delete_option']) ? $nokri['user_profile_delete_option']  : false;
/* For job Location level text */
$job_country_level_heading = ( isset($nokri['job_country_level_heading']) && $nokri['job_country_level_heading'] != ""  ) ? $nokri['job_country_level_heading'] : '';
/* For Map  text */
$map_location_txt = ( isset($nokri['job_map_heading_txt']) && $nokri['job_map_heading_txt'] != ""  ) ? $nokri['job_map_heading_txt'] : '';

$job_country_level_1 = ( isset($nokri['job_country_level_1']) && $nokri['job_country_level_1'] != ""  ) ? $nokri['job_country_level_1'] : '';

$job_country_level_2 = ( isset($nokri['job_country_level_2']) && $nokri['job_country_level_2'] != ""  ) ? $nokri['job_country_level_2'] : '';

$job_country_level_3 = ( isset($nokri['job_country_level_3']) && $nokri['job_country_level_3'] != ""  ) ? $nokri['job_country_level_3'] : '';

$job_country_level_4 = ( isset($nokri['job_country_level_4']) && $nokri['job_country_level_4'] != ""  ) ? $nokri['job_country_level_4'] : '';
/* Make location selected on update ad */
$ad_countries	=	nokri_get_cats('ad_location' , 0 );
$country_html	=	'';
foreach( $ad_countries as $ad_country )
{
	$selected	=	'';
	if(isset($cand_custom_loc[0]))
	{
		if( $levelz > 0 && $ad_country->term_id == $cand_custom_loc[0])
		{
			$selected	=	'selected="selected"';
		}
	}
	$country_html	.=	'<option value="'.$ad_country->term_id.'" '.$selected.'>' . $ad_country->name .  '</option>';
}
$country_states = '';
if( $levelz >= 2 )
{

	$ad_states	=	nokri_get_cats('ad_location' , $cand_custom_loc[0] );
	$country_states	=	'';
	foreach( $ad_states as $ad_state )
	{
		$selected	=	'';
		if( $levelz > 0 && $ad_state->term_id == $cand_custom_loc[1] )
		{
			$selected	=	'selected="selected"';
		}
		$country_states	.=	'<option value="'.$ad_state->term_id.'" '.$selected.'>' . $ad_state->name .  '</option>';
		
	}
	
}
$country_cities	= '';
if( $levelz >= 3 )
{
	$ad_country_cities	=	nokri_get_cats('ad_location' , $cand_custom_loc[1] );
	$country_cities	=	'';
	foreach( $ad_country_cities as $ad_city )
	{
		$selected	=	'';
		if( $levelz > 0 && $ad_city->term_id ==  $cand_custom_loc[2] )
		{
			$selected	=	'selected="selected"';
		}
		$country_cities	.=	'<option value="'.$ad_city->term_id.'" '.$selected.'>' . $ad_city->name .  '</option>';
		
	}
	
}
$country_towns = '';
if( $levelz >= 4 )
{
	$ad_country_town	=	nokri_get_cats('ad_location' , $cand_custom_loc[2] );
	
	$country_towns	=	'';
	foreach( $ad_country_town as $ad_town )
	{
		$selected	=	'';
		if( $levelz > 0 && $ad_town->term_id == $cand_custom_loc[3] )
		{
			$selected	=	'selected="selected"';
		}
		$country_towns	.=	'<option value="'.$ad_town->term_id.'" '.$selected.'>' . $ad_town->name .  '</option>';
		
	}
	
}
?>
<form id="candidate-profile" method="post" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" id="country_level" name="country_level" value="<?php echo esc_attr($levelz); ?>" />
 <div class="cp-loader"></div>
<!-- Candidate Personal Informations -->
<div class="main-body">
<div class="dashboard-edit-profile">
    <h4 class="dashboard-heading"><?php echo esc_html__('Personal Information','nokri'); ?></h4>
        <div class="row">
            <div class="col-md-6 col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class=""><?php echo esc_html__('Your Full Name','nokri'); ?></label>
                    <input autocomplete="off" data-parsley-error-message="<?php echo esc_html__('Enter Your Name','nokri'); ?>" type="text"  required  class="form-control" value="<?php echo esc_attr($user_info->display_name); ?>" name="cand_name" placeholder="<?php echo esc_html__('Write Full Name','nokri'); ?>">
                </div>
            </div>
            <div class="col-md-6 col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class=""><?php echo esc_html__('Profession','nokri'); ?></label>
                    <input type="text"  value="<?php echo get_user_meta($user_crnt_id, '_user_headline', true); ?>" name="cand_headline" class="form-control" placeholder="<?php echo esc_html__('e.g. Web Developer','nokri'); ?>">
                </div>
            </div>
            <div class="clear"></div>
            <div class="col-md-6 col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class=""><?php echo esc_html__('Email','nokri'); ?></label>
                    <input type="email" value="<?php echo  $user_info->user_email; ?>" name="cand_email" class="form-control" disabled placeholder="<?php echo esc_html__('candidate@example.com','nokri'); ?>">
                </div>
            </div>
            <div class="col-md-6 col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class=""><?php echo esc_html__('Phone','nokri'); ?></label>
                    <input type="number" data-parsley-error-message="<?php echo esc_html__('Should be in digits','nokri'); ?>" data-parsley-type="digits"    value="<?php echo get_user_meta($user_crnt_id, '_sb_contact', true); ?>"  name="cand_phone" class="form-control" placeholder="<?php echo esc_html__('Contact number without space','nokri'); ?>">
                </div>
            </div>
            <div class="col-md-6 col-xs-12 col-sm-6">
                <div class="form-group">
                    <label ><?php echo esc_html__( 'Date Of Birth', 'nokri' ); ?></label>
                    <input type="text"   value="<?php echo  nokri_candidate_user_meta('_cand_dob'); ?>" name="cand_dob" class="datepicker-cand-dob form-control"  />
                </div>
            </div>
            <div class="col-md-6 col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class=""><?php echo esc_html__( 'Gender', 'nokri' ); ?></label>
                    <select  class="select-generat form-control" name="cand_gender">
                        <option value="male" <?php if ( $cand_gender == 'male') { echo "selected"; } ; ?>><?php echo esc_html__( 'Male', 'nokri' ); ?></option>
                        <option value="female" <?php if ( $cand_gender == 'female') { echo "selected"; } ; ?>><?php echo esc_html__( 'Female', 'nokri' ); ?></option>
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class=""><?php echo esc_html__('Profile Image:','nokri'); ?></label>
                    <input id="imgdp" name="candidate_dp[]" type="file" class=" candidate_files-data file form-control" data-show-preview="false" data-allowed-file-extensions='["jpg", "png", "jpeg"]' data-show-upload="false">
                </div>
            </div>
            <div class="col-md-6 col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class=""><?php echo esc_html__( 'Experience', 'nokri' ); ?></label>
                    <select   class="select-generat form-control"  name="cand_experience">
                        <?php echo nokri_job_post_taxonomies('job_experience', $cand_experience); ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class=""><?php echo esc_html__( 'Level', 'nokri' ); ?></label>
                    <select   class="select-generat form-control"  name="cand_level">
                        <?php echo nokri_job_post_taxonomies('job_level', $cand_level); ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-xs-12 col-sm-6">
                <div class="form-group">
                    <label class=""><?php echo esc_html__( 'Type', 'nokri' ); ?></label>
                    <select   class="select-generat form-control"  name="cand_type">
                        <?php echo nokri_job_post_taxonomies('job_type', $cand_type); ?>
                    </select>
                </div>
            </div>
             <?php if($profile_setting_option) { ?>
            <div class="col-md-12 col-xs-12 col-sm-12">
                <div class="form-group">
                    <label class=""><?php echo esc_html__( 'Set your profile', 'nokri' ); ?></label>
                    <select  class="select-generat form-control" name="cand_profile">
                    <option value="0"><?php echo esc_html__( 'Select an option', 'nokri' ); ?></option>
                        <option value="pub" <?php if ( $cand_profile == 'pub') { echo "selected"; } ; ?>><?php echo esc_html__( 'Public', 'nokri' ); ?></option>
                        <option value="priv" <?php if ( $cand_profile == 'priv') { echo "selected"; } ; ?>><?php echo esc_html__( 'Private', 'nokri' ); ?></option>
                    </select>
                </div>
            </div>
             <?php } ?>
            <div class="col-md-12 col-xs-12 col-sm-12">
                <div class="form-group">
                    <label class=""><?php echo esc_html__('Select Your Skills','nokri'); ?></label>
                    <select   class="select-generat form-control" name="cand_skills[]" multiple="multiple">
                         <?php echo nokri_candidate_skills('job_skills','_cand_skills'); ?>
                    </select>
                </div>
            </div>
            
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                 <div class="form-group">
                 <label><?php echo esc_html__( 'Select your skills percentage respectively', 'nokri' ); ?></label>
                    <input type="text" id="tags_tag" name="cand_skills_values"  value="<?php echo (rtrim($cand_skills_values)); ?>" class="form-control" data-role="tagsinput"/>
                 </div>
            </div>
            
            
            <div class="col-md-12 col-xs-12 col-sm-12">
                <div class="form-group">
                    <label class=""><?php echo esc_html__('About yourSelf','nokri'); ?></label>
                    <textarea  name="cand_intro" class="form-control rich_textarea"   cols="30" rows="10"><?php echo  nokri_candidate_user_meta('_cand_intro'); ?></textarea>
                </div>
            </div>
            <div class="col-md-12 col-xs-12 col-sm-12">
                <input type="submit"  value="<?php echo esc_html__('Save Information','nokri'); ?>" class="btn n-btn-flat cand_person_save">
                <input type="button" disabled  value="<?php echo  esc_html__( 'Processing...','nokri' ); ?>" class="btn n-btn-flat cand_person_pro"> 
            </div>
        </div>
</div>
</div>
<!-- End Candidate Personal Informations -->                             
<!-- Candidate Resume Uplaoad -->
<div class="main-body">
	<div class="dashboard-edit-profile" id="add-resume">
		<h4 class="dashboard-heading"><?php echo esc_html__('Add Resumes','nokri'); ?></h4>
		<div class="row">
			<div class="col-md-12 col-xs-12 col-sm-12">
                <div class="form-group">
                    <label class="control-label">
                        <?php echo esc_html__( 'Your Resume', 'nokri'); ?><small><?php echo " " .esc_html__('Drag drop or click to upload resumes against you apply for jobs','nokri'); ?></small>
                    </label>
                    <div id="dropzone_resume" class="dropzone"></div>
                </div>
			</div>
		</div>
	</div>
</div>
<!-- End Candidate Resume Uplaoad -->                         
<!-- Candidate Education -->                           
<div class="main-body">
	<div class="dashboard-edit-profile for-edus">
		<h4 class="dashboard-heading"><?php echo esc_html__('Educational Details','nokri'); ?></h4>
		<div class="row">
				<?php 
                 $cand_education	=  get_user_meta($user_crnt_id, '_cand_education', true); 
                 $cand_education    =  ( $cand_education ) ? $cand_education : array('1');	
                 $c = 1;
                 if( $cand_education){
                 foreach($cand_education as $edu)
                 {
                     
                 $removeBtn = '';
                 if( $c != 1 )
                 {
                    $removeBtn = '<div class="input-group-btn remove-btn"><button class="btn btn-danger" type="button" onclick="remove_education_fields('.$c.');"> <span class="ti-minus" aria-hidden="true"></span>'.esc_html__('Remove', 'nokri' ).'</button></div>';
                 }
                  $removeClass = ( $c != 1 ) ? 'removeclass_edu'.$c : '';
                  
                  $degree_name       =  (isset( $edu['degree_name'] ) )        ? esc_html($edu['degree_name'])      : '';
                  $degree_institute  =  (isset( $edu['degree_institute'] ) )   ? esc_html($edu['degree_institute']) : '';
                  $degree_start      =  (isset( $edu['degree_start'] ) )       ? esc_html($edu['degree_start'])     : '' ;
                  $degree_end        =  (isset( $edu['degree_end'] ) ) 		   ? esc_html($edu['degree_end'])       : '';
                  $degree_percent    =  (isset( $edu['degree_percent'] ) )     ? esc_html($edu['degree_percent'])   : '';
                  $degree_grade      =  (isset( $edu['degree_grade'] ) )       ? esc_html($edu['degree_grade'])     : '';
                  $degree_detail     =   (isset( $edu['degree_detail'] ) )     ? ($edu['degree_detail'])            : '';
                ?>
			
				<div class="ad-more-box-single <?php echo esc_attr($removeClass); ?>">
                	<?php if($c > 1){?>
                	<div class="col-md-12 col-sm-12"><h4 class="dashboard-heading"><?php echo esc_html__( 'Education Additional Field', 'nokri');?></h4></div>
                    <?php } ?>
					<div class="col-md-6 col-sm-6">
						<div class="form-group ">
							<label>
								<?php echo esc_html__( 'Qualification Title', 'nokri'); ?><span class="required">*</span>
							</label>
							<input type="text"    placeholder="<?php echo esc_html__( 'Degree Title', 'nokri'); ?>"  name="cand_education['degree_name'][]" class="form-control" value="<?php  echo esc_html($degree_name); ?>">
						</div>
					</div>
                    
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label>
								<?php echo esc_html__( 'Institute Name', 'nokri'); ?>
							</label>
							<input type="text"  placeholder="<?php echo esc_html__( 'Institute Name', 'nokri'); ?>" name="cand_education['degree_institute'][]" class="form-control" value="<?php echo esc_html($degree_institute); ?>">
						</div>
					</div>
                    <div class="clear"></div>
					<div class="col-md-6 col-xs-12 col-sm-6">
						<div class="form-group">
							<label class="">
								<?php echo esc_html__( 'Start Date', 'nokri'); ?>
							</label>
							<input type="text"  name="cand_education['degree_start'][]" value="<?php echo esc_html($degree_start); ?>" class="datepicker-here-canidate form-control" />
						</div>
					</div>
					<div class="col-md-6 col-xs-12 col-sm-6">
						<div class="form-group">
							<label class="">
								<?php echo esc_html__( 'End Date', 'nokri'); ?>
							</label>
							<input type="text"  value="<?php echo esc_html($degree_end); ?>" name="cand_education['degree_end'][]" class="datepicker-here-canidate form-control" />
						</div>
					</div>
                    <div class="clear"></div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label>
								<?php echo esc_html__( 'Percentage', 'nokri'); ?>
							</label>
							<input type="text"  data-parsley-pattern="/([0-9]{1,}\.[0-9]{1,})/"  data-parsley-error-message="<?php echo esc_html__('Should Be In Decimals ','nokri'); ?>"  placeholder="<?php echo esc_html__('Only digits allowed without % sign e.g 80.0','nokri'); ?>" name="cand_education['degree_percent'][]" class="form-control" value="<?php echo esc_html($degree_percent); ?>">
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label>
								<?php echo esc_html__( 'Grades', 'nokri'); ?>
							</label>
							<input type="text" placeholder="<?php echo esc_html__('Only Grade Letter e.g A+,B,C','nokri'); ?>" name="cand_education['degree_grade'][]" class="form-control" value="<?php echo esc_html($degree_grade); ?>">
						</div>
					</div>
                    <div class="clear"></div>
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<label>
								<?php echo esc_html__( 'Description', 'nokri'); ?>
							</label>
							<textarea rows="6" class="form-control rich_textarea" name="cand_education['degree_detail'][]" id="ad_description2"><?php echo ($degree_detail); ?></textarea>
						</div>
					</div>
					<?php echo "".$removeBtn ; ?>
				</div>
				<?php 
					$c++; } 
							}?>
                            
				<div class="clearfix"></div>
               <div class="ad_more_box"> 
				<div id="education_fields"></div>
				<div class="input-group-btn ad-more-btn">
					<button class="btn btn-success" type="button" onclick="return education_fields();"> <span class="ti-plus" aria-hidden="true"></span>
						<?php echo esc_html__( 'Add More', 'nokri'); ?>
					</button>
				</div>
			</div>
			<div class="col-md-12 col-xs-12 col-sm-12">
				<input type="submit" value="<?php echo esc_html__('Save Education','nokri'); ?>" class="btn n-btn-flat cand_person_save">
                <input type="button" disabled  value="<?php echo  esc_html__( 'Processing...','nokri' ); ?>" class="btn n-btn-flat cand_person_pro">
			</div>
		</div>
	</div>
</div>
 <!-- End Candidate  Education -->
<!-- Candidate Professions -->                           
<div class="main-body">
    <div class="dashboard-edit-profile for-pros">
        <h4 class="dashboard-heading"><?php echo esc_html__('Job Experience','nokri'); ?></h4>
            <div class="row">
							<?php 
							$cand_profession	= get_user_meta($user_crnt_id, '_cand_profession', true); 
                             $cand_profession    =  ( $cand_profession ) ? $cand_profession : array('1');	
                             $c = 1;
                             if( $cand_profession) {
							  foreach($cand_profession as $profession) {
								$removeBtn = '';
								if( $c != 1 )
								 {
								$removeBtn = '<div class="input-group-btn remove-btn"><button class="btn btn-danger" type="button" onclick="remove_professional_fields('.$c.');"><span class="ti-minus" aria-hidden="true"></span>'.esc_html__('Remove', 'nokri' ).'</button></div>';
								}
							  $removeClass 		  = ( $c != 1 ) ? 'removeclass_pro'.$c : '';
							  $project_name       =  (isset( $profession['project_name'] ) ) ? esc_html($profession['project_name']) : '';
							  
  $project_start      =  (isset( $profession['project_start'] ) ) ? esc_html($profession['project_start']) : '';
  $project_end        =  (isset( $profession['project_end'] ) && $profession['project_end'] != "" ) ? esc_html($profession['project_end']) : '';
  $project_role       =  (isset( $profession['project_role'] ) ) ? esc_html($profession['project_role']) : '';
  $project_organization =  (isset( $profession['project_organization'] ) ) ? esc_html($profession['project_organization']) : '';
  $project_detail     =  (isset( $profession['project_desc'] ) ) ? ($profession['project_desc']) : '';
							  
							  $hide_class = '';
							 
							  $tweek_class = '';
							  if ($project_name == 1)
							  {
								  $tweek_class = 'checked="checked"';
							  }
							  if ($project_end == '' && $project_name == 1)
							  {
								 $hide_class = 'readonly="readonly"';
							  }
							?>
            			<div class="ad-more-box-single <?php echo esc_attr($removeClass); ?>">
                        <?php if($c > 1){?>
                	<div class="col-md-12 col-sm-12"><h4 class="dashboard-heading"><?php echo esc_html__( 'Professional Additional Field', 'nokri');?></h4></div>
                    <?php } ?>
                        <div class="col-md-6 col-sm-6 col-sm-6">
                            <div class="form-group">
                                <label><?php echo esc_html__('Organization Name','nokri'); ?><span class="required">*</span></label>
                                <input type="text"  value="<?php echo esc_html($project_organization); ?>" placeholder="<?php echo esc_html__('Organization Name','nokri'); ?>" name="cand_profession['project_organization'][]"  class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label><?php echo esc_html__('Your Role','nokri'); ?><span class="required">*</span></label>
                                <input type="text" value="<?php echo esc_html($project_role); ?>"  placeholder="<?php echo esc_html__('Software Engineer Etc','nokri'); ?>" name="cand_profession['project_role'][]"  class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label class=""><?php echo esc_html__('Job start Date','nokri'); ?></label>
                                <input  type="text"  name="cand_profession['project_start'][]" value="<?php echo esc_html($project_start); ?>" class="datepicker-here-canidate form-control"  />
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12 col-sm-6"> 
                            <div class="form-group " >
                                <label class="end-hide" ><?php echo esc_html__('Job End Date','nokri'); ?></label>
                                <input type="text"  value="<?php echo esc_html($project_end); ?>" name="cand_profession['project_end'][]"  class="datepicker-here-canidate form-control end-hide"   <?php echo ($hide_class); ?>  />

<input type="hidden"  value="<?php echo esc_html($project_name); ?>" name="cand_profession['project_name'][]"  class="checked-input-hide"   <?php echo ($hide_class); ?>  />

<input type="checkbox" name="checked" <?php echo esc_attr($tweek_class); ?>  class="icheckbox_minimal form-control" >&nbsp;<?php echo esc_html__('Are You Currently Working There?','nokri'); ?> 
                            </div>
                        </div>     
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label><?php echo esc_html__('Description','nokri'); ?></label>
                                <textarea rows="6" class="form-control rich_textarea"  name="cand_profession['project_desc'][]" id="ad_description"><?php echo ($project_detail); ?></textarea>
                            </div>
                        </div>
                  		<?php echo "".$removeBtn ; ?>
                        </div>
                        <?php  $c++; }  } ?>
                        <div class="clearfix"></div>
                         <div class="ad_more_box"> 
                        <div id="professional_fields"></div>
        				<div class="input-group-btn ad-more-btn">
       					 <button class="btn btn-success" type="button"  onclick="return professional_fields();"> <span class="ti-plus" aria-hidden="true"></span><?php echo esc_html__('Add More','nokri'); ?></button>
      					</div>
        				</div>
        				<div class="col-md-12 col-xs-12 col-sm-12">
                    <input type="submit" value="<?php echo esc_html__('Save experience','nokri'); ?>" class="btn n-btn-flat cand_person_save">
                    <input type="button" disabled  value="<?php echo  esc_html__( 'Processing...','nokri' ); ?>" class="btn n-btn-flat cand_person_pro">
                </div>
            </div>
    </div>
</div>
 <!-- End Candidate Professions-->
<!-- Candidate Certifications -->                           
<div class="main-body">
    <div class="dashboard-edit-profile for-cert">
        <h4 class="dashboard-heading"><?php echo esc_html__('Certifications Detail','nokri'); ?></h4>
            <div class="row">
							<?php 
							 $cand_certifications	=  get_user_meta($user_crnt_id, '_cand_certifications', true);
							 $cand_certifications   =  ( $cand_certifications ) ? $cand_certifications : array('1');
							 $cert = '1';
							  foreach($cand_certifications as $certification) {
								$removeBtn = '';
								if( $cert != 1 )
								 {
								$removeBtn = '<div class="input-group-btn remove-btn"><button class="btn btn-danger" type="button" onclick="remove_certification_fields('.$cert.');"> <span class="ti-minus" aria-hidden="true"></span>'.esc_html__('Remove', 'nokri' ).'</button></div>';
								}
							  $removeClass              =  ( $cert != 1 ) ? 'removeclass_cert'.$cert : '';
							  $certification_name       =  (isset( $certification['certification_name'] ) ) ? esc_html($certification['certification_name']) : '';
							  $certification_start      =  (isset( $certification['certification_start'] ) ) ? esc_html($certification['certification_start']) : '';
							  $certification_end        =  (isset( $certification['certification_end'] ) ) ? esc_html($certification['certification_end']) : '';
							  $certification_duration   =  (isset( $certification['certification_duration'] ) ) ? esc_html($certification['certification_duration']) : '';
							  $certification_institute  =  (isset( $certification['certification_institute'] ) ) ? esc_html($certification['certification_institute']) : '';
							  $certification_desc       =  (isset( $certification['certification_desc'] ) ) ? ($certification['certification_desc']) : '';
							?>
            			<div class="ad-more-box-single <?php echo esc_attr($removeClass); ?>">
                        <?php if($cert > 1){?>
                	<div class="col-md-12 col-sm-12"><h4 class="dashboard-heading"><?php echo esc_html__( 'Certification Additional Field', 'nokri');?></h4></div>
                    <?php } ?>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group ">
                                <label><?php echo esc_html__('Certification Title','nokri'); ?><span class="required">*</span></label>
                                <input type="text" placeholder="<?php echo esc_html__('Certification Title','nokri'); ?>" name="cand_certifications['certification_name'][]" class="form-control" value="<?php echo esc_html($certification_name); ?>">
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label class=""><?php echo esc_html__('Certification Start Date','nokri'); ?></label>
                                <input type="text" name="cand_certifications['certification_start'][]" value="<?php echo esc_html($certification_start); ?>" class="datepicker-here-canidate form-control"   />
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label class=""><?php echo esc_html__('Certification End Date','nokri'); ?></label>
                                <input type="text" value="<?php echo esc_html($certification_end); ?>" name="cand_certifications['certification_end'][]" class="datepicker-here-canidate form-control"   />
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label><?php echo esc_html__('Certification Duration','nokri'); ?><span class="required">*</span></label>
                                                    <input type="text" value="<?php echo esc_html($certification_duration); ?>"  placeholder="<?php echo esc_html__('Certification Duration','nokri'); ?>" name="cand_certifications['certification_duration'][]"  class="form-control">
                                                </div>
                                            </div>
                        <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label><?php echo esc_html__('Certification Institute','nokri'); ?><span class="required">*</span></label>
                                                    <input type="text" value="<?php echo esc_html($certification_institute); ?>" placeholder="<?php echo esc_html__('Certification Institute','nokri'); ?>" name="cand_certifications['certification_institute'][]"  class="form-control">
                                                </div>
                                            </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label><?php echo esc_html__('Description','nokri'); ?></label>
                                                    <textarea rows="6" class="form-control rich_textarea"  name="cand_certifications['certification_desc'][]" id="certification_description"><?php echo ($certification_desc); ?></textarea>
                                                </div>
                                            </div>
                  <?php echo "".$removeBtn ; ?>
                                            </div>
                                            <?php  $cert++; } ?>
                                            <div class="clearfix"></div>
                                             <div class="ad_more_box">   
                                            <div id="certification_fields"></div>
                                             <div class="input-group-btn ad-more-btn">
                                <button class="btn btn-success" type="button"  onclick="return certification_fields();"> <span class="ti-plus" aria-hidden="true"></span> <?php echo esc_html__('Add More','nokri'); ?></button>
                                			</div>
                                 </div>
        				<div class="col-md-12 col-xs-12 col-sm-12">
                    <input type="submit" value="<?php echo esc_html__('Save Certifications','nokri'); ?>" class="btn n-btn-flat cand_person_save">
                    <input type="button" disabled  value="<?php echo  esc_html__( 'Processing...','nokri' ); ?>" class="btn n-btn-flat cand_person_pro">
                </div>
            </div>
    </div>
</div>
 <!-- End Candidate Certifications-->
<!-- Candidate Portfolio -->
<div class="main-body">
    <div class="dashboard-edit-profile">
        <h4 class="dashboard-heading"><?php echo esc_html__('Add Portfolio','nokri'); ?></h4>
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <div class="row">
                    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                     <div class="form-group">
                        <label class="control-label"><?php echo esc_html__('Photos for your Projects','nokri'); ?><small><?php echo " ".esc_html__('Drag drop or click to upload your project images','nokri'); ?></small></label>
                        <div id="dropzone" class="dropzone"></div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label><?php echo esc_html__('Video url (only youtube) ','nokri'); ?></label>
                            <input type="text" placeholder="<?php echo esc_attr__('Put youtube video link','nokri'); ?>" value="<?php echo  nokri_candidate_user_meta('_cand_video'); ?>" name="cand_video" class="form-control">
                        </div>
                    </div>
                   </div>
                </div>
            </div>
    </div>
</div>
<!-- End Candidate Portfolio -->
<!-- Candidate Social Links -->
<div class="main-body">
    <div class="dashboard-edit-profile">
        <h4 class="dashboard-heading"><?php echo esc_html__('Social Links','nokri'); ?></h4>
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <div class="dashboard-social-links">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label><?php echo esc_html__('Face Book','nokri'); ?><span class="required">*</span></label>
                                <input type="text" value="<?php echo  nokri_candidate_user_meta('_cand_fb'); ?>"  name="cand_fb" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label><?php echo esc_html__('Twitter','nokri'); ?><span class="required">*</span></label>
                                <input type="text" value="<?php echo  nokri_candidate_user_meta('_cand_twiter'); ?>" name="cand_twiter" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label><?php echo esc_html__('LinkedIn','nokri'); ?><span class="required">*</span></label>
                                <input type="text" value="<?php echo  nokri_candidate_user_meta('_cand_linked'); ?>"  name="cand_linked"  class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label><?php echo esc_html__('Google Plus','nokri'); ?> <span class="required">*</span></label>
                                <input type="text" value="<?php echo  nokri_candidate_user_meta('_cand_google'); ?>" name="cand_google" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <input type="submit" value="<?php echo esc_html__('Save Profiles Links', 'nokri' ); ?>" class="btn n-btn-flat cand_person_save">
                    <input type="button" disabled  value="<?php echo  esc_html__( 'Processing...','nokri' ); ?>" class="btn n-btn-flat cand_person_pro">
                </div>
            </div>
    </div>
</div>
 <!-- End Candidate Social Links --> 
 
<!-- Candidate Location -->

<div class="main-body">
<?php if($is_lat_long) { ?> 
    <div class="dashboard-edit-profile">
        <h4 class="dashboard-heading"><?php echo esc_html__('Location And Adress','nokri'); ?></h4>
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <div class="row">
                     <!-- Candidate Location -->     
                      <input type="hidden" id="is_profile_edit" value="1" />
                      <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group"> 
                                     <label class="control-label"><?php echo esc_html__( 'Set your location', 'nokri' ); ?></label>
                                    <input class="form-control" name="cand_address" id="sb_user_address" value="<?php echo esc_attr($ad_mapLocation); ?>">
                                    <?php if($mapType == 'google_map') { ?>
                      <a href="javascript:void(0);" id="your_current_location" title="<?php echo esc_html__('You Current Location', 'nokri' ); ?>"><i class="fa fa-crosshairs"></i></a>
                      <?php } ?>
                                </div>
                            </div>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group"> 
                                     <div id="dvMap" style="width:100%; height: 300px"></div>                                            
                                </div>
                            </div>
                      <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group"> 
                                      <label class="control-label"><?php echo esc_html__( 'Latitude', 'nokri' ); ?></label>
                                   <input class="form-control" type="text" name="cand_map_lat" id="ad_map_lat" value="<?php echo esc_attr($ad_map_lat); ?>">
                                </div>
                            </div>
                      <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group"> 
                                     <label class="control-label"><?php echo esc_html__( 'Longitude', 'nokri' ); ?></label>
                                    <input class="form-control" name="cand_map_long" id="ad_map_long" value="<?php echo esc_attr($ad_map_long); ?>" type="text">
                                </div>
                            </div>
                      <!-- End Candidate Location -->
                      </div>
                </div>
                
            </div>
    </div>
<?php } ?>
<div class="dashboard-edit-profile">
<h4 class="dashboard-heading"><?php echo esc_html($job_country_level_heading); ?></h4>
    <div class="row">
              <!--job country -->
           <div class="col-md-6 col-sm-6 col-xs-12">
           <div class="form-group">
            <label><?php echo esc_html($job_country_level_1 ); ?></label>
              <select class="js-example-basic-single" data-allow-clear="true" data-placeholder="<?php echo esc_html__( 'Select Your Country', 'nokri' ); ?>" id="ad_country" name="cand_country">
                 
                  <?php echo "".($country_html);?>
              </select>
             
            </div>
           </div>
            <!--job state -->
            <div class="col-md-6 col-sm-6 col-xs-12" id="ad_country_sub_div" <?php if($country_states == "" ){echo 'style="display: none;"';}?>>
           <div class="form-group" >
           <label><?php echo esc_html($job_country_level_2 ); ?></label>
              <select class="js-example-basic-single" data-allow-clear="true" data-placeholder="<?php echo esc_html__( 'Select State', 'nokri' ); ?>" id="ad_country_states" name="cand_country_states">
                 
                  <?php echo "".($country_states);?>
              </select>
           </div></div>
           <!--job city -->
           <div class="col-md-6 col-sm-6 col-xs-12" id="ad_country_sub_sub_div" <?php if($country_cities == "" ){echo 'style="display: none;"';}?>>
           <div class="form-group">
           <label><?php echo esc_html($job_country_level_3 ); ?></label>
              <select class="js-example-basic-single" data-allow-clear="true" data-placeholder="<?php echo esc_html__( 'Select State', 'nokri' ); ?>" id="ad_country_cities" name="cand_country_cities">
                
                  <?php echo "".($country_cities);?>
              </select>
           </div>
           </div>
            <!--job town -->
            <div class="col-md-6 col-sm-6 col-xs-12" id="ad_country_sub_sub_sub_div" <?php if($country_towns == "" ){echo 'style="display: none;"';}?>>
           <div class="form-group">
            <label><?php echo esc_html($job_country_level_4 ); ?></label>
              <select class="js-example-basic-single" data-allow-clear="true" data-placeholder="<?php echo esc_html__( 'Select State', 'nokri' ); ?>" id="ad_country_towns" name="cand_country_towns">
                
                  <?php echo "".($country_towns);?>
              </select>
           </div>
           </div>
         </div>
         <div class="col-md-12 col-xs-12 col-sm-12">
            <input type="submit" value="<?php echo esc_html__('Save Location', 'nokri' ); ?>" class="btn n-btn-flat cand_person_save">
            <input type="button" disabled  value="<?php echo  esc_html__( 'Processing...','nokri' ); ?>" class="btn n-btn-flat cand_person_pro">
        </div>
</div>
</div>
 <!-- End Candidate Location -->
<!-- Hidden Inputs For Candidate Portfolio -->
<input type="hidden" id="dictFallbackMessage" value="<?php echo esc_html__('Your browser does not support drag\'n\'drop file uploads.', 'nokri'); ?>" />
<input type="hidden" id="dictFallbackText" value="<?php echo esc_html__('Please use the fallback form below to upload your files like in the olden days.', 'nokri'); ?>" />
<input type="hidden" id="dictFileTooBig" value="<?php echo esc_html__('File is too big ({{filesize}}MiB). Max filesize: {{maxFilesize}}MiB.', 'nokri'); ?>" />
<input type="hidden" id="dictInvalidFileType" value="<?php echo esc_html__('You can\'t upload files of this type.', 'nokri'); ?>" />
<input type="hidden" id="dictResponseError" value="<?php echo esc_html__('Server responded with {{statusCode}} code.', 'nokri'); ?>" />
<input type="hidden" id="dictCancelUpload" value="<?php echo esc_html__('Cancel upload', 'nokri'); ?>" />
<input type="hidden" id="dictCancelUploadConfirmation" value="<?php echo esc_html__('Are you sure you want to cancel this upload?', 'nokri'); ?>" />
<input type="hidden" id="dictRemoveFile" value="<?php echo esc_html__('Remove file', 'nokri'); ?>" />
<input type="hidden" id="dictMaxFilesExceeded" value="<?php echo esc_html__('You can not upload any more files.', 'nokri'); ?>" />
<input type="hidden" id="required_images" value="<?php echo esc_html__( 'Images are required.', 'nokri' ); ?>" />
<input type="hidden" id="is_candidate" name="is_update" value="<?php echo esc_attr($is_candidate); ?>" />        
</form>
 <!-- update password-->  
<div class="main-body change-password">
 <div class="dashboard-edit-profile">
  <h4 class="dashboard-heading"><?php echo esc_html__('Change Password','nokri'); ?></h4>
        <form id="change_password" method="post" enctype="multipart/form-data">
         <div class="row">
             <div class="col-md-12 col-xs-12 col-sm-12">
                    <div class="row">
                        <div class="dashboard-location">
                            
                            <div class="col-md-6 col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <label><?php echo esc_html__('Old Password','nokri'); ?></label>
                                    <input type="password" class="form-control" name="old_password" placeholder="<?php echo esc_html__('Enter old password','nokri'); ?>">
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <label><?php echo esc_html__('New Password','nokri'); ?></label>
                                    <input type="password" name="new_password" class="form-control" placeholder="<?php echo esc_html__('Enter new password','nokri'); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xs-12 col-sm-12">
                <?php if($is_acount_del) { ?>
                <input type="button" value="<?php echo esc_html__('Delete account?','nokri'); ?>" class="btn btn-custom del_acount"><?php } ?>
                 <input type="submit" value="<?php echo esc_html__('Update password','nokri'); ?>" class="btn n-btn-flat change_password">
                 <input type="button" disabled  value="<?php echo  esc_html__( 'Processing...','nokri' ); ?>" class="btn n-btn-flat cand_pass_pro">
                </div>
            </div>
        </form>
    </div>
</div>
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
 ?>