<?php wp_enqueue_style('wp-smp-single-page'); ?>
<?php wp_enqueue_script('wp-smp-single-page'); ?>
<?php $public_ins = new Wp_Smp_Public(); ?>
<?php
$thisProject = $public_ins->wpsmp_get_single_project($_REQUEST['pst']);

$myid = $public_ins->wpsmpwc_my_info('id');
if(!empty($thisProject)){
    $public_ins->wpsmpwc_updateview($thisProject->post_id);
?>
    <div class="single__project">
        <div class="container">
            <div class="content_wrap row justify-content-between">
                <div class="left_side pl-0 col-md-7">
                    <div class="content">
                        <div class="imageshow">
                            <img src="<?php echo esc_url($thisProject->thimbnail); ?>" alt="viewport">
                        </div>

                        <div class="gallery mt-3 pb-3 d-flex justify-content-center">

                            <?php
                            foreach($thisProject->media as $img){
                                ?>
                                <div class="imgitem">
                                    <img src="<?php echo esc_url($img); ?>" alt="">
                                </div>
                                <?php
                            }
                            ?>
                        </div>

                    </div>
                </div>

                <div class="right_side pr-0 col-md-5">
                    <div class="content bg-white">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="myname"><?php echo __($thisProject->name, 'wp-smp'); ?></h4>
                                <small class="myclass"><?php echo __($public_ins->wpsmp_wc_classname($myid), 'wp-smp'); ?></small>
                                <?php echo __($thisProject->points, 'wp-smp'); ?>
                            </div>
                            <div class="card-body">
                                <?php echo __($thisProject->post_date, 'wp-smp'); ?>
                                <?php echo __($thisProject->postview, 'wp-smp'); ?>
                            </div>

                            <div class="card-footer">
                                <div class="webclass-shareicons">
                                    <a class="btn whatsapp btn-sm btn-social-outline btn-wp-outline" href="whatsapp://send?text=Please check this: <?php urlencode(home_url( $_SERVER['REQUEST_URI'] )) ?>" target="_blank" title="">
                                    <i class="fab fa-whatsapp"></i> Whatsapp
                                    </a>

                                    <a class="btn btn-sm btn-social-outline btn-fb-outline" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( home_url( $_SERVER['REQUEST_URI'] )); ?>" target="_blank" title="">
                                    <i class="fab fa-facebook-square"></i> Share
                                    </a>

                                    <div class="wctooltip">
                                        <input type="text" value="<?php echo esc_url(home_url( $_SERVER['REQUEST_URI'] )); ?>" id="pagelink">
                                        <button class="btn-c btn-c-outline" onclick="copylink()" onmouseout="outFunc()">
                                        <span class="wctooltiptext" id="wcmyTooltip">Copy to clipboard</span>
                                        Copy
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Project Link -->
                            <div class="px-0 mt-3 text-center d-flex justify-content-center">
                                <div class="btncontents mb-5">
                                    <span class="wpsmp-excerpt"><?php  _e($thisProject->excerpt,'wp-smp'); ?></span>

                                    <?php
                                    if(!empty($thisProject->project_url)){
                                        ?>
                                        <h3 class="viewprojecttitle text-uppercase mb-2">View my project page</h3>
                                        <a class="btn btn-block btn-gray gonowbtn" target="_blank"
                                            href="<?php echo esc_url($thisProject->project_url); ?>"
                                            role="button">
                                            Go Now
                                        </a>
                                        <?php
                                    }
                                    ?>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="allprojects mt-5">
            <div class="container px-0">
                <h3 class="single_title">MY PROJECTS</h3>
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
                                        <a href="">
                                            <span class="wpsmpover"></span>
                                            <img src="<?php echo esc_url($project->thimbnail); ?>" alt="">
                                        </a>
                                    </div>
                                    <div class="wpsmp-project-info">
                                        <h5 class="smph5"><a href=""><?php _e($project->title,'wp-smp'); ?></a></h5>
                                        <span class="wpsmp-excerpt"><?php  _e(substr($project->excerpt, 0, 50),'wp-smp'); ?></span>
                                    </div>
                                    <div class="wpsmp-user-info d-flex justify-content-between">
                                        <span class="name d-flex flex-column align-self-end">
                                            <a href=""><?php _e($project->name,'wp-smp'); ?></a>
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
        </div>
    </div>
<?php
}