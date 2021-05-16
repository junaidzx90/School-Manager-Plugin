<?php
$public_ins = new Wp_Smp_Public();
$myprofile = $public_ins->wpsmp_get_my_profile();
?>
<div class="wp-smp_dashboard_wrapper row mx-0 clearfix">
    <!-- wp-smp_Profile ifo -->
    <div class="wp-smp_profile_info col-12 dahboard_banner smpheader">
        <div class="container px-0">
            <div class="user_profile_info pb-4 row mx-0">

                <div class="avatartooltip">
                    <i class="fa fa-close" aria-hidden="true"></i>
                    <div class="radio-flex">
                        <div class="radio-container">
                            <div class="radio-options">
                                <input class="radio-input"
                                    data-avtr="<?php echo $myprofile->avatarurl.'avatar-1.png'; ?>" id="show1"
                                    type="radio" name="show" value="1" />
                                <label
                                    style="background-image: url(<?php echo $myprofile->avatarurl.'avatar-1.png'; ?>);"
                                    class="radio-label show1" for="show1"></label>

                                <input class="radio-input"
                                    data-avtr="<?php echo $myprofile->avatarurl.'avatar-2.png'; ?>" id="show2"
                                    type="radio" name="show" value="2" />
                                <label
                                    style="background-image: url(<?php echo $myprofile->avatarurl.'avatar-2.png'; ?>);"
                                    class="radio-label show2" for="show2"></label>

                                <input class="radio-input"
                                    data-avtr="<?php echo $myprofile->avatarurl.'avatar-3.png'; ?>" id="show3"
                                    type="radio" name="show" value="3" />
                                <label
                                    style="background-image: url(<?php echo $myprofile->avatarurl.'avatar-3.png'; ?>);"
                                    class="radio-label show3" for="show3"></label>

                                <input class="radio-input"
                                    data-avtr="<?php echo $myprofile->avatarurl.'avatar-4.png'; ?>" id="show4"
                                    type="radio" name="show" value="4" />
                                <label
                                    style="background-image: url(<?php echo $myprofile->avatarurl.'avatar-4.png'; ?>);"
                                    class="radio-label show4" for="show4"></label>
                            </div>
                            <div class="radio-options">
                                <input class="radio-input"
                                    data-avtr="<?php echo $myprofile->avatarurl.'avatar-5.png'; ?>" id="show5"
                                    type="radio" name="show" value="5" />
                                <label
                                    style="background-image: url(<?php echo $myprofile->avatarurl.'avatar-5.png'; ?>);"
                                    class="radio-label show5" for="show5"></label>

                                <input class="radio-input"
                                    data-avtr="<?php echo $myprofile->avatarurl.'avatar-6.png'; ?>" id="show6"
                                    type="radio" name="show" value="6" />
                                <label
                                    style="background-image: url(<?php echo $myprofile->avatarurl.'avatar-6.png'; ?>);"
                                    class="radio-label show6" for="show6"></label>

                                <input class="radio-input"
                                    data-avtr="<?php echo $myprofile->avatarurl.'avatar-7.png'; ?>" id="show7"
                                    type="radio" name="show" value="7" />
                                <label
                                    style="background-image: url(<?php echo $myprofile->avatarurl.'avatar-7.png'; ?>);"
                                    class="radio-label show7" for="show7"></label>

                                <input class="radio-input"
                                    data-avtr="<?php echo $myprofile->avatarurl.'avatar-8.png'; ?>" id="show8"
                                    type="radio" name="show" value="8" />
                                <label
                                    style="background-image: url(<?php echo $myprofile->avatarurl.'avatar-8.png'; ?>);"
                                    class="radio-label show8" for="show8"></label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="user_avatar col-md-4 col-sm-4 align-self-end">
                    <div style="background-image: url(<?php echo !empty($myprofile->profileAvatar)? __($myprofile->profileAvatar,'wp-smp'): _e($myprofile->avatarurl.'default-avatar.png','wp-smp') ?>);"
                        class="profile_img">
                        <!-- Profile avatar comes here -->
                        <span class="user_img d-none">
                            <label class="btns select-avatar">Select Avatar</label>
                        </span>
                    </div>
                </div>

                <!-- profile info left -->
                <div class="user_info col-8 align-self-end">
                    <h2 class="user_name text-white mb-0">
                        <?php echo __(str_replace(["-","_"]," ",$myprofile->user_nicename),'wp-smp'); ?></h2>
                    <input type="text" class="form-control my-2 d-none" id="user_name_inp" placeholder="Name"
                        value="<?php echo str_replace(["-","_"]," ",$myprofile->user_nicename); ?>">

                    <h6 class="school_name d-inline">
                        <?php echo !empty($myprofile->user_school)?'<a target="_junu" href="'.esc_url($myprofile->user_school).'">'.__($myprofile->user_school,'wp-smp').'</a>':''; ?><span
                            class="wcclass"><?php echo !empty($myprofile->user_class)? ' | '.__($myprofile->readable_class,'wp-smp'):''; ?></span>
                    </h6>

                    <input type="text" class="form-control my-2 d-none text-lowercase" id="school_name_inp"
                        placeholder="website"
                        value="<?php echo !empty($myprofile->user_school)?__($myprofile->user_school,'wp-smp'):''; ?>">

                    <select name="wcclasses" class="d-none" id="wcclasses">
                        <?php
                        if(!empty($myprofile->user_class)){
                            echo '<option value="'.__($myprofile->user_class,'wp-smp').'" selected>'.__($myprofile->readable_class,'wp-smp').'</option>';
                        }else{
                            echo '<option value="0">Select class</option>';
                            echo '<option value="youngexplorers">Young Explorers</option>';
                            echo '<option value="megacoders">Mega Coders</option>';
                            echo '<option value="procoders">Pro Coders</option>';
                        }
                        ?>
                    </select>

                    <div class="user_eraning d-flex justify-content-start">
                        <div class="leaderboard-points text-white">
                            <i
                            class="fas fa-user-graduate profile_awerd_icon"></i>&nbsp;<span><?php echo $myprofile->my_course_points; ?></span>
                        </div>
                        <div class="leaderboard-rank text-white ml-2">
                            <i class="fas fa-medal profile_coin_icon"></i>
                            &nbsp;<span><?php echo $myprofile->my_skill_points; ?></span>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!-- Edit profile -->
        <div class="edit_profile p_edit"><i class="fas fa-edit"></i><span>Edit Profile</span></div>
        <div class="edit_profile p_save d-none">Save</div>
    </div>

    <div class="container profile_info_wraps px-0">
        <div class="row mx-0">
            <!-- wp-smp_dashboard tabs -->
            <div style="top: 33px !important;" class="user_info_left pt-5 pb-2 col-12 col-md-4">
                <span class="toggleclass">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </span>
                <h3 class="about_me">About me</h3>
                <p class="user_desc">
                    <?php echo !empty($myprofile->my_description)?__($myprofile->my_description,'wp-smp'):''; ?>&nbsp;(:
                </p>
                <div class="form-group">
                    <textarea class="form-control d-none" name="user_desc" id="user_desc" cols="30"
                        rows="3"><?php echo !empty($myprofile->my_description)?__($myprofile->my_description,'wp-smp'):''; ?></textarea>
                </div>
                <table class="profile_tbl">
                    <tr>
                        <th>PROJECTS</th>
                        <td>
                            <?php
                            echo '<span class="badge badge-success projectscountn">'.$myprofile->count_project;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>PROJECT LIKES</th>
                        <td>
                            <?php
                            echo '<i class="badge badge-success counts">'.$myprofile->my_likes.'</i>';
                        ?>
                        </td>
                    </tr>
                    <tr>
                        <th>PROJECT VIEWS</th>
                        <td>
                            <?php
                            echo '<span class="badge badge-success">'.$myprofile->my_project_view;
                        ?>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="user_info_right pb-5 pt-3 col-12 col-md-11">

                <h3 class="rates_courses_title text-uppercase">
                    <?php echo __(str_replace(["-","_"]," ",$myprofile->user_nicename),'wp-smp'); ?> PROGRESS</h3>
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
                            <li class="nav-item">
                                <input type="hidden" class="uname"
                                    value="<?php echo __(str_replace(["-","_"]," ",$myprofile->user_nicename),'wp-smp'); ?>">
                                <a class="nav-link active projectpanebtn" href="#projectspane" role="tab"
                                    aria-controls="projectspane text-capitalize" aria-selected="true">Projects</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#rates_courses_earn" role="tab"
                                    aria-controls="rates_courses_earn" aria-selected="true">Courses</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#morals_earn" role="tab" aria-controls="morals_earn"
                                    aria-selected="false">Skills</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content mt-3">

                            <!-- Projects -->
                            <div class="tab-pane active card mt-2" id="projectspane">
                                projects
                            </div>

                            <!-- Earnings -->
                            <?php
                            $ratings = $public_ins->wpsmp_get_my_rattings();

                            if($ratings):?>
                            <div class="tab-pane" id="rates_courses_earn" role="tabpanel">
                                <!-- course item -->
                                <div class="course_item my-2">
                                    <a href="<?php echo home_url( '/leaderboard' ) ?>">
                                        <div class="rates row mx-0 align-items-center">
                                            <?php
                                        $courseRates = $public_ins->wpsmp_get_my_points_rattings('course');
                                        
                                        if($courseRates){
                                            // Stotre total points from individual rates
                                            $ratingsum = 0;
                                            foreach( $courseRates as $rates){
                                                $ratingsum = $rates->total;
                                                echo '<div class="col-6 col-sm-5 p-0">';
                                                echo '<span class="course_name">'.$rates->rate_for.'</span>';
                                                echo '</div>';

                                                // rating val
                                                echo '<div class="col-5 rates_icon">';
                                                echo $public_ins->get_rattings_icons($ratingsum);
                                                echo '</div>';
                                                echo '<div class="col-6 col-sm-2 text-right p-0"><span class="totalofproject"><i class="fas fa-award _awerd_icon"></i>&nbsp;'.$public_ins->formatwccountinwithsuffix($ratingsum).'</span></div>';
                                            }
                                        }
                                        ?>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <!-- MORALS TAB -->
                            <div class="tab-pane" id="morals_earn" role="tabpanel" aria-labelledby="morals_earn-tab">
                                <!-- skill item -->
                                <div class="course_item my-2">
                                    <a href="<?php echo home_url( '/leaderboard' ) ?>">
                                        <div class="rates row mx-0 align-items-center">
                                            <?php
                                        $skills = $public_ins->wpsmp_get_my_points_rattings('skill');
                                        
                                        if($skills){
                                            // Stotre total points from individual rates
                                            $pointsres = 0;
                                            foreach( $skills as $item){
                                                $pointsres = $item->total;
                                                echo '<div class="col-6 col-sm-5 p-0">';
                                                echo '<span class="course_name">'.$item->rate_for.'</span>';
                                                echo '</div>';

                                                // rating val
                                                echo '<div class="col-5 rates_icon">';
                                                echo $public_ins->get_rattings_icons($pointsres);
                                                echo '</div>';
                                                echo '<div class="col-6 col-sm-2 text-right p-0"><span class="totalofproject"><i class="fas fa-award _awerd_icon"></i>&nbsp;'.$public_ins->formatwccountinwithsuffix($pointsres).'</span></div>';
                                            }
                                        }
                                        ?>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <?php else: ?>
                            <!-- IF No Earnings -->
                            <div class="tab-pane" id="rates_courses_earn">
                                <div class="card rates_courses_card pt-4 mb-4">
                                    <img class="iconimg" src="<?php echo $myprofile->avatarurl.'points.jpg'; ?>"
                                        alt="">
                                    <div class="card-body">
                                        <blockquote class="mx-auto text-center">
                                            Here you will see all your points. Which you earn from teachers
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- All Projects -->
    <div class="container">
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
                                        <span class="delete__project" data-id="<?php echo $project->post_id; ?>"><i class="fa fa-trash projectdel" aria-hidden="true"></i></span>
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
</div>