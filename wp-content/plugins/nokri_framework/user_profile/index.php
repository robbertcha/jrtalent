<?php 
add_action( 'show_user_profile', 'sb_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'sb_show_extra_profile_fields' );
 
function sb_show_extra_profile_fields( $user ) { ?>
    <h3><?php echo __('Package Information','redux-framework'); ?></h3>
 	<?php
	/* Getting Employer Packages Details */	
	$class_terms = get_terms('job_class', array('hide_empty' => false , 'orderby'=> 'id', 'order' => 'ASC' ));
	 if( count( $class_terms ) > 0 )
	 { 
		$class = $row_data = '';
		foreach( $class_terms as $class_term)
		{		
			$meta_name =  'package_job_class_'.$class_term->term_id;
		    //$class	   =   get_the_author_meta( $meta_name, $user->ID );
			$class	     =	 get_user_meta( $user->ID, $meta_name, true );
			  if($class == '')
			  {
				  $class = __( "N/A", 'nokri' );
			  }
			
			
			$row_data .=   '<tr>
            <th><label for="_sb_pkg_type">'. esc_html(ucfirst( $class_term->name)). __(' Jobs','redux-framework').'</label></th>
            <td>
                <input type="text" name="'. esc_attr( $meta_name ).'" id="'. esc_attr( $meta_name ).'" value="'. esc_attr( $class ).'" class="regular-text" /><br />
            </td>
        </tr>
        <tr>';
			//echo nokri_employer_dashboard(ucfirst( $class_term->name) ." Jobs :",$meta_name);
		}
	 }
	?>
    <table class="form-table">
    <tr>
            <th><label for="_sb_pkg_date"><?php echo esc_html__(' Package expiry (Y-mm-dd)','redux-framework'); ?></label></th>
            <td>
                <input type="text" name="_sb_pkg_date" id="_sb_pkg_date" value="<?php echo get_user_meta( $user->ID, '_sb_expire_ads', true ); ?>" class="regular-text" /><br />
            </td>
        </tr>
        <?php echo $row_data; ?>
        <?php  
		global $nokri;
		if((isset($nokri['cand_search_mode'])) && $nokri['cand_search_mode']  == '2' ) { ?>
        <tr>
            <th><label for="_sb_cand_search_value"><?php echo esc_html__('Candidates Resumes Access','redux-framework'); ?></label></th>
            <td>
                <input type="text" name="_sb_cand_search_value" id="_sb_cand_search_value" value="<?php echo get_user_meta( $user->ID, '_sb_cand_search_value', true ); ?>" class="regular-text" /><br />
            </td>
        </tr>
        <?php } ?>
    </table>
    
    
    <h3><?php echo __('User Profile Information','redux-framework'); ?></h3>
    <?php
	/* Type setting */
	 $is_employer 		= get_user_meta($user->ID, '_sb_reg_type',true );
    $is_candidates 		= get_user_meta($user->ID, '_sb_reg_type',true );
	/* Profile setting */
	$profile_option 	= get_user_meta($user->ID, '_user_profile_status',true );
	?>
    <table class="form-table">
    <tr>
            <th><label for="_sb_user_type"><?php echo esc_html__('User Type','redux-framework'); ?></label></th>
            <td>
                <select class="form-control" id="_sb_user_type" name="_sb_user_type">
        <option value="1" <?php if($is_employer == 1) { echo "selected = selected"; } ?> ><?php echo __("Employer", "redux-framework"); ?></option>
        <option value="0" <?php if($is_candidates == 0) { echo "selected = selected"; } ?> ><?php echo __("Candidate", "redux-framework"); ?></option>
     </select>
            </td>
        </tr>
    
    <tr>
            <th><label for="_sb_user_profile_setting"><?php echo esc_html__('User Profile Setting','redux-framework'); ?></label></th>
            <td>
                <select class="form-control" id="_sb_user_profile_setting" name="_sb_user_profile_setting">
        <option value="pub" <?php if($profile_option == 'pub') { echo "selected = selected"; } ?> ><?php echo __("Public", "redux-framework"); ?></option>
        <option value="priv" <?php if($profile_option == 'priv') { echo "selected = selected"; } ?> ><?php echo __("Private", "redux-framework"); ?></option>
     </select>
            </td>
        </tr>
    
    </table>
<?php }

add_action( 'personal_options_update', 'sb_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'sb_save_extra_profile_fields' );
 
function sb_save_extra_profile_fields( $user_id ) {
 
    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;
 	
	/* Updating Package Expiry Details */
	if( isset( $_POST['_sb_pkg_date'] ) && $_POST['_sb_pkg_date'] != '' )
	{
		update_user_meta( absint( $user_id ), '_sb_expire_ads', wp_kses_post( $_POST['_sb_pkg_date'] ) );
	}
     /* Updating Jobs Details */	
	 $class_terms = get_terms('job_class', array('hide_empty' => false , 'orderby'=> 'id', 'order' => 'ASC' ));
	 if( count( $class_terms ) > 0 )
	 { 
		$class = $row_data = '';
		foreach( $class_terms as $class_term)
		{		
			$meta_name   =  'package_job_class_'.$class_term->term_id;
			$class	     =	 get_user_meta( $user->ID, $meta_name, true );
			 if($_POST[$meta_name] != '')
			 {
				 update_user_meta( absint( $user_id ), $meta_name, wp_kses_post( $_POST[$meta_name] ) );
			 }
			 
		}
	 }
	 /* Updating Candidate Search Details */
	if( isset( $_POST['_sb_cand_search_value'] ) && $_POST['_sb_cand_search_value'] != '' )
	{
		update_user_meta( absint( $user_id ), '_sb_cand_search_value', wp_kses_post( $_POST['_sb_cand_search_value'] ) );
	}
	
	/* Updating User Type Information */
	if( isset( $_POST['_sb_user_type'] ) && $_POST['_sb_user_type'] != '' )
	{
		update_user_meta( absint( $user_id ), '_sb_reg_type', wp_kses_post( $_POST['_sb_user_type'] ) );
	}
	/* Updating User Profile setting */
	if( isset( $_POST['_sb_user_profile_setting'] ) && $_POST['_sb_user_profile_setting'] != '' )
	{
		update_user_meta( absint( $user_id ), '_user_profile_status', wp_kses_post( $_POST['_sb_user_profile_setting'] ) );
	}
 	
 
 
}