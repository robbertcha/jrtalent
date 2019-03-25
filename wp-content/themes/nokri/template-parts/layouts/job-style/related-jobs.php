<?php 
$rtl_class = '';
if(is_rtl())
{
	$rtl_class = 'flip';
}
$job_id	 =	get_the_ID();
$user_id =  get_current_user_id();
global $nokri;
/* Related Job Query*/
 $cats = wp_get_post_terms( $job_id, 'job_category' );
$categories	=	array();
foreach( $cats as $cat )
{
	$categories[]	=	$cat->term_id;
}
$relateds_jobs = '3';
if((isset($nokri['relateds_jobs_numbers'])) && $nokri['relateds_jobs_numbers']  != '' )
{
	 $relateds_jobs =  ($nokri['relateds_jobs_numbers']);
}
$args = array( 
'post_type' 		=> 'job_post',
'posts_per_page' 	=> $relateds_jobs,
'order'				=> 'DESC',
'post__not_in'		=> array( $job_id ),
'tax_query' 		=> array(
array(
'taxonomy' 			=> 'job_category',
'field' 			=> 'id',
'terms' 			=> $categories,
'operator'=> 'IN'
)),
'meta_query' 		=> 	array(
					array(
						'key'     => '_job_status',
						'value'   => 'active',
						'compare' => '=',
					),
					),
);
 $the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) { ?>
   <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
      <div class="n-related-jobs">
         <div class="heading-title">
            <h2><?php echo esc_html__('Related Jobs', 'nokri' ); ?></h2>
         </div>
         <div class="n-search-listing n-featured-jobs">
            <div class="n-featured-job-boxes">
<?php
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
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
$job_type        		   =      wp_get_post_terms($job_id, 'job_type', array("fields" => "ids"));
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
      </div>
   </div>
<?php } wp_reset_query();