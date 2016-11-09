<?php
/**
 * SSM Courses
 *
 * @package   SSM_Courses
 * @license   GPL-2.0+
 */

/**
 * Register post types and taxonomies.
 *
 * @package SSM_Courses
 */
class SSM_Courses_Registrations {

	public $post_type = 'course';

	public $taxonomies = array( 'course-category' );

	public function init() {
		// Add the SSM Courses and taxonomies
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Initiate registrations of post type and taxonomies.
	 *
	 * @uses SSM_Courses_Registrations::register_post_type()
	 * @uses SSM_Courses_Registrations::register_taxonomy_category()
	 */
	public function register() {
		$this->register_post_type();
		$this->register_taxonomy_category();
	}

	/**
	 * Register the custom post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	protected function register_post_type() {
		$labels = array(
			'name'               => __( 'Courses', 'ssm-courses' ),
			'singular_name'      => __( 'Course', 'ssm-courses' ),
			'add_new'            => __( 'Add Course', 'ssm-courses' ),
			'add_new_item'       => __( 'Add Course', 'ssm-courses' ),
			'edit_item'          => __( 'Edit Course', 'ssm-courses' ),
			'new_item'           => __( 'New Course', 'ssm-courses' ),
			'view_item'          => __( 'View Course', 'ssm-courses' ),
			'search_items'       => __( 'Search Courses', 'ssm-courses' ),
			'not_found'          => __( 'No courses found', 'ssm-courses' ),
			'not_found_in_trash' => __( 'No courses in the trash', 'ssm-courses' ),
		);

		$supports = array(
			'title',
			'thumbnail',
			'page-attributes'
		);

		$args = array(
			'labels'          		=> $labels,
			'supports'        		=> $supports,
			'public'          		=> true,
			'capability_type' 		=> 'page',
			'publicly_queriable'	=> true,
			'show_ui' 						=> true,
			'show_in_nav_menus' 	=> true,
			'rewrite'         		=> array( 'slug' => 'courses', ),
			'menu_position'   		=> 30,
			'menu_icon'       		=> 'dashicons-welcome-learn-more',
			'has_archive'					=> 'courses',
			'exclude_from_search'	=> false,
		);

		$args = apply_filters( 'ssm_courses_args', $args );

		register_post_type( $this->post_type, $args );
	}

	/**
	 * Register a taxonomy for Project Categories.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	protected function register_taxonomy_category() {
		$labels = array(
			'name'                       => __( 'Course Categories', 'ssm-courses' ),
			'singular_name'              => __( 'Course Category', 'ssm-courses' ),
			'menu_name'                  => __( 'Categories', 'ssm-courses' ),
			'edit_item'                  => __( 'Edit Course Category', 'ssm-courses' ),
			'update_item'                => __( 'Update Course Category', 'ssm-courses' ),
			'add_new_item'               => __( 'Add New Course Category', 'ssm-courses' ),
			'new_item_name'              => __( 'New Course Category Name', 'ssm-courses' ),
			'parent_item'                => __( 'Parent Course Category', 'ssm-courses' ),
			'parent_item_colon'          => __( 'Parent Course Category:', 'ssm-courses' ),
			'all_items'                  => __( 'All Course Categories', 'ssm-courses' ),
			'search_items'               => __( 'Search Course Categories', 'ssm-courses' ),
			'popular_items'              => __( 'Popular Course Categories', 'ssm-courses' ),
			'separate_items_with_commas' => __( 'Separate course categories with commas', 'ssm-courses' ),
			'add_or_remove_items'        => __( 'Add or remove course categories', 'ssm-courses' ),
			'choose_from_most_used'      => __( 'Choose from the most used course categories', 'ssm-courses' ),
			'not_found'                  => __( 'No course categories found.', 'ssm-courses' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => true,
			'rewrite'           => array( 'slug' => 'course-category' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args = apply_filters( 'ssm_courses_category_args', $args );

		register_taxonomy( $this->taxonomies[0], $this->post_type, $args );
	}
}