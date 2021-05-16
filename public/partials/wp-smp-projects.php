<?php wp_enqueue_style('bootstrap'); ?>
<?php wp_enqueue_style('wp-smp-projects'); ?>
<?php wp_enqueue_script('jquery.form'); ?>
<?php wp_enqueue_script('bootstrap'); ?>
<?php wp_enqueue_script('wp-smp-project');
$public_ins = new  Wp_Smp_Public();
$myid = $public_ins->wpsmpwc_my_info('id');
?>
<?php get_header(); ?>
<?php require_once(WPSMP_PATH.'admin/partials/wpsmp-colors.php'); ?>
<?php
if(!wp_check_password( get_option("wc_user_pass"), $public_ins->wpsmpwc_my_info('user_pass'), $public_ins->wpsmpwc_my_info('id') )){
    echo "<span class='error'>Please Login to your parent side!</span>";
    die;
}
?>
<div id="wpsmpmain">
<?php echo $public_ins->wpsmp_page_header(); ?>

<?php
if(isset($_GET['pst'])){
    require_once WPSMP_PATH."/public/partials/wp-smp-single.php";
}else{
?>
    <div class="wpsm container">
        <div class="search_project_box">
            <div class="input-wrap">
                <input class="p_search_inp" type="search" placeholder="Search project">
            </div>
        </div>

        <div class="projects_filters row mx-0 justify-content-center">
            <div class="form-group col-sm-3">
                <?php
                    // Here will be course title dropdown
                    echo $public_ins->get_wpsmp_wccourse_dropdown();
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
                // Get projects
                $projects = $public_ins->wpsmpwc_get_projects();
            
                foreach($projects as $project){
                    if(!empty($project->title)){
                    ?>
                    <div class="wpsmp-project col-12 col-sm-6 col-md-4 col-lg-3 mt-sm-2">
                        <div class="projectimg">
                            <a href="?pst=<?php _e($project->post_id, 'wp-smp') ?>">
                                <span class="wpsmpover"></span>
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
                                <small class="classname"><?php _e($project->classname,'wp-smp'); ?></small>
                            </span>
                            <span class="points align-self-end">
                                <a target="_junu" href="<?php echo esc_url(SMP_PARENT_SITE.'/leaderboard'); ?>"><small class="badge badge-wpsmp">Points: <?php _e($project->points,'wp-smp'); ?></small></a>
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
<?php 
}
?>
<?php get_footer(); ?>