<?php 
$user_id  = get_current_user_id();
/* Getting Company Published Jobs */
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args = array(
	'post_type'   => 'job_post',
	'orderby'     => 'date',
	'order'       => 'DESC',
	'paged'       => $paged,
	'author' 	  => $user_id,
	'post_status' => array('publish'),
);
$query = new WP_Query( $args ); 
$job_html =   '';
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
}
global $wpdb;
$query1	=	"SELECT * FROM $wpdb->postmeta WHERE post_id IN ($job_ids) AND meta_key like '_job_applied_resume_%' ORDER BY meta_id DESC";
$applier_resumes    = $wpdb->get_results( $query1 );
$noti_html = '';
if ( isset ($applier_resumes) && count($applier_resumes) > 0)
{
	foreach ( $applier_resumes as $resumes ) 
	 {
		 $array_data	=	explode( '|',  $resumes->meta_value );
		 $applier	    =	$array_data[0];
		 $user          =   get_user_by( 'id', $applier );
		 $apply_date    =   get_post_meta($resumes->post_id, '_job_applied_date_'.$applier, true);
		 /* Is user exist */
		$user_exist = get_userdata( $applier );
		if ( $user_exist ) {
			$user_display_name = $user->display_name;
		} else {
			  $user_display_name = '';
		}
		 
		
		 $noti_html    .=   ' <li>
								<div class="notif-single">
										<a href="'.get_author_posts_url($applier).'">'.$user_display_name.'</a>'." ".esc_html__( 'Applied To', 'nokri' ).' <a href="'.get_the_permalink($resumes->post_id).'" class="notif-job-title">'." ".get_the_title($resumes->post_id).'</a>
									</div>
									<span class="notif-timing"><i class="icon-clock"></i> '.$apply_date.'</span>
								</li>';
	}
}
?>
<div class="cp-loader"></div>
<div class="main-body">
<?php if ( isset ($applier_resumes) && count($applier_resumes) > 0) {  ?>
	<div class="notification-area">
                            <h4> <?php echo esc_html__( 'All Notifications', 'nokri' ); ?></h4>
                            <div class="notif-box">
                                <ul>
										<?php echo  ($noti_html); ?>
                                    <li>
                                    </li>
                                </ul>
                            </div>
                        </div>
<?php } else {  ?>
<div class="alert alert-info alert-dismissable alert-style-1">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <i class="ti-info-alt"></i><?php echo esc_html__( 'No Notifications', 'nokri' ); ?>
</div>
<?php } ?>
        <div class="pagination-box clearfix">
            <?php echo nokri_job_pagination( $query );?>
        </div>
</div>