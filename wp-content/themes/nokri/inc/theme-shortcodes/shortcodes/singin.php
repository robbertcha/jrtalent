<?php
/* ------------------------------------------------ */
/* Singn In */
/* ------------------------------------------------ */

function singnin_short()
{
	vc_map(array(
		"name" => esc_html__("Sign In", 'nokri') ,
		"base" => "signin_short_base",
		"category" => esc_html__("Theme Shortcodes", 'nokri') ,
		"params" => array(

			nokri_generate_type( esc_html__('Terms & Conditions', 'nokri' ), 'vc_link', 'terms_link' ),
			nokri_generate_type( esc_html__('Terms & Condition Title', 'nokri' ), 'textfield', 'terms_title' ),
			
			nokri_generate_type( esc_html__('Capcha Code', 'nokri' ), 'dropdown', 'is_captcha', esc_html__( "Captcha is for stop spamming", 'nokri' ), "", array( "Please select" => "", "With Capcha" => "with", "Without Capcha" => "without") ),

		) ,
	));
	
	vc_map(array(
		"name" => esc_html__("Sign In", 'nokri') ,
		"base" => "signin_short_base",
		"category" => esc_html__("Theme Shortcodes", 'nokri') ,
		"params" => array(
		array(
		   'group' => esc_html__( 'Shortcode Output', 'nokri' ),  
		   'type' => 'custom_markup',
		   'heading' => esc_html__( 'Shortcode Output', 'nokri' ),
		   'param_name' => 'order_field_key',
		   'description' => nokri_VCImage('nokri_sign_in.png') . esc_html__( 'Ouput of the shortcode will be look like this.', 'nokri' ),
		  ),
		  array(
		"group" => esc_html__("Basic", "nokri"),
		"type" => "textfield",
		"holder" => "div",
		"class" => "",
		"heading" => esc_html__( "Main heading", 'nokri' ),
		"param_name" => "basic_heading",
		),
		array(
		"group" => esc_html__("Basic", "nokri"),
		"type" => "textarea",
		"holder" => "div",
		"class" => "",
		"heading" => esc_html__( "Some Details", 'nokri' ),
		"param_name" => "basic_details",
		),
		array(
		"group" => esc_html__("Basic", "nokri"),
		"type" => "attach_image",
		"holder" => "div",
		"class" => "",
		"heading" => esc_html__( "Image", 'nokri' ),
		"param_name" => "basic_bg_img",
		"description" => esc_html__('263x394', 'nokri'),
		),
		array(
		"group" => esc_html__("Field Names", "nokri"),
		"type" => "textfield",
		"holder" => "div",
		"class" => "",
		"heading" => esc_html__( "Page heading", 'nokri' ),
		"param_name" => "page_heading",
		),
		array(
		"group" => esc_html__("Field Names", "nokri"),
		"type" => "textfield",
		"holder" => "div",
		"class" => "",
		"heading" => esc_html__( "Email address", 'nokri' ),
		"param_name" => "user_email",
		),
		array(
		"group" => esc_html__("Field Names", "nokri"),
		"type" => "textfield",
		"holder" => "div",
		"class" => "",
		"heading" => esc_html__( "Password Text", 'nokri' ),
		"param_name" => "user_password",
		),
		array(
		"group" => esc_html__("Field Names", "nokri"),
		"type" => "textfield",
		"holder" => "div",
		"class" => "",
		"heading" => esc_html__( "Forgot Password Text", 'nokri' ),
		"param_name" => "forgot_password",
		),
		array(
		"group" => esc_html__("Field Names", "nokri"),
		"type" => "textfield",
		"holder" => "div",
		"class" => "",
		"heading" => esc_html__( "Button Text", 'nokri' ),
		"param_name" => "submit_button",
		),
		array(
		"group" => esc_html__("Field Names", "nokri"),
		"type" => "textfield",
		"holder" => "div",
		"class" => "",
		"heading" => esc_html__( "Already acount text", 'nokri' ),
		"param_name" => "already_acount",
		),
		array(
		"group" => esc_html__("Field Names", "nokri"),
		"type" => "textfield",
		"holder" => "div",
		"class" => "",
		"heading" => esc_html__( "Signup text", 'nokri' ),
		"param_name" => "signup_text",
		),
		/* Social options*/
		array(
		"group" => esc_html__("Social texts", "nokri"),
		"type" => "textfield",
		"holder" => "div",
		"class" => "",
		"heading" => esc_html__( "Heading", 'nokri' ),
		"param_name" => "social_heading",
		),
		array(
		"group" => esc_html__("Social texts", "nokri"),
		"type" => "textfield",
		"holder" => "div",
		"class" => "",
		"heading" => esc_html__( "Details", 'nokri' ),
		"param_name" => "social_details",
		),
		array(
		"group" => esc_html__("Social texts", "nokri"),
		"type" => "textfield",
		"holder" => "div",
		"class" => "",
		"heading" => esc_html__( "Facebook text", 'nokri' ),
		"param_name" => "social_fb",
		),
		array(
		"group" => esc_html__("Social texts", "nokri"),
		"type" => "textfield",
		"holder" => "div",
		"class" => "",
		"heading" => esc_html__( "Gmail text", 'nokri' ),
		"param_name" => "social_gmail",
		),
		array(
		"group" => esc_html__("Social texts", "nokri"),
		"type" => "textfield",
		"holder" => "div",
		"class" => "",
		"heading" => esc_html__( "Linkddin text", 'nokri' ),
		"param_name" => "social_linked",
		),
	),
	));
}

add_action('vc_before_init', 'singnin_short');

function signin_short_base_func($atts, $content = '')
{
	extract(shortcode_atts(array(
		'order_field_key' => '',
		'basic_heading' => '',
		'basic_details' => '',
		'basic_bg_img' => '',
		'page_heading'    => '',
		'user_email'      => '', 
		'submit_button'   => '',
		'user_password'   => '',
		'forgot_password' => '',
		'already_acount'  => '',
		'social_heading'  => '',
		'social_details'  => '',
		'signup_text'     => '',
		'social_fb'       => '',
		'social_gmail'    => '',
		'social_linked'   => '',
	) , $atts));
/*Main heading*/
$basic_heading = (isset($basic_heading) && $basic_heading != "") ? '<h1>'.$basic_heading.'</h1>' : "";
/*Main details*/
$basic_details = (isset($basic_details) && $basic_details != "") ? '<p>'.$basic_details.'</p>' : "";
/*Section heading*/
$page_heading = (isset($page_heading) && $page_heading != "") ? '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="post-job-heading"><h3>'.$page_heading.'</h3></div></div>' : "";
/*Social heading*/
$social_heading = (isset($social_heading) && $social_heading != "") ? '<div class="post-job-heading"><h3>'.$social_heading.'</h3></div>' : "";
/*Social details*/
$social_details = (isset($social_details) && $social_details != "") ? '<div class="form-group"><p>'.$social_details.'</p></div>': "";
/*already acount*/
$already_acount = (isset($already_acount) && $already_acount != "") ? $already_acount : "";
/*signup*/
$signup_text = (isset($signup_text) && $signup_text != "") ? $signup_text : "";
/*submit button*/
$submit_button = (isset($submit_button) && $submit_button != "") ? $submit_button : "";
/*submit button*/
$forgot_password = (isset($forgot_password) && $forgot_password != "") ? $forgot_password : "";

/*fb button*/
$social_fb = (isset($social_fb) && $social_fb != "") ? $social_fb : "";
/*gmail button*/
$social_gmail = (isset($social_gmail) && $social_gmail != "") ? $social_gmail : "";
/*linkedin button*/
$social_linked = (isset($social_linked) && $social_linked != "") ? $social_linked : "";


global $nokri;
$social_login	=	'';
if( isset($nokri['fb_api_key']) && $nokri['fb_api_key'] != "" )
{ 
	   $social_login	.=  '<div class="form-group"><a href="javascript:void(0)" class="btn-facebook btn-block btn-social"  onclick="hello(\'facebook\').login('. "{scope : 'email',}".')"><i class="ti-facebook"></i><span>'.($social_fb).'</span></a></div> ';                     
}
if( isset($nokri['gmail_api_key']) && $nokri['gmail_api_key'] != "" )
{
	   $social_login	.=  '<div class="form-group"><a href="javascript:void(0)" class="btn-google btn-block btn-social"  onclick="hello(\'google\').login('. "{scope : 'email',}".')"><img src="'.get_template_directory_uri().'/images/g-logo.png" class="img-resposive" alt="Google logo"><span>'.($social_gmail).'</span></a></div>';                         
}
		
/* Linkedin key*/
$linkedin_api_key = '';
if((isset($nokri['linkedin_api_key'])) && $nokri['linkedin_api_key']  != '' && (isset($nokri['linkedin_api_secret'])) && $nokri['linkedin_api_secret']  != '' && (isset($nokri['redirect_uri'])) && $nokri['redirect_uri']  != '' )
{
	$linkedin_api_key =  ($nokri['linkedin_api_key']);
	$linkedin_secret_key =  ($nokri['linkedin_api_secret']);
	$redirect_uri =  ($nokri['redirect_uri']);
	$linkedin_url = 'https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id='.$linkedin_api_key.'&redirect_uri='.$redirect_uri.'&state=popup&scope=r_emailaddress r_basicprofile';
    $social_login	.=   '<div class="form-group"><a href="'.esc_url( $linkedin_url ).'" class="btn-linkedIn btn-block"><i class="ti-linkedin"></i><span>'.($social_linked).'</span></a></div>';
}
		
$authentication		  =	new authentication();
$code           	  = time();
$_SESSION['sb_nonce'] = $code;

/* Background Image */
$bg_img = '';
if( $basic_bg_img != "" )
{
$bgImageURL	=	nokri_returnImgSrc( $basic_bg_img );
$bg_img = ( $bgImageURL != "" ) ? ' \\s\\t\\y\\l\\e="background: rgba(0, 0, 0, 0.6) url('.$bgImageURL.') 0 0 no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; background-position: center center; background-attachment:scroll;"' : "";
}

return '<section class="n-pages-breadcrumb" '.str_replace('\\',"",$bg_img).'>
     <div class="container">
        <div class="row">
           <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-2">
              <div class="n-breadcrumb-info">
                '.($basic_heading.$basic_details).'
              </div>
           </div>
        </div>
     </div>
</section>
<section class="n-job-pages-section">
         <div class="container">
            <div class="row">
               <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 col-md-offset-1 col-lg-offset-1">
                  <div class="row">
                     <div class="n-job-pages">
                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                           <div class="row">
                              <div class="n-page-left-side">
							  '.($page_heading).'
							   '.$authentication->nokri_sign_in_form($code,$already_acount,$signup_text,$submit_button,$forgot_password).'
							   </div>
                           </div>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 nopadding">
                           <div class="n-page-right-side">
                              '.($social_heading.$social_details).'
							  <div class="social-buttons">
							  '.($social_login).'
                              </div>
							  </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
		<!-- Forget Password -->
      <div class="custom-modal">
         <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
               <!-- Modal content-->
               <div class="modal-content">
			   <div class="cp-spinner cp-skeleton"></div>
                  <div class="modal-header rte">
                     <h2 class="modal-title">'.  esc_html__( 'Forgot Your Password ?','nokri' ).'</h2>
                  </div>
					'.$authentication->nokri_forgot_password_form().'
               </div>
            </div>
         </div>
      </div>';
}
if (function_exists('nokri_add_code'))
{
	nokri_add_code('signin_short_base', 'signin_short_base_func');
}