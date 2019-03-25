<?php
global $nokri;
/* Getting Title From Query String */ 
$title	=	'';
if( isset( $_GET['job_title'] ) && $_GET['job_title'] != "" )
{
	$title	=	$_GET['job_title'];
}


 /* Getting All Taxonomy From Query String */
 $taxonomies	=	array('job_type','ad_title', 'cat_id','job_category','job_tags','job_qualifications','job_level','job_salary','job_currency','job_skills','job_experience','job_currency','job_shift','job_class','ad_location');
foreach( $taxonomies as $tax )
{
	$$tax = '';
	if( isset( $_GET[$tax] ) && $_GET[$tax] != ""  )
		{
			$$tax	=	array(
			array('taxonomy' => $tax,'field'    => 'term_id','terms'   => $_GET[$tax]),);	
		}
}
$category	=	'';
if( isset( $_GET['cat_id'] ) && $_GET['cat_id'] != ""  )
{
	$category	=	array(
		array(
		'taxonomy' => 'job_category',
		'field'    => 'term_id',
		'terms'    => $_GET['cat_id'],
		),
	);	
}	

$location	=	'';
if( isset( $_GET['job_location'] ) && $_GET['job_location'] != ""  )
{
	$location	=	array(
		array(
		'taxonomy' => 'ad_location',
		'field'    => 'term_id',
		'terms'    => $_GET['job_location'],
		),
	);	
}

$location_keyword	=	'';
if( isset( $_GET['loc_keyword'] ) && $_GET['loc_keyword'] != ""  )
{
	$location_keyword	=	array(
		array(
		'taxonomy'     => 'ad_location',
		'field'        => 'name',
		'terms'        => $_GET['loc_keyword'],
		 'operator'    => 'LIKE'
		),
	);	
}


/* Passing Query String Results To Arguments */ 
$order	=	'DESC';
if( isset($_GET['order_job']) )
{
	if( isset($_GET['order_job']) && $_GET['order_job'] != "" )
	{
		 $order	  =	$_GET['order_job'];
	}
}


if ( get_query_var( 'paged' ) ) 
{
	$paged = get_query_var( 'paged' );
} 
else if ( get_query_var( 'page' ) )
{
/*This will occur if on front page.*/
$paged = get_query_var( 'page' );
} 
else 
{
	$paged = 1;
}
$html = ''; 


$args	=	array(
'tax_query' => array($category,$job_salary,$title, $job_type,$job_category,$job_tags,$job_qualifications,$job_level,$job_skills,$job_experience,$job_currency,$job_shift,$job_class,$location,$location_keyword),
's' 				=> 	$title,
'posts_per_page' 	=> 	 get_option( 'posts_per_page' ),
'post_type' 		=> 	'job_post',
'post_status' 		=> 	'publish',
'order'				=> 	$order,
'orderby' 			=> 	'date',
'paged' 			=> 	$paged,
'meta_query' 		=> 	array(
		array(
			'key'     => '_job_status',
			'value'   => 'active',
			'compare' => '=',
		),
	), 
);

$results = new WP_Query( $args );
if ($results->found_posts > 0)
{
	$message = __('Available Jobs','nokri');
}
else
{
	$message = __('No Jobs Matched','nokri');
}
/* Default */
$lat = ( isset($nokri['sb_default_lat']) && $nokri['sb_default_lat'] != ""  ) ? $nokri['sb_default_lat'] : 40.7127837;
$long = ( isset($nokri['sb_default_long']) && $nokri['sb_default_long'] != ""  ) ? $nokri['sb_default_long'] : -74.00594130000002;
/* Premium Jobs Top Query */
$premium_jobs_class_num = ( isset($nokri['premium_jobs_class_number']) && $nokri['premium_jobs_class_number'] != ""  ) ? $nokri['premium_jobs_class_number'] : "";

if( isset( $nokri['premium_jobs_class'] ) && $nokri['premium_jobs_class'] != ''   )
{
	$job_classes	=	'';
	$job_classes	=	array(
		array(
		'taxonomy' => 'job_class',
		'field'    => 'term_id',
		'terms'    => $nokri['premium_jobs_class'],
		'operator' => 'IN',
		),
	);	

$args_premium	    =	  array(
'tax_query'         =>    array($job_classes,$category),
'posts_per_page' 	=> 	 $premium_jobs_class_num,
'post_type' 		=> 	'job_post',
'post_status' 		=> 	'publish',
'orderby' 			=> 	'rand',
'meta_query' 		=> 	array(
		array(
			'key'     => '_job_status',
			'value'   => 'active',
			'compare' => '=',
		),
	), 
);
}
/* Advertisement Module */
$advert_up = $advert_down = '';
if( isset( $nokri['search_job_advert_switch']) && $nokri['search_job_advert_switch'] == "1" )
{
	/*Above joba */
	if(isset( $nokri['search_job_advert_up']) && $nokri['search_job_advert_up'] != "")
	{
		$advert_up = '<div class="n-advert-box">'.$nokri['search_job_advert_up'].'</div>';
	}
	/*Below jobs */
	if(isset( $nokri['search_job_advert_down']) && $nokri['search_job_advert_down'] != "")
	{
		$advert_down = '<div class="n-advert-box">'.$nokri['search_job_advert_down'].'</div>';
	}
	
}


?>
<div class="search-page-with-map sidebars">
         <?php get_sidebar( 'map' ); ?>
       <div class="left-part">
            <div class="col-md-12 col-xs-12 col-sm-12 side-listings">
                <div class="n-search-main">
                    <div class="heading-area">
                      <div class="row">
                         <div class="col-md-8 col-sm-8 col-xs-12">
                            <h4><?php echo esc_html($message)." ".'(' .esc_html( $results->found_posts ).')'; ?></h4>
                         </div>
                         <div class="col-md-4 col-sm-4 col-xs-12">
                           <form method="GET" id="job_order_search">
                               <select class="js-example-basic-single form-control change_order" data-allow-clear="true" data-placeholder="<?php  echo esc_html__("Select Option", "nokri"); ?>" style="width: 100%" name="order_job">
                                  <option value="0" ><?php  echo esc_html__("Select Option", "nokri"); ?></option>
                                  <option value="ASC" <?php if ( $order == 'ASC') { echo "selected"; } ; ?> ><?php  echo esc_html__("Ascending", "nokri"); ?></option>
                                  <option value="DESC" <?php if ( $order == 'DESC') { echo "selected"; } ; ?>><?php  echo esc_html__("Descending ", "nokri"); ?></option>
                               </select>
                            </form>
                         </div>
                      </div>
                   </div>
                    <?php echo ($advert_up); ?>
                   <div class="n-search-listing n-featured-jobs featured">
                      <div class="n-featured-job-boxes">
                        <?php
				       if( isset( $nokri['premium_jobs_class_switch'] ) && $nokri['premium_jobs_class_switch'] == '1')
						{
							 /*Section Title */
						$section_title = (isset($nokri['premium_jobs_class_title']) && $nokri['premium_jobs_class_title'] != "") ? '<div class="heading"><h4>'.$nokri['premium_jobs_class_title'].'</h4></div>' : "";
								echo $section_title;
							  /* Premium jobs in list style*/
							  $results_premium   = new WP_Query( $args_premium );
							  $current_layout    =   $nokri['search_layout'];
							  $layouts		    =   array( 'list_1', 'list_2', 'list_3' );
								if ( $results_premium->have_posts() )
								 { 
									if (in_array($current_layout, $layouts))  					
											 {		
												 require trailingslashit( get_template_directory () ) . "template-parts/layouts/job-style/search-layout-premium-list2.php";
												 echo($out);
											 }
											wp_reset_postdata();
								}
						}
						?>
                      </div>
                      </div>
                   <div class="n-search-listing n-featured-jobs">
                      <div class="n-featured-job-boxes">
                         <?php
						 	/* Regular Search Query */
								  $marker	= trailingslashit( get_template_directory_uri () ) . 'images/map-loacation.png';
								  if( isset( $nokri['map_marker_img']['url'] ) && $nokri['map_marker_img']['url'] != "" )
									{
										$marker1 = array($nokri['map_marker_img']['url']);
										$marker  = 	$marker1[0];
									}
								   $map_listings = '';
								   if ( $results->have_posts() ) {
									$map_listings = '<script>
									 var addressPoints = [';
									$html = ''; 
									while ( $results->have_posts() )
									{
										$results->the_post();
										$pid	         =	   get_the_ID();
										$author_id       =     get_post_field( 'post_author', $pid );
										$jobs	         =	   new jobs();
										$job_type        =     wp_get_post_terms($pid, 'job_type', array("fields" => "ids"));
										$job_type	     =	   isset( $job_type[0] ) ? $job_type[0] : '';
										$ad_map_lat	     =     get_post_meta($pid, '_job_lat', true);
                                        $ad_map_long	 =     get_post_meta($pid, '_job_long', true);
										$ad_mapLocation	 =     get_post_meta($pid, '_job_address', true);
										echo $jobs->nokri_search_layout_list_3( $pid );
										$replace_title = stripslashes_deep(wp_strip_all_tags(str_replace("|"," ",get_the_title($pid))));
										
										$map_listings	 .='{
											"title":"'.$replace_title.'",
											"job_link":"'.get_the_permalink($pid).'",
											"job_type":"'.nokri_job_post_single_taxonomies('job_type', $job_type).'",
											"job_address":"'.$ad_mapLocation.'",
											"lat":"'.$ad_map_lat.'",
											"lng":"'.$ad_map_long.'",
										  },';
									
										
										}
								          $map_listings	.= ']; </script>';
										 /* Restore original Post Data */
										 wp_reset_postdata();
									 } 
									 else
									 {
										 $map_listings = '<script>
									 var addressPoints = [];</script>';
									 }
								  ?>
                          <div class="clearfix"></div>
                          <?php echo  ($advert_down); ?>
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <nav aria-label="Page navigation">
                                <?php echo nokri_job_pagination( $results );?>
                            </nav>
                         </div>
                      </div>
                   </div>
                </div>
            </div>
       </div>
        <div class="right-part">
            <div class="map" id="mapid"></div>
        </div>
    </div>
    <?php echo $map_listings; ?>
<script>

jQuery(document).ready(function () {
var ps = new PerfectScrollbar('.side-filters');
var ps = new PerfectScrollbar('.side-listings');
});

var map = L.map('mapid').setView([<?php echo $lat; ?>, <?php echo $long; ?>], 12);
L.tileLayer( 'https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}{r}.png').addTo( map );
var myIcon = L.icon({
  iconUrl: '<?php echo $marker; ?>',
  iconRetinaUrl: '<?php echo $marker; ?>',
  iconSize: [64, 64],
  iconAnchor: [28, 21],
  popupAnchor: [0, -22]
});
var markerClusters = L.markerClusterGroup();
for ( var i = 0; i < addressPoints.length; ++i ) 
{

	var popup = '<div class="on-map-jobs"><div class="n-job-single"><div class="n-job-detail"><ul class="list-inline"><li class="n-job-title-box"><h4><a href="'+ addressPoints[i].job_link+'">'+ addressPoints[i].title+'</a><span>'+ addressPoints[i].job_type+'</span></h4><p><i class="ti-location-pin"></i>'+ addressPoints[i].job_address+'</p></li></ul></div></div></div>';


  var m = L.marker( [addressPoints[i].lat, addressPoints[i].lng], {icon: myIcon} )
                  .bindPopup( popup );

  markerClusters.addLayer( m );
	  map.fitBounds(markerClusters.getBounds());
	  map.addLayer( markerClusters );
}
map.addLayer( markerClusters );
 </script>