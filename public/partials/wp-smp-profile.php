<?php
wp_head();
wp_enqueue_style('wp-smp-profile');
wp_enqueue_script('wp-smp-profile');

    if(current_user_can( 'administrator' ) && is_user_logged_in(  )){
        require_once(plugin_dir_path( __FILE__ ).'/admin-profile.php');
    }else{
        if(isset($_REQUEST['sid'])){
            require_once(plugin_dir_path( __FILE__ ).'/public-profile.php');
        }else{
            get_header();
            ?>
            <div class="errorpage">
                <img width='300' style='margin:0 auto' src='https://upload.wikimedia.org/wikipedia/commons/thumb/0/03/Forbidden_Symbol_Transparent.svg/1200px-Forbidden_Symbol_Transparent.svg.png'></br>
                <h1>You are not allowed</h1>
            </div>
            <?php
            get_footer();
        }
    }
wp_footer();