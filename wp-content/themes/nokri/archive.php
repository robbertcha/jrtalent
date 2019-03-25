<?php get_header();
global $nokri;
$current_category        =   get_queried_object();
if(empty($current_category))
{
	get_template_part( 'template-parts/archives/blog','archive');
}
else
{
	$current_category_name   =  ($current_category->taxonomy); 
	$taxonomies	             =	 array('job_category','job_tags', 'job_type','job_qualifications','job_level','job_salary','job_salary_type','job_skills','job_experience','job_currency','job_shift','job_class','job_location');
	if (in_array($current_category_name, $taxonomies))
	{
		get_template_part( 'template-parts/archives/job','archive');
	}
	else
	{
		get_template_part( 'template-parts/archives/blog','archive');
	}
}
get_footer();