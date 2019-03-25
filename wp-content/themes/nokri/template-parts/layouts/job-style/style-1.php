<?php require trailingslashit( get_template_directory () ) . "/template-parts/layouts/job-style/job-informations.php"; ?>
<section class="n-single-job">
         <div class="container">
            <div class="row">
               <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
               <?php if ( get_post_status() == 'pending') { ?>
                  <div class="alert alert-info alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong><?php echo esc_html__('Information ! ', 'nokri' ); ?></strong><?php echo esc_html__('Your job is awaiting for admin approval', 'nokri' ); ?> 
</div>
                  <?php } ?>
                <?php echo "".($job_badge_ul); ?>
                  <div class="n-single-title">
                     <h4><?php the_title(); ?></h4>
                     <ul>
                        <li> <i class="fa fa-map-marker"></i><?php echo nokri_job_country($job_id); ?></li>
                        <li> <i class="fa fa-hand-o-right"></i><?php echo nokri_job_post_single_taxonomies('job_type', $job_type); ?></li>
                        <li> <i class="fa fa-clock-o"></i><?php echo nokri_time_ago(); ?></li>
                        <li><?php echo nokri_job_post_single_taxonomies('job_currency', $job_currency). " ".nokri_job_post_single_taxonomies('job_salary', $job_salary)." ".'/'. " ".nokri_job_post_single_taxonomies('job_salary_type', $job_salary_type); ?></li>
                     </ul>
                  </div>
                  <?php echo ($advert_up); ?>
                  <div class="n-single-meta">
                     <ul class="n-single-meta-detail">
                        <li>
                           <small><?php echo esc_html__('Category', 'nokri' ); ?></small>
                           <strong><a href=""><?php echo esc_html($project); ?></a></strong>
                        </li>
                        <li>
                           <small><?php echo esc_html__('Shift', 'nokri' ); ?></small>
                           <strong><?php echo nokri_job_post_single_taxonomies('job_shift', $job_shift); ?></strong>
                        </li>
                        <li>
                           <small><?php echo esc_html__('Posted On', 'nokri' ); ?></small>
                           <strong><?php echo esc_html($post_date); ?></strong>
                        </li>
                        <li>
                           <small><?php echo esc_html__('No. of Openings', 'nokri' ); ?></small>
                           <strong><?php echo esc_html($job_vacancy)." ".($opening_text); ?></strong>
                        </li>
                        <li>
                           <small><?php echo esc_html__('Job Experience :', 'nokri' ). " "; ?></small>
                           <strong><?php echo nokri_job_post_single_taxonomies('job_experience', $job_experience); ?></strong>
                        </li>
                        <li>
                           <small><?php echo esc_html__('Job Level :', 'nokri' )." "; ?></small>
                           <strong><?php echo nokri_job_post_single_taxonomies('job_level', $job_level); ?></strong>
                        </li>
                     </ul>
                  </div>
                  <div class="n-single-detail">
                     <h4><?php echo esc_html__('Job Description', 'nokri' ); ?></h4>
                     <?php   echo remove_empty_tags_recursive(get_the_content());?>
                  </div>
                  <div class="n-skills">
                     <h5><i class="fa fa-tags"></i><?php echo esc_html__('Skills:', 'nokri' ); ?></h5>
                     <div class="n-skills-tags">
                        <?php echo "".rtrim($skill_tags,','); ?>
                     </div>
                  </div>
                  <?php echo ($advert_down); 
				   // check if plugin addtoany actiavted then load that otherwise builtin function
					if ( in_array( 'add-to-any/add-to-any.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )
					{
						 echo do_shortcode('[addtoany]');
					}
				  ?>
               </div>
               <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                  <aside class="n-single-sidebar">
                     <div class="app-deadline">
                        <div class="short-detail-icon">
                           <i class="ti-timer"></i>
                        </div>
                        <div class="short-detail-meta">
                           <small> <?php echo esc_html__('Deadline', 'nokri' ); ?></small>
                           <strong><?php echo esc_html($job_deadline); ?></strong>
                        </div>
                        <span class="ab-iocn"><i class="ti-alarm-clock"></i></span>
                     </div>
                     <div class="apply-buttons">
                     <?php
					 /* Author Check */
				  	if ($user_id == $post_author_id || current_user_can('administrator') ) {   ?>
                     <a href="<?php echo get_the_permalink( $nokri['sb_post_ad_page'] ); ?>?id=<?php echo esc_attr( $job_id );  ?>" class="btn n-btn-flat btn-mid btn-clear"><?php echo esc_html__('Edit Job', 'nokri' ); ?></a>
                     <?php } else {  ?>
                     <?php if($post_apply_status == 'active') {
						 if($job_apply_with == 'exter') { 
						  ?>
                          <a href="<?php echo esc_url($job_apply_url) ?>" class="btn n-btn-flat btn-mid btn-clear" target="_blank"><?php echo esc_html__('Apply now', 'nokri' ); ?></a>
                          <?php } else { ?>
                     <a href="javascript:void(0)" class="btn n-btn-flat btn-mid btn-clear apply_job" data-job-id="<?php echo esc_attr( $job_id );?>" data-toggle="modal" data-author-id="<?php echo esc_attr( $post_author_id );?>" data-target="#myModal" id="applying_job"><?php echo esc_html__('Apply now', 'nokri' ); ?></a>                        
                        <?php }
						/* Enable/disable linkedin apply */
						if((isset($nokri['cand_linkedin_apply'])) && $nokri['cand_linkedin_apply']  == 1 )
							{ 
						echo '<div class="divider">
                           <small>'.esc_html__('Or', 'nokri' ).'</small>	
                           <hr>
                        </div>';
						/* Linkedin key*/
						$linkedin_api_key = '';
						if((isset($nokri['linkedin_api_key'])) && $nokri['linkedin_api_key']  != '' && (isset($nokri['linkedin_api_secret'])) && $nokri['linkedin_api_secret']  != '' && (isset($nokri['redirect_uri'])) && $nokri['redirect_uri']  != '' )
						{
							$linkedin_api_key =  ($nokri['linkedin_api_key']);
							$linkedin_secret_key =  ($nokri['linkedin_api_secret']);
							$redirect_uri =  ($nokri['redirect_uri']);
							$state = 'not_logged_in-' . $job_id;
							if(is_user_logged_in())
							{
								$state = 'logged_in-' . $job_id;
							}
						echo '<a href="https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id='.$linkedin_api_key.'&redirect_uri='.$redirect_uri.'&state='.esc_attr($state).'&scope=r_emailaddress r_basicprofile" class="btn-linkedIn btn-block"><i class="ti-linkedin"></i> <span>'.esc_html__( 'Apply With LinkedIn', 'nokri' ).'</span></a>'; 
						}
					}
					 } else { ?><a href="javascript:void(0)" class="btn n-btn-flat btn-mid btn-clear"><?php echo esc_html__('Job Expired', 'nokri' ); ?></a> <?php } } ?>
                     </div>
                     <?php if($is_public) { ?>
                     <div class="n-single-job-company">
                        <div class="dingle-job-company-meta">
                        <?php if($emp_fb != '' || $emp_google != '' || $emp_twitter != '' || $emp_linkedin != '' ) { ?>
                           <ul class="social-links list-inline">
                     		<?php if($emp_fb) { ?>
                        <li> <a href="<?php echo esc_url($emp_fb); ?>"><img src="<?php echo get_template_directory_uri();?>/images/icons/006-facebook.png" alt="<?php echo esc_attr__( 'icon', 'nokri' ); ?>"></a></li>
						<?php } if($emp_google) { ?>
                        <li> <a href="<?php echo esc_url($emp_google); ?>"><img src="<?php echo get_template_directory_uri();?>/images/icons/003-google-plus.png" alt="<?php echo esc_attr__( 'icon', 'nokri' ); ?>"></a></li>
                        <?php } if($emp_twitter) { ?>
                        <li> <a href="<?php echo esc_url($emp_twitter); ?>"><img src="<?php echo get_template_directory_uri();?>/images/icons/004-twitter.png" alt="<?php echo esc_attr__( 'icon', 'nokri' ); ?>"></a></li>
                        <?php } if($emp_linkedin) { ?>
                        <li> <a href="<?php echo esc_url($emp_linkedin); ?>"><img src="<?php echo get_template_directory_uri();?>/images/icons/005-linkedin.png" alt="<?php echo esc_attr__( 'icon', 'nokri' ); ?>"></a></li>
                        <?php }  ?>
                     		</ul>
                            <?php } ?>
                           <div class="contact-img">
                              <img src="<?php echo esc_url($image_link[0]); ?>" class="img-responsive img-circle" alt="<?php echo esc_attr__('company profile image', 'nokri' ); ?>">
                           </div>
                           <div class="contact-caption">
                              <h4><?php echo esc_html($company_name); ?></h4>
                              <a href="<?php echo esc_url($web); ?>" target="_blank" ><?php echo esc_html__('Visit Website', 'nokri' ); ?></a>
                           </div>
                        </div>
                        <a class="view-profile" href="<?php echo esc_url(get_author_posts_url($post_author_id));?>"><?php echo esc_html__('Visit Profile', 'nokri' ); ?></a>
                     </div>
                     <?php } ?>
                     <div class="n-single-job-company">
                    	<div class="dingle-job-company-meta">
                        <div id="itemMap" style="height:300px;" ></div>
                   		 <input type="hidden" id="lat" value="<?php echo esc_attr($ad_map_lat); ?>" />
                    	<input type="hidden" id="lon" value="<?php echo esc_attr($ad_map_long); ?>" />
                    	</div>
                    </div>
                    <?php if((isset($nokri['single_job_tags'])) && $nokri['single_job_tags']  == 1 ) { ?>
                     <div class="n-job-tags">
                         <h3><?php echo esc_html__('Job Tags:', 'nokri' ); ?></h3>
                         <ul class="job-tag-list">
                            <?php echo "".($tags_html); ?>
                         </ul>
                     </div>
                     <?php } ?>
                  </aside>
               </div>
               <?php
			   if((isset($nokri['relateds_jobs_switch'])) && $nokri['relateds_jobs_switch']  == '1' )
				{
			   		echo get_template_part( 'template-parts/layouts/job-style/related','jobs');
				}
			    ?>
            </div>
         </div>
 </section>