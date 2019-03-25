<?php
/* Template Name: Page Employer */ 
/**
 * The template for displaying Pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#page-search
 *
 * @package nokri
 */
 $current_user_id 	  = get_current_user_id();
 get_header();
global $nokri;
$title	=	'';
if( isset( $_GET['emp_title'] ) && $_GET['emp_title'] != ""  )
{
	$title	=	$_GET['emp_title'];
}
$cands_qry =   array(
		'key' => '_sb_reg_type',
		'value' => '1',
		'compare' => '='
	);
 

 $order = 'display_name';
 $orderby = 'ASC';
 if( isset( $_GET['order'] ) && $_GET['order'] == 'name' )
 {
	$orderby =  'display_name';
	$order   =  'ASC';
 }
 elseif (isset( $_GET['order'] ) && $_GET['order'] == 'date')
 {
	 $orderby  = 'registered';
	 $order   =  'DESC';
 }
// total no of User to display
$limit  =    isset( $nokri['user_pagination'] )         ?    $nokri['user_pagination']     :   10;
$page   =   (get_query_var('page')) ? get_query_var('page') : 1;
$offset =   ($page * $limit) - $limit;
// Query args
$args = array(
   'search'         => "*".esc_attr( $title )."*",
   'order' 	        => $order,
   'orderby'        => $orderby ,
   'number' 	    => $limit,
   'offset'	        => $offset,
   'role'           => 'subscriber',
   'meta_query' 	=> array($cands_qry, )
);
// Create the WP_User_Query object
$wp_user_query = new WP_User_Query($args);
// Get the results
$users         =  $wp_user_query->get_results();
$total_users   =  $wp_user_query->get_total();
$pages_number  =  ceil($total_users/$limit);
if($total_users > 0)
{
	$users_found = esc_html__("Employer found", 'nokri')." ".'('.$total_users.')';
}
else
{
	$users_found = esc_html__("No Employer found", 'nokri');
}
/* search section bg */ 
$list_bg_url = '';
 if ( isset( $nokri['candidate_list_bg_img'] ) )
{
	$list_bg_url = nokri_getBGStyle('candidate_list_bg_img');
}
?>
 <section class="n-search-page n-user-page">
         <div class="container">
            <div class="row">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="row">
                     <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                     <aside class="new-sidebar">
                      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <?php echo get_sidebar( 'employers' ); ?>
                        </div>
                        </aside>
                     </div>
                     <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <div class="n-search-main">
                           <div class="n-bread-crumb">
                              <ol class="breadcrumb">
                                 <li> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html__("Home", 'nokri'); ?></a></li>
                             <li class="active"><a href="javascript:void(0);" class="active"><?php echo esc_html__("Employer Search", 'nokri'); ?></a></li>
                              </ol>
                           </div>
                           <div class="heading-area">
                              <div class="row">
                                 <div class="col-md-8 col-sm-8 col-xs-12">
                                    <h4><?php echo esc_html($users_found); ?></h4>
                                 </div>
                                 <div class="col-md-4 col-sm-4 col-xs-12">
                                      <form method="GET" id="candiate_order">
                                   <select class="js-example-basic-single form-control candidates_orders" data-allow-clear="true" data-placeholder="<?php echo esc_html__("Select option", 'nokri'); ?>" style="width: 100%" name="order">
                                      <option value="0"><?php echo esc_html__("Select order", 'nokri'); ?></option>
                                    <option value="name" <?php if(isset($_GET['order']) && $_GET['order'] == 'name') echo "selected=selected"; ?>><?php echo esc_html__("Alphabatically", 'nokri'); ?></option>
                                    <option value="date" <?php if(isset($_GET['order']) && $_GET['order'] == 'date') echo "selected=selected"; ?>><?php echo esc_html__("New registered", 'nokri'); ?></option>
                                   </select>
                                </form>
                                 </div>
                              </div>
                           </div>
                           <div class="n-search-listing n-featured-jobs">
                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nopadding">
                                 <div class="row">
                                 <div class="n-company-grids">
                                    <?php
									/* Query User results */
									if (!empty($users))
									 {
										 $fb_link = $twitter_link = $google_link = $linkedin_link = '';
										// Loop through results
										foreach ($users as $user) {
											 $user_id   = $user->ID;
											$user_name = $user->display_name;
											/* Profile Pic  */
											$image_dp_link[0] =  get_template_directory_uri(). '/images/candidate-dp.jpg';
											if( isset( $nokri['nokri_user_dp']['url'] ) && $nokri['nokri_user_dp']['url'] != "" )
											{
												$image_dp_link = array($nokri['nokri_user_dp']['url']);	
											}
											if(get_user_meta($user_id, '_sb_user_pic', true ) != '')
											{
												$attach_dp_id     =  get_user_meta($user_id, '_sb_user_pic', true );
												$image_dp_link    =  wp_get_attachment_image_src( $attach_dp_id, '' );
											}
											$user_post_count = count_user_posts( $user_id , 'job_post' );
											$user_post_count_html = '<span class="job-openings">'.$user_post_count." ".esc_html__( 'Openings', 'nokri' ).'</span>';
											$emp_address   = get_user_meta($user_id, '_emp_map_location', true);
												/* Social links */
												$emp_fb        = get_user_meta($user_id, '_emp_fb', true);
												$emp_twitter    = get_user_meta($user_id, '_emp_twitter', true);
												$emp_google    = get_user_meta($user_id, '_emp_google', true);
												$emp_linkedin    = get_user_meta($user_id, '_emp_linked', true);
												 if($emp_fb)
												 {
													 $fb_link = '<li><a href="'. esc_url($emp_fb).'"><img src="'. get_template_directory_uri().'/images/icons/006-facebook.png" alt="'.esc_attr__( 'icon', 'nokri' ).'"></a></li>';
												 }
												 if($emp_twitter)
												 {
													 $twitter_link = '<li><a href="'. esc_url($emp_twitter).'"><img src="'. get_template_directory_uri().'/images/icons/004-twitter.png" alt="'.esc_attr__( 'icon', 'nokri' ).'"></a></li>';
												 }
												  if($emp_google)
												 {
													 $google_link = '<li><a href="'. esc_url($emp_google).'"><img src="'. get_template_directory_uri().'/images/icons/003-google-plus.png" alt="'.esc_attr__( 'icon', 'nokri' ).'"></a></li>';
												 }
												 if($emp_linkedin)
												 {
													 $linkedin_link = '<li><a href="'. esc_url($emp_linkedin).'"><img src="'. get_template_directory_uri().'/images/icons/005-linkedin.png" alt="'.esc_attr__( 'icon', 'nokri' ).'"></a></li>';
												 }
												/* Social links */
												$adress_html = '';
												if($emp_address)
												{
													$adress_html = '<p class="location"><i class="la la-map-marker"></i>'." ".$emp_address.'</p>';
												}
												$social_icons = '';
												if($emp_fb || $emp_twitter || $emp_google || $emp_linkedin)
												{
													$social_icons = '<div class="n-company-bottom"><ul class="social-links list-inline">'. "". $fb_link.$twitter_link.$google_link.$linkedin_link.'</ul></div>';
												}
												
													/* follow company */
													$follow_btn = '';
													if(get_user_meta($current_user_id, '_sb_reg_type', true) == 0)
													 { 
														$comp_follow = get_user_meta( $current_user_id, '_cand_follow_company_'.$user_id,true);
														if ( $comp_follow ) 
														{  
															$follow_btn = '<a   class="btn n-btn-rounded">'.esc_html__('Followed','nokri').'</a>';
														} 
													 else
													  { 
															$follow_btn = '<a  data-value="'.esc_attr( $user_id ).'"  class="btn n-btn-rounded follow_company"><i class="fa fa-send-o"></i>'. " ".esc_html__('Follow','nokri').'</a>';
													  }
													 }
													 $company_tot_jobs  = ( count_user_posts( $user_id , 'job_post' ) );
													$open_positions_txt =  esc_html__('Open postion','nokri');
													$postion_html = '';
													if($company_tot_jobs < 1)
													 { 
													 	$postion_html = '<span>'.esc_html__('No open postion','nokri').'</span>';
													 }
													 
													 
													 if($company_tot_jobs > 1)
													 { 
													 	$open_positions_txt =  esc_html__('Open postions','nokri'); 
													 }
													  
													 if($company_tot_jobs)
													 {
														 $postion_html = '<span>'.$company_tot_jobs." ".$open_positions_txt.'</span>';
													 }
													  $intro_html = '';
													 $emp_intro   = get_user_meta($user_id, '_emp_intro', true);
													 if($emp_intro)
													 {
														 $intro_html = '<p>'.wp_trim_words( $emp_intro, 20, '…' ).'</p>';
													 }
													 
											 ?>
                                             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                             <div class="n-company-grid-single">
                                                <div class="n-company-grid-img">
                                                   <div class="n-company-logo">
                                                     <a href="<?php echo esc_url(get_author_posts_url($user_id)); ?>"> <img src="<?php echo esc_url($image_dp_link[0]); ?>" class="img-responsive" alt="<?php echo esc_attr__('image','nokri'); ?>"></a>
                                                   </div>
                                                   <div class="n-company-title">
                                                      <h3><a href="<?php echo esc_url(get_author_posts_url($user_id)); ?>"><?php echo $user_name; ?></a></h3>
                                                      <?php echo "".($adress_html); ?>
                                                   </div>
												   <div class="n-company-follow">
                                                    <?php echo "".($follow_btn); ?>
                                                   </div>
                                                </div>
                                                <?php echo "".($social_icons); ?>
                                             </div>
                                          </div>
                        				 <?php }  } 
									 ?>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nopadding">
                                 <nav aria-label="Page navigation">
                                    <ul class="pagination">
                                        <?php echo  nokri_user_pagination($pages_number,$page); ?>
                                    </ul>
                                 </nav>
                              </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
<?php
get_footer();