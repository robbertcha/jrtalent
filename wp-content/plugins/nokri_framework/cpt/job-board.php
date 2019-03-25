<?php 
// Register post  type and taxonomy
add_action( 'init', 'sb_themes_custom_types', 0 );
function sb_themes_custom_types() {
	 //Register Post type
	 $args = array(
      'public' => true,
      'label'  =>  __( 'Nokri JobBoard', 'redux-framework' ),
	  'supports' => array(  'title', 'thumbnail', 'editor', 'author' ),
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'has_archive' => true,
		'rewrite' => array('with_front' => false, 'slug' => 'job')
	  
    );
    register_post_type( 'job_post', $args );
	
	//add_filter('post_type_link', 'custom_event_permalink', 1, 3);
function custom_event_permalink($post_link, $id = 0, $leavename) {
	
    if ( strpos('%ad%', $post_link) === 'FALSE' ) {
        return $post_link;
    }
    $post = get_post($id);
    if ( is_wp_error($post) || $post->post_type != 'job_post' ) {
        return $post_link;
    }
    return str_replace('ad',  'ad/' . $post->ID, $post_link);
}
	
	//Ads Cats
	register_taxonomy('job_category',array('job_post'), array(
		'hierarchical' => true,
		'show_ui' => true,
		'label'  =>  __( 'Categories', 'redux-framework' ),
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'job_category' ),
  ));
	//Ads tags
	register_taxonomy('job_tags',array('job_post'), array(
		'hierarchical' => false,
		'label'  => __( 'Tags', 'redux-framework' ),
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'job_tag' ),
  ));
	//Ads Type
	register_taxonomy('job_type',array('job_post'), array(
		'hierarchical' => true,
		'label'  => __( 'Type', 'redux-framework' ),
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'job_type' ),
  ));
  //Ads Type
	register_taxonomy('job_qualifications',array('job_post'), array(
		'hierarchical' => true,
		'label'  => __( 'Qualifications', 'redux-framework' ),
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'job_qualifications' ),
  ));
  //Job Level
	register_taxonomy('job_level',array('job_post'), array(
		'hierarchical' => true,
		'label'  => __( 'Level', 'redux-framework' ),
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'job_level' ),
  ));
  //Job Salary
	register_taxonomy('job_salary',array('job_post'), array(
		'hierarchical' => true,
		'label'  => __( 'Salary', 'redux-framework' ),
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'job_salary' ),
  ));
  //Job Salary Type
	register_taxonomy('job_salary_type',array('job_post'), array(
		'hierarchical' => true,
		'label'  => __( 'Salary Type', 'redux-framework' ),
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'job_salary_type' ),
  ));
  
  //Job Skills
	register_taxonomy('job_skills',array('job_post'), array(
		'hierarchical' => true,
		'label'  => __( 'Skills', 'redux-framework' ),
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'job_skills' ),
  ));
  
  //Ad Experience 
	register_taxonomy('job_experience',array('job_post'), array(
		'hierarchical' => true,
		'label'  => __( 'Experience', 'redux-framework' ),
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'job_experience' ),
  ));
  //Job Currency 
	register_taxonomy('job_currency',array('job_post'), array(
		'hierarchical' => true,
		'label'  => __( 'Currency', 'redux-framework' ),
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'job_currency' ),
  ));
  //Job Shift
	register_taxonomy('job_shift',array('job_post'), array(
		'hierarchical' => true,
		'label'  => __( 'Shift', 'redux-framework' ),
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'job_shift' ),
  ));
  //Job Class
	register_taxonomy('job_class',array('job_post'), array(
		'hierarchical' => true,
		'label'  => __( 'Job Class', 'redux-framework' ),
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'job_class' ),
  ));
	
	
  //Ads Locations
	register_taxonomy('ad_location',array('job_post'), array(
		'hierarchical' => true,
		'show_ui' => true,
		'label'  =>  __( 'Locations', 'redux-framework' ),
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'ad_location' ),
  ));
  
  // Register Post type for Map Countries
    $args = array(
      'public' => true,
	   'menu_icon' => 'dashicons-location',
      'label'  =>  __( 'Map Countries', 'redux-framework' ),
	  'supports' => array( 'thumbnail', 'title')
    );
    register_post_type( '_sb_country', $args );
	
}




add_action('job_class_add_form_fields', 'job_class_metabox_add', 10, 1);
add_action('job_class_edit_form_fields', 'job_class_metabox_edit', 10, 1);    

function job_class_metabox_add($tag) { ?>
<h3><?php echo __("Regular Job Info", "redux-framework"); ?></h3>
    <div class="form-field">
        <label for="emp_class_check"><?php echo __("Select regular for free jobs", "redux-framework"); ?></label>
        <select class="form-control" id="image2" name="emp_class_check">
            <option><?php echo __("Select Option", "redux-framework"); ?></option>
            <option><?php echo __("Regular", "redux-framework"); ?></option>
         </select>
    </div>
<?php }     

function job_class_metabox_edit($tag) { ?>
<h3><?php echo __("Regular Job Info", "redux-framework"); ?></h3>
    <table class="form-table">
        <tr class="form-field">
        <th scope="row" valign="top">
            <label for="emp_class_check"><?php echo __("Select regular for free jobs", "redux-framework"); ?></label>
        </th>
        <td>
				<?php 
                    $selectArrVal =  get_term_meta($tag->term_id, 'emp_class_check', true); 
                    $selectArr = array(
                        "1" => __("Regular", "redux-framework"),
                    );
                ?>
            	<select name="emp_class_check" id="emp_class_check" type="text" aria-required="true" >
                    <?php 
						echo '<option value="">'. __("Select Option", "redux-framework") .'</option>';
						foreach( $selectArr as $key => $val )
						{
							$selected = ( $key == $selectArrVal ) ? 'selected="selected"' : '';
							echo '<option value="'.esc_attr($key).'" '.$selected.'>'.esc_html($val).'</option>';
						}
					?>
                </select>
        </td>
        </tr>
    </table>
<?php }

add_action('created_job_class', 'save_job_class_metadata', 10, 1);
add_action('edited_job_class', 'save_job_class_metadata', 10, 1);

function save_job_class_metadata($term_id){
{
    if (isset($_POST['emp_class_check']))
        update_term_meta( $term_id, 'emp_class_check', $_POST['emp_class_check']);
}
}





add_action('menu_category_edit_form_fields','menu_category_edit_form_fields');
add_action('menu_category_add_form_fields','menu_category_edit_form_fields');
add_action('edited_menu_category', 'menu_category_save_form_fields', 10, 2);
add_action('created_menu_category', 'menu_category_save_form_fields', 10, 2);

function menu_category_save_form_fields($term_id) {
    $meta_name = 'order';
    if ( isset( $_POST[$meta_name] ) ) {
        $meta_value = $_POST[$meta_name];
        // This is an associative array with keys and values:
        // $term_metas = Array($meta_name => $meta_value, ...)
        $term_metas = get_option("taxonomy_{$term_id}_metas");
        if (!is_array($term_metas)) {
            $term_metas = Array();
        }
        // Save the meta value
        $term_metas[$meta_name] = $meta_value;
        update_option( "taxonomy_{$term_id}_metas", $term_metas );
    }
}

function menu_category_edit_form_fields ($term_obj) {
    // Read in the order from the options db
    $term_id = $term_obj->term_id;
    $term_metas = get_option("taxonomy_{$term_id}_metas");
    if ( isset($term_metas['order']) ) {
        $order = $term_metas['order'];
    } else {
        $order = '0';
    }
?>
    <tr class="form-field">
            <th valign="top" scope="row">
                <label for="order"><?php _e('Category Order', ''); ?></label>
            </th>
            <td>
                <input type="text" id="order" name="order" value="<?php echo esc_attr($order); ?>"/>
            </td>
        </tr>
<?php 
}


// Register metaboxes for Country CPT
add_action( 'add_meta_boxes', 'sb_meta_box_for_country' );
function sb_meta_box_for_country()
{
    add_meta_box( 'sb_metabox_for_country', 'County', 'sb_render_meta_country', '_sb_country', 'normal', 'high' );
}
function sb_render_meta_country( $post )
{
 // We'll use this nonce field later on when saving.
    wp_nonce_field( 'my_meta_box_nonce_country', 'meta_box_nonce_country' );
?>
<div class="margin_top">
	<input type="text" name="country_county" class="project_meta" placeholder="<?php echo esc_attr__('County', 'redux-framework' ); ?>" size="30" value="<?php echo get_the_excerpt($post->ID ); ?>" id="country_county" spellcheck="true" autocomplete="off">
    <p><?php echo __('This should be follow ISO2 like', 'redux-framework'); ?> <strong><?php echo __('US', 'redux-framework'); ?></strong> <?php echo __('for USA and', 'redux-framework' ); ?> <strong><?php echo __('CA', 'redux-framework'); ?></strong> <?php echo __('for Canada','redux-framework'); ?>, <a href="http://data.okfn.org/data/core/country-list" target="_blank"><?php echo __('Read More.', 'redux-framework' );?></a></p>
</div>

<?php
}
// Saving Metabox data 
add_action( 'save_post', 'sb_themes_meta_save_country' );
function sb_themes_meta_save_country( $post_id )
{
  // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
// if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce_country'] ) || !wp_verify_nonce( $_POST['meta_box_nonce_country'], 'my_meta_box_nonce_country' ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;
	
	// Make sure your data is set before trying to save it
    if( isset( $_POST['country_county'] ) )
	{
        //update_post_meta( $post_id, '_sb_country_county', $_POST['country_county'] );
		$my_post = array(
			'ID'           => $post_id,
			'post_excerpt'   => $_POST['country_county'],
		);
		global $wpdb;
		$county	=	$_POST['country_county'];
		$wpdb->query( "UPDATE $wpdb->posts SET post_excerpt = '$county' WHERE ID = '$post_id'" );
	}
		
		
}





add_filter('manage_job_post_posts_columns', function ( $columns ) 
{
	unset($columns['job_qualifications']);
	return $columns;
} );





/* Remove Extra Columns Starts */
if ( ! function_exists( 'nokri_job_post_remove_columns' ) ) {	 
function nokri_job_post_remove_columns( $columns ) {
	$arr = array("job_type", "job_qualifications", "job_salary", "job_skills", "job_experience", "job_currency", "job_shift", "job_class", "ad_location","job_level");
	foreach( $arr as $r )
	{	
		$column_remove = '';
		$column_remove = 'taxonomy-'.$r;
		unset( $columns["$column_remove"] );
	}	
	return $columns;
}
}
add_filter ( 'manage_edit-job_post_columns', 'nokri_job_post_remove_columns' );



/* ========================= */
/* Add Custom Colours To Job Type */
/* ========================= */


 add_action( 'admin_enqueue_scripts', 'nokri_mw_enqueue_color_picker' );
 function nokri_mw_enqueue_color_picker( $hook_suffix ) 
 {
	 wp_enqueue_style( 'wp-color-picker' );
	 wp_enqueue_script( 'wp-color-picker-alpha', trailingslashit( get_template_directory_uri () )  . 'js/wp-color-picker-alpha.min.js', array( 'wp-color-picker' ), false, true );
	 wp_enqueue_script( 'nokri-admin-js', trailingslashit( get_template_directory_uri () )  . 'js/admin.js', array( 'wp-color-picker' ), false, true );
  }
 
 function nokri_add_color_to_category( $term )
 {
	 
		if(isset($term->taxonomy))
		{
			$tax_type = ($term->taxonomy);
		}
		else
		{
			$tax_type = ($term);
		}
	$tax_type_meta = '_'.$tax_type.'_term_color';
	$tax_type_meta_bg = '_'.$tax_type.'_term_color_bg';
	 
	$field_name =  $tax_type.'_term_color';
	$field_name_bg = $tax_type.'_term_color_bg';
	 
 	$termID   = isset($term->term_id) ? $term->term_id : '';
  	$termMeta = get_term_meta($termID, $tax_type_meta, true );
	
	$termMeta_bg = get_term_meta($termID, $tax_type_meta_bg, true );
	
	
    
	 $customfield = $termMeta;
	 $cname = ( $customfield  && $customfield != "" ) ? $customfield : "#fff";
	 
	 $customfieldbg = $termMeta_bg;
	 $cname_bg = ( $customfieldbg  && $customfieldbg != "" ) ? $customfieldbg : "#fff";
	 
	 echo "<table class='form-table'><tbody> <tr class='form-field term-parent-wrap'><th scope='row'><label for='".$field_name_bg."'>".__ ('Select BG Color','opportunities')."</label></th><td><input type='text' value='".esc_attr($cname_bg)."' class='my-color-field color-picker'  data-default-color='#effeff' data-alpha='true' name='".$field_name_bg."' id='".$field_name_bg."' /></td></tr></tbody></table>";
	 
	 
	  echo "<table class='form-table'><tbody> <tr class='form-field term-parent-wrap'><th scope='row'><label for='".$field_name."'>".__ ('Select Font Color','opportunities')."</label></th><td><input type='text' value='".esc_attr($cname)."' class='my-color-field color-picker'  data-default-color='#effeff' data-alpha='true' name='".$field_name."' id='".$field_name."' /></td></tr></tbody></table>";
 
 }
 
function save_custom_tax_color_field( $termID )
{
	
	$taxonomy_data = get_term($termID);
	$taxonomy_type = ($taxonomy_data->taxonomy);
	$post_data     = $taxonomy_type.'_term_color';
	
	$post_data_bg     = $taxonomy_type.'_term_color_bg';
	
	
if ( isset( $_POST[$post_data] ) ) 
{
	$termMeta = $_POST[$post_data];
	$tax_type_meta = '_'.$taxonomy_type.'_term_color';
	
	update_term_meta( $termID, $tax_type_meta, '');
	if($termMeta != "" )
	{
		update_term_meta( $termID, $tax_type_meta, $termMeta);
	}

 }
 
 
if ( isset( $_POST[$post_data_bg] ) ) 
{
	$termMeta_bg = $_POST[$post_data_bg];
	
	
	$tax_type_meta_bg = '_'.$taxonomy_type.'_term_color_bg';
	
	update_term_meta( $termID, $tax_type_meta_bg, '');
	if($termMeta_bg != "" )
	{
		update_term_meta( $termID, $tax_type_meta_bg, $termMeta_bg);
	}

 } 
 
}

	$array_terms = array('job_type', 'job_class');

	if(count((array)$array_terms) > 0 )
	{
		
		foreach( $array_terms as $type )
		{
			if( $type != "" )
			{
				add_action($type.'_add_form_fields', 'nokri_add_color_to_category' );
				add_action($type.'_edit_form_fields', 'nokri_add_color_to_category' );
				add_action( "create_".$type, 'save_custom_tax_color_field' );
				add_action( "edited_".$type, 'save_custom_tax_color_field' );
			}
		}
	}
// Register metaboxes for Products
add_action( 'add_meta_boxes', 'sb_adforest_ad_meta_box' );
function sb_adforest_ad_meta_box()
{
    add_meta_box('sb_thmemes_adforest_metaboxes_for_ad', __('Assign job','redux-framework' ), 'sb_render_meta_for_ads', 'job_post', 'normal', 'high' );
}
function sb_render_meta_for_ads( $post )
{
 // We'll use this nonce field later on when saving.
    wp_nonce_field( 'my_meta_box_nonce_ad', 'meta_box_nonce_product' );
?>

<div class="margin_top">
<p><?php echo __('Select Author','redux-framework' ); ?></p>
    <select name="sb_change_author" style="width:100%; height:40px;">
<?php
$users = get_users( array( 'fields' => array( 'display_name', 'ID' ),'meta_query' => array( 'key' => '_sb_reg_type', 'value' => '1','compare' => '=') ));
foreach ( $users as $user ) {
	if( get_user_meta( $user->ID, '_sb_reg_type', true ) != '1' )
		continue;
	echo '<span>' . esc_html( $user->display_name ) . '</span>';
?>
    	<option value="<?php echo esc_attr( $user->ID ); ?>" <?php if( $post->post_author == $user->ID ) echo 'selected'; ?>>
			<?php echo esc_html( $user->display_name ); ?>
		</option>
<?php
}
?>
    </select>
</div>
<?php
}
// Saving Metabox data 
add_action( 'save_post', 'sb_themes_meta_save_for_ad' );
function sb_themes_meta_save_for_ad( $post_id )
{
  // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
// if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce_product'] ) || !wp_verify_nonce( $_POST['meta_box_nonce_product'], 'my_meta_box_nonce_ad' ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;
	
	// Make sure your data is set before trying to save it
    if( isset( $_POST['sb_change_author'] ) )
	{
		$my_post = array(
		'ID' => $post_id,
		'post_author' => $_POST['sb_change_author'],
		);
		// unhook this function so it doesn't loop infinitely
        remove_action('save_post', 'sb_themes_meta_save_for_ad');

        // update the post, which calls save_post again
        wp_update_post( $my_post );

        // re-hook this function
        add_action('save_post', 'sb_themes_meta_save_for_ad');
	}
		
		
}