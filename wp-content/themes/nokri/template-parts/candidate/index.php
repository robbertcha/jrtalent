<?php
/* Template Name: Candidate Resume */ 
$cand_skills = $skill_tags =  $portfolio_html = '';
$user_crnt_id = get_current_user_id();
/* Getting Candidate Portfolio */
if( get_user_meta( $user_crnt_id, '_cand_portfolio', true ) != "" )
 {	
	$port = get_user_meta( $user_crnt_id, '_cand_portfolio', true );
	$portfolios = explode(',', $port);
	if((array)$portfolios && count($portfolios) > 0)
	{
		foreach($portfolios as $portfolio)
		{	
			$portfolio_image_sm = wp_get_attachment_image_src( $portfolio, 'nokri_job_hundred' );
			$portfolio_image_lg = wp_get_attachment_image_src( $portfolio, 'nokri_cand_large' );
			$portfolio_html .= '<li><a class="portfolio-gallery" data-fancybox="gallery" href="'.esc_url($portfolio_image_lg[0]).'"><img src="'.esc_url($portfolio_image_sm[0]).'"></a></li>';
		}
	}
 }
/* Getting Count Apllied Jobs */	 
 $args  = array(
'post_type'  => 'job_post',
'orderby'    => 'date',
'order'      => 'DESC',
'meta_query' => array( array( 'key'   => '_job_applied_resume_'.$user_crnt_id)),
);
$query = new WP_Query( $args );
$applied_jobs = $query->found_posts;
/* Getting Followed Companies Count  */
 $get_result      =  nokri_following_company_ids($user_crnt_id);
 $follow_comp     =   count( (array) $get_result);
 /* Getting User Skills Tags */
$cand_skills	= get_user_meta($user_crnt_id, '_cand_skills', true);
if($cand_skills != '') 
  {
	$taxonomies = get_terms('job_skills', array('hide_empty' => false , 'orderby'=> 'id', 'order' => 'ASC' ,  'parent'   => 0  ));
	if(count($taxonomies) > 0) {
		foreach($taxonomies as $taxonomy)
 			{
	 			if (in_array( $taxonomy->term_id, $cand_skills ))
				$skill_tags .= '<a href="javascript:void(0)">'.esc_html($taxonomy->name).'</a>';
 			}
		}

	}
$intro = get_user_meta($user_crnt_id, '_cand_intro', true);
/* Low profile txt*/
$profile_percent = get_user_meta($user_crnt_id, '_cand_profile_percent', true);
$user_low_profile_txt = ( isset($nokri['user_low_profile_txt']) && $nokri['user_low_profile_txt'] != ""  ) ? $nokri['user_low_profile_txt'] : ""; 	
?>
<div class="main-body n-candidate-detail">
<div class="dashboard-stats">
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="stat-box parallex">
                <div class="stat-box-meta">
                    <div class="stat-box-meta-text">
                        <h4><?php echo esc_html__( 'Applied jobs', 'nokri' ); ?></h4>
                        <h3><?php echo esc_html($applied_jobs); ?></h3>
                    </div>
                    <div class="stat-box-meta-icon">
                        <img src="<?php echo get_template_directory_uri();?>/images/icons/applied-jobs.png" class="img-responsive" alt="<?php echo esc_html__( 'applied jobs', 'nokri' ); ?>">
                    </div>
                </div>
                <p><a href="<?php echo get_the_permalink(); ?>?candidate-page=jobs-applied"><?php echo esc_html__( 'View all applied jobs', 'nokri' ); ?></a></p>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="stat-box blue">
                <div class="stat-box-meta">
                    <div class="stat-box-meta-text">
                        <h4><?php echo esc_html__( 'Followed companies', 'nokri' ); ?></h4>
                        <h3><?php echo esc_html($follow_comp); ?></h3>
                    </div>
                    <div class="stat-box-meta-icon">
                        <img src="<?php echo get_template_directory_uri();?>/images/icons/followers.png" class="img-responsive" alt="<?php echo esc_html__( 'followed companies', 'nokri' ); ?>">
                    </div>
                </div>
                <p><a href="<?php echo get_the_permalink(); ?>?candidate-page=followed-companies"><?php echo esc_html__( 'View all followed companies', 'nokri' ); ?></a></p>
            </div>
        </div>
    </div>
</div>
         <div class="n-candidate-meta">
             <h4><?php echo esc_html__( 'My profile', 'nokri' ); ?></h4>
             <?php if($intro) { ?>
             <p><?php echo ($intro); ?></p>
             <?php } if(!empty($skill_tags)) { ?> 
             <div class="n-skills">
                <h4><?php echo esc_html__( 'Skills:', 'nokri' ); ?></h4>
                <div class="n-skills-tags">
                <?php echo "".($skill_tags); ?>
                </div>
             </div>
             <?php 
			 }
			 $cand_education = get_user_meta($user_crnt_id, '_cand_education', true); 
			 if ( $cand_education  && $cand_education[0]['degree_name'] != '' ) {  ?>
             <div class="timeline-box">
                <h4><?php echo esc_html__( 'Education:', 'nokri' ); ?> </h4>
                <ul class="education">
                   <?php
				   foreach($cand_education as $edu) { 
				   $degre_name		= (isset($edu['degree_name']))       ?  '<div class="lead">'.esc_html($edu['degree_name']).'<div>' :   '';
				   $degre_strt		= (isset($edu['degree_start']))      ?  $edu['degree_start'] :   '';
				   $degre_insti	    = (isset($edu['degree_institute']))  ?  '<div class="type ">'.esc_html($edu['degree_institute']).'</div>'   :   '';
				  $degre_details	  = (isset($edu['degree_detail']))   ? '<p class="info">'.$edu['degree_detail'].'</p>'   :   '';
									?>
									<li><span></span>
										<div>
										  <div class="date"><?php echo esc_html($degre_strt)." "; 
										  if($edu['degree_end'] != '') { echo '-'.esc_html($edu['degree_end']); } ?></div>
										   <?php echo "".($degre_name).($degre_insti).($degre_details);?>
											</div>
										</li>
										 <?php } ?>
                </ul>
             </div>
              <?php } 
$cand_profession	= get_user_meta($user_crnt_id, '_cand_profession', true);
if ( $cand_profession  && $cand_profession[0]['project_organization'] != '') { ?>
             <div class="timeline-box">
                <h4><?php echo esc_html__( 'Work Experience:', 'nokri' ); ?> </h4>
                <ul class="education">
                   <?php 
                                 foreach($cand_profession as $profession) {
									 $project_end = $profession['project_end'];
									 if($profession['project_end'] == '')
									 {
										$project_end =  esc_html__( 'Currently Working', 'nokri' );
									 }
$project_role	= (isset($profession['project_role'])) ? '<div class="lead">'.esc_html($profession['project_role']).'<div>' :   '';
$project_org	= (isset($profession['project_organization']))? '<div class="type ">'.$profession['project_organization'].'<div>' :   '';
$project_strt	= (isset($profession['project_start']))  ? esc_html($profession['project_start'])   :   '';
$project_detail	= (isset($profession['project_desc']))  ? '<div class="info">'.$profession['project_desc'].'</div>'   :   '';				
									  ?>
                                   <li><span></span>
                                        <div>
                                      	<div class="date"><?php echo esc_html($project_strt)." "; 
                                      if($project_end != '') { echo '-'.($project_end); } ?></div>
                                       <?php echo "".($project_role).($project_org).($project_detail);?>
                                        </div>
                                    </li>
                                    <?php } ?>
                </ul>
             </div>
             <?php } 
$cand_certifications	=  get_user_meta($user_crnt_id, '_cand_certifications', true);
if ( $cand_certifications  && $cand_certifications[0]['certification_name'] != '') { ?>
             <div class="timeline-box cetificates">
                <h4><?php echo esc_html__( 'Awards and certificates:', 'nokri' ); ?></h4>
                <ul class="education">
                  <?php 
                                             foreach($cand_certifications as $certification) { 
                                             if ($certification['certification_name'] != '') {
												 
$certi_name	= (isset($certification['certification_name'])) ? '<div class="lead">'.esc_html($certification['certification_name']).'<div>' :   '';
$certi_durat = (isset($certification['certification_duration']))  ? '<span>'.esc_html($certification['certification_duration']).'</span>'   :   '';
$certi_inst	= (isset($certification['certification_institute']))? '<div class="type ">'.$certification['certification_institute'].$certi_durat.'<div>' :   '';
$certi_strt	= (isset($certification['certification_start']))  ? esc_html($certification['certification_start'])   :   '';
$certi_detail	= (isset($certification['certification_desc']))  ? '<div class="info">'.$certification['certification_desc'].'</div>'   :   '';
                                             ?>
                                                <li><span></span>
                                                    <div>
                                      <div class="date"><?php echo ($certi_strt)." "; 
                                      if($certification['certification_end'] != '') { echo '-'.esc_html($certification['certification_end']); } ?></div>
                                       <?php echo "".($certi_name).($certi_inst).($certi_detail);?> 
                                                    </div>
                                                </li>
                                                <?php }  } ?>
                </ul>
             </div>
              <?php  } if ($portfolio_html) { ?>
             <div class="timeline-box">
                <h4><?php echo esc_html__( 'Portfolio:', 'nokri' ); ?>  </h4>
                <div class="n-my-portfolio">
                   <ul>
                   <?php echo "".$portfolio_html; ?>
                   </ul>
                </div>
             </div>
             <?php } ?>
          </div>
       </div>