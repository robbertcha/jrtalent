<?php
global $nokri;
$dashboard_page =  $footer_style =  '';
/* Search page lay out */
$search_page_layout = ( isset($nokri['search_page_layout']) && $nokri['search_page_layout'] != ""  ) ? $nokri['search_page_layout'] : "";
if((isset($nokri['sb_dashboard_page'])) && $nokri['sb_dashboard_page']  != '' )
{
	$dashboard_page =  ($nokri['sb_dashboard_page']);
}
if((isset($nokri['select_footer_layout'])) && $nokri['select_footer_layout']  != '' )
{
	 $footer_style =  ($nokri['select_footer_layout']);
}
/*No footer in map search */
if($search_page_layout == '3' && basename(get_page_template()) == 'page-search.php')
{
	
}
else
{
	if(basename(get_page_template()) != 'page-dashboard.php')
	{
		get_template_part( 'template-parts/footers/footer', $footer_style);
	}
}
/* Hidden Inputs */
get_template_part( 'template-parts/hidden','inputs' );
/* Linkedin access*/
include( 'template-parts/linkedin-access.php' );
/* Linkedin messages */
get_template_part( 'template-parts/linkedin','messages' );
/* Email verification and reset password */
 get_template_part( 'template-parts/verification','logic' ); ?>
<div id="popup-data"></div> 
<div id="app-data"></div>
<div id="short-desc-data"></div>
<div id="status_action_data"></div>
<?php
if( isset( $nokri['banners_code_footer'] ) &&  $nokri['banners_code_footer'] != '')
{
	echo ($nokri['banners_code_footer']);
}
?> 
 <?php
if((isset($nokri['scroll_to_top'])) && $nokri['scroll_to_top']  == '1' ) { ?>
<a href="#" class="scrollup"><i class="fa fa-chevron-up"></i></a>
<?php } echo nokri_authorization();
wp_footer();?>
</div>
</body>
</html>