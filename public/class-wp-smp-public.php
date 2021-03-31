<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/junaidzx90/wp-smp/issues
 * @since      1.0.0
 *
 * @package    Wp_Smp
 * @subpackage Wp_Smp/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wp_Smp
 * @subpackage Wp_Smp/public
 * @author     Md Junayed <devjoo.contact@gmail.com>
 */
class Wp_Smp_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		// Wp-smp template pages
        add_filter('theme_page_templates', array($this, 'wpsmp_templates'));
        add_filter('template_include', array($this, 'wpsmp_page_attributes'));
        // Wp-smp archive page include for projects
        add_filter('template_include', array($this, 'wpsmp_projects_template'));

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( 'bootstrap', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );

		wp_enqueue_style( 'wp-smp-public', plugin_dir_url( __FILE__ ) . 'css/wp-smp-public.css', array(),  microtime(), 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'bootstrap', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ), $this->version, true );

		wp_enqueue_script( 'jquery.form', plugin_dir_url( __FILE__ ) . 'js/jquery.form.min.js', array( 'jquery' ), $this->version, true );

		wp_enqueue_script( 'wp-smp-public', plugin_dir_url( __FILE__ ) . 'js/wp-smp-public.js', array( 'jquery' ), microtime(), true );

		wp_enqueue_script( 'wp-smp-project', plugin_dir_url( __FILE__ ) . 'js/wp-smp-project.js', array( 'jquery' ), microtime(), true );

	}

	/**
     * Define template name
     */
    public function wpsmp_templates($templates)
    {
        $templates['wp-smp-projects.php'] = 'Projects';
        $templates['wp-smp-profile.php'] = 'Profile';

        return $templates;
    }

    // Set custom page attributes
    public function wpsmp_page_attributes($template)
    {
        if (get_page_template_slug() === 'wp-smp-projects.php') {

            if ($theme_file = locate_template(array('wp-smp-projects.php'))) {
                $template = $theme_file;
            } else {
                $template = dirname(__FILE__) . '/partials/wp-smp-projects.php';
            }
        }

        if (get_page_template_slug() === 'wp-smp-profile.php') {

            if ($theme_file = locate_template(array('wp-smp-profile.php'))) {
                $template = $theme_file;
            } else {
                $template = dirname(__FILE__) . '/partials/wp-smp-profile.php';
            }
        }

        if ($template == '') {
            throw new \Exception('No template found');
        }

        return $template;
    }

    // Define custom post template with single page
    public function wpsmp_projects_template($template)
    {

        // For custom archive page
        if (is_post_type_archive('projects')) {
            $theme_files = array('wp-smp-projects.php', '/partials/wp-smp-projects.php');
            $exists_in_theme = locate_template($theme_files, false);
            if ($exists_in_theme != '') {
                return $exists_in_theme;
            } else {
                return dirname(__FILE__) . '/partials/wp-smp-projects.php';
            }
        }

        // For custom single post
        if (is_singular('projects')) {
            $theme_post = array('wp-smp-single.php', '/partials/wp-smp-single.php');
            $exists_in_theme_pst = locate_template($theme_post, false);
            if ($exists_in_theme_pst != '') {
                return $exists_in_theme_pst;
            } else {
                return dirname(__FILE__) . '/partials/wp-smp-singleb.php';
            }
        }
        return $template;
    }


    // WPSMP PAGE HEADER
    function wpsmp_page_header(){
    ?>
    <div class="smpheader row justify-content-center">
        <div class="wpsm-hdr-content text-center">
            <h1 class="smph1">This is Page Header</h1>
            <h4 class="smp4">This is subheading</h4>
        </div>
    </div>
    <?php
    }

}
