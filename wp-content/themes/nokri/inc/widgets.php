<?php
/* ========================= */
/* Nokri Search Widget */
/* ========================= */


/*Adds search_Widget widget */
class nokri_search_job extends WP_Widget {
/** Register widget with WordPress */
function __construct() {
		parent::__construct(
			'nokri_search_job', // Base ID
			esc_html__( 'Nokri search by keyword', 'nokri' ), // Name
			array( 'description' => esc_html__( 'Show Search Box', 'nokri' ), ) // Args
						    );
					   }
     /**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		
		global $nokri;
		 $title	=	'';
		 $in  = '';
		 if(isset($instance['is_open'] ) && $instance['is_open'] == 'open' )
		 {
			 $in = 'in';
		 }
		 
		if( isset( $_GET['job_title'] ) && $_GET['job_title'] != "" )
		{
			$title	=	$_GET['job_title'];
			$in     = 'in';
		}
		 ?>				
         <div class="panel panel-default">
        <div class="panel-heading active" role="tab">
            <a role="button" data-toggle="collapse" href="#search-widget">
              <?php echo ($instance['title'] ); ?>
            </a>
        </div>
        <div id="search-widget" class="panel-collapse collapse <?php echo esc_attr($in); ?>" role="tabpanel" >
          <div class="panel-body">
            <form role="search" method="get" action = "<?php echo get_the_permalink($nokri['sb_search_page']); ?>">
                <div class="form-group">
                     
                     <input type="text" class="form-control" value="<?php echo esc_attr( $title ); ?>" name="job_title" placeholder="<?php echo esc_html__('Search Here','nokri') ?>">
                </div>
                <div class="form-group form-action">
                 <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                </div>
                <?php echo nokri_search_params( 'job_title' ); ?>
            </form>
          </div>
        </div>
      </div>
              <?php 
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
	$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'nokri' );
	/* Seting Open Or Not*/
	$is_open = ! empty( $instance['is_open'] ) ? $instance['is_open'] : esc_html__( 'Select Widget Type', 'nokri' );
	?>
	<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'nokri' ); ?></label> 
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
	</p>
    <!--Open/Close  --->
    <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'is_open' ) ); ?>"><?php esc_attr_e( 'Set Widget', 
'nokri' ); ?>
		</label> 
        <select name="<?php echo esc_attr( $this->get_field_name( 'is_open' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'is_open' ) ); ?>" class="widefat">
        <option value="open" <?php if ( $is_open == 'open') { echo "selected"; } ; ?> ><?php echo esc_html__( 'Open', 'nokri' ); ?></option>
        <option value="close" <?php if ( $is_open == 'close') { echo "selected"; } ; ?> ><?php echo esc_html__( 'Close', 'nokri' ); ?></option>    				
		</select>
        </p>
	<?php 
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
	$instance = array();
	$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
	/* Save open/close*/
	$instance['is_open'] = ( ! empty( $new_instance['is_open'] ) ) ? strip_tags( $new_instance['is_open'] ) : ''; 
	return $instance;
	}
	} 

// register Foo_Widget widget
function nokri_search_job() {
	register_widget( 'nokri_search_job' );
}
add_action( 'widgets_init', 'nokri_search_job' );


/* ========================= */
/* Add Category  widget*/
/* ========================= */


class nokri_categories extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'nokri_categories', // Base ID
			esc_html__( 'Nokri Categories', 'nokri' ), // Name
			array( 'description' => esc_html__( 'Show Categories You Want', 'nokri' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		

		echo ( $args['before_widget'] );
		if ( ! empty( $instance['title'] ) ) 
		{
			echo ( $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'] );
		}
		$categories = get_categories( array( 'orderby' => 'name', 'order'   => 'ASC' ) );
		?>
        <div class="categories-module">
		<?php
		if( count((array)  $categories ) > 0 )
		{
			$count = '';
			if( count((array) $categories ) > 0)
			 {
				foreach($categories as $category)
				{
					$count = nokri_get_category_count($category->term_id);
					echo'<li> <a href="'.get_category_link($category->term_id).'"> '.$category->name .' '.'<span>( '.$count.' )</span></a> </li>';
				} 
			}
		}
		?>
		</div>
		<?php 
		echo ($args['after_widget']);
}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'nokri' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 

'nokri' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo 

esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

} 
// register nokri Widget widget
function nokri_categories() {
    register_widget( 'nokri_categories' );
}
add_action( 'widgets_init', 'nokri_categories' );


/* ========================= */
/*  Category widget In Search*/
/* ========================= */


class nokri_search_categories extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'nokri_search_categories', // Base ID
			esc_html__( 'Search Categories', 'nokri' ), // Name
			array( 'description' => esc_html__( 'Show All Job Categories', 'nokri' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		
		/* Make cats selected on update Job*/
		if(taxonomy_exists('job_category'))
		{
			$ad_cats	=	nokri_get_cats('job_category' , 0 );
			if( count((array)  $ad_cats ) > 0 )
			 {
			$cats_html	=	'';
			$cats_html	.=	'<option value="asa">' .esc_html__( 'Select an option', 'nokri' ).'</option>';
			foreach( $ad_cats as $ad_cat )
			{
				$selected	=	'';
				if ( isset( $_GET['cat_id'] ) && $_GET['cat_id'] == $ad_cat->term_id) 
				{
						$selected = 'selected = "selected"';
				}
				$cats_html	.=	'<option value="'.esc_attr($ad_cat->term_id).'" '.$selected.'>' .esc_html( $ad_cat->name ).'</option>';
			}
			global $nokri;
			 $in  = '';
			 if(isset($instance['is_open'] ) && $instance['is_open'] == 'open' )
			 {
				 $in = 'in';
			 }
			if( isset( $_GET['job_cat'] ) && $_GET['job_cat'] != "" )
			{
				$in     = 'in';
			}
			?>
										<div class="panel panel-default">
										<div class="panel-heading active" role="tab" >
											<a role="button" data-toggle="collapse" href="#collapse-job_category">
											 <?php echo "".$instance['title']; ?>
											</a>
										</div>
										<div id="collapse-job_category"  class="panel-collapse collapse <?php echo esc_attr($in); ?>" role="tabpanel" >
										  <div class="panel-body">
										  <?php 
					if( isset( $_GET['cat_id'] ) && $_GET['cat_id'] != "" )
					{
					?>
					<div class="cat_head"><span><?php echo nokri_get_taxonomy_parents( $_GET['cat_id'], 'job_category', false); ?></span></div>
					<?php
					}
					?>
			<form method="get" id="search_form" action="<?php echo get_the_permalink( $nokri['sb_search_page'] ); ?>">
			<div class="cp-loader"></div>
			<div class="form-group">
			 <select class="questions-category form-control" data-parsley-required="true" id="make_id">
					<?php echo "".$cats_html; ?>
				</select>
			</div>
			<div class="form-group" id="select_modal">
            
            </div>
			<div id="select_modals" class="form-group">
            
            </div>
			<div id="select_forth_div" class="margin-top-10">
            
            </div>
			<div class="form-group form-action">
			</div>
            <input type="button" class="btn n-btn-flat btn-mid" id="category_search" value="<?php echo esc_html__( 'Search', 'nokri' ); ?>">
		   <input type="hidden" name="cat_id" id="cat_id" value="" />
		   <?php echo nokri_search_params( 'cat_id' ); ?>
		   </form>
			 </div>
				</div>
			  </div>
			<?php 
			 }
		}
		echo ($args['after_widget']);
}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'nokri' );
		/* Seting Open Or Not*/
		$is_open = ! empty( $instance['is_open'] ) ? $instance['is_open'] : esc_html__( 'Select Widget Type', 'nokri' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 

'nokri' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo 

esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
         <!--Open/close --->
        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'is_open' ) ); ?>"><?php esc_attr_e( 'Set Widget', 
'nokri' ); ?>
		</label> 
        <select name="<?php echo esc_attr( $this->get_field_name( 'is_open' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'is_open' ) ); ?>" class="widefat">
        <option value="open" <?php if ( $is_open == 'open') { echo "selected"; } ; ?> ><?php echo esc_html__( 'Open', 'nokri' ); ?></option>
        <option value="close" <?php if ( $is_open == 'close') { echo "selected"; } ; ?> ><?php echo esc_html__( 'Close', 'nokri' ); ?></option>    				
		</select>
        </p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		/* Save open/close*/
		$instance['is_open'] = ( ! empty( $new_instance['is_open'] ) ) ? strip_tags( $new_instance['is_open'] ) : ''; 

		return $instance;
	}

} 
// register nokri Widget widget
function nokri_search_categories() {
    register_widget( 'nokri_search_categories' );
}
add_action( 'widgets_init', 'nokri_search_categories' );


/* ========================= */
/* Title widget In Search*/
/* ========================= */


class nokri_job_title extends WP_Widget {

	/**
	 * Register widget with WordPress.   
	 */
	function __construct() {
		parent::__construct(
			'nokri_job_title', // Base ID
			esc_html__( 'Search Job Title', 'nokri' ), // Name
			array( 'description' => esc_html__( 'Search Job Title', 'nokri' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		

		echo ( $args['before_widget'] );
		if ( ! empty( $instance['title'] ) ) 
		{
			echo ( $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'] );
		}
		
		$expand	=	"";
		$title	=	'';
		if( isset( $_GET['job_title'] ) && $_GET['job_title'] != "" )
		{
			$expand	=	"in";
			$title	=	$_GET['job_title'];
		}
		global $nokri;
		?>
        <div class="search-blog">
         <form method="get" action="<?php echo get_the_permalink( $nokri['sb_search_page'] ); ?>">
           <div class="input-group stylish-input-group">
              <input id="autocomplete-dynamic" autocomplete="off" class="form-control" placeholder="<?php echo esc_html__('search', 'nokri' ); ?>" type="text" name="job_title" value="<?php echo esc_attr( $title ); ?>">
              <span class="input-group-addon">
              <button type="submit" id="search-submit"> <span class="fa fa-search"></span> </button>
              </span> 
           </div>
            <?php echo nokri_search_params( 'job_title' ); ?>
            </form> 
        </div> 
		<?php 
		echo ($args['after_widget']);
}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	 public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'nokri' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 

'nokri' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo 

esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

} 
// register nokri Widget 
function nokri_job_title() {
    register_widget( 'nokri_job_title' );
}
add_action( 'widgets_init', 'nokri_job_title' );


/* ========================= */
/* All In One Taxonomy Widget */
/* ========================= */

// nokri framework is active
if ( in_array( 'nokri_framework/index.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )
{ 
	class nokri_search_widget extends WP_Widget {
	
		/*  Register widget with WordPress. */
		function __construct() {
			parent::__construct(
				'nokri_search_widget', // Base ID
				esc_html__( 'All Search Widget', 'nokri' ), // Name
				array( 'description' => esc_html__( 'Add All Search Widget', 'nokri' ), ) // Args
			);
		}
	
		/**
		 * Front-end display of widget.
		 *
		 * @see WP_Widget::widget()
		 *
		 * @param array $args     Widget arguments.
		 * @param array $instance Saved values from database.
		 */
		public function widget( $args, $instance ) {
			
			 $taxonomy_list = ( ! empty( $instance['taxonomy_list'] ) ) ? $instance['taxonomy_list'] : 'job_category'; 
			 global $nokri;
			 /* Displaying  Taxonomies Terms On Widet   */
			 
			 
			echo nokri_job_search_taxonomies_checkboxes($taxonomy_list,$instance); 
			
	}
		/**
		 * Back-end widget form.
		 *
		 * @see WP_Widget::form()
		 *
		 * @param array $instance Previously saved values from database.
		 */
		public function form( $instance ) {
			$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'nokri' );
			/* Select Field */
			$taxonomy_list = ! empty( $instance['taxonomy_list'] ) ? $instance['taxonomy_list'] : esc_html__( 'Select Widget', 'nokri' );
			/* Number Of Records */
			$no_of_records = ! empty( $instance['no_of_records'] ) ? $instance['no_of_records'] : esc_html__( 'Select Number', 'nokri' );
			/* Seting Open Or Not*/
			$is_open = ! empty( $instance['is_open'] ) ? $instance['is_open'] : esc_html__( 'Select Widget Type', 'nokri' );
			?>
			<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 
	
	'nokri' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo 
	
	esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			</p>
			<!-- Select Field  --->
			<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'post_order' ) ); ?>"><?php esc_attr_e( 'Select Widget', 
	'nokri' ); ?>
			</label> 
			<select name="<?php echo esc_attr( $this->get_field_name( 'taxonomy_list' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'taxonomy_list' ) ); ?>" class="widefat">
			<?php
			/* Getting All Taxonomies Of CPT */
			$customPostTaxonomies =  get_object_taxonomies( 'job_post', 'object' );
			if(count($customPostTaxonomies) > 0)
			{
				   foreach($customPostTaxonomies as $tax)
					{
						if ($tax->name == 'job_category') 
						{
						continue;
						}
						$selected = ($taxonomy_list == $tax->name) ? 'selected' : '';
						echo '<option value="'.esc_html($tax->name).'" '.$selected.'>'.esc_html($tax->labels->singular_name).'</option>';    		}
			}
			?>
			</select>
			</p>
			<!--Open/Close  --->
			<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'no_of_records' ) ); ?>"><?php esc_attr_e( 'By Default Number of Records:', 
	
	'nokri' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'no_of_records' ) ); ?>" name="<?php echo 
	
	esc_attr( $this->get_field_name( 'no_of_records' ) ); ?>" type="number" value="<?php echo esc_attr( $no_of_records ); ?>">
			</p>
			<!--Number Of Records  --->
			<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'is_open' ) ); ?>"><?php esc_attr_e( 'Set Widget', 
	'nokri' ); ?>
			</label> 
			<select name="<?php echo esc_attr( $this->get_field_name( 'is_open' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'is_open' ) ); ?>" class="widefat">
			<option value="open" <?php if ( $is_open == 'open') { echo "selected"; } ; ?> ><?php echo esc_html__( 'Open', 'nokri' ); ?></option>
			<option value="close" <?php if ( $is_open == 'close') { echo "selected"; } ; ?> ><?php echo esc_html__( 'Close', 'nokri' ); ?></option>    				
			</select>
			</p>
			<?php 
		}
	
		/**
		 * Sanitize widget form values as they are saved.
		 *
		 * @see WP_Widget::update()
		 *
		 * @param array $new_instance Values just sent to be saved.
		 * @param array $old_instance Previously saved values from database.
		 *
		 * @return array Updated safe values to be saved.
		 */
		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			/* Third Feild */
			$instance['taxonomy_list'] = ( ! empty( $new_instance['taxonomy_list'] ) ) ? strip_tags( $new_instance['taxonomy_list'] ) : '';
			/* Save Number Of Records*/
			$instance['no_of_records'] = ( ! empty( $new_instance['no_of_records'] ) ) ? strip_tags( $new_instance['no_of_records'] ) : '';
			/* Save open/close*/
			$instance['is_open'] = ( ! empty( $new_instance['is_open'] ) ) ? strip_tags( $new_instance['is_open'] ) : ''; 
	
			return $instance;
		}
	
	} 
	// Register  All In One Taxonomy Widget
	function nokri_search_widget() {
		register_widget( 'nokri_search_widget' );
	}
	add_action( 'widgets_init', 'nokri_search_widget' );

}
/* ========================= */
/*  Location widget In Search*/
/* ========================= */


class nokri_search_location extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'nokri_search_location', // Base ID
			esc_html__( 'Nokri Custom Locations', 'nokri' ), // Name
			array( 'description' => esc_html__( 'Show All Job Locations', 'nokri' ), ) // Args
		);
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
		public function widget( $args, $instance ) {
       /*  Select Country,  City, State */
		$search_countries	=	nokri_get_cats('ad_location' , 0 );
		if( count( $search_countries ) > 0 )
		 {
		$cats_html	=	'';
		$cats_html	.=	'<option value="0">' .esc_html__( 'Select an option', 'nokri' ).'</option>';
		foreach( $search_countries as $search_country )
		{
			$selected	=	'';
			if ( isset( $_GET['job_location'] ) && $_GET['job_location'] == $search_country->term_id) 
			{
					$selected = 'selected = "selected"';
			}
			$cats_html	.=	'<option value="'.esc_attr($search_country->term_id).'" '.$selected.'>' .esc_html( $search_country->name ).'</option>';
		}
		global $nokri;
		$in  = '';
		 if(isset($instance['is_open'] ) && $instance['is_open'] == 'open' )
		 {
			 $in = 'in';
		 }
		if( isset( $_GET['location'] ) && $_GET['location'] != "" )
		{
			$in     = 'in';
		}
		/*  for job search/candidate search */
		 if(isset($instance['for'] ) && $instance['for'] == 'job' )
		 {
			 $form_for =  get_the_permalink( $nokri['sb_search_page'] );
		 }
		 else
		 {
			 $form_for =  get_the_permalink( $nokri[ 'candidates_search_page'] );
		 }
		 ?>
        <div class="panel panel-default">
            <div class="panel-heading active" role="tab" >
                <a role="button" data-toggle="collapse" href="#location_search">
                 <?php echo "".$instance['title']; ?>
                </a>
            </div>
            <div id="location_search"  class="panel-collapse collapse <?php echo esc_attr($in); ?>" role="tabpanel">
              <div class="panel-body">
              <?php 
				if( isset( $_GET['job_location'] ) && $_GET['job_location'] != "" )
				{
				?>
                <div class="cat_head"><span><?php echo nokri_get_taxonomy_parents( $_GET['job_location'], 'ad_location', false); ?></span></div>
                <?php
				}
				?>
        <form method="get" id="search_form" action="<?php echo "".($form_for); ?>">
        <div class="cp-loader"></div>
        <div class="form-group">
         <select class="questions-category form-control" data-parsley-required="true" id="countries_id" >
                <?php echo "".$cats_html; ?>
            </select>
        </div>
        <div class="form-group" id="select_modal_countries"></div>
        <div id="select_modals_state" class="form-group"></div>
        <div id="select_forth_div_city" class="margin-top-10"></div>
        <div class="form-group form-action">
        </div>
      <input type="button" class="btn n-btn-flat btn-mid location_search" id="location_search" value="<?php echo esc_html__( 'Search', 'nokri' ); ?>">
      <input type="hidden" name="job_location" id="location_id" value="" />
       <?php echo nokri_search_params('job_location' ); ?>
       </form>
         </div>
            </div>
          </div>      
		<?php 
		 }
}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'nokri' );
		/* Seting Open Or Not*/
		$is_open = ! empty( $instance['is_open'] ) ? $instance['is_open'] : esc_html__( 'Select Widget Type', 'nokri' );
		/* Seting job search/candidate search*/
		$for = ! empty( $instance['for'] ) ? $instance['for'] : esc_html__( 'Select Widget for', 'nokri' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 

'nokri' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo 

esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
        <!--Open/close  --->
        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'is_open' ) ); ?>"><?php esc_attr_e( 'Set Widget', 
'nokri' ); ?>
		</label> 
        <select name="<?php echo esc_attr( $this->get_field_name( 'is_open' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'is_open' ) ); ?>" class="widefat">
        <option value="open" <?php if ( $is_open == 'open') { echo "selected"; } ; ?> ><?php echo esc_html__( 'Open', 'nokri' ); ?></option>
        <option value="close" <?php if ( $is_open == 'close') { echo "selected"; } ; ?> ><?php echo esc_html__( 'Close', 'nokri' ); ?></option>    				
		</select>
        </p>
        <!--job search/candidate search  --->
        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'for' ) ); ?>"><?php esc_attr_e( 'Widget For', 
'nokri' ); ?>
		</label> 
        <select name="<?php echo esc_attr( $this->get_field_name( 'for' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'for' ) ); ?>" class="widefat">
        <option value="job" <?php if ( $for == 'job') { echo "selected"; } ; ?> ><?php echo esc_html__( 'Jobs search', 'nokri' ); ?></option>
        <option value="cand" <?php if ( $for == 'cand') { echo "selected"; } ; ?> ><?php echo esc_html__( 'candidates search', 'nokri' ); ?></option>    				
		</select>
        </p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		/* Save open/close*/
		$instance['is_open'] = ( ! empty( $new_instance['is_open'] ) ) ? strip_tags( $new_instance['is_open'] ) : '';
		/* job search/candidate search  */
		$instance['for'] = ( ! empty( $new_instance['for'] ) ) ? strip_tags( $new_instance['for'] ) : '';
		
		return $instance;
	}

} 
// register nokri Widget widget
function nokri_search_location() {
    register_widget( 'nokri_search_location' );
}
add_action( 'widgets_init', 'nokri_search_location' );


/* ========================= */
/* Candidate Title widget In Search*/
/* ========================= */


class nokri_search_candidate extends WP_Widget {
/** Register widget with WordPress */
function __construct() {
		parent::__construct(
			'nokri_search_candidate', // Base ID
			esc_html__( 'Search by candidate  title', 'nokri' ), // Name
			array( 'description' => esc_html__( 'Get candidate by title', 'nokri' ), ) // Args
						    );
					   }
     /**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		
		global $nokri;
		 $title	=	'';
		 $in  = '';
		 if(isset($instance['is_open'] ) && $instance['is_open'] == 'open' )
		 {
			 $in = 'in';
		 }
		if( isset( $_GET['cand_title'] ) && $_GET['cand_title'] != "" )
		{
			$title	=	$_GET['cand_title'];
			$in     = 'in';
		}
		 ?>				
         <div class="panel panel-default">
        <div class="panel-heading active" role="tab">
            <a role="button" data-toggle="collapse" href="#search-widget">
              <?php echo ($instance['title'] ); ?>
            </a>
        </div>
        <div id="search-widget" class="panel-collapse collapse <?php echo esc_attr($in); ?>" role="tabpanel" >
          <div class="panel-body">
            <form role="search" method="get" action = "<?php echo get_the_permalink($nokri['candidates_search_page']); ?>">
                <div class="form-group">
                     <input type="text"  class="form-control" value="<?php echo esc_html($title); ?>" name="cand_title" placeholder="<?php echo esc_html__('Search Here','nokri') ?>" >
                </div>
                <div class="form-group form-action">
                <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                </div>
                  <?php echo nokri_search_params( 'cand_title' ); ?>
            </form>
          </div>
        </div>
      </div>
              <?php 
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
	$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'nokri' );
	/* Seting Open Or Not*/
	$is_open = ! empty( $instance['is_open'] ) ? $instance['is_open'] : esc_html__( 'Select Widget Type', 'nokri' );
	?>
	<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'nokri' ); ?></label> 
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
	</p>
    <!--Open/Close  --->
    <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'is_open' ) ); ?>"><?php esc_attr_e( 'Set Widget', 
'nokri' ); ?>
		</label> 
        <select name="<?php echo esc_attr( $this->get_field_name( 'is_open' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'is_open' ) ); ?>" class="widefat">
        <option value="open" <?php if ( $is_open == 'open') { echo "selected"; } ; ?> ><?php echo esc_html__( 'Open', 'nokri' ); ?></option>
        <option value="close" <?php if ( $is_open == 'close') { echo "selected"; } ; ?> ><?php echo esc_html__( 'Close', 'nokri' ); ?></option>    				
		</select>
        </p>
	<?php 
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
	$instance = array();
	$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
	/* Save open/close*/
	$instance['is_open'] = ( ! empty( $new_instance['is_open'] ) ) ? strip_tags( $new_instance['is_open'] ) : ''; 
	return $instance;
	}
	} 

// register Foo_Widget widget
function nokri_search_candidate() {
	register_widget( 'nokri_search_candidate' );
}
add_action( 'widgets_init', 'nokri_search_candidate' );

/* ========================= */
/*  Candidates Type widget   */
/* ========================= */


class nokri_search_candidate_type extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'nokri_search_candidate_type', // Base ID
			esc_html__( 'Search by candidate type', 'nokri' ), // Name
			array( 'description' => esc_html__( 'Show All candidate type', 'nokri' ), ) // Args
		);
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		 $max_record	=   $instance['no_of_records']  ? $instance['no_of_records'] : 3;
		 
		
       /*  Select Country,  City, State */
		$search_types	=	nokri_get_cats('job_type' , 0 );
		if( count((array) $search_types ) > 0 )
		 {
		$type_html	=	'';
		$count	=	1;
		$cls	=	'';
		$showed	=	false;
		$cur_cls	=	'sb_type';
		$is_run 	=	true;
		foreach( $search_types as $search_type )
		{
			$selected	=	'';
			if ( isset( $_GET['cand_type'] ) && $_GET['cand_type'] == $search_type->term_id) 
			{
					$selected = 'checked = "checked"';
			}
			if( $count > $max_record && $is_run)
			{
				$cls	=	'hide_type hide_li';
				$showed = true;
				$is_run	=	false;
			}
			if( $showed )
			{
				$showed	=	false;
				$type_html	.=	'<li class="show-more hide_now_'.esc_attr( $cur_cls ).'"><small><a href="javascript:void(0);" class="show_records" data-attr-id="hide_type" data-attr-hide="'.esc_attr( $cur_cls ).'">'.__('Show more','nokri').'</a></small></li>';	
			}
			$type_html	.=	'<li class="'.esc_attr( $cls ) .'"><input class="input-icheck input-icheck-search cand_type_form" '.esc_attr($selected).' value="'.esc_attr($search_type->term_id).'" type="radio"  name="cand_type"> <label>' .esc_html( $search_type->name ).'</label></li>';
			$count++;
		}
		global $nokri;
		$in  = '';
		 if(isset($instance['is_open'] ) && $instance['is_open'] == 'open' )
		 {
			 $in = 'in';
		 }
		if( isset( $_GET['cand_type'] ) && $_GET['cand_type'] != "" )
		{
			$in     = 'in';
		}
		?>
        <div class="panel panel-default">
        <div class="panel-heading active" role="tab" >
            <a role="button" data-toggle="collapse" href="#cand_job_type">
            <?php echo "".$instance['title']; ?>
            </a>
        </div>
        <div id="cand_job_type"  class="panel-collapse collapse <?php echo esc_attr($in);?>" role="tabpanel">
        <form method="get" id="cand_type_form"  action="<?php echo get_the_permalink( $nokri['candidates_search_page'] ); ?>">
          <div class="panel-body">
            <ul class="list">
              <?php echo "".($type_html);?>
           </ul>
          </div>
          <?php echo nokri_search_params( 'cand_type' ); ?>
          </form>
          
        </div>
      </div>     
		<?php 
		 }
		 /* Number Of Records */
		$no_of_records = ! empty( $instance['no_of_records'] ) ? $instance['no_of_records'] : esc_html__( 'Select Number', 'nokri' );
}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'nokri' );
		/* Seting Open Or Not*/
		$is_open = ! empty( $instance['is_open'] ) ? $instance['is_open'] : esc_html__( 'Select Widget Type', 'nokri' );
		/* Number Of Records */
		$no_of_records = ! empty( $instance['no_of_records'] ) ? $instance['no_of_records'] : esc_html__( 'Select Number', 'nokri' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 

'nokri' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo 

esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
        <!--Open/close  --->
        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'is_open' ) ); ?>"><?php esc_attr_e( 'Set Widget', 
'nokri' ); ?>
		</label> 
        <select name="<?php echo esc_attr( $this->get_field_name( 'is_open' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'is_open' ) ); ?>" class="widefat">
        <option value="open" <?php if ( $is_open == 'open') { echo "selected"; } ; ?> ><?php echo esc_html__( 'Open', 'nokri' ); ?></option>
        <option value="close" <?php if ( $is_open == 'close') { echo "selected"; } ; ?> ><?php echo esc_html__( 'Close', 'nokri' ); ?></option>    				
		</select>
        </p>
       <!--Number Of Records  --->
        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'no_of_records' ) ); ?>"><?php esc_attr_e( 'By Default Number of Records:', 

'nokri' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'no_of_records' ) ); ?>" name="<?php echo 

esc_attr( $this->get_field_name( 'no_of_records' ) ); ?>" type="number" value="<?php echo esc_attr( $no_of_records ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		/* Save open/close*/
		$instance['is_open'] = ( ! empty( $new_instance['is_open'] ) ) ? strip_tags( $new_instance['is_open'] ) : '';
		/* Save Number Of Records*/
		$instance['no_of_records'] = ( ! empty( $new_instance['no_of_records'] ) ) ? strip_tags( $new_instance['no_of_records'] ) : '';
		return $instance;
		
	}

} 
// register nokri Widget widget
function nokri_search_candidate_type() {
    register_widget( 'nokri_search_candidate_type' );
}
add_action( 'widgets_init', 'nokri_search_candidate_type' );

/* ========================= */
/*  Candidates Level widget   */
/* ========================= */


class nokri_search_candidate_level extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'nokri_search_candidate_level', // Base ID
			esc_html__( 'Search by candidate level', 'nokri' ), // Name
			array( 'description' => esc_html__( 'Show candidates by level', 'nokri' ), ) // Args
		);
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	     public function widget( $args, $instance ) {
		/* Number Of Records */
		$no_of_records = ! empty( $instance['no_of_records'] ) ? $instance['no_of_records'] : esc_html__( 'Select Number', 'nokri' );
       /*  Select Country,  City, State */
		$search_types	=	nokri_get_cats('job_level' , 0 );
		if( count((array) $search_types ) > 0 )
		 {
		$type_html	=	 '';
		$count	    =	1;
		$showed     =   false;
		$cls	    =	'';
		$cur_cls	=	'sb_level';
		$is_run 	=	true;
		foreach( $search_types as $search_type )
		{
			$selected	=	'';
			if ( isset( $_GET['cand_level'] ) && $_GET['cand_level'] == $search_type->term_id) 
			{
					 $selected = 'checked = "checked"';
			}
			if( $count > $no_of_records && $is_run )
			{
				$cls	=	'hide_level hide_li';
				$showed = true;
				$is_run	=	false;
			}
			if( $showed )
			{
				$showed	=	false;
				$type_html	.=	'<li class="show-more hide_now_'.esc_attr( $cur_cls ).'"><small><a href="javascript:void(0);" class="show_records" data-attr-id="hide_level" data-attr-hide="'.esc_attr( $cur_cls ).'">'.__('Show more','nokri').'</a></small></li>';	
			}

			
			$type_html	.=	'<li class="'.esc_attr( $cls ).'"><input class="input-icheck input-icheck-search cand_level_form" '.esc_attr($selected).' value="'.esc_attr($search_type->term_id).'" type="radio"  name="cand_level"> <label>' .esc_html( $search_type->name ).'</label></li>';
			$count++;
		}
		global $nokri;
		$in  = '';
		 if(isset($instance['is_open'] ) && $instance['is_open'] == 'open' )
		 {
			 $in = 'in';
		 }
		if( isset( $_GET['cand_level'] ) && $_GET['cand_level'] != "" )
		{
			$in     = 'in';
		}
		?>
        <div class="panel panel-default">
        <div class="panel-heading active" role="tab" >
            <a role="button" data-toggle="collapse" href="#cand_job_level">
            <?php echo "".$instance['title']; ?>
            </a>
        </div>
        <div id="cand_job_level" class="panel-collapse collapse <?php echo esc_attr($in);?>" role="tabpanel">
        <form method="get" id="cand_level_form" class="search_candidates_form" action="<?php echo get_the_permalink( $nokri['candidates_search_page'] ); ?>">
          <div class="panel-body">
            <ul class="list">
              <?php echo "".($type_html);?>
           </ul>
          </div>
           <?php echo nokri_search_params( 'cand_level' ); ?>
          </form>
         
        </div>
      </div>     
		<?php 
		 }
}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'nokri' );
		/* Seting Open Or Not*/
		$is_open = ! empty( $instance['is_open'] ) ? $instance['is_open'] : esc_html__( 'Select Widget Type', 'nokri' );
		/* Number Of Records */
		$no_of_records = ! empty( $instance['no_of_records'] ) ? $instance['no_of_records'] : esc_html__( 'Select Number', 'nokri' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 

'nokri' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo 

esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
        <!--Open/close  --->
        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'is_open' ) ); ?>"><?php esc_attr_e( 'Set Widget', 
'nokri' ); ?>
		</label> 
        <select name="<?php echo esc_attr( $this->get_field_name( 'is_open' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'is_open' ) ); ?>" class="widefat">
        <option value="open" <?php if ( $is_open == 'open') { echo "selected"; } ; ?> ><?php echo esc_html__( 'Open', 'nokri' ); ?></option>
        <option value="close" <?php if ( $is_open == 'close') { echo "selected"; } ; ?> ><?php echo esc_html__( 'Close', 'nokri' ); ?></option>    				
		</select>
        </p>
        <!-- Number of records  --->
        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'no_of_records' ) ); ?>"><?php esc_attr_e( 'By Default Number of Records:', 

'nokri' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'no_of_records' ) ); ?>" name="<?php echo 

esc_attr( $this->get_field_name( 'no_of_records' ) ); ?>" type="number" value="<?php echo esc_attr( $no_of_records ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		/* Save open/close*/
		$instance['is_open'] = ( ! empty( $new_instance['is_open'] ) ) ? strip_tags( $new_instance['is_open'] ) : '';
		/* Save Number Of Records*/
		$instance['no_of_records'] = ( ! empty( $new_instance['no_of_records'] ) ) ? strip_tags( $new_instance['no_of_records'] ) : '';
		return $instance;
	}

} 
// register nokri Widget widget
function nokri_search_candidate_level() {
    register_widget( 'nokri_search_candidate_level' );
}
add_action( 'widgets_init', 'nokri_search_candidate_level' );

/* ========================= */
/*  Candidates Experience widget   */
/* ========================= */


class nokri_search_candidate_experience extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'nokri_search_candidate_experience', // Base ID
			esc_html__( 'Search by candidate experience', 'nokri' ), // Name
			array( 'description' => esc_html__( 'Show candidates by level', 'nokri' ), ) // Args
		);
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	     public function widget( $args, $instance ) {
		/* Number Of Records */
		$no_of_records = ! empty( $instance['no_of_records'] ) ? $instance['no_of_records'] : esc_html__( 'Select Number', 'nokri' );
       /*  Select Country,  City, State */
		$search_types	=	nokri_get_cats('job_experience' , 0 );
		if( count((array) $search_types ) > 0 )
		 {
		$type_html	=	 '';
		$count	    =	1;
		$showed     =   false;
		$cls	    =	'';
		$cur_cls	=	'sb_experience';
		$is_run 	=	true;
		foreach( $search_types as $search_type )
		{
			$selected	=	'';
			if ( isset( $_GET['cand_experience'] ) && $_GET['cand_experience'] == $search_type->term_id) 
			{
					 $selected = 'checked = "checked"';
			}
			if( $count > $no_of_records && $is_run )
			{
				$cls	=	'hide_experience hide_li';
				$showed = true;
				$is_run	=	false;
			}
			if( $showed )
			{
				$showed	=	false;
				$type_html	.=	'<li class="show-more show-more hide_now_'.esc_attr( $cur_cls ).'"><small><a href="javascript:void(0);" class="show_records" data-attr-id="hide_experience" data-attr-hide="'.esc_attr( $cur_cls ).'">'.__('Show more','nokri').'</a></small></li>';	
			}

			
			$type_html	.=	'<li class="'.esc_attr( $cls ).'"><input class="input-icheck input-icheck-search cand_experience_form" '.esc_attr($selected).' value="'.esc_attr($search_type->term_id).'" type="radio"  name="cand_experience"> <label>' .esc_html( $search_type->name ).'</label></li>';
			$count++;
		}
		global $nokri;
		$in  = '';
		 if(isset($instance['is_open'] ) && $instance['is_open'] == 'open' )
		 {
			 $in = 'in';
		 }
		if( isset( $_GET['cand_experience'] ) && $_GET['cand_experience'] != "" )
		{
			$in     = 'in';
		}
		?>
        <div class="panel panel-default">
        <div class="panel-heading active" role="tab" >
            <a role="button" data-toggle="collapse" href="#cand_job_experience">
            <?php echo "".$instance['title']; ?>
            </a>
        </div>
        <div id="cand_job_experience" class="panel-collapse collapse <?php echo esc_attr($in);?>" role="tabpanel">
        <form method="get" id="cand_experience_form" class="search_candidates_form" action="<?php echo get_the_permalink( $nokri['candidates_search_page'] ); ?>">
          <div class="panel-body">
            <ul class="list">
              <?php echo "".($type_html);?>
           </ul>
          </div>
           <?php echo nokri_search_params( 'cand_experience' ); ?>
          </form>
         
        </div>
      </div>     
		<?php 
		 }
}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'nokri' );
		/* Seting Open Or Not*/
		$is_open = ! empty( $instance['is_open'] ) ? $instance['is_open'] : esc_html__( 'Select Widget Type', 'nokri' );
		/* Number Of Records */
		$no_of_records = ! empty( $instance['no_of_records'] ) ? $instance['no_of_records'] : esc_html__( 'Select Number', 'nokri' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 

'nokri' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo 

esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
        <!--Open/close  --->
        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'is_open' ) ); ?>"><?php esc_attr_e( 'Set Widget', 
'nokri' ); ?>
		</label> 
        <select name="<?php echo esc_attr( $this->get_field_name( 'is_open' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'is_open' ) ); ?>" class="widefat">
        <option value="open" <?php if ( $is_open == 'open') { echo "selected"; } ; ?> ><?php echo esc_html__( 'Open', 'nokri' ); ?></option>
        <option value="close" <?php if ( $is_open == 'close') { echo "selected"; } ; ?> ><?php echo esc_html__( 'Close', 'nokri' ); ?></option>    				
		</select>
        </p>
        <!-- Number of records  --->
        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'no_of_records' ) ); ?>"><?php esc_attr_e( 'By Default Number of Records:', 

'nokri' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'no_of_records' ) ); ?>" name="<?php echo 

esc_attr( $this->get_field_name( 'no_of_records' ) ); ?>" type="number" value="<?php echo esc_attr( $no_of_records ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		/* Save open/close*/
		$instance['is_open'] = ( ! empty( $new_instance['is_open'] ) ) ? strip_tags( $new_instance['is_open'] ) : '';
		/* Save Number Of Records*/
		$instance['no_of_records'] = ( ! empty( $new_instance['no_of_records'] ) ) ? strip_tags( $new_instance['no_of_records'] ) : '';
		return $instance;
	}

} 
// register nokri Widget widget
function nokri_search_candidate_experience() {
    register_widget( 'nokri_search_candidate_experience' );
}
add_action( 'widgets_init', 'nokri_search_candidate_experience' );

/* ========================= */
/*  Candidates skill widget  */
/* ========================= */


class nokri_search_candidate_skills extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'nokri_search_candidate_skills', // Base ID
			esc_html__( 'Search by candidate skills', 'nokri' ), // Name
			array( 'description' => esc_html__( 'Show candidate by skills', 'nokri' ), ) // Args
		);
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		/* Number Of Records */
		$no_of_records = ! empty( $instance['no_of_records'] ) ? $instance['no_of_records'] : esc_html__( 'Select Number', 'nokri' );
       /*  Select Country,  City, State */
		$search_types	=	nokri_get_cats('job_skills' , 0 );
		if( count((array) $search_types ) > 0 )
		 {
		$skill_html	=	'';
		$count	=	1;
		$cls	=	'';
		$showed	=	false;
		$cur_cls	=	'sb_skills';
		$is_run 	=	true;
		foreach( $search_types as $search_type )
		{
			$selected	=	'';
			if ( isset( $_GET['cand_skills'] ) && $_GET['cand_skills'] == $search_type->term_id) 
			{
					$selected = 'checked = "checked"';
			}
			
			if( $count > $no_of_records && $is_run )
			{
				$cls	=	'hide_skills hide_li';
				$showed = true;
				$is_run	=	false;
			}
			if( $showed )
			{
				$showed	=	false;
				$skill_html	.=	'<li class="show-more hide_now_'.esc_attr( $cur_cls ).'"><small><a href="javascript:void(0);" class="show_records" data-attr-id="hide_skills" data-attr-hide="'.esc_attr( $cur_cls ).'">'.__('Show more','nokri').'</a></small></li>';	
			}
			
			$skill_html	.=	'<li class="'.esc_attr( $cls ).'"><input class="input-icheck input-icheck-search cand_skills_form" '.esc_attr($selected).' value="'.esc_attr($search_type->term_id).'" type="radio"  name="cand_skills"> <label>' .esc_html( $search_type->name ).'</label></li>';
			$count++;
		}
		global $nokri;
		$in  = '';
		 if(isset($instance['is_open'] ) && $instance['is_open'] == 'open' )
		 {
			 $in = 'in';
		 }
		if( isset( $_GET['cand_skills'] ) && $_GET['cand_skills'] != "" )
		{
			$in     = 'in';
		}
		?>
        <div class="panel panel-default">
        <div class="panel-heading active" role="tab" >
            <a role="button" data-toggle="collapse" href="#cand_job_skills">
            <?php echo "".$instance['title']; ?>
            </a>
        </div>
        <div id="cand_job_skills"  class="panel-collapse collapse <?php echo esc_attr($in);?>" role="tabpanel">
        <form method="get" id="cand_skills_form"  action="<?php echo get_the_permalink( $nokri['candidates_search_page'] ); ?>">
          <div class="panel-body">
            <ul class="list">
              <?php echo "".($skill_html);?>
           </ul>
          </div>
          <?php echo nokri_search_params( 'cand_skills' ); ?>
          </form>
          
        </div>
      </div>     
		<?php 
		 }
}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'nokri' );
		/* Seting Open Or Not*/
		$is_open = ! empty( $instance['is_open'] ) ? $instance['is_open'] : esc_html__( 'Select Widget Type', 'nokri' );
		/* Number Of Records */
		$no_of_records = ! empty( $instance['no_of_records'] ) ? $instance['no_of_records'] : esc_html__( 'Select Number', 'nokri' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 

'nokri' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo 

esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
        <!--Open/close  --->
        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'is_open' ) ); ?>"><?php esc_attr_e( 'Set Widget', 
'nokri' ); ?>
		</label> 
        <select name="<?php echo esc_attr( $this->get_field_name( 'is_open' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'is_open' ) ); ?>" class="widefat">
        <option value="open" <?php if ( $is_open == 'open') { echo "selected"; } ; ?> ><?php echo esc_html__( 'Open', 'nokri' ); ?></option>
        <option value="close" <?php if ( $is_open == 'close') { echo "selected"; } ; ?> ><?php echo esc_html__( 'Close', 'nokri' ); ?></option>    				
		</select>
        </p>
        <!--Number of records --->
        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'no_of_records' ) ); ?>"><?php esc_attr_e( 'By Default Number of Records:', 

'nokri' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'no_of_records' ) ); ?>" name="<?php echo 

esc_attr( $this->get_field_name( 'no_of_records' ) ); ?>" type="number" value="<?php echo esc_attr( $no_of_records ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		/* Save open/close*/
		$instance['is_open'] = ( ! empty( $new_instance['is_open'] ) ) ? strip_tags( $new_instance['is_open'] ) : '';
		/* Save Number Of Records*/
		$instance['no_of_records'] = ( ! empty( $new_instance['no_of_records'] ) ) ? strip_tags( $new_instance['no_of_records'] ) : '';
		return $instance;
	}

} 
// register nokri Widget widget
function nokri_search_candidate_skills() {
    register_widget( 'nokri_search_candidate_skills' );
}
add_action( 'widgets_init', 'nokri_search_candidate_skills' );

/* ========================= */
/*  blog search widget  */
/* ========================= */

/*Adds search_Widget widget */
class nokri_search_blogs extends WP_Widget {
/** Register widget with WordPress */
function __construct() {
		parent::__construct(
			'nokri_search', // Base ID
			esc_html__( 'blog posts Search', 'nokri' ), // Name
			array( 'description' => esc_html__( 'Show Search Box', 'nokri' ), ) // Args
						    );
					   }
     /**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.rss
	 */
	public function widget( $args, $instance ) {
		echo ($args['before_widget']);
		if ( ! empty( $instance['title'] ) ) {
			echo ($args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title']);
		}
		 ?>
			
          <div class="search-blog">
         <form role="search" method="get" id="search-form" action="<?php echo home_url( '/' ); ?>">
           <div class="input-group stylish-input-group">
              <input  class="form-control" type="text"  value="<?php the_search_query(); ?>" name="s" id="s" placeholder="<?php echo esc_html__( 'Search here', 'nokri' ); ?>" >
              <span class="input-group-addon">
              <button type="submit" id="search-submit"> <span class="fa fa-search"></span> </button>
              </span> 
           </div>
            </form> 
        </div>   
         
		<?php 
		echo ( $args['after_widget'] ); 
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
	$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'nokri' );
	?>
	<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'nokri' ); ?></label> 
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
	</p>
	<?php 
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
	$instance = array();
	$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
	return $instance;
	}
	} 

// register Foo_Widget widget
function nokri_search_blogs() {
	register_widget( 'nokri_search_blogs' );
}
add_action( 'widgets_init', 'nokri_search_blogs' );

/* ========================= */
/*  Add recent Posts widget */
/* ========================= */


class nokri_popular_posts extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'nokri_popular_posts', // Base ID
			esc_html__( 'Recent Blog posts ', 'nokri' ), // Name
			array( 'description' => esc_html__( 'Show Your Blog Posts ', 'nokri' ), ) // Args
		);
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo ($args['before_widget']);
		if ( ! empty( $instance['title'] ) ) {
			echo ($args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title']);
		}
		?>
        <ul class="related-post">
        <?php 
		 $limits_pops 		= ( ! empty( $instance['limits_pops'] ) ) ? $instance['limits_pops'] : '5';
		$popularpost 		= new WP_Query( array(
		'posts_per_page' 	=> $limits_pops, 
		'order'				 => 'DESC'
		 ) );
		 
		while ( $popularpost->have_posts() ) : $popularpost->the_post();
		$pid = get_the_ID();
		?>
          <li> 		<?php if ( has_post_thumbnail() ) { ?>
                    <div class="recent-ads-list-image">
                        <a href="<?php esc_url (the_permalink($pid)); ?>" class="recent-ads-list-image-inner"><?php the_post_thumbnail('nokri_thumb_100',array('class'=>'img-responsive')); ?></a>
                    </div>
                    <?php } ?>
                    <div class="recent-ads-list-content">
                       <a href="<?php the_permalink(); ?>"><?php echo  wp_trim_words( get_the_title(), 7, '...' ); ?></a>
                        <span><i class="fa fa-calendar"></i><?php the_time(get_option( 'date_format' )); ?> </span>
                    </div>
                </li>
       <?php
       endwhile; 
      wp_reset_query();
      ?>
      </ul>
	<?php 
	echo ($args['after_widget']);
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'nokri' );
		/* Second Field */
		$limits_pops = ! empty( $instance['limits_pops'] ) ? $instance['limits_pops'] : esc_html__( 'Post No', 'nokri' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'nokri' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
        <!-- Second Field  --->
       <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'limits_pops' ) ); ?>"><?php esc_attr_e( 'No Of Posts ', 

'nokri' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'limits_pops' ) ); ?>" name="<?php echo 

esc_attr( $this->get_field_name( 'limits_pops' ) ); ?>" type="number" value="<?php echo esc_attr( $limits_pops); ?>">
		</p>
		<p>
		<?php 
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		/* Second Feild */
		$instance['limits_pops'] = ( ! empty( $new_instance['limits_pops'] ) ) ? strip_tags( $new_instance['limits_pops'] ) : '';

		return $instance;
	}

}
// register Popular Posts widget
function nokri_popular_posts() {
    register_widget( 'nokri_popular_posts' );
}
add_action( 'widgets_init', 'nokri_popular_posts' );

/* ========================= */
/* Employer Title widget In Search*/
/* ========================= */
class nokri_search_employer extends WP_Widget {
/** Register widget with WordPress */
function __construct() {
		parent::__construct(
			'nokri_search_employer', // Base ID
			esc_html__( 'Search by employer  title', 'nokri' ), // Name
			array( 'description' => esc_html__( 'Get employer by title', 'nokri' ), ) // Args
						    );
					   }
     /**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		
		global $nokri;
		 $title	=	'';
		 $in  = '';
		 if(isset($instance['is_open'] ) && $instance['is_open'] == 'open' )
		 {
			 $in = 'in';
		 }
		if( isset( $_GET['emp_title'] ) && $_GET['emp_title'] != "" )
		{
			$title	=	$_GET['emp_title'];
			$in     = 'in';
		}
		 ?>				
         <div class="panel panel-default">
        <div class="panel-heading active" role="tab">
            <a role="button" data-toggle="collapse" href="#search-widget">
              <?php echo ($instance['title'] ); ?>
            </a>
        </div>
        <div id="search-widget" class="panel-collapse collapse <?php echo esc_attr($in); ?>" role="tabpanel" >
          <div class="panel-body">
            <form role="search" method="get" action = "<?php echo get_the_permalink($nokri['employer_search_page']); ?>">
                <div class="form-group">
                     <input type="text"  class="form-control" value="<?php echo esc_html($title); ?>" name="emp_title" placeholder="<?php echo esc_html__('Search Here','nokri') ?>" >
                </div>
                <div class="form-group form-action">
                <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                </div>
                  <?php echo nokri_search_params( 'emp_title' ); ?>
            </form>
          </div>
        </div>
      </div>
              <?php 
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
	$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'nokri' );
	/* Seting Open Or Not*/
	$is_open = ! empty( $instance['is_open'] ) ? $instance['is_open'] : esc_html__( 'Select Widget Type', 'nokri' );
	?>
	<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'nokri' ); ?></label> 
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
	</p>
    <!--Open/Close  --->
    <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'is_open' ) ); ?>"><?php esc_attr_e( 'Set Widget', 
'nokri' ); ?>
		</label> 
        <select name="<?php echo esc_attr( $this->get_field_name( 'is_open' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'is_open' ) ); ?>" class="widefat">
        <option value="open" <?php if ( $is_open == 'open') { echo "selected"; } ; ?> ><?php echo esc_html__( 'Open', 'nokri' ); ?></option>
        <option value="close" <?php if ( $is_open == 'close') { echo "selected"; } ; ?> ><?php echo esc_html__( 'Close', 'nokri' ); ?></option>    				
		</select>
        </p>
	<?php 
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
	$instance = array();
	$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
	/* Save open/close*/
	$instance['is_open'] = ( ! empty( $new_instance['is_open'] ) ) ? strip_tags( $new_instance['is_open'] ) : ''; 
	return $instance;
	}
	} 

// register Foo_Widget widget
function nokri_search_employer() {
	register_widget( 'nokri_search_employer' );
}
add_action( 'widgets_init', 'nokri_search_employer' );

/* ========================= */
/* Employer Advertisement widget In Search*/
/* ========================= */
class nokri_advertisement_widget extends WP_Widget {
/** Register widget with WordPress */
function __construct() {
		parent::__construct(
			'nokri_advertisement_widget', // Base ID
			esc_html__( 'Advertisement widget', 'nokri' ), // Name
			array( 'description' => esc_html__( 'Get advertisement widget', 'nokri' ), ) // Args
						    );
					   }
     /**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		
		$in  = '';
		 if(isset($instance['is_open'] ) && $instance['is_open'] == 'open' )
		 {
			 $in = 'in';
		 }
		global $nokri;
		 ?>				
         <div class="panel panel-default">
        <div class="panel-heading active" role="tab">
            <a role="button" data-toggle="collapse" href="#advertisment-widget">
              <?php echo ($instance['title'] ); ?>
            </a>
        </div>
        <div id="advertisment-widget" class="panel-collapse collapse <?php echo esc_attr($in); ?>" role="tabpanel" >
          <div class="panel-body">
            <?php echo "".($instance['source_img'] ); ?>
          </div>
        </div>
      </div>
              <?php 
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
	$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'nokri' );
	/* Source image*/
	$source_img = ! empty( $instance['source_img'] ) ? $instance['source_img'] : '';
	/* Seting Open Or Not*/
	$is_open = ! empty( $instance['is_open'] ) ? $instance['is_open'] : esc_html__( 'Select Widget Type', 'nokri' );
	?>
	<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'nokri' ); ?></label> 
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
	</p>
    <!--Source image --->
    <p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'source_img' ) ); ?>"><?php esc_attr_e( 'Paste source:', 'nokri' ); ?></label> 	<textarea rows="4" cols="50"  id="<?php echo esc_attr( $this->get_field_id( 'source_img' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'source_img' ) ); ?>"><?php echo esc_attr( $source_img ); ?></textarea>
	</p>
    <!--Open/Close  --->
    <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'is_open' ) ); ?>"><?php esc_attr_e( 'Set Widget', 
'nokri' ); ?>
		</label> 
        <select name="<?php echo esc_attr( $this->get_field_name( 'is_open' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'is_open' ) ); ?>" class="widefat">
        <option value="open" <?php if ( $is_open == 'open') { echo "selected"; } ; ?> ><?php echo esc_html__( 'Open', 'nokri' ); ?></option>
        <option value="close" <?php if ( $is_open == 'close') { echo "selected"; } ; ?> ><?php echo esc_html__( 'Close', 'nokri' ); ?></option>    				
		</select>
        </p>
	<?php 
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
	$instance = array();
	$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
	/* Save Source image*/
	$instance['source_img'] = ( ! empty( $new_instance['source_img'] ) ) ? ( $new_instance['source_img'] ) : '';
	/* Save open/close*/
	$instance['is_open'] = ( ! empty( $new_instance['is_open'] ) ) ? strip_tags( $new_instance['is_open'] ) : '';  
	return $instance;
	}
	} 

// register Foo_Widget widget
function nokri_advertisement_widget() {
	register_widget( 'nokri_advertisement_widget' );
}
add_action( 'widgets_init', 'nokri_advertisement_widget' );


add_action( 'widgets_init', function(){
     register_widget( 'nokri_listing_blog_posts' );
});
if (! class_exists ( 'nokri_listing_blog_posts' )) {
class nokri_listing_blog_posts extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		// Instantiate the parent object
		parent::__construct( false, 'Nokri Recent Blog Posts' );
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		global $post;
		if($instance['nokri_listing_post_no'] == "" )
		{
			$instance['nokri_listing_post_no']	=	5;	
		}
		$args = array( 'post_type' => 'post', 'posts_per_page' => $instance['nokri_listing_post_no'], 'orderby' => 'date', 'order' => 'DESC');
		$recent_posts = get_posts( $args );
		

	?>
    <div class="widget">
                           <div class="widget-heading">
                              <h4 class="panel-title"><?php echo esc_html( $instance['title'] ); ?></h4>
                           </div>
                           <div class="recent-ads">
                           <?php foreach ( $recent_posts as $recent_post ): ?>
                              <div class="recent-ads-list">
                                 <div class="recent-ads-container">
                                 <?php if ( has_post_thumbnail( $recent_post->ID ) ):
									  $get_img_src = '';
									  $get_img_src =	nokri_get_feature_image( $recent_post->ID, 'nokri_blog_recent_post');
								  ?>
                                    <div class="recent-ads-list-image">
                                       <a href="#" class="recent-ads-list-image-inner">
                                       <img src="<?php echo esc_url( $get_img_src[0] ); ?>" alt="<?php echo "".( get_the_title( $recent_post->ID ) ); ?>">
                                       </a>
                                    </div>
                                 <?php endif; ?>	   
                                    <div class="recent-ads-list-content">
                                       <h3 class="recent-ads-list-title">
                                          <a href="<?php echo esc_url( get_the_permalink( $recent_post->ID ) ); ?>"><?php echo esc_html( get_the_title( $recent_post->ID ) ); ?></a>
                                       </h3>
                                       <ul class="recent-ads-list-location">
                                       <?php
									     $category = '';
									  	 $category = get_the_category( $recent_post->ID );
									   ?>
                                          <li><a href="<?php echo esc_url( get_category_link(  $category[0]->cat_ID ) ); ?>"><?php echo ''.$category[0]->cat_name; ?></a></li>
                                       </ul>
                                    </div>
                                 </div>
                              </div>
							<?php endforeach; ?>	  
                           </div>
                        </div>
    <?php
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = esc_html__( 'Nokri Recent Blog Posts', 'nokri' );
		}
		if ( isset( $instance[ 'nokri_listing_post_no' ] ) ) {
			$nokri_listing_post_no = $instance[ 'nokri_listing_post_no' ];
		}
		else {
			$nokri_listing_post_no = 5;
		}
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" >
            <?php echo esc_html__( 'Title:', 'nokri' ); ?>
            </label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'nokri_listing_post_no' ) ); ?>">
			<?php esc_html__( 'How many posts to display:', 'nokri' ); ?>
            </label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'nokri_listing_post_no' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'nokri_listing_post_no' ) ); ?>" type="text" value="<?php echo esc_attr( $nokri_listing_post_no ); ?>">
		</p>
		<?php 
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['nokri_listing_post_no'] = ( ! empty( $new_instance['nokri_listing_post_no'] ) ) ? strip_tags( $new_instance['nokri_listing_post_no'] ) : '';
		return $instance;
	}
} // Recent Posts
}