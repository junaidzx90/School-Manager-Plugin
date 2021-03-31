<?php wp_enqueue_style('bootstrap'); ?>
<?php wp_enqueue_style('wp-smp-public'); ?>
<?php wp_enqueue_script('jquery.form'); ?>
<?php wp_enqueue_script('bootstrap'); ?>
<?php wp_enqueue_script('wp-smp-public'); ?>
<?php wp_enqueue_script('wp-smp-project'); ?>
<?php get_header(); ?>
<?php require_once(WPSMP_PATH.'admin/partials/wpsmp-colors.php'); ?>

<div id="wpsmpmain">
<?php echo Wp_Smp_Public::wpsmp_page_header(); ?>

<div class="wpsm container">
    <div class="smpprojects py-2">
        <div class="wpsmp-projects-items row justify-content-center">
            <div class="wpsmp-project col-12 col-sm-6 col-md-4 col-lg-3 mt-sm-2">
                <div class="projectimg">
                    <a href="">
                        <span class="wpsmpover"></span>
                        <small class="wpsmp-likebtn"><i class="fa fa-heart" aria-hidden="true"></i> 0</small>
                        <img src="https://www.w3schools.com/w3css/img_lights.jpg" alt="">
                    </a>
                </div>
                <div class="wpsmp-project-info">
                    <h5 class="smph5"><a href="">Lorem ipsum dolor sit</a></h5>
                    <span class="wpsmp-excerpt">Lorem ipsum dolor sit amet consectetur adipisicing elit.</span>
                </div>
                <div class="wpsmp-user-info d-flex justify-content-between">
                    <span class="name d-flex flex-column align-self-end">
                        <a href="">Md Junayed</a>
                        <small>Mega coders</small>
                    </span>
                    <span class="points align-self-end">
                        <a href=""><small class="badge badge-wpsmp">Points: 18K</small></a>
                    </span>
                </div>
            </div>

            <div class="wpsmp-project col-12 col-sm-6 col-md-4 col-lg-3 mt-sm-2">
                <div class="projectimg">
                    <a href="">
                        <span class="wpsmpover"></span>
                        <small class="wpsmp-likebtn"><i class="fa fa-heart" aria-hidden="true"></i> 0</small>
                        <img src="https://www.w3schools.com/w3css/img_lights.jpg" alt="">
                    </a>
                </div>
                <div class="wpsmp-project-info">
                    <h5 class="smph5"><a href="">Lorem ipsum dolor sit</a></h5>
                    <span class="wpsmp-excerpt">Lorem ipsum dolor sit amet consectetur adipisicing elit.</span>
                </div>
                <div class="wpsmp-user-info d-flex justify-content-between">
                    <span class="name d-flex flex-column align-self-end">
                        <a href="">Md Junayed</a>
                        <small>Mega coders</small>
                    </span>
                    <span class="points align-self-end">
                        <a href=""><small class="badge badge-wpsmp">Points: 18K</small></a>
                    </span>
                </div>
            </div>

            <div class="wpsmp-project col-12 col-sm-6 col-md-4 col-lg-3 mt-sm-2">
                <div class="projectimg">
                    <a href="">
                        <span class="wpsmpover"></span>
                        <small class="wpsmp-likebtn"><i class="fa fa-heart" aria-hidden="true"></i> 0</small>
                        <img src="https://www.w3schools.com/w3css/img_lights.jpg" alt="">
                    </a>
                </div>
                <div class="wpsmp-project-info">
                    <h5 class="smph5"><a href="">Lorem ipsum dolor sit</a></h5>
                    <span class="wpsmp-excerpt">Lorem ipsum dolor sit amet consectetur adipisicing elit.</span>
                </div>
                <div class="wpsmp-user-info d-flex justify-content-between">
                    <span class="name d-flex flex-column align-self-end">
                        <a href="">Md Junayed</a>
                        <small>Mega coders</small>
                    </span>
                    <span class="points align-self-end">
                        <a href=""><small class="badge badge-wpsmp">Points: 18K</small></a>
                    </span>
                </div>
            </div>

            <div class="wpsmp-project col-12 col-sm-6 col-md-4 col-lg-3 mt-sm-2">
                <div class="projectimg">
                    <a href="">
                        <span class="wpsmpover"></span>
                        <small class="wpsmp-likebtn"><i class="fa fa-heart" aria-hidden="true"></i> 0</small>
                        <img src="https://www.w3schools.com/w3css/img_lights.jpg" alt="">
                    </a>
                </div>
                <div class="wpsmp-project-info">
                    <h5 class="smph5"><a href="">Lorem ipsum dolor sit</a></h5>
                    <span class="wpsmp-excerpt">Lorem ipsum dolor sit amet consectetur adipisicing elit.</span>
                </div>
                <div class="wpsmp-user-info d-flex justify-content-between">
                    <span class="name d-flex flex-column align-self-end">
                        <a href="">Md Junayed</a>
                        <small>Mega coders</small>
                    </span>
                    <span class="points align-self-end">
                        <a href=""><small class="badge badge-wpsmp">Points: 18K</small></a>
                    </span>
                </div>
            </div>
                
        </div>
    </div>
</div>
<?php get_footer(); ?>