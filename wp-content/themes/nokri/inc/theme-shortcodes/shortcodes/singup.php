<?php
/* ------------------------------------------------ */
/* Singn Up */
/* ------------------------------------------------ */

function singnup_short()
{
	
	vc_map(array(
		"name" => esc_html__("Signup", 'nokri') ,
		"base" => "admin_choice_short_base",
		"category" => esc_html__("Theme Shortcodes", 'nokri') ,
		"params" => array(
		array(
		   'group' => esc_html__( 'Shortcode Output', 'nokri' ),  
		   'type' => 'custom_markup',
		   'heading' => esc_html__( 'Shortcode Output', 'nokri' ),
		   'param_name' => 'order_field_key',
		    'description' => nokri_VCImage('nokri_sign_up.png') . esc_html__( 'Ouput of the shortcode will be look like this.', 'nokri' ),
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
		"heading" => esc_html__( "Section heading", 'nokri' ),
		"param_name" => "section_heading",
		),
		array(
		"group" => esc_html__("Field Names", "nokri"),
		"type" => "textfield",
		"holder" => "div",
		"class" => "",
		"heading" => esc_html__( "Name Text", 'nokri' ),
		"param_name" => "user_name",
		),
		array(
		"group" => esc_html__("Field Names", "nokri"),
		"type" => "textfield",
		"holder" => "div",
		"class" => "",
		"heading" => esc_html__( "Email Text", 'nokri' ),
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
		"heading" => esc_html__( "Employer Button Text", 'nokri' ),
		"param_name" => "emp_btn",
		),
		array(
		"group" => esc_html__("Field Names", "nokri"),
		"type" => "textfield",
		"holder" => "div",
		"class" => "",
		"heading" => esc_html__( "Candidate Button Text", 'nokri' ),
		"param_name" => "cand_btn",
		),
		array(
		"group" => esc_html__("Field Names", "nokri"),
		"type" => "textfield",
		"holder" => "div",
		"class" => "",
		"heading" => esc_html__( "Agrement Text", 'nokri' ),
		"param_name" => "user_agrement",
		),
		array(
		"group" => esc_html__("Field Names", "nokri"),
		"type" => "textfield",
		"holder" => "div",
		"class" => "",
		"heading" => esc_html__( "Agrement Link", 'nokri' ),
		"param_name" => "user_agrement_link",
		),
		array(
		"group" => esc_html__("Field Names", "nokri"),
		"type" => "textfield",
		"holder" => "div",
		"class" => "",
		"heading" => esc_html__( "Button Text", 'nokri' ),
		"param_name" => "user_btn",
		),
		array(
		"group" => esc_html__("Field Names", "nokri"),
		"type" => "textfield",
		"holder" => "div",
		"class" => "",
		"heading" => esc_html__( "Already Registered Text", 'nokri' ),
		"param_name" => "already_txt",
		),
		array(
		"group" => esc_html__("Field Names", "nokri"),
		"type" => "textfield",
		"holder" => "div",
		"class" => "",
		"heading" => esc_html__( "Login text", 'nokri' ),
		"param_name" => "login_txt",
		),
		/* Sidebar details */
		array(
		"group" => esc_html__("Sidebar", "nokri"),
		"type" => "textfield",
		"holder" => "div",
		"class" => "",
		"heading" => esc_html__( "Heading", 'nokri' ),
		"param_name" => "side_heading",
		),
		array(
		"group" => esc_html__("Sidebar", "nokri"),
		"type" => "textarea",
		"holder" => "div",
		"class" => "",
		"heading" => esc_html__( "Details", 'nokri' ),
		"param_name" => "side_details",
		),
		array(
		"group" => esc_html__("Sidebar", "nokri"),
		"type" => "textarea",
		"holder" => "div",
		"class" => "",
		"heading" => esc_html__( "Details", 'nokri' ),
		"param_name" => "side_points",
		 "description"   =>  __("Points separate with | sign", "nokri")
		),
		array(
		"group" => esc_html__("Sidebar", "nokri"),
		"type" => "textfield",
		"holder" => "div",
		"class" => "",
		"heading" => esc_html__( "Button text", 'nokri' ),
		"param_name" => "side_button",
		),
		array(
		"group" => esc_html__("Sidebar", "nokri"),
		"type" => "textfield",
		"holder" => "div",
		"class" => "",
		"heading" => esc_html__( "Button link", 'nokri' ),
		"param_name" => "side_button_link",
		),
	
		
	),
	));
}

add_action('vc_before_init', 'singnup_short');

function admin_choice_short_base_func($atts, $content = '')
{
	extract(shortcode_atts(array(
		'order_field_key' => '',
		'basic_heading' => '',
		'basic_details' => '', 
		'basic_bg_img' => '',
		'section_heading' => '',
		'user_name' => '',
		'user_email' => '',
		'user_password' => '',
		'user_agrement' => '',
		'user_btn' => '',
		'user_agrement_link' => '',
		'terms_title' => '',
		'section_title' => '',
		'cand_btn' => '',
		'emp_btn' => '',
		'already_txt' => '',
		'login_txt' => '',
		'side_heading' => '',
		'side_details' => '',
		'side_points' => '',
		'side_button' => '',
		'side_button_link' => '',
	) , $atts));
	
global $nokri;


/*Main heading*/
$basic_heading = (isset($basic_heading) && $basic_heading != "") ? '<h1>'.$basic_heading.'</h1>' : "";
/*Main details*/
$basic_details = (isset($basic_details) && $basic_details != "") ? '<p>'.$basic_details.'</p>' : "";
/*Section heading*/
$section_heading = (isset($section_heading) && $section_heading != "") ? '<h3>'.$section_heading.'</h3>' : "";
/*Section Social*/
$section_social = (isset($user_social) && $user_social != "") ? '<div class="loginbox-title">'.$user_social.'</div>' : "";
/* User Name */
$section_user_name = (isset($user_name) && $user_name != "") ? ' <label>'.$user_name.' <span class="required">*</span></label>': "";
/* Email */
$section_user_email = (isset($user_email) && $user_email != "") ? '<label>'.$user_email.'<span class="required">*</span></label>': "";
/* Password */
$section_user_password = (isset($user_password) && $user_password != "") ? '<label>'.$user_password.'<span class="required">*</span></label>' : "";
/*Phone Number*/
$section_user_phone = (isset($user_phone) && $user_phone != "") ? '<label>'.$user_phone.'<span class="required">*</span></label>' : "";
/* Button Text */
$section_user_btn = (isset($user_btn) && $user_btn != "") ? $user_btn: "";  
/* Term & Condition */
$section_term = (isset($user_agrement) && $user_agrement != "") ? $user_agrement: "";
/* Term & Condition  Link */
$section_term_link = (isset($user_agrement_link) && $user_agrement_link != "") ? $user_agrement_link: "";
/* Employer Button */
$section_emp_btn = (isset($emp_btn) && $emp_btn != "") ? $emp_btn  : esc_html__( 'Employer','nokri' );
/* Candidate Button*/
$section_cand_btn = (isset($cand_btn) && $cand_btn != "") ? $cand_btn : esc_html__( 'Candidate','nokri' );
/* Already Register Text*/
$section_already_txt = (isset($already_txt) && $already_txt != "") ? $already_txt : esc_html__( 'Already registered, login here.','nokri' );
/*side bar heading */
$side_heading = (isset($side_heading) && $side_heading != "") ? '<h3>'.$side_heading.'</h3>' : '';
/*side bar details */
$side_details = (isset($side_details) && $side_details != "") ? '<p>'.$side_details.'</p>' : '';
/*side bar link */
$side_button_link = (isset($side_button_link) && $side_button_link != "") ? $side_button_link : '';	
/*side bar button */
$side_button = (isset($side_button) && $side_button != "") ? '<a href="'.$side_button_link.'" class="btn n-btn-flat btn-mid btn-block">'.$side_button.'</a>' : '';

$authentication	=	new authentication();
$code = time();
$_SESSION['sb_nonce'] = $code;
/* Points */
$li     = '';
$points = explode("|",$side_points);
foreach ($points as $point)
{
	$li .= '<li>'.esc_html($point).'</li>';
}

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
                     <div class="n-job-pages register-page">
                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                           <div class="row">
                              <div class="n-page-left-side">
                                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="post-job-heading">
                                       '.($section_heading).'
                                    </div>
                                 </div>
                                 '.$authentication->nokri_sign_up_form( $section_term_link, $terms_title, $section_user_name,$section_user_email,$section_user_password,$section_term,$section_user_btn,$section_user_phone,$code,$section_term_link,$section_emp_btn,$section_cand_btn,$section_already_txt,$login_txt).'
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 nopadding">
                           <div class="n-page-right-side">
                              <div class="post-job-heading">
                                 '.($side_heading).'
                              </div>
                              <div class="form-group">
                                 '.($side_details).'
                              </div>
                              <ul>
                                 '.($li).'
                              </ul>
                              '.($side_button).'
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>';
}
if (function_exists('nokri_add_code'))
{
	nokri_add_code('admin_choice_short_base', 'admin_choice_short_base_func');
}