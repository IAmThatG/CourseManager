<?php
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/10/2016
     * Time: 4:47 AM
     */
    $page_title = "E-Learner/lecturer_home";

    require_once ('C:\wamp\www\course_manager\classes\session.php');
    require_once ('C:\wamp\www\course_manager\classes\functions.php');
    require_once ('C:\wamp\www\course_manager\controllers\lecturer_controller.php');
    require_once ('C:\wamp\www\course_manager\models\lecturer_model.php');
    require_once ('C:\wamp\www\course_manager\classes\course.php');
    require_once ('C:\wamp\www\course_manager\models\course_model.php');

    $allowed_roles = array('lecturer');

    $session = new Session();
    $func = new Functions();
    $courses = new Course();
    $course_mod = new CourseModel();

    $uid = $session->getUserID();

    $role = $session->getUserRole();
    $session->setSiteRole($allowed_roles);
//
//    var_dump($uid);
//    var_dump($role);

    $lect_model = new LecturerModel();
    $lecturer = $lect_model->getLectById($uid);
//    var_dump($lecturer);

    $ass_course = $course_mod->checkAssigned($uid);
//    var_dump($ass_course);

//    for($i = 0; $i < count($ass_course); $i++)
//    {
//        $course_list = $ass_course[$i];
//        $found_course = $course_mod->getCourseById($course_list->getId());
//        var_dump($found_course);
//    }
?>
<?php
    include_once (PUBLIC_LOC."layouts/header.php");
    include_once (PUBLIC_LOC."layouts/nav_lecturer.php");
?>

<div id="blue">
    <div class="container">
        <div class="row centered">
            <div class="col-lg-8 col-lg-offset-2">
                <h4><b>WELCOME <?=strtoupper($lecturer->fullName())?>!!!</b></h4>
                <p>Here Are the Courses Assigned to you</p>
            </div>
        </div><!-- row -->
    </div><!-- container -->
</div><!-- blue wrap -->

<div class="container w">
    <div class="row">
        <div class="col-md-offset-1 col-md-9">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th><h4 class="text-center text-info">COURSE CODE</h4></th>
                        <th><h4 class="text-center text-info">COURSE TITLE</h4></th>
                        <th><h4 class="text-center text-info">OPTIONS</h4></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        for($i = 0; $i < count($ass_course); $i++)
                        {
                            $course_list = $ass_course[$i];
                            $found_course = $course_mod->getCourseById($course_list->getId());
                            ?>
                            <tr>
                                <td><h4 class="text-center text-info"><?=$found_course->getCourseCode();?></h4></td>
                                <td><h4 class="text-center text-info"><?=$found_course->getCourseTitle();?></h4></td>
                                <!--<td><h4 class="text-center text-info"><?/*= $course_list->getServiceName(); */?></h4></td>-->
                                <td>
                                    <div class="text-center">
                                        <a href="<?=PUBLIC_PATH?>lecturer/course_view.php?course_id=<?=$found_course->getId();?>" class="btn btn-primary"><b>View Course</b></a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="#?course_id=<?=$found_course->getId();?>" class="btn btn-danger"><b>Opt Out</b></a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                    ?>
                    </tbody>
                </table>
                <br><br><br>
            </div>
        </div>
    </div>
</div>

<?php include_once (PUBLIC_LOC."layouts/footer.php");?>

