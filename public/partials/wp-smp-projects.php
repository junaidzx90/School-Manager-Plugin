<?php wp_enqueue_style('bootstrap'); ?>
<?php wp_enqueue_style('wp-smp-public'); ?>
<?php wp_enqueue_script('jquery.form'); ?>
<?php wp_enqueue_script('bootstrap'); ?>
<?php wp_enqueue_script('wp-smp-public'); ?>
<?php wp_enqueue_script('wp-smp-project');

?>
<?php get_header(); ?>
<?php require_once(WPSMP_PATH.'admin/partials/wpsmp-colors.php'); ?>
<?php
if(!defined(SMP_PARENT_SITE) && get_option("wc_my_email") == ""){
	die("You haven't set this plugin properly");
}
?>
<div id="wpsmpmain">
<?php echo Wp_Smp_Public::wpsmp_page_header(); ?>

<div class="wpsm container">
    <div class="search_project">
        <div class="input-wrap">
            <input class="p_search_inp" type="search" placeholder="Search project">
        </div>
    </div>

    <div class="projects_filters row mx-0 justify-content-center">
        <div class="form-group col-sm-3">
            <?php
                // Here will be course title dropdown
                echo Wp_Smp_Public::get_wpsmp_wccourse_dropdown();
            ?>
        </div>

        <div class="form-group col-sm-3">
            <div class="form-group">
                <select class="custom-select dropdownmenu" id="filters">
                    <option selected value="-1">All types</option>
                    <option value="mostrecent">Most recent</option>
                    <option value="mostviewed">Most viewed</option>
                    <option value="mostliked">Most liked</option>
                </select>
            </div>
        </div>
    </div>


    <div class="smpprojects py-2">
        <div class="wpsmp-projects-items row justify-content-center">
            <?php
            global $wp_query;
            // Get webclass student Id
            $wcID = Wp_Smp_Public::wpsmpwc_my_info('id');
            $user_nicename = Wp_Smp_Public::wpsmpwc_my_info('user_nicename');

            // Get projects
            $projects = Wp_Smp_Public::wpsmpwc_get_projects($wcID);
           
            foreach($projects as $project){
                if($project->title != ""){
                ?>
                <div class="wpsmp-project col-12 col-sm-6 col-md-4 col-lg-3 mt-sm-2">
                    <div class="projectimg">
                        <a href="">
                            <span class="wpsmpover"></span>
                            <!-- <small class="wpsmp-likebtn"><i class="fa fa-heart" aria-hidden="true"></i> 0</small> -->
                            <img src="<?php echo esc_url($project->thimbnail); ?>" alt="">
                        </a>
                    </div>
                    <div class="wpsmp-project-info">
                        <h5 class="smph5"><a href=""><?php _e($project->title,'wp-smp'); ?></a></h5>
                        <span class="wpsmp-excerpt"><?php  _e(substr($project->excerpt, 0, 50),'wp-smp'); ?></span>
                    </div>
                    <div class="wpsmp-user-info d-flex justify-content-between">
                        <span class="name d-flex flex-column align-self-end">
                            <a href=""><?php _e($user_nicename,'wp-smp'); ?></a>
                            <small>Mega coders</small>
                        </span>
                        <span class="points align-self-end">
                            <a href=""><small class="badge badge-wpsmp">Points: 18K</small></a>
                        </span>
                    </div>
                </div>
                <?php
                }
            }
            ?>
        </div>
        <?php
        if($projects->max_num_pages > 1 ){
            ?>
            <div class="text-center my-5 loadmorediv">
                <button type="button" class="btn btn-outline-primary px-5 load_more_projects">Load More</button>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<?php get_footer(); ?>