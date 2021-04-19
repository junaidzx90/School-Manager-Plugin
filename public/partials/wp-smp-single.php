<?php wp_enqueue_style('wp-smp-single-page'); ?>
<?php wp_enqueue_script('wp-smp-single-page'); ?>


<div class="single__project">
    <div class="container">
        <div class="content_wrap row justify-content-between">
            <div class="left_side pl-0 col-md-7">
                <div class="content">
                    <div class="imageshow">
                        <img src="https://tripxtours.imgix.net/uploads/dubai_tours/7151b56b36daae9cfca66c185bfc0edf.jpg?auto=compress&w=2000&h=1500&crop=faces&fit=min" alt="viewport">
                    </div>

                    <div class="gallery mt-3 pb-3 d-flex justify-content-center">
                        <div class="imgitem">
                            <img src="https://www.tandemconstruction.com/sites/default/files/styles/project_slider_main/public/images/project-images/IMG-Fieldhouse-10.jpg?itok=Whi8hHo9" alt="">
                        </div>
                        <div class="imgitem">
                            <img src="https://imgcomfort.com/Userfiles/Upload/images/illustration-geiranger.jpg" alt="">
                        </div>
                        <div class="imgitem">
                            <img src="https://www.sticky.digital/wp-content/uploads/2013/11/img-6.jpg" alt="">
                        </div>
                    </div>

                </div>
            </div>

            <div class="right_side pr-0 col-md-5">
                <div class="content bg-white">
                    <div class="card">
                        <div class="card-header">
                            name
                        </div>
                        <div class="card-body">
                            details
                        </div>

                        <div class="card-footer">
                            <div class="webclass-shareicons">
                                <a class="btn whatsapp btn-sm btn-social-outline btn-wp-outline" href="whatsapp://send?text=Please check this: <?php urlencode(the_permalink()) ?>" target="_blank" title="">
                                <i class="fab fa-whatsapp"></i> Whatsapp
                                </a>

                                <a class="btn btn-sm btn-social-outline btn-fb-outline" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( the_permalink()); ?>" target="_blank" title="">
                                <i class="fab fa-facebook-square"></i> Share
                                </a>

                                <div class="wctooltip">
                                    <input type="text" value="<?php //echo esc_url(the_permalink()); ?>" id="pagelink">
                                    <button class="btn-c btn-c-outline" onclick="copylink()" onmouseout="outFunc()">
                                    <span class="wctooltiptext" id="wcmyTooltip">Copy to clipboard</span>
                                    Copy
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Project Link -->
                        <div class="px-0 mt-3 text-center d-flex justify-content-center">
                            <div class="btncontents mb-2">
                                <?php //echo the_excerpt(); ?>
                                <h3 class="viewprojecttitle text-uppercase mb-2">View my project page</h3>
                                <a class="btn btn-block btn-gray gonowbtn" target="_blank"
                                    href="<?php ?>"
                                    role="button">
                                    Go Now
                                </a>
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
                    $projects = Wp_Smp_Public::wpsmpwc_get_projects();
                
                    foreach($projects as $project){
                        if($project->title != ""){
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
                                <h5 class="smph5"><a href=""><?php _e($project->title,'wp-smp'); ?></a></h5>
                                <span class="wpsmp-excerpt"><?php  _e(substr($project->excerpt, 0, 50),'wp-smp'); ?></span>
                            </div>
                            <div class="wpsmp-user-info d-flex justify-content-between">
                                <span class="name d-flex flex-column align-self-end">
                                    <a href=""><?php _e($project->name,'wp-smp'); ?></a>
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
    </div>
    
</div>