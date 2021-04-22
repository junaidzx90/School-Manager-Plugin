<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/junaidzx90/wp-smp/issues
 * @since      1.0.0
 *
 * @package    Wp_Smp
 * @subpackage Wp_Smp/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Smp
 * @subpackage Wp_Smp/admin
 * @author     Md Junayed <devjoo.contact@gmail.com>
 */
class Wp_Smp_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-smp-admin.css', array(), microtime(), 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-smp-admin.js', array( 'jquery' ), $this->version, true );

	}

	// Add administrator caps
	function add_wpsmp_caps() {
		global $wp_roles;

		$role = get_role( 'administrator' );
		$role->add_cap( 'projects' );
		$role->add_cap( 'edit_projects' );
		$role->add_cap( 'edit_others_projects' );
		$role->add_cap( 'delete_others_projects' );
		$role->add_cap( 'read_private_projects' );
		$role->add_cap( 'manage_projects' );
	}

	public function wpsmp_pages_register(){
		add_menu_page( 'School Manager', 'School Manager', 'manage_options', 'wp-smp', array($this,"wpsmp_menupage_display"), 'dashicons-welcome-learn-more', 40 );
		
		add_settings_section( 'wpsmp_settings_section', '', '', 'wpsmp_settings' );
		add_settings_field( 'wpsmp_profile', '📋 Add Profile Page', array($this,'wpsmp_profile_page_func'), 'wpsmp_settings', 'wpsmp_settings_section');
		register_setting( 'wpsmp_settings_section', 'wpsmp_profile');
		
		add_settings_field( 'wc_my_email', '📧 Parent access email', array($this,'wc_my_email_page_func'), 'wpsmp_settings', 'wpsmp_settings_section');
		register_setting( 'wpsmp_settings_section', 'wc_my_email');

		add_settings_field( 'wc_user_pass', '📧 Password', array($this,'wc_user_pass_page_func'), 'wpsmp_settings', 'wpsmp_settings_section');
		register_setting( 'wpsmp_settings_section', 'wc_user_pass');
	}

	// Display page
	function wpsmp_menupage_display(){
		require_once(plugin_dir_path( __FILE__ ).'partials/wp-smp-admin-display.php');
	}

	// PRofile page setup
	function wpsmp_profile_page_func(){
		echo '<br>';
		global $wp_query;
		$args = array(
			'post_type' => 'page',
			'post_status' => 'publish',
			'name'      => 'wpsmp_profile',
			'selected' 	=> get_option( 'wpsmp_profile' ),
			'show_option_none'      => '',
			'show_option_no_change' => 'Select Page',
			'option_none_value'     => '',
		);
		wp_dropdown_pages( $args );
		echo '<br><br>';
	}

	function wc_my_email_page_func(){
		echo '<br><input type="email" value="'.get_option("wc_my_email").'" name="wc_my_email" placeholder="Email"><br><br>';
	}
	function wc_user_pass_page_func(){
		echo '<br><input type="password" value="'.get_option("wc_user_pass").'" name="wc_user_pass" placeholder="Password">';

		if(get_option("wc_user_pass")){
			$public_ins = new Wp_Smp_Public();
			if(!wp_check_password( get_option("wc_user_pass"), $public_ins->wpsmpwc_my_info('user_pass'), $public_ins->wpsmpwc_my_info('id') )){
				echo "<span class='error'>Password Incorrect!</span>";
				delete_option("wc_user_pass");
			}
		}
	}

	/*
	* Creating a function to create our CPT
	function wpsmp_projects_postype() {
		// Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'Projects', 'Student Projects Page', 'wp-smp' ),
			'singular_name'       => _x( 'Project', 'Project page', 'wp-smp' ),
			'menu_name'           => __( 'Projects', 'wp-smp' ),
			'all_items'           => __( 'All Projects', 'wp-smp' ),
			'view_item'           => __( 'View Project', 'wp-smp' ),
			'add_new_item'        => __( 'Add New Project', 'wp-smp' ),
			'add_new'             => __( 'Add New', 'wp-smp' ),
			'edit_item'           => __( 'Edit Project', 'wp-smp' ),
			'update_item'         => __( 'Update Project', 'wp-smp' ),
			'search_items'        => __( 'Search Project', 'wp-smp' ),
			'not_found'           => __( 'Not Found', 'wp-smp' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'wp-smp' ),
		);
		 
		// Set other options for Custom Post Type
		 
		$args = array(
			'label'               => __( 'Projects', 'wp-smp' ),
			'description'         => __( 'Projects posts', 'wp-smp' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'thumbnail','editor','comments','author' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'menu_position'       => 45,
			'menu_icon'           => 'dashicons-welcome-learn-more',
			'show_in_rest' => true,
			'map_meta_cap' => true,
			'capabilities' => array(
				'read_posts' => true,
				'edit_post' => true,
				'edit_posts' => 'projects',
				'published_posts' => 'projects',
				'edit_published_posts' => 'projects',
				'edit_others_posts ' => 'projects'
			),
	 
		);
		 
		// Registering your Custom Post Type
		register_post_type( 'projects', $args );
	 
	}
	*/
}
