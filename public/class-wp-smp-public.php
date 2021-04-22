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
	public function __construct( $plugin_name = '', $version = '' ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		// Wp-smp template pages
        add_filter('theme_page_templates', array($this, 'wpsmp_templates'));
        add_filter('template_include', array($this, 'wpsmp_page_attributes'));
        // Wp-smp archive page include for projects
        // add_filter('template_include', array($this, 'wpsmp_projects_template'));
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( 'bootstrap', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );

		wp_enqueue_style( 'wp-smp-projects', plugin_dir_url( __FILE__ ) . 'css/wp-smp-projects.css', array(),  microtime(), 'all' );

		wp_enqueue_style( 'wp-smp-single-page', plugin_dir_url( __FILE__ ) . 'css/wp-smp-single-page.css', array(),  microtime(), 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'bootstrap', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ), $this->version, true );

		wp_enqueue_script( 'jquery.form', plugin_dir_url( __FILE__ ) . 'js/jquery.form.min.js', array( 'jquery' ), $this->version, true );

		wp_enqueue_script( 'wp-smp-project', plugin_dir_url( __FILE__ ) . 'js/wp-smp-project.js', array( 'jquery' ), microtime(), true );

		wp_enqueue_script( 'wp-smp-single-page', plugin_dir_url( __FILE__ ) . 'js/wp-smp-single-page.js', array( 'jquery' ), microtime(), true );
        
        wp_localize_script( "wp-smp-project", "my_projects_data", array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'security' => wp_create_nonce( 'my_projects_data' ),
        ));

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
    /*
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
    */

    // WPSMP PAGE HEADER
    function wpsmp_page_header(){
    ?>
    <div class="smpheader mx-0 row justify-content-center">
        <div class="wpsm-hdr-content text-center">
            <h1 class="smph1">This is Page Header</h1>
            <h4 class="smp4">This is subheading</h4>
        </div>
    </div>
    <?php
    }

    function get_post_slug($post_id)
    {
        global $wpdb;
        if ($slug = $wpdb->get_var("SELECT post_name FROM {$wpdb->prefix}posts WHERE ID = $post_id")) {
            return $slug;
        } else {
            return '';
        }
    }

    // get my information from parent site
    function wpsmpwc_my_info($data){
        $mymail = get_option( 'wc_my_email' );
        $url = SMP_PARENT_SITE.'/wp-json/wc/v1/myinfo/'.$mymail;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);
        $obj = json_decode($result);

        return $data = $obj->$data;
    }

    // SEND POST REQUEST
    public function send_post_request_to_json($url, $data = array()){
        if(!empty($url) && !empty($data)){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            $result = curl_exec($ch);
            curl_close($ch);
            $obj = json_decode($result);

            return $obj;
        }
    }
    // SEND GET REQUEST
    public function send_get_request_to_json($url){
        if(!empty($url)){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, $url);
            $result = curl_exec($ch);
            curl_close($ch);
            $obj = json_decode($result);

            return $obj;
        }
    }
    /**
     * Projects
     */
    function wpsmpwc_get_projects(){
        $url = SMP_PARENT_SITE.'/wp-json/wc/v1/projects';
        $mymail = get_option( 'wc_my_email' );
        $mypass = get_option("wc_user_pass");
        $data = array(
            "email" =>  $mymail,
            "pass"  => $mypass
        );
        $result = $this->send_post_request_to_json($url, $data);
        return $result;
    }

    /**
     * Update post views count
     */
    function wpsmpwc_updateview($post_id){
        $url = SMP_PARENT_SITE.'/wp-json/wc/v1/upview';
        $data = array(
            "post_id" =>  $post_id
        );
        $this->send_post_request_to_json($url, $data);
    }

    /**
     * Get Single project
     */
    public function wpsmp_get_single_project($post_id){
        $url = SMP_PARENT_SITE.'/wp-json/wc/v1/singleproject';
        $mymail = get_option( 'wc_my_email' );
        $mypass = get_option("wc_user_pass");
        $data = array(
            "email" =>  $mymail,
            "pass"  => $mypass,
            "post_id"  => $post_id
        );
        $result = $this->send_post_request_to_json($url, $data);
        return $result;
    }

    /**
     * Get get_wcmypoints
     */
    public function wpsmp_get_wcmypoints($my_id){
        $url = SMP_PARENT_SITE.'/wp-json/wc/v1/mypoints/'.$my_id;
        $result = $this->send_get_request_to_json($url);
        return $result;
    }

    /**
     * Get postview
     */
    public function wpsmp_wc_postview($post_id){
        $url = SMP_PARENT_SITE.'/wp-json/wc/v1/postview/'.$post_id;
        $result = $this->send_get_request_to_json($url);
        return $result;
    }

    /**
     * Get postview
     */
    public function wpsmp_wc_classname($my_id){
        $url = SMP_PARENT_SITE.'/wp-json/wc/v1/classname/'.$my_id;
        $result = $this->send_get_request_to_json($url);
        return $result;
    }

    /**
     * Get courses dropdown listitem
     */
    function get_wpsmp_wccourse_dropdown(){
        $url = SMP_PARENT_SITE.'/wp-json/wc/v1/course_dropdown';
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);
        $obj = json_decode($result);

        return $obj;
    }

    // Project for filter data
    function wpsmp_wcproject_filterning(){
        check_ajax_referer('my_projects_data', 'security');
        
        $page = 1;
        if(isset($_POST['page'])){
            $page = $_POST['page'];
        }

        $filterdata = "";
        $filters = "";

        if(isset($_POST['filterdata'])){
            $filterdata = sanitize_text_field( $_POST['filterdata'] );
        }
        if(isset($_POST['filters'])){
            $filters = sanitize_text_field($_POST['filters']);
        }
        
        $url = SMP_PARENT_SITE.'/wp-json/wc/v1/filters';

        // For Sequrity
        $mymail = get_option( 'wc_my_email' );
        $mypass = get_option("wc_user_pass");

        $data = array(
            "filterdata" =>  $filterdata,
            "filters"  => $filters,
            "page"  => $page,
            "email" =>  $mymail,
            "pass"  => $mypass
        );
        $projects = $this->send_post_request_to_json($url, $data);

        if($projects == "404"){
            echo 404;
            die;
        }

        foreach($projects as $project){
            if(!empty($project->title)){
                ?>
                <div class="wpsmp-project col-12 col-sm-6 col-md-4 col-lg-3 mt-sm-2">
                    <div class="projectimg">
                        <a href="?pst=<?php _e($project->post_id, 'wp-smp') ?>">
                            <span class="wpsmpover"></span>
                            <!-- <small class="wpsmp-likebtn"><i class="fa fa-heart" aria-hidden="true"></i> 0</small> -->
                            <img src="<?php echo esc_url($project->thimbnail); ?>" alt="">
                        </a>
                    </div>
                    <div class="wpsmp-project-info">
                        <h5 class="smph5"><a href="?pst=<?php _e($project->post_id, 'wp-smp') ?>"><?php _e($project->title,'wp-smp'); ?></a></h5>
                        <span class="wpsmp-excerpt"><?php  _e(substr($project->excerpt, 0, 50),'wp-smp'); ?></span>
                    </div>
                    <div class="wpsmp-user-info d-flex justify-content-between">
                        <span class="name d-flex flex-column align-self-end">
                            <a href="<?php echo esc_url(home_url('/' . $public_ins->get_post_slug(get_option('wpsmp_profile', true)).'?sid='.$myid)); ?>"><?php _e($project->name,'wp-smp'); ?></a>
                            <small class="myclass"><?php echo __($project->classname, 'wp-smp'); ?></small>
                        </span>
                        <span class="points align-self-end">
                            <a target="_junu" href="<?php echo esc_url(SMP_PARENT_SITE.'/leaderboard'); ?>"><small class="badge badge-wpsmp">Points: <?php echo __($project->points, 'wp-smp'); ?></small></a>
                        </span>
                    </div>
                </div>
                <?php
            }
        }
        
        die;
    }
}
