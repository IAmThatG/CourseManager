<?php
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/23/2016
     * Time: 4:45 AM
     */
    $page_title = "E-Learner: my_courses";

    require_once ('C:\wamp\www\course_manager\classes\session.php');
    require_once ('C:\wamp\www\course_manager\models\course_model.php');
    require_once ('C:\wamp\www\course_manager\classes\notice.php');
    require_once ('C:\wamp\www\course_manager\classes\enrolment.php');
    require_once ('C:\wamp\www\course_manager\controllers\enrolment_controller.php');

    $allowed_roles = array('student');

    $session = new Session();
    $enroled = new Enrolment();
    $enroled = new Notice();
    $enrolment_ctrl = new EnrolmentController();
    $course_mod = new CourseModel();

    $uid = $session->getUserID();
    //var_dump($uid);
    $role = $session->getUserRole();
    $session->setSiteRole($allowed_roles);

    $enroled = $enrolment_ctrl->showEnrolled($uid);
    //var_dump($enroled);
?>
<?php
    include_once (PUBLIC_LOC."layouts/header.php");
    include_once (PUBLIC_LOC."layouts/nav_student.php");
?>
<div id="blue">
    <div class="container">
        <div class="row centered">
            <div class="col-lg-8 col-lg-offset-2">
                <h4><b>Here Are Courses You Have Enroled For</b></h4>
            </div>
        </div><!-- row -->
    </div><!-- container -->
</div><!-- blue wrap -->

<div class="container w">
    <div class="row">

        <?php
            if ($enroled == 0)
                echo '<div class="col-md-12 text-center alert alert-info">
                        <h4><b>You Have Not Enroled for Any Course</b></h4>
                    </div><br><br><br><br><br><br><br><br><br>';
            for($i = 0; $i < count($enroled); $i++)
            {
                $enrolment_list = $enroled[$i];
                $enroled_courses = $course_mod->getCourseById($enrolment_list->getId());
                //var_dump($enroled_courses);
                ?>
                <div class="col-md-6 text-center">
                    <a href="<?=PUBLIC_PATH?>student/course_view.php?course_id=<?=$enroled_courses->getId()?>">
                        <img src="<?= COURSE_PIC_URL ?><?= $enroled_courses->getCourseImg() ?>" class="img-circle tilt" width="150" height="150">
                    </a>
                    <div class="caption">
                        <br>
                        <h4 class="text-center text-primary"><?=strtoupper($enroled_courses->getCourseTitle())?></h4>
                    </div>
                    <br><br><br>
                </div>
                <?php
            }
        ?>
    </div>
</div>
<?php include_once (PUBLIC_LOC."layouts/footer.php");?>
