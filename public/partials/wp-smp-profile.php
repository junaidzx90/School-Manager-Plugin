<?php
wp_head();
get_header();
wp_enqueue_style('bootstrap');
wp_enqueue_style('webclass_main_css');
wp_enqueue_style('fontawesome.min');
wp_enqueue_style('solid');
wp_enqueue_style('wp-smp-profile');
wp_enqueue_script('wp-smp-profile');
wp_enqueue_script('webclass_main_js');
wp_enqueue_script('webclass_profile_js');
wp_enqueue_script('bootstrap');

wp_localize_script( "webclass_main_js", "webclass_main", array(
    'ajaxurl' => admin_url('admin-ajax.php')
));
wp_localize_script( "webclass_profile_js", "studentprofilepage", array(
    'ajaxurl' => admin_url('admin-ajax.php')
));
require_once(WPSMP_PATH.'admin/partials/wpsmp-colors.php');

    if(current_user_can( 'administrator' ) && is_user_logged_in(  )){
        require_once(plugin_dir_path( __FILE__ ).'/admin-profile.php');
    }else{
        if(isset($_REQUEST['sid'])){
            require_once(plugin_dir_path( __FILE__ ).'/public-profile.php');
        }else{
            ?>
            <div class="errorpage">
                <img width='300' style='margin:0 auto' src='https://upload.wikimedia.org/wikipedia/commons/thumb/0/03/Forbidden_Symbol_Transparent.svg/1200px-Forbidden_Symbol_Transparent.svg.png'></br>
                <h1>You are not allowed</h1>
            </div>
            <?php
        }
    }
wp_footer();

get_footer();