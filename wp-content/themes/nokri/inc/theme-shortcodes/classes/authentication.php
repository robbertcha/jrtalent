<?php
// sign up form
if (! class_exists ( 'authentication' )) {
class authentication
{
		function nokri_sign_up_form( $string, $terms , $section_user_name = '',$section_user_email='',$section_user_password = '',$section_term = '',$section_user_btn = '',$section_user_phone = '',$key_code =	'' , $section_term_link = '',$section_emp_btn = '',$section_cand_btn = '',$section_already_txt = '',$login_txt = '')
		{
			

			global $nokri;
			$rtl_class = '';
			if(is_rtl())
			{
				$rtl_class = "flip";
			}
			
			/* Only admin post job */
			$regsiter_buttons = '<input type="hidden" value="0"/>';
			if((isset($nokri['job_post_for_admin'])) && $nokri['job_post_for_admin']  != '1' )
			{
				$regsiter_buttons = '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="btn-group" id="status" data-toggle="buttons">
					   <label class="btn btn-default btn-md">
					 <input type="radio" value="1" name="sb_reg_type" >'.$section_emp_btn.'</label>
					   </label>
					   <label class="btn btn-default btn-md active">
					    <input type="radio" value="0" name="sb_reg_type" checked="checked">'.$section_cand_btn.'</label>
					   </label>
					</div>
				 </div>';
			}
			
			
			
		return '<form id="sb-signup-form" method="post" >
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
					    <input placeholder="'. esc_html__( 'Your Name','nokri' ).'" class="form-control" type="text" data-parsley-required="true" data-parsley-error-message="'. esc_html__( 'Please enter your name.', 'nokri' ) .'" name="sb_reg_name" >
					</div>
				 </div>
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
					  <input placeholder="'.  esc_html__( 'Your Email','nokri' ).'" class="form-control" type="email" data-parsley-type="email" data-parsley-required="true" data-parsley-error-message="'. esc_html__( 'Please enter your valid email.', 'nokri' ) .'" data-parsley-trigger="change" name="sb_reg_email">
					</div>
				 </div>
		
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
					   <input placeholder="'.  esc_html__( 'Your Password','nokri' ) .'" class="form-control" type="password" data-parsley-required="true" data-parsley-error-message="'. esc_html__( 'Please enter your password.', 'nokri' ) .'" name="sb_reg_password">
					</div>
				 </div>
		
				'.$regsiter_buttons.'
		
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="buttons-area">
					   <div class="form-group">
						  <input type="checkbox" name="icheck_box" class="input-icheck-others" data-parsley-required="true" data-parsley-error-message="'. __( 'Please accept terms and conditions.', 'nokri' ) .'" >
						  <p> '. esc_html__( 'I Agree', 'nokri' ).' <a href="'.$section_term_link.'" target="_blank">'. $section_term .'</a></p>
					   </div>
					   <button class="btn n-btn-flat btn-mid pull-right '.esc_attr($rtl_class).'" type="submit" id="sb_register_submit">'.$section_user_btn.'</button>
					   <button class="btn n-btn-flat btn-mid pull-right '.esc_attr($rtl_class).' no-display disabled" type="button" id="sb_register_msg">'.  esc_html__( 'Processing...','nokri' ).'</button>
					   <button class="btn n-btn-flat btn-mid pull-right '.esc_attr($rtl_class).' no-display disabled" type="button" id="sb_register_redirect">'.  esc_html__( 'Redirecting...','nokri' ).'</button>
					</div>
				 </div>
		
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="signup-area">
					   '.$section_already_txt.' <a href="'.get_the_permalink( $nokri['sb_sign_in_page'] ).'">'.$login_txt.'</a>
					</div>
				 </div>
		   <input type="hidden" class="get_action" value="register"/>
		   <input type="hidden" id="verify_account_msg" value="'.__('Verificaton email has been sent to your email.','nokri').'" />
		   <input type="hidden" id="nonce" value="'.$key_code.'" />
		</form>';
		}
		
		// sign In form
		function nokri_sign_in_form ( $key_code = '',$already_acount = '',$sign_up = '',$submit_button = '',$forgot_password= '')
		{
			global $nokri;
			$rtl_class = '';
			if(is_rtl())
			{
				$rtl_class = "flip";
			}
			
		return '<form id="sb-login-form-data"  >
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
					   <input placeholder="'.  esc_html__( 'Your Email','nokri' ).'" class="form-control" type="email" data-parsley-type="email" data-parsley-required="true" data-parsley-error-message="'. esc_html__( 'Please enter your valid email.', 'nokri' ) .'" data-parsley-trigger="change" name="sb_reg_email" id="sb_reg_email">
					</div>
				 </div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
					   <input placeholder="'.  esc_html__( 'Your Password','nokri' ) .'" class="form-control" type="password" data-parsley-required="true" data-parsley-error-message="'. esc_html__( 'Please enter your password.', 'nokri' ) .'" name="sb_reg_password">
					</div>
				 </div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
					   <a href="#" class="pull-left '.esc_attr($rtl_class).'" data-target="#myModal" data-toggle="modal">'.($forgot_password).'</a>
					   <button class="btn n-btn-flat btn-mid pull-right '.esc_attr($rtl_class).'" type="submit" id="sb_login_submit">'.($submit_button).'</button>
		   <button class="btn n-btn-flat btn-mid pull-right '.esc_attr($rtl_class).' no-display" type="button" id="sb_login_msg" disabled>'.  esc_html__( 'Processing...','nokri' ).'</button>
		   <button class="btn n-btn-flat btn-mid pull-right '.esc_attr($rtl_class).' no-display" type="button" id="sb_login_redirect" disabled>'.  esc_html__( 'Redirecting...','nokri' ).'</button>
					</div>
				 </div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="signup-area">
					   '.($already_acount).'<a href="'.get_the_permalink( $nokri['sb_sign_up_page'] ).'">'." ".($sign_up ).'</a>
					</div>
				 </div>
		   <input type="hidden" id="nonce" value="'.$key_code.'" />
		   <input type="hidden" class="get_action" value="login" />
		</form>';
		
		
		}
		
		// Forgot Password Form
		function nokri_forgot_password_form()
		{
			return '
			<form id="sb-forgot-form">
				 <div class="modal-body">
					<div class="form-group">
					  <label>'. esc_html__( 'Email','nokri' ).'</label>
					  <input placeholder="'.  esc_html__( 'Your Email Where We Send You New Password','nokri' ).'" class="form-control" type="email" data-parsley-type="email" data-parsley-required="true" data-parsley-error-message="'. esc_html__( 'Please enter valid email.', 'nokri' ) .'" data-parsley-trigger="change" name="sb_forgot_email" id="sb_forgot_email">
					</div>
				 </div>
				 <div class="modal-footer">
					   <button class="btn n-btn-flat btn-mid btn-block" type="submit" id="sb_forgot_submit">'.esc_html__( 'Reset My Account','nokri' ).'</button>
					   <button class="btn btn-default" type="button" id="sb_forgot_msg">'.esc_html__( 'Processing...','nokri' ).'</button>
				 </div>
		  </form>
		';	
		}
}
}








// Ajax handler for Login User
add_action( 'wp_ajax_sb_login_user', 'nokri_login_user' );
add_action( 'wp_ajax_nopriv_sb_login_user', 'nokri_login_user' );
// Login User
if (! function_exists ( 'nokri_login_user' )) {
 function nokri_login_user()
{
 global $nokri;
 // Getting values
 $params = array();
 parse_str($_POST['sb_login_data'], $params);
 $remember = false;
 if( $params['is_remember'] )
 {
  		$remember = true;
 } 
 $user  = wp_authenticate( $params['sb_reg_email'], $params['sb_reg_password'] );
 if( !is_wp_error($user) )
 {
  if( count((array)  $user->roles ) == 0 )
  {
   echo __( 'Your account is not verified yet.', 'nokri' );
   die();
  }
  else
  {
   $res = nokri_auto_login($params['sb_reg_email'], $params['sb_reg_password'], $remember ); 
   if( $res == 1 )
   {
    echo "1";
   }
  }
 }
 else
 {
   echo esc_html__( 'Invalid email or password.', 'nokri' ); 
 }
 die();
 
}
}

// Ajax handler for Register User
add_action( 'wp_ajax_sb_register_user', 'nokri_register_user' );
add_action( 'wp_ajax_nopriv_sb_register_user', 'nokri_register_user' );
if (! function_exists ( 'nokri_register_user' )) {
// Register User
function nokri_register_user()
{
	global $nokri;
	$params = array();
    parse_str($_POST['sb_signup_data'], $params);
	if( email_exists($params['sb_reg_email']) == false )
	{
		{
			/*demo check */
			$is_demo =  nokri_demo_mode();
			if($is_demo)
			{ 
				echo '3';
				die(); 
			}
			$user_name	=	explode( '@', $params['sb_reg_email'] );
			$u_name   	=	nokri_check_user_name( $user_name[0] );
			$uid        =	wp_create_user( $u_name, $params['sb_reg_password'], $params['sb_reg_email'] );
			wp_update_user( array( 'ID' => $uid, 'display_name' => $params['sb_reg_name'] ) );
			update_user_meta($uid, '_sb_contact', $params['sb_reg_contact']);
			update_user_meta($uid, '_sb_reg_type', $params['sb_reg_type']);
			update_user_meta($uid, '_user_profile_status', 'pub');
			// Email for new user
			   if ( function_exists( 'nokri_email_on_new_user' ) )
			   {
					nokri_email_on_new_user($uid, '');
			   }
			 if( isset( $nokri['sb_new_user_email_verification'] ) && $nokri['sb_new_user_email_verification'] )
			   {
				$user = new WP_User($uid);
				// Remove all user roles after registration
				foreach($user->roles as $role){
				 $user->remove_role($role);
				}
				echo 2;
				die();
			   }
			   else
			   {
				nokri_auto_login($params['sb_reg_email'], $params['sb_reg_password'], true );
				echo 1;
				die();
			   }
			
			}
		//else
			{
				echo esc_html__( 'please verify captcha code', 'nokri' );
			}
				}
		else
		{
			echo esc_html__( 'Email already exist, please try other one.', 'nokri' );
		}
		die();
	}
}




if (! function_exists ( 'nokri_auto_login' )) {
function nokri_auto_login($username, $password, $remember )
{
	$creds = array();
	$creds['user_login']    = $username;
	$creds['user_password'] = $password;
	$creds['remember']      = $remember;
	
	$user = wp_signon( $creds, false );
	if ( is_wp_error($user) )
	{
		return false;
	}
	else
	{
	if( count((array)  $user->roles ) > 0 )
	{
	return true;
	}
	else
	{
	return 2;
	}
	}
}
}




add_action( 'wp_ajax_sb_social_login', 'nokri_check_social_user' );
add_action( 'wp_ajax_nopriv_sb_social_login', 'nokri_check_social_user' );
if ( ! function_exists( 'nokri_check_social_user' ) ) {
function nokri_check_social_user($keycode = '', $email = '', $name = '', $headline = '', $profile_url = '')
{
 //if( $_SESSION['sb_nonce'] == $_POST['key_code'] )
 global $nokri;
 
 /*demo check */
$is_demo =  nokri_demo_mode();
if($is_demo)
{ 
	echo '3|'. __( "Edit in demo user not allowed", 'nokri' );
	die(); 
}
 if(  $keycode != "" || $_POST['key_code'] !=  "" )
 {
  if( $email == "" )		 
  	$user_name = $_POST['email'];
  else
  	$user_name = $email;
  unset($_SESSION['sb_nonce']);
  $_SESSION['sb_nonce'] = time();
  if( email_exists( $user_name ) == true )
  {
   $user = get_user_by( 'email', $user_name );
   $user_id = $user->ID;
   /* if only admin can post */
   if((isset($nokri['job_post_for_admin'])) && $nokri['job_post_for_admin']  == '1' )
	{
		update_user_meta($user_id, '_sb_reg_type', 1);
	}
   if( $user )
   {
    wp_set_current_user( $user_id, $user->user_login );
    wp_set_auth_cookie( $user_id );
    //do_action( 'wp_login', $user->user_login );

	if( $keycode == "" )
   		 echo '1|' . $_SESSION['sb_nonce'] . '|1|' . __( "You're logged in successfully.", 'nokri' );
	else
		 return 1;
   }
  }
  else
  {
   // Here we need to register user.
   $password = mt_rand (1000,10000);
   $uid  = nokri_do_register( $user_name, $password );
   global $nokri;
   if ( function_exists( 'nokri_email_on_new_user' ) )
   {
    	nokri_email_on_new_user($uid, $password);
   }
   if( $keycode == "" )
   {
   		echo '1|' . $_SESSION['sb_nonce'] . '|1|' . __( "You're registered and logged in successfully.", 'nokri' );
   }
	else
	{
		$user = get_user_by( 'email', $user_name );
		$user_id = $user->ID;
		if( $user )
		{
			wp_set_current_user( $user_id, $user->user_login );
			wp_set_auth_cookie( $user_id );
			// need to store user meta values
		}
		return 2;
	}
  }
 }
 else
 {
  echo '0|error|Invalid request|Diret Access not allowed'; 
 }
 die();
}
}




if (! function_exists ( 'nokri_user_not_logged_in' )) 
{
	function nokri_user_not_logged_in()
	{
			global $nokri;
			if( get_current_user_id() == "" )
			{
				echo nokri_redirect( home_url( '/' ) );
			}
	}
}
if (! function_exists ( 'nokri_user_logged_in' )) {
function nokri_user_logged_in()
{
	if( get_current_user_id() != "" )
	{
		echo nokri_redirect( home_url( '/' ) );	
	}
}
}
if (! function_exists ( 'nokri_check_user_name' )) {
function nokri_check_user_name( $username = '' )
{
	if ( username_exists( $username ) )
	{
		$random = rand();
		$username	=	$username . '-' . $random;
		nokri_check_user_name($username);		
	}
	return $username;
}
}

add_action( 'wp_ajax_sb_reset_password', 'nokri_reset_password' );
add_action( 'wp_ajax_nopriv_sb_reset_password', 'nokri_reset_password' );

// Reset Password
if ( ! function_exists( 'nokri_reset_password' ) )
{
function nokri_reset_password()
{
	global $nokri;
	// Getting values
	$params = array();
    parse_str($_POST['sb_data'], $params);
	$token			=	$params['token'];
	$token_arr		=	explode( '-sb-uid-', $token );
	$key			=	$token_arr[0];
	$uid			= 	$token_arr[1];
	$token_db		=	get_user_meta( $uid, 'sb_password_forget_token', true ); 
	if( $token_db != $key )
	{
		echo '0|' . esc_html__( "Invalid security token.", 'nokri' );
	}
	else
	{
		$new_password	=	$params['sb_new_password'];
		wp_set_password( $new_password, $uid );
		update_user_meta($uid, 'sb_password_forget_token', '');
		echo '1|' . esc_html__( "Password Changed successfully.", 'nokri' );
	}
	die();
}
}





/* After Social Login Acount Check*/

add_action('wp_ajax_after_social_login', 'nokri_after_social_login');
if ( ! function_exists( 'nokri_after_social_login' ) ) {
function nokri_after_social_login()
{
    $user_id  = get_current_user_id();
	$acount_type = array();
	parse_str($_POST['social_login_data'], $acount_type);
	$acount_type = $acount_type['sb_reg_type'];
    update_user_meta($user_id, '_sb_reg_type', $acount_type);
	echo 1;
	die();
 }
}



if( ! function_exists( 'nokri_do_register' ) )
{
function nokri_do_register($email= '', $password = '')
{
	global $nokri;
	$user_name	=	explode( '@', $email );
	$u_name	=	nokri_check_user_name( $user_name[0] );
	$uid =	wp_create_user( $u_name, $password, $email );
	wp_update_user( array( 'ID' => $uid, 'display_name' => $u_name ) );
	update_user_meta($uid, '_user_profile_status', 'pub');
	nokri_auto_login($email, $password, true );
	
	
	return $uid;
}
}

/************************************/
/* Ajax handler for Saving Empoyer Profile   */
/************************************/
add_action( 'wp_ajax_emp_profiles', 'nokri_emp_profiles' );
add_action( 'wp_ajax_nopriv_emp_profiles', 'nokri_emp_profiles' );

function nokri_emp_profiles()
{
	global $nokri;
	/*Setting profile option*/
	$profile_setting_option = isset($nokri['user_profile_setting_option']) ? $nokri['user_profile_setting_option']  : false;
	$taxonomy =  'job_category';
	$user_id  =   get_current_user_id();
	/*demo check */
	$is_demo =  nokri_demo_mode();
	if($is_demo)
	{ 
		echo '2';
		die(); 
	}
	
	
	// Getting values From Param
	$params = array();
    parse_str($_POST['sb_data'], $params);
	$emp_name 		= 	$params['emp_name'];
	$emp_headline 	= 	$params['emp_headline'];
	$emp_web 		= 	$params['emp_web'];
	$emp_est 		= 	$params['emp_est'];
	$emp_search 	= 	$params['is_in_search'];
	$emp_intro 		= 	$params['emp_intro'];
	$emp_phone 		= 	$params['sb_reg_contact'];
	$emp_entity 	= 	$params['emp_entity'];
	$emp_nos 		= 	$params['emp_nos'];
	$emp_dp 		= 	$params['emp_dp'];
	$emp_profile 	= 	$params['emp_profile'];
	$emp_lat 		= 	$params['ad_map_lat'];
	$emp_long 		= 	$params['ad_map_long'];
    $emp_adress 	= 	$params['emp_adress'];
	$emp_fb 		= 	$params['emp_fb'];
	$emp_twitter 	= 	$params['emp_twitter'];
	$emp_linked 	= 	$params['emp_linked'];
	$emp_google 	= 	$params['emp_google'];
	$emp_map_location = $params['sb_user_address'];
	$emp_postal_address = $params['sb_user_postal'];
	$emp_cat 		=  	$params['emp_cat'];
	/* Updating Values In User Meta Of Current User */
	if ($emp_name != '')
	{
		wp_update_user( array( 'ID' => $user_id, 'display_name' => $params['emp_name'] ) ); 
	}
	if ($emp_headline != '')
	{
		update_user_meta( $user_id, '_user_headline', $emp_headline);
	}
	if ($emp_web != '')
	{
		update_user_meta( $user_id, '_emp_web', $emp_web);
	}
	if ($emp_est != '')
	{
		update_user_meta( $user_id, '_emp_est', $emp_est);
	}
	if ($emp_search != '')
	{
		update_user_meta( $user_id, '_emp_search', $emp_search);
	}
	 if ($emp_phone != '')
	{
		update_user_meta( $user_id, '_sb_contact', $emp_phone);
	}
	if ($emp_entity != '')
	{
		update_user_meta( $user_id, '_emp_entity', $emp_entity);
	}
	if ($emp_nos != '')
	{
		update_user_meta( $user_id, '_emp_nos', $emp_nos);
	}
	if ($emp_cat != '')
	{
		update_user_meta( $user_id, '_emp_skills', $emp_cat);
	}
	
	/*If allowed */
	if($profile_setting_option)
	{
		update_user_meta( $user_id, '_user_profile_status', $emp_profile);
	}
	else
	{
		update_user_meta( $user_id, '_user_profile_status', 'pub');
	}
	update_user_meta( $user_id, '_emp_intro', $emp_intro);
	update_user_meta( $user_id, '_emp_fb', $emp_fb);
	update_user_meta( $user_id, '_emp_twitter', $emp_twitter);
	update_user_meta( $user_id, '_emp_linked', $emp_linked);
	update_user_meta( $user_id, '_emp_google', $emp_google);
	
	if ($emp_map_location != '')
	{
		update_user_meta($user_id, '_emp_map_location', $emp_map_location );
	}
	if ($emp_lat != '')
	{
		update_user_meta($user_id, '_emp_map_lat', $emp_lat );
	}
	if ($emp_long != '')
	{
		update_user_meta($user_id, '_emp_map_long', $emp_long );
	}
	if ($emp_postal_address != '')
	{
		update_user_meta($user_id, '_emp_postal_address', $emp_postal_address );
	}
	
	

	echo "1";
	die();
}

/************************************/
/* Ajax handler for Proifle Picture   */
/************************************/ 
add_action('wp_ajax_upload_user_pic', 'nokri_user_profile_pic');
if( ! function_exists( 'nokri_user_profile_pic' ) )
{
function nokri_user_profile_pic(){
	global $nokri;
$user_id = get_current_user_id();
/*demo check */
$is_demo =  nokri_demo_mode();
if($is_demo)
{ 
	echo '2|' . esc_html__( "Demo User Not Allowed", 'nokri' );
	die(); 
}
  /* img upload */
 $condition_img = 7;
 $img_count = count((array) explode( ',',$_POST["image_gallery"] )); 

 if(!empty($_FILES["my_file_upload"])){

 require_once ABSPATH . 'wp-admin/includes/image.php';
 require_once ABSPATH . 'wp-admin/includes/file.php';
 require_once ABSPATH . 'wp-admin/includes/media.php';
  
   
 $files = $_FILES["my_file_upload"];

   
 $attachment_ids=array();
 $attachment_idss='';

 if($img_count>=1){
 $imgcount=$img_count;
 }else{
 $imgcount=1;
 }
  

 $ul_con='';

 foreach ($files['name'] as $key => $value) {            
   if ($files['name'][$key]) { 
    $file = array( 
     'name' => $files['name'][$key],
     'type' => $files['type'][$key], 
     'tmp_name' => $files['tmp_name'][$key], 
     'error' => $files['error'][$key],
     'size' => $files['size'][$key]
    ); 
	
    $_FILES = array ("my_file_upload" => $file); 
	
// Allow certain file formats
$imageFileType	=	end( explode('.', $file['name'] ) );
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo '0|' . esc_html__( "Sorry, only JPG, JPEG, PNG & GIF files are allowed.", 'nokri' );
	die();
}
 
    $size_arr	    =	explode( '-', $nokri['sb_upload_profile_pic_size'] );
	$display_size	=	$size_arr[1];
	$actual_size	=	$size_arr[0];
	 // Check file size
	if ($file['size'] > $nokri['sb_upload_profile_pic_size'] ) {
		echo '0|' . esc_html__( "Max allowed image size is"." ".$display_size, 'nokri' );
		die();
	}
    
    
    foreach ($_FILES as $file => $array) {              
      
      if($imgcount>=$condition_img){ break; } 
     $attach_id = media_handle_upload( $file, $post_id );
      $attachment_ids[] = $attach_id; 

      $image_link = wp_get_attachment_image_src( $attach_id, 'nokri-user-profile' );
      
    }
    if($imgcount>$condition_img){ break; } 
    $imgcount++;
   } 
  }

  
 } 
/*img upload */
$attachment_idss =  array_filter( $attachment_ids  );
$attachment_idss =  implode( ',', $attachment_idss );  


$arr = array();
$arr['attachment_idss'] = $attachment_idss;
$arr['ul_con']          =  $ul_con; 

$uid	=	$user_id;
update_user_meta($uid, '_sb_user_pic', $attach_id );
echo '1|' . $image_link[0];
 die();

}
}




/************************************/
// Ajax handler for add to cart    //
/************************************/
add_action( 'wp_ajax_sb_add_cart', 'nokri_add_to_cart' );
add_action('wp_ajax_nopriv_sb_add_cart', 'nokri_add_to_cart');
if ( ! function_exists( 'nokri_add_to_cart' ) ) {
function nokri_add_to_cart()
{
	global $nokri;
	$user_id = get_current_user_id();
	$user_type = get_user_meta($user_id, '_sb_reg_type', true);
	
	if( $user_id == "" )
	{
		echo '0|' . __( "You must need to logged in.", 'nokri' );
		die();	
	}
	
	if( $user_type == 0 )
	{
		echo '5|' . __( "Candidates Can't Purchase Packages", 'nokri' ) .'|' . get_the_permalink();
		die();
	}
	
	/*demo check */
	$is_demo =  nokri_demo_mode();
	if($is_demo)
	{ 
		echo '6|' . __( "Editing not allowed in demo mode", 'nokri' ) .'|' . get_the_permalink();
		die(); 
	}
	
	
	
	
	
	$product_id	  = 	$_POST['product_id'];
	$is_avail     = 	get_user_meta( $user_id, 'avail_free_package', true); 
    $is_pkg_free  = 	get_post_meta($product_id, 'op_pkg_typ',true );
	
	if ($is_avail == 1 && $_POST['is_free'] == 1)
	{
		echo '4|' . __( "You have already availed free package", 'nokri') .'|' . get_the_permalink( $nokri['package_page'] );
		die();
	}
	
	if ($_POST['is_free'] == 1 &&  $is_pkg_free == 1 )
	{
		 nokri_free_package($product_id);
		 update_user_meta( get_current_user_id(), 'avail_free_package', (int)'1');	
		 echo '3|' . __( "Success", 'nokri') .'|' . get_the_permalink( $nokri['sb_post_ad_page'] );
		 die();
	}
	$qty	=	$_POST['qty'];
	global $woocommerce;
	if( $woocommerce->cart->add_to_cart($product_id, $qty) )
	{
		echo '1|' . __( "Added to cart.", 'nokri' ) .'|' . $woocommerce->cart->get_cart_url();
	}
	else
	{
		echo '1|' . __( "Already in your cart.", 'nokri' ) .'|' . $woocommerce->cart->get_cart_url();
	}
	die();
}
}



/************************************/
// Ajax handler for Job Posting. //
/************************************/

add_action('wp_ajax_sb_ad_posting', 'nokri_ad_posting');
if ( ! function_exists( 'nokri_ad_posting' ) ) {
function nokri_ad_posting()
{
	global $nokri;
	
	/*demo check */
	$is_demo =  nokri_demo_mode();
	if($is_demo)
	{ 
		echo '2';
		die(); 
	}
	$job_params = array();
	parse_str($_POST['sb_data'], $job_params);
	// Getting values
	$job_date =    		$job_params['job_date'];
	$job_description = 	$job_params['job_description'];
	$job_category = 	$job_params['job_category'];
	$job_type =         $job_params['job_type'];
	$job_level =        $job_params['job_level'];
	$job_shift =        $job_params['job_shift'];
	$job_experience =   $job_params['job_experience'];
	$job_skills =       $job_params['job_skills'];
	$job_salary =       $job_params['job_salary']; 
	$job_qualifications = $job_params['job_qualifications'];
	$job_currency =     $job_params['job_currency'];
	$job_salary_type =     $job_params['job_salary_type'];
	$job_address = 		$job_params['sb_user_address'];
	$job_lat = 			$job_params['ad_map_lat'];
	$job_long = 		$job_params['ad_map_long'];
	$job_phone = 		$job_params['job_phone'];
	$job_posts = 		$job_params['job_posts'];
	$job_apply_with = 		$job_params['job_apply_with'];
	$job_apply_url = 		$job_params['job_external_url'];
	$job_class = 		array();
	$job_class_checked = $job_params['class_type_value'];
	if( get_current_user_id() == "" )
	{
		echo "0";
		die();
	}
	$ad_status	=	'publish';
	if( $_POST['is_update'] != "" )
	{
		if( $nokri['sb_update_approval'] == 'manual' )
		{
			$ad_status	=	'pending';
		}
		$pid			    =	$_POST['is_update'];
		//$media			= 	get_attached_media( 'image',$pid );
	}
	else
	{
		if( $nokri['sb_ad_approval'] == 'manual' )
		{
			$ad_status	=	'pending';
		}
		$pid			=	get_user_meta ( get_current_user_id(), 'ad_in_progress', true );
		$media 			=	get_attached_media( 'image',$pid );
		/*Now user can post new Job*/
		delete_user_meta(get_current_user_id(), 'ad_in_progress');
			/* Getting User Simple Jobs Informations */
			$simple_job_term_id =  nokri_simple_jobs();
			$meta_name  		=  'package_job_class_'.$simple_job_term_id;
			$simple_ads       	=  get_user_meta(get_current_user_id(), $meta_name, true);
			if( $simple_ads > 0 && !is_super_admin( get_current_user_id() ) )
			{
				$simple_ads	=	$simple_ads - 1;
				update_user_meta( get_current_user_id(), $meta_name, $simple_ads );
			}
			update_post_meta($pid, '_nokri_ad_status_', 'active' );
			
	}
	nokri_get_notify_on_ad_post($pid);
	
	/* Getting Other Jobs Informations */
	foreach($job_class_checked as $job_class)
	{
		$no_of_jobs          =  get_user_meta(get_current_user_id(), 'package_job_class_'.$job_class, true);
		if( $no_of_jobs > 0  )
			{
				$no_of_jobs	=	$no_of_jobs - 1;
				update_user_meta( get_current_user_id(), 'package_job_class_'.$job_class, $no_of_jobs );
				update_post_meta( $pid, 'package_job_class_'.$job_class, $job_class );
				wp_set_post_terms($pid, $job_class_checked, 'job_class');  
			}
	}
	/*Bad words filteration*/
	$words		=	explode( ',', $nokri['bad_words_filter'] );
	$replace	=	$nokri['bad_words_replace'];
	
	
	$desc		=	nokri_badwords_filter( $words, $job_params['job_description'], $replace );
	$title		=	nokri_badwords_filter( $words, $job_params['job_title'], $replace );
	$my_post 	=   array(
						'ID'			=> $pid,
						'post_title'	=> $title,
						'post_status'   => $ad_status,
						'post_content'	=> $desc,
						'post_type' 	=> 'job_post',
						'post_name' 	=> $title
					 );
					 
	
	
	wp_update_post( $my_post );
			
	
	/* Categories Level */
	$categories =	array();
	if( $job_params['job_cat'] != "" ) 		  { $categories[] =	$job_params['job_cat'];	         }
	if( $job_params['job_cat_second'] != "" ) { $categories[] =	$job_params['job_cat_second'];	 }
	if( $job_params['job_cat_third'] != "" )  { $categories[] =	$job_params['job_cat_third'];	 }
	if( $job_params['job_cat_forth'] != "" )  { $categories[] =	$job_params['job_cat_forth'];	 }
	wp_set_post_terms( $pid, $categories, 'job_category' );
	
	/*countries*/
	$countries =	array();
	if( $job_params['ad_country'] != "" )        {  $countries[]	=	$job_params['ad_country'];	 }
	if( $job_params['ad_country_states'] != "" ) {  $countries[]	=	$job_params['ad_country_states'];}
	if( $job_params['ad_country_cities'] != "" ) {  $countries[]	=	$job_params['ad_country_cities']; }
	if( $job_params['ad_country_towns'] != "" )  {  $countries[]	=	$job_params['ad_country_towns']; }
	wp_set_post_terms( $pid, $countries, 'ad_location' );
	
	
	/*******************************/
	/*setting taxonomoies Post Meta */
	/*******************************/
	if ($job_date != '')
	{
		update_post_meta( $pid, '_job_date', $job_date);
	}
	if( $job_params['job_type'] != "" )
	{
		wp_set_post_terms($pid, $job_type, 'job_type');
	}
	if( $job_params['job_level'] != "" )
	{
		wp_set_post_terms($pid, $job_level, 'job_level');
	}
	//if( $job_params['job_shift'] != "" )
	//{
		wp_set_post_terms($pid, $job_shift, 'job_shift');
	//}
	if( $job_params['job_experience'] != "" )
	{
		wp_set_post_terms($pid, $job_experience, 'job_experience');
	}
	if( $job_params['job_skills'] != "" )
	{
		wp_set_post_terms($pid, $job_skills, 'job_skills');
	}
	if( $job_params['job_salary'] != "" )
	{
		wp_set_post_terms($pid, $job_salary, 'job_salary');

	} 
	if( $job_params['job_salary_type'] != "" )
	{
		wp_set_post_terms($pid, $job_salary_type, 'job_salary_type');
	}
	if( $job_params['job_qualifications'] != "" )
	{
		wp_set_post_terms($pid, $job_qualifications, 'job_qualifications');
	}
	if( $job_params['job_currency'] != "" )
	{
		wp_set_post_terms($pid, $job_currency, 'job_currency');
	}
	if( $job_posts != "" )
	{
		update_post_meta( $pid, '_job_posts', $job_posts);
	}
	/* Setting Tags */
	$tags	=	explode(',', $job_params['job_tags'] );
	wp_set_object_terms($pid, $tags, 'job_tags');
	if ($job_address != '')
	{
		update_post_meta( $pid, '_job_address', $job_address);
	}
	if ($job_lat != '')
	{
		update_post_meta( $pid, '_job_lat', $job_lat); 
	}
	if ($job_long != '')
	{
		update_post_meta( $pid, '_job_long', $job_long); 
	}
	
	update_post_meta( $pid, '_job_apply_with', $job_apply_with); 
	update_post_meta( $pid, '_job_apply_url', $job_apply_url); 
	
	
	/* Jobs Status */
	update_post_meta( $pid, '_job_status', 'active');
	echo get_the_permalink( $pid );
	
	 die();
	}
}

/* Create Post By Title */
if ( ! function_exists( 'nokri_check_author' ) ) {
function nokri_check_author( $ad_id )
{
	if( get_post_field( 'post_author', $ad_id ) != get_current_user_id() )
	{
		return false;
	}
	else
	{
		return true;	
	}
}
}

add_action('wp_ajax_post_ad', 'nokri_post_ad_process');
if ( ! function_exists( 'nokri_post_ad_process' ) ) {
function nokri_post_ad_process()
{
	
		
	if( $_POST['is_update'] != "")
	{
		die();
	}
	
	
	$title	=	$_POST['title'];
	if( get_current_user_id() == "" )
		die();
		
	if( !isset( $title ) )
		die();
	
	

	$ad_id	=	get_user_meta ( get_current_user_id(), 'ad_in_progress', true );	
	if( get_post_status ( $ad_id ) && $ad_id != "" )
	{
		$my_post = array(
			'ID'           => $ad_id,
			'post_title'   => $title
		);
		wp_update_post( $my_post );	
		die();	
	}
	

	// Gather post data.
	$my_post = array(
    'post_title'    => $title,
    'post_status'   => 'pending',
    'post_author'   => get_current_user_id(),
    'post_type'     => 'job_post'
);

// Insert the post into the database.
$id	=  wp_insert_post( $my_post );
if( $id )
{
	update_user_meta( get_current_user_id(), 'ad_in_progress', $id );	
}

die();

}
}




// Get States
add_action('wp_ajax_sb_get_sub_states', 'nokri_get_sub_states');
add_action( 'wp_ajax_nopriv_sb_get_sub_states_search', 'nokri_get_sub_states_search' );
if ( ! function_exists( 'nokri_get_sub_states' ) ) {
function nokri_get_sub_states()
{
	$cat_id	=	$_POST['cat_id'];
	$ad_cats	=	nokri_get_cats('ad_location' , $cat_id );
	if( count((array)  $ad_cats ) > 0 )
	{
		$cats_html	=	'<select class="category form-control" id="ad_cat_sub" name="ad_cat_sub">';
		$cats_html	.=	'<option label="'.esc_html__('Select Option','nokri').'"></option>';
		foreach( $ad_cats as $ad_cat )
		{
			$cats_html	.=	'<option value="'.$ad_cat->term_id.'">' . $ad_cat->name .  '</option>';
		}
		$cats_html	.=	'</select>';
		echo($cats_html);
		die();
	}
	else
	{
		echo "";
		die();
	}
}
}


/*Employer Action Request*/
add_action('wp_ajax_job_action', 'nokri_job_action');
if ( ! function_exists( 'nokri_job_action' ) ) {
function nokri_job_action()
{
	$user_id = get_current_user_id();
	$cv_action = $_POST['cv_action'];
	$job_id = $_POST['job_id'];
	$cand_id = $_POST['cand_id'];  
	if( $cv_action != "" )
	{
		update_post_meta( $job_id, '_job_applied_status_'.$cand_id,$cv_action);
	}
	echo nokri_canidate_apply_status( $cv_action );
	die();  
}
}






/*Employer Email Tempalte Action */

add_action('wp_ajax_create_email_action', 'nokri_create_email_templates');
if ( ! function_exists( 'nokri_create_email_templates' ) ) {
function nokri_create_email_templates()
{
	$user_id = get_current_user_id();
	$email_params = array();
	parse_str($_POST['temp_data'], $email_params);
    $temp_name        =  $email_params['email_temp_name'];
    $temp_subject     =  $email_params['email_temp_subject'];
    $temp_description =  $email_params['email_temp_details'];
	$template_id 	  =  $email_params['template_id'];  
	$template_for 	  =  $email_params['email_temp_for'];
	$template_date    =  date("F j, Y");
	/*demo check */
	$is_demo =  nokri_demo_mode();
	if($is_demo)
	{ 
		echo '2';
		die(); 
	}
	
	if( $template_id != "" )
	{
		$template_meta_key = $template_id;
	}
	else
	{
		$template_meta_key = '_email_temp_name_'.$user_id.'_'.time();
	}
	//header("Content-Type: application/json; charset=UTF-8");
	$template['name'] 		= $temp_name;	
	$template['subject'] 	= $temp_subject;	
	$template['body'] 	 	= $temp_description;
	$template['for'] 	 	= $template_for;
	$template['date'] 	 	= $template_date;
	$templateData           = json_encode($template);
	$templateData      		= nokri_base64Encode($templateData);
	update_user_meta( $user_id, $template_meta_key, $templateData );
	echo 1;
	die();  
}
}





/* Employer Deleting Email Template*/

add_action('wp_ajax_del_email_temp', 'nokri_del_email_temp');
if ( ! function_exists( 'nokri_del_email_temp' ) ) {
function nokri_del_email_temp()
{
/*demo check */
$is_demo =  nokri_demo_mode();
if($is_demo)
{ 
	echo '2';
	die(); 
}
$user_id   =   get_current_user_id();
$temp_id = $_POST['temp_id'];
 delete_user_meta($user_id, $temp_id);
echo 1;			
die();
 }
}




/* Employer Select Email Template */

add_action('wp_ajax_template_select_action', 'nokri_template_select');
if ( ! function_exists( 'nokri_template_select' ) ) {
function nokri_template_select()
{
     /* Getting Email Templates */
		$user_id   =   get_current_user_id();
		$res       =   nokri_get_resumes_list( $user_id );
		$meta_key  = $_POST['temp_val'];
		if( $meta_key != "" )
		{	
			$meta_data 			= get_user_meta($user_id, $meta_key, true );
			$meta_data 			= nokri_base64Decode($meta_data);
			$val 				= json_decode( $meta_data, true );
			$template_name 		= $val['name'];
			$template_subject 	= $val['subject'];
			$template_body 		= $val['body'];
			$template_for		= $val['for'];  
		}
		
		$html = '<input type="hidden" value="'.$template_for.'"  name="cand_status_val" />
								<div class="form-group no-email-subject">
									<input  type="text" class="form-control" name="email_sub" value="'. esc_html($template_subject).'" placeholder="'. esc_html__( 'Subject', 'nokri' ).'" required>
								</div>
							<div class="form-group no-email-body">
                        <label class="">'.__( "Email template.", 'nokri' ).'</label>
                        <textarea name="email_body" rows="6" class="form-control rich_textarea" placeholder="'. esc_html__( 'Cover Letter', 'nokri' ) .'" required>'. esc_html($template_body).'</textarea>
                    </div>';
	
	echo ''.$html;
	die();	
	
		
   }
}

/* Employer Sending Email*/
add_action('wp_ajax_sending_email', 'nokri_sending_email');
if ( ! function_exists( 'nokri_sending_email' ) ) {
function nokri_sending_email()
{
	/*demo check */
	$is_demo =  nokri_demo_mode();
	if($is_demo)
	{ 
		echo '2';
		die(); 
	}
	$user_id = get_current_user_id();
	$send_email_params = array();
	parse_str($_POST['email_data'], $send_email_params);
	$candidate_id  =  $send_email_params['candidiate_id']; 
	$job_id        =  $send_email_params['job_stat_id'];
	$cand_status   =  $send_email_params['cand_status_val'];
	$is_send_mail  =  $send_email_params['is_send_email'];
	if( $candidate_id != "" )
	{
		update_post_meta( $job_id, '_job_applied_status_'.$candidate_id,$cand_status);
	}
	if($is_send_mail == 'true')
	{
		$subject           =   $send_email_params['email_sub'];
		$body              =   $send_email_params['email_body'];
		nokri_employer_status_email($job_id,$candidate_id,$subject,$body);
	}
	echo 1;
	die();
 }
}

/* Employer Activating/Inactivating His Job*/

add_action('wp_ajax_inactive_job', 'nokri_inactive_job');
if ( ! function_exists( 'nokri_inactive_job' ) ) {
function nokri_inactive_job()
{
	/*demo check */
	$is_demo =  nokri_demo_mode();
	if($is_demo)
	{ 
		echo '2';
		die(); 
	}
    $job_id     = $_POST['job_id'];
	$job_status = $_POST['job_status'];
	if($job_id != '') 
	{
       update_post_meta( $job_id, '_job_status',$job_status);
	}
	echo 1;			
	die();
 }
}


/* Employer Deleting His Job*/

add_action('wp_ajax_del_emp_job', 'nokri_del_my_job');
if ( ! function_exists( 'nokri_del_my_job' ) ) {
function nokri_del_my_job()
{
	/*demo check */
	$is_demo =  nokri_demo_mode();
	if($is_demo)
	{ 
		echo '2';
		die(); 
	}
    $emp_job_id = $_POST['emp_job_id'];
    wp_trash_post($emp_job_id);
	echo 1;			
	die();
 }
}


/* Employer Deleting His Followers*/
add_action('wp_ajax_un_following_followers', 'nokri_un_following_followers');
if ( ! function_exists( 'nokri_un_following_followers' ) ) {
function nokri_un_following_followers()
{
$user_id 				= get_current_user_id();
$follower_id   			= $_POST['follower_id'];
/*demo check */
$is_demo =  nokri_demo_mode();
if($is_demo)
{ 
	echo '2';
	die(); 
}
if( $follower_id != "" )
	{   
		if(delete_user_meta( $follower_id, '_cand_follow_company_'.$user_id,$user_id))
		{
			echo "1";
			die();
		}
		else
		{
			echo "0";
			die();
		}
	}
	echo "0";
	die();
	}
}


/************************************/
/* Return Followers  ID's*/
/************************************/
if ( ! function_exists( 'nokri_followers_ids' ) )
{
	function nokri_followers_ids($user_id)
	{
		/* Query For Getting All Followed Companies */
		global $wpdb;
		$query	          =      "SELECT meta_value FROM $wpdb->usermeta WHERE user_id = '$user_id' AND meta_key like '_cand_follow_company_%'";
		$cand_followings  =      $wpdb->get_results($query);
		if(count((array) $cand_followings) > 0 )
		{
			 $ids = array();
			 foreach ( $cand_followings as $companies ) 
			 {
				  $ids[] = $companies->meta_value;
			 }
			return $ids;
		}
	}
}


/**********************************/
/* User updating  password       */
/**********************************/

add_action('wp_ajax_change_password', 'nokri_change_password');
if ( ! function_exists( 'nokri_change_password' ) ) {
function nokri_change_password()
{
$user_id 				= get_current_user_id();
$password_data          = array();
parse_str($_POST['password_data'], $password_data);
$old_password           =  $password_data['old_password']; 
$new_password           =  $password_data['new_password']; 
$user 				    = 	get_user_by( 'ID', $user_id );
/*demo check */
$is_demo =  nokri_demo_mode();
if($is_demo)
{ 
	echo '4';
	die(); 
}
if( $old_password == ""  )
{
	echo 0;
	die();
} 
if($new_password == ""  )
{
	echo 1;
	die();
} 

if ( $user && wp_check_password( $old_password, $user->data->user_pass, $user->ID ) ) 
{
	    wp_set_password( $new_password, $user_id );
		echo 2;
		die();
} 
else
 {
	echo 3;
	die();
 }

	
	}
}

/**********************************/
/* Del acount      */
/**********************************/

add_action('wp_ajax_delete_myaccount', 'nokri_delete_my_account');
if ( ! function_exists( 'nokri_delete_my_account' ) )
{ 
 function nokri_delete_my_account()
 {
/*demo check */
$is_demo =  nokri_demo_mode();
if($is_demo)
{ 
	echo '4';
	die(); 
}
  //check user is logged in or not
 $user_id 				= get_current_user_id();
  if( is_super_admin( $user_id ) )
  {
	   echo '1';
	   die(); 
  }
  else
  {
   // delete comment with that user id
   $c_args = array ('user_id' => $user_id,'post_type' => 'any','status' => 'all');
   $comments = get_comments($c_args);
   if(count((array) $comments) > 0 )
   {
    foreach($comments as $comment) :
     wp_delete_comment($comment->comment_ID, true);
    endforeach;
   }
   // delete user posts
    $args = array ('numberposts' => -1,'post_type' => 'any','author' => $user_id);
    $user_posts = get_posts($args);
    // delete all the user posts
    if(count((array) $user_posts) > 0 )
    {
     foreach ($user_posts as $user_post) {
     wp_delete_post($user_post->ID, true);
     }
    }
    //now delete actual user
    wp_delete_user($user_id);
    echo 0;
    die();
  }
 }
}

/* Contact me */
add_action( 'wp_ajax_nopriv_contact_me', 'nokri_contact_me' );
add_action('wp_ajax_contact_me', 'nokri_contact_me');
if ( ! function_exists( 'nokri_contact_me' ) ) {
function nokri_contact_me()
{
	$contact_me_params = array();
	parse_str($_POST['contact_me_data'], $contact_me_params);
	$headers            =  array('Content-Type: text/html; charset=UTF-8');  
	$reciver_id         =  $contact_me_params['receiver_id']; 
	$sender_name        =  $contact_me_params['contact_name'];
	$sender_email       =  $contact_me_params['contact_email'];
	$subject            =  $contact_me_params['contact_subject'];
	$message            =  $contact_me_params['contact_message'];
	nokri_contact_me_email( $reciver_id,$sender_email,$sender_name,$subject,$message);
	echo 1;
	die();
 }
}