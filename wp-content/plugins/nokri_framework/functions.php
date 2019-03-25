<?php
// Resend Email
add_action('wp_ajax_sb_resend_email', 'nokri_resend_email');
add_action( 'wp_ajax_nopriv_sb_resend_email', 'nokri_resend_email' );
function nokri_resend_email()
{
 $email = $_POST['usr_email'];
 $user = get_user_by( 'email', $email );
 if( get_user_meta($user->ID, 'sb_resent_email', true) != 'yes' )
 {
  
  nokri_email_on_new_user($user->ID, '', false);
  update_user_meta($user->ID, 'sb_resent_email', 'yes');
 }
 die();
}

/* Employer Sending Email*/

if ( ! function_exists( 'nokri_employer_status_email' ) )
 {
	function nokri_employer_status_email($job_id,$candidate_id,$subject,$body)
	{
		global $nokri;
	   // Auhtor info
	   $author_id           =  get_post_field( 'post_author', $job_id );
	   $author_id    		=  get_userdata( $author_id );
	   $author_name  		=  $author_id->display_name;
	   $author_email 		=  $author_id->user_email;
	   $author_job_title 	=  get_the_title($job_id);
	   // Candidate  info
	   $candidate_id    	 =  get_userdata( $candidate_id );
	   $candidate_name       =  $candidate_id->display_name;
	   $candidate_email 	 =  $candidate_id->user_email;
	   $subject       		 =  $subject;
	   $from         		 =  $nokri['sb_job_status_message_from'];
	   $headers              = array('Content-Type: text/html; charset=UTF-8' );
	  
	   wp_mail( $candidate_email, $subject, $body, $headers );
	
	 }
 }
 
 
// contact me function
function nokri_contact_me_email($reciver_id,$sender_email,$sender_name,$subject_form,$message)
{
 global $nokri;
  if( isset( $nokri['sb_new_cotact_message'] ) &&  $nokri['sb_new_cotact_message'] != "" && isset( $nokri['sb_new_cotact_from'] ) && $nokri['sb_new_cotact_from'] != "" )
  {
	 
	// receiver info
   $reciver_id   =  get_userdata( $reciver_id );
   $reciver_name =  $reciver_id->display_name;
   $reciver_email = $reciver_id->user_email;
    
   // sender info
   $sender_email   = $sender_email;
   $subject       = $nokri['sb_new_cotact_message'];
   $from         = $nokri['sb_new_cotact_from'];
   $headers      = array('Content-Type: text/html; charset=UTF-8',"From: $from" );
   
   $msg_keywords  = array('%site_name%', '%display_name%', '%email%','%subject%','%message%');
   
   
   $msg_replaces  = array(get_bloginfo( 'name' ),$sender_name,$sender_email,$subject_form, $message );
   
   $body = str_replace($msg_keywords, $msg_replaces, $nokri['sb_new_cotact_body']);
   
   wp_mail( $reciver_email, $subject, $body, $headers );
  }
  

 
}
 
 
// New job applier function
function nokri_new_candidate_apply($job_id,$candidate_id)
{
 global $nokri;
  if( isset( $nokri['sb_msg_on_new_apply'] ) &&  $nokri['sb_msg_on_new_apply'] != "" && isset( $nokri['sb_msg_from_on_new_apply'] ) && $nokri['sb_msg_from_on_new_apply'] != "" )
  {
	 
	// Auhtor info
   $author_id           =  get_post_field( 'post_author', $job_id );
   $author_id    		=  get_userdata( $author_id );
   $author_name  		=  $author_id->display_name;
   $author_email 		=  $author_id->user_email;
   $author_job_title 	=  get_the_title($job_id);
   
  
   
   // Candidate  info
   $candidate_id    	=  get_userdata( $candidate_id );
   $candidate_name       =  $candidate_id->display_name;
  
   $subject       = $nokri['sb_msg_subject_on_new_apply'];
   $from         = $nokri['sb_msg_from_on_new_apply'];
   $headers      = array('Content-Type: text/html; charset=UTF-8',"From: $from" );
   
   $msg_keywords  = array('%site_name%', '%job_title%', '%candidate_name%','%message%');
   
   $msg_replaces  = array(get_bloginfo( 'name' ),$author_job_title,$candidate_name);
  
    $body = str_replace($msg_keywords, $msg_replaces, $nokri['sb_msg_on_new_apply']);
  

   wp_mail( $author_email, $subject, $body, $headers );
  }
  

 
} 
 
 
 
 
 
 
 
 

// Email on new User
function nokri_email_on_new_user($user_id, $social = '', $admin_email = true)
{
 global $nokri;
 
 if( isset( $nokri['sb_new_user_email_to_admin'] ) && $nokri['sb_new_user_email_to_admin'] && $admin_email )
 {
  if( isset( $nokri['sb_new_user_admin_message_admin'] ) &&  $nokri['sb_new_user_admin_message_admin'] != "" && isset( $nokri['sb_new_user_admin_message_from_admin'] ) && $nokri['sb_new_user_admin_message_from_admin'] != "" )
  {
   $to = get_option( 'admin_email' );
   $subject = $nokri['sb_new_user_admin_message_subject_admin'];
   $from = $nokri['sb_new_user_admin_message_from_admin'];
   $headers = array('Content-Type: text/html; charset=UTF-8',"From: $from" );
   
   // User info
   $user_info = get_userdata( $user_id );
   $msg_keywords  = array('%site_name%', '%display_name%', '%email%');
   $msg_replaces  = array(get_bloginfo( 'name' ), $user_info->display_name, $user_info->user_email );
   
   $body = str_replace($msg_keywords, $msg_replaces, $nokri['sb_new_user_admin_message_admin']);
   wp_mail( $to, $subject, $body, $headers );
  }
  
 }
 
 
 
 if( isset( $nokri['sb_new_user_email_to_user'] ) && $nokri['sb_new_user_email_to_user'] )
 {
	 
  if( isset( $nokri['sb_new_user_message'] ) &&  $nokri['sb_new_user_message'] != "" && isset( $nokri['sb_new_user_message_from'] ) && $nokri['sb_new_user_message_from'] != "" )
  {
   // User info
   $user_info = get_userdata( $user_id );
   $to = $user_info->user_email;
   $subject = $nokri['sb_new_user_message_subject'];
   $from = $nokri['sb_new_user_message_from'];
   $headers = array('Content-Type: text/html; charset=UTF-8',"From: $from" );
   $user_name = $user_info->user_email;
   if( $social != '' )
    $user_name .= "(Password: $social )";
	
   $verification_link = '';
   if( isset( $nokri['sb_new_user_email_verification'] ) && $nokri['sb_new_user_email_verification'] && $social == "" )
   {
    $token = get_user_meta($user_id, 'sb_email_verification_token', true);
    if( $token == "" )
    {
     $token  =  nokri_randomString(50);
    }
    $verification_link = trailingslashit( get_home_url()) . '?verification_key=' . $token . '-sb-uid-'. $user_id;

    update_user_meta($user_id, 'sb_email_verification_token', $token);
   }
	
   $msg_keywords  = array('%site_name%', '%user_name%', '%display_name%','%verification_link%');
   $msg_replaces  = array(get_bloginfo( 'name' ), $user_name, $user_info->display_name ,$verification_link);
   $body = str_replace($msg_keywords, $msg_replaces, $nokri['sb_new_user_message']);
   wp_mail( $to, $subject, $body, $headers );
  }
 }
 
}

// Ajax handler for Forgot Password
add_action( 'wp_ajax_sb_forgot_password', 'nokri_forgot_password' );
add_action( 'wp_ajax_nopriv_sb_forgot_password', 'nokri_forgot_password' );
// Forgot Password
function nokri_forgot_password()
{
	global $nokri;
	// Getting values
	$params = array();
    parse_str($_POST['sb_data'], $params);
	$email	=	$params['sb_forgot_email'];
	if( email_exists( $email ) == true )
	{
	// lets generate our new password
		$random_password = wp_generate_password( 12, false );
		
		
			$to = $email;
			
			$subject = __( 'Your new password', 'redux-framework' );
			
			$body = __( 'Your new password is: ', 'redux-framework' ) .$random_password;
			
		    $from	=	get_bloginfo( 'name' );	
			
		if( isset( $nokri['sb_forgot_password_from'] ) && $nokri['sb_forgot_password_from'] != "" )
		{
			$from	=	$nokri['sb_forgot_password_from'];
		}
		
		$headers = array('Content-Type: text/html; charset=UTF-8',"From: $from" );
		if( isset( $nokri['sb_forgot_password_message'] ) &&  $nokri['sb_forgot_password_message'] != "" )
		{
			$subject_keywords  = array('%site_name%');
			$subject_replaces  = array(get_bloginfo( 'name' ));
			
			$subject = str_replace($subject_keywords, $subject_replaces, $nokri['sb_forgot_password_subject']);

		   $token  =  nokri_randomString(50);
		   $user = get_user_by( 'email', $email );
		   $msg_keywords  = array('%site_name%', '%user%', '%reset_link%');
		   $reset_link = trailingslashit( get_home_url() ) . '?token=' . $token . '-sb-uid-'. $user->ID;
		   $msg_replaces  = array(get_bloginfo( 'name' ),  $user->display_name, $reset_link );
           $body = str_replace($msg_keywords, $msg_replaces, $nokri['sb_forgot_password_message']);

		}

			
			$mail = wp_mail( $to, $subject, $body, $headers );
			if( $mail )
			{
				// Get user data by field and data, other field are ID, slug, slug and login
				 update_user_meta($user->ID, 'sb_password_forget_token', $token);
   				 echo "1";
			}
			else
			{
				echo __( 'Email server not responding', 'redux-framework' );	
			}
				
	}
	else
	{
		echo __( 'Email is not resgistered with us.', 'redux-framework' );	
	}
	die();
}

// Email on Job Post

function nokri_get_notify_on_ad_post($pid)
{
	global $nokri;
	if( isset( $nokri['sb_send_email_on_ad_post'] ) && $nokri['sb_send_email_on_ad_post'] )
	{
		$to = $nokri['ad_post_email_value'];
		$subject = __('New Job', 'redux-framework') . '-' . get_bloginfo( 'name' );
		$body = '<html><body><p>'.__('Got new ad','redux-framework'). ' <a href="'.get_edit_post_link($pid).'">' . get_the_title($pid) .'</a></p></body></html>';
		$from	=	get_bloginfo( 'name' );
		if( isset( $nokri['sb_msg_from_on_new_ad'] ) && $nokri['sb_msg_from_on_new_ad'] != "" )
		{
			$from	=	$nokri['sb_msg_from_on_new_ad'];
		}
			$headers = array('Content-Type: text/html; charset=UTF-8',"From: $from" );
		if( isset( $nokri['sb_msg_on_new_ad'] ) &&  $nokri['sb_msg_on_new_ad'] != "" )
		{
			
			$author_id = get_post_field ('post_author', $pid);
			$user_info = get_userdata($author_id);
			
			$subject_keywords  = array('%site_name%', '%job_owner%', '%job_title%');
			$subject_replaces  = array(get_bloginfo( 'name' ), $user_info->display_name, get_the_title($pid));
			
			$subject = str_replace($subject_keywords, $subject_replaces, $nokri['sb_msg_subject_on_new_ad']);

			$msg_keywords  = array('%site_name%', '%job_owner%', '%job_title%', '%job_link%');
			$msg_replaces  = array(get_bloginfo( 'name' ), $user_info->display_name, get_the_title($pid), get_edit_post_link($pid) );
			
			$body = str_replace($msg_keywords, $msg_replaces, $nokri['sb_msg_on_new_ad']);

		}
				 wp_mail( $to, $subject, $body, $headers );
	}
}

if( ! function_exists( 'nokri_base64Encode' ) )
{
	function nokri_base64Encode($json){
		return base64_encode($json);

	}
}
if( ! function_exists( 'nokri_base64Decode' ) )
{
	function nokri_base64Decode($json){
		return base64_decode($json);

	}
}
if( ! function_exists( 'nokri_downloadfiles_option' ) )
{
	function nokri_downloadfiles_option($theFile = '')
	{
	if( ! $theFile ) {
		return;
	  }
	  //clean the fileurl
	  $file_url  = stripslashes( trim( $theFile ) );
	  //get filename
	  $file_name = basename( $theFile );
	  //get fileextension
	 
	  $file_extension = pathinfo($file_name);
	  //security check
	  $fileName = strtolower($file_url);
	  
	  $whitelist =  array('txt', 'pdf', 'doc', 'docx') ;
	  
	  if(!in_array(end(explode('.', $fileName)), $whitelist))
	  {
		  exit('Invalid file!');
	  }
	  if(strpos( $file_url , '.php' ) == true)
	  {
		  die("Invalid file!");
	  }
	 
		$file_new_name = $file_name;
	  $content_type = "";
	  //check filetype
	  switch( $file_extension['extension'] ) {
			case "txt": 
			  $content_type="file/txt"; 
			  break;
			case "pdf": 
			  $content_type="file/pdf"; 
			  break;
			case "doc": 
			  $content_type="file/doc"; 
			  break;
			case "docx":
			case "docx": 
			  $content_type="file/docx"; 
			  break;
			default: 
			  $content_type="application/force-download";
	  }
	  
	  $content_type = apply_filters( "ibenic_content_type", $content_type, $file_extension['extension'] );
	  
	  header("Expires: 0");
	  header("Cache-Control: no-cache, no-store, must-revalidate"); 
	  header('Cache-Control: pre-check=0, post-check=0, max-age=0', false); 
	  header("Pragma: no-cache");	
	  header("Content-type: {$content_type}");
	  header("Content-Disposition:attachment; filename={$file_new_name}");
	  header("Content-Type: application/force-download");
	   
	  readfile("{$file_url}");
	 
		
	}
}


// Ajax handler for newsletter
add_action( 'wp_ajax_sb_mailchimp_subcribe', 'nokri_mailchimp_subcribe' );
add_action( 'wp_ajax_nopriv_sb_mailchimp_subcribe', 'nokri_mailchimp_subcribe' );
// Addind Subcriber into Mailchimp
function nokri_mailchimp_subcribe ()
{
	global $nokri;
	    $listid     =   $nokri['mailchimp_api_list_id'];
		$sb_action	=	$_POST['sb_action'];
	
		$apiKey	=	$nokri['mailchimp_api_key'];
	
		// Getting value from form
		$email	=	$_POST['sb_email'];
		$fname	=	'';
		$lname	=	'';
		
        // MailChimp API URL
        $memberID = md5(strtolower($email));
        $dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
        $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listid . '/members/' . $memberID;
        
        // member information
        $json = json_encode(array(
            'email_address' => $email,
            'status'        => 'subscribed',
            'merge_fields'  => array(
                'FNAME'     => $fname,
                'LNAME'     => $lname
            )
        ));
        
        // send a HTTP POST request with curl
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        // store the status message based on response code
       $mcdata=json_decode($result);
	  if (!empty($mcdata->error))
	  {
	   echo 0;
	  }
	  else
	  {
	   echo 1;
	  }
		die();
}

// Free packgae function
if ( ! function_exists( 'nokri_free_package' ) ) {
function nokri_free_package( $product_id )
{
	global $nokri;
	$uid	          =	  get_current_user_id();
	$cand_is_search	  =	  (int)get_post_meta( $product_id, 'is_candidates_search', true );
	$cand_search_val  =	  (int)get_post_meta( $product_id, 'candidate_search_values', true );
	$c_terms = get_terms('job_class', array('hide_empty' => false , 'orderby'=> 'id', 'order' => 'ASC' ));
		 if( count( $c_terms ) > 0 )
		 { 
			foreach( $c_terms as $c_term)
			{		
				$meta_name = '';
				$meta_name  		=   'package_job_class_'.$c_term->term_id;
				$class	            =	(int)get_post_meta( $product_id, $meta_name, true );
				if( $class == '-1' )
				{
					update_user_meta( $uid, $meta_name, (int)'-1' );
				}
				else if( is_numeric( $class ) &&  $class > 0 )
				{
					$no_of_jobs	=	get_user_meta( $uid, $meta_name, true );
					$new_jobs	=	$class + $no_of_jobs;
					update_user_meta( $uid, $meta_name, (int)$new_jobs );
				}
				else
				{
					update_user_meta( $uid, $meta_name, (int)'0' );	
				}				
			}
		 }
		 
		// Expiry date logic
		$days	=	get_post_meta( $product_id, 'package_expiry_days', true );
		if( $days == '-1' )
		{
			update_user_meta( $uid, '_sb_expire_ads', '-1' );
		}
		else
		{
			    $expiry_date	=	get_user_meta( $uid, '_sb_expire_ads', true );
				$e_date	        =	strtotime( $expiry_date );	
				$today	        =	strtotime( date( 'Y-m-d') );
				if( $expiry_date && $today > $e_date )
				{
					$new_expiry	=	date('Y-m-d', strtotime("+$days days"));
				}
				else
				{
					$date	=	date_create( $expiry_date );
					date_add($date,date_interval_create_from_date_string("$days days"));
					$new_expiry	=	 date_format($date,"Y-m-d");
					
				}
				
			update_user_meta( $uid, '_sb_expire_ads', $new_expiry );
			/* Updating candidate search */
			if((isset($nokri['cand_search_mode'])) && $nokri['cand_search_mode']  == '2' )
			{
				/* Counting existing values */
				if( $cand_search_val == '-1' )
				{
					update_user_meta( $uid, '_sb_cand_search_value', (int)'-1' );
				}
				else if( is_numeric( $cand_search_val ) &&  $cand_search_val > 0 )
				{
					$no_of_search	    =	get_user_meta( $uid, '_sb_cand_search_value', $cand_is_search );
					$new_searches	    =	$cand_search_val + $no_of_search;
					update_user_meta( $uid, '_sb_cand_search_value', (int)$new_searches );
				}
				else
				{
					update_user_meta( $uid,  '_sb_cand_search_value', (int)'0' );	
				}	
				update_user_meta( $uid, '_sb_cand_is_search', $cand_is_search );
			}
			
		}
}
}

// After Successfull payment
add_action( 'woocommerce_order_status_completed', 'nokri_after_payment' );
if ( ! function_exists( 'nokri_after_payment' ) ) 
{
	function nokri_after_payment( $order_id )
	{
		global $nokri;
		global $woocommerce;
		$order 	= new WC_Order( $order_id );	
		$uid    = get_post_meta( $order_id, '_customer_user', true );
		$c_terms = get_terms('job_class', array('hide_empty' => false , 'orderby'=> 'id', 'order' => 'ASC' ));
		$items = $order->get_items();
		foreach ( $items as $item )
		{
			  $product_id = $item['product_id'];
			  $cand_is_search	  =	  (int)get_post_meta( $product_id, 'is_candidates_search', true );
	    	  $cand_search_val    =	  (int)get_post_meta( $product_id, 'candidate_search_values', true );
			 if( count((array)  $c_terms ) > 0 )
			 { 
				foreach( $c_terms as $c_term)
				{		
					$meta_name 			= '';
					$meta_name  		=  'package_job_class_'.$c_term->term_id;
					$class				=	(int)get_post_meta( $product_id, $meta_name, true );
					if( $class == '-1' )
					{
						update_user_meta( $uid, $meta_name, (int)'-1' );
					}
					else if( is_numeric( $class ) &&  $class > 0 )
					{
						$no_of_jobs	=	get_user_meta( $uid, $meta_name, true );
						$new_jobs	=	$class + (int)( $no_of_jobs);
						update_user_meta( $uid, $meta_name, (int)$new_jobs );
					}
					else
					{
						update_user_meta( $uid, $meta_name, (int)'0' );	
					}				
				}
			 }
			 
			// Expiry date logic
			$days	=	get_post_meta( $product_id, 'package_expiry_days', true );
			if( $days == '-1' )
			{
				update_user_meta( $uid, '_sb_expire_ads', '-1' );
			}
			else
			{
				$expiry_date	=	get_user_meta( $uid, '_sb_expire_ads', true );
				$e_date	=	strtotime( $expiry_date );	
				$today	=	strtotime( date( 'Y-m-d') );
				if($expiry_date && $today > $e_date )
				{
					$new_expiry	=	date('Y-m-d', strtotime("+$days days"));
				}
				else
				{
					$date	=	date_create( $expiry_date );
					date_add($date,date_interval_create_from_date_string("$days days"));
					$new_expiry	=	 date_format($date,"Y-m-d");
				}
				update_user_meta( $uid, '_sb_expire_ads', $new_expiry );
				/* Updating candidate search */
				if((isset($nokri['cand_search_mode'])) && $nokri['cand_search_mode']  == '2' )
				{
					/* Counting existing values */
					if( $cand_search_val == '-1' )
					{
						update_user_meta( $uid, '_sb_cand_search_value', (int)'-1' );
					}
					else if( is_numeric( $cand_search_val ) &&  $cand_search_val > 0 )
					{
						$no_of_search	    =	get_user_meta( $uid, '_sb_cand_search_value', true );
						$new_searches	    =	$cand_search_val + (int)$no_of_search;
						update_user_meta( $uid, '_sb_cand_search_value', (int)$new_searches );
					}
					else
					{
						update_user_meta( $uid,  '_sb_cand_search_value', (int)'0' );	
					}	
					update_user_meta( $uid, '_sb_cand_is_search', $cand_is_search );
				}
				
			}
		}
	}
}
// Linkedin handling
if ( ! function_exists( 'nokri_linked_handling' ) ) 
{
	function nokri_linked_handling($code)
	{
		global $nokri;
		
		$client_id =  ($nokri['linkedin_api_key']);
		$client_secret =  ($nokri['linkedin_api_secret']);
		$redirect_uri =  ($nokri['redirect_uri']);
		//$api_cal       =  'https://api.linkedin.com/v1/people/~';
		$api_cal = "https://api.linkedin.com/v1/people/~:(email-address,first-name,last-name,headline,summary,public-profile-url)";
		
		if($code != "" ){
		 $ch = curl_init();
		 curl_setopt($ch, CURLOPT_URL,"https://www.linkedin.com/oauth/v2/accessToken");
		 curl_setopt($ch, CURLOPT_POST, 0);
		 curl_setopt($ch, CURLOPT_POSTFIELDS,"grant_type=authorization_code&code=".$code."&redirect_uri=$redirect_uri&client_id=$client_id&client_secret=$client_secret");
		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		 $server_output = curl_exec ($ch);
		 curl_close ($ch);
		}
		
		if(isset($code) && isset(json_decode($server_output)->access_token) && json_decode($server_output)->access_token != ''){
		
			 $ch = curl_init();
			 curl_setopt($ch, CURLOPT_URL,"$api_cal?oauth2_access_token=".json_decode($server_output)->access_token."&format=json");
			 curl_setopt($ch, CURLOPT_POST, 0);
			 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			 $server_output2 = curl_exec ($ch);
			 curl_close ($ch);
			 return $server_output2;
		}
	}	
}

/* ========================= */
/* Remove Empty P From Content */
/* ========================= */
if ( ! function_exists( 'nokri_remove_empty_p' ) )
{	
	function nokri_remove_empty_p( $content ) {
    $content = force_balance_tags( $content );
    $content = preg_replace( '#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content );
    $content = preg_replace( '~\s?<p>(\s|&nbsp;)+</p>\s?~', '', $content );
    return $content;
}
}
add_filter('the_content', 'nokri_remove_empty_p', 20, 1);

/* ------------------------------------------------ */
/* // Remove notices in Redux */
/* ------------------------------------------------ */
 add_action('init', 'nokri_removeDemoModeLink');
 function nokri_removeDemoModeLink() { // Be sure to rename this function to something more unique
	if ( class_exists('ReduxFrameworkPlugin') ) {
		remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
	}
	if ( class_exists('ReduxFrameworkPlugin') ) {
		remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
	}
	
	
												}
/* Hide admin bar*/
add_action( 'after_setup_theme', 'nokri_hide_adminbar' );
if ( ! function_exists( 'nokri_hide_adminbar' ) )
{
	function nokri_hide_adminbar()
	{
		if ( is_user_logged_in() && !is_admin() &&  !( defined( 'DOING_AJAX' ) && DOING_AJAX ) )
		{
			$user = wp_get_current_user();
			if (in_array('subscriber',$user->roles))
			{
				// user has subscriber role
				show_admin_bar(false);
			}		
		}
	}
}




/*For Demo Data Settings Starts*/
// Ajax handler for add to cart
add_action( 'wp_ajax_demo_data_start', 'nokri_before_install_demo_data' );
// Addind Subcriber into Mailchimp
function nokri_before_install_demo_data()
{
	if( get_option( 'nokri_fresh_installation' ) != 'no' )
	{
		update_option( 'nokri_fresh_installation', $_POST['is_fresh'] );
	}
	die();
}


// Importing data
function nokri_importing_data($demo_type)
{

	global $wpdb;
	$sql_file_OR_content;
	if( $demo_type == 'Demo' )
	{
		$sql_file_OR_content	=	SB_PLUGIN_PATH . 'sql/demo-eng.sql';
	}
	else if($demo_type == 'Arabic')
	{
		$sql_file_OR_content	=	SB_PLUGIN_PATH . 'sql/demo-ar.sql';
	}
	else if($demo_type == 'Hindi')
	{
		$sql_file_OR_content	=	SB_PLUGIN_PATH . 'sql/demo-hin.sql';
	}
		
		
		
		
		
	$SQL_CONTENT = (strlen($sql_file_OR_content) > 300 ?  $sql_file_OR_content : file_get_contents($sql_file_OR_content)  );  
	
	
	
	
	$allLines = explode("\n",$SQL_CONTENT); 
	$zzzzzz = $wpdb->query('SET foreign_key_checks = 0');
	preg_match_all("/\nCREATE TABLE(.*?)\`(.*?)\`/si", "\n". $SQL_CONTENT, $target_tables);
	foreach ($target_tables[2] as $table)
	{
		$wpdb->query('DROP TABLE IF EXISTS '.$table);
	}
	$zzzzzz = $wpdb->query('SET foreign_key_checks = 1');
	//$wpdb->query("SET NAMES 'utf8'");	
	$templine = '';	// Temporary variable, used to store current query
	foreach ($allLines as $line)
	{		
		// Loop through each line
		if (substr($line, 0, 2) != '--' && $line != '')
		{
			$templine .= $line; 	// (if it is not a comment..) Add this line to the current segment
			if (substr(trim($line), -1, 1) == ';')
			{		// If it has a semicolon at the end, it's the end of the query
				if( $wpdb->prefix != 'wp_' )
				{
					$templine = str_replace("`wp_", "`$wpdb->prefix", $templine);
				}
				if(!$wpdb->query($templine))
				{ 
					//print('Error performing query \'<strong>' . $templine . '\': ' . $wpdb->error . '<br /><br />');
				}  
				$templine = ''; // set variable to empty, to start picking up the lines after ";"
			}
		}
	}	
	//return 'Importing finished. Now, Delete the import file.';
}

/*For Demo Data Settings ends */



/************************/
/*User type information*/
/**********************/
function new_user_type( $contactmethods ) {
    $contactmethods['user_type'] =  __('User Type','redux-framework' );
    return $contactmethods;
}
add_filter( 'new_user_type', 'new_user_type', 10, 1 );


function new_modify_user_table( $column ) {
    $column['user_type'] = __('User Type','redux-framework' );
    return $column;
}
add_filter( 'manage_users_columns', 'new_modify_user_table' );

function new_modify_user_table_row( $val, $column_name, $user_id ) {
    switch ($column_name) {
        case 'user_type' :
			$user_tpye_info = __('Candidate','redux-framework' );
			if(get_user_meta( $user_id, '_sb_reg_type', true ) == 1)
			{
				$user_tpye_info = __('Employer','redux-framework' );
			}
            return $user_tpye_info;
            break;
        default:
    }
    return $val;
}
add_filter( 'manage_users_custom_column', 'new_modify_user_table_row', 10, 3 );