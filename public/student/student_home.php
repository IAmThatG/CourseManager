<?php
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/10/2016
     * Time: 4:34 AM
     */
    $page_title = "E-Learner/student";

    require_once ('C:\wamp\www\course_manager\classes\session.php');
    require_once ('C:\wamp\www\course_manager\classes\functions.php');
    require_once ('C:\wamp\www\course_manager\controllers\student_controller.php');
    require_once ('C:\wamp\www\course_manager\models\student_model.php');
    require_once ('C:\wamp\www\course_manager\models\course_model.php');

    $allowed_roles = array('student');

    $session = new Session();
    $func = new Functions();

    $uid = $session->getUserID();

    $role = $session->getUserRole();
    $session->setSiteRole($allowed_roles);
    //   $uid = $_SESSION['user'];

//   var_dump($uid);
//    var_dump($role);

    $stud_model = new StudentModel();
    $course_model = new CourseModel();

    $student = $stud_model->getStudById($uid);
//    var_dump($student);

    $courses = $course_model->getAllCourses();
?>
<?php
    include_once (PUBLIC_LOC."layouts/header.php");
    include_once (PUBLIC_LOC."layouts/nav_student.php");
?>

<div id="blue">
    <div class="container">
        <div class="row centered">
            <div class="col-lg-8 col-lg-offset-2">
                <h4><b>WELCOME <?=strtoupper($student->fullName())?>!!!</b></h4>
                <p>Feel Free To SignUp For Any Course</p>
            </div>
        </div><!-- row -->
    </div><!-- container -->
</div><!-- blue wrap -->

<div class="container w">
    <div class="row">
        <?php for($i = 0; $i < count($courses); $i++) {
            $course_list = $courses[$i];
            ?>
            <div class="col-md-6 text-center">
                <a href="<?=PUBLIC_PATH?>student/course_details.php?course_id=<?=$course_list->getId()?>">
                    <img src="<?= COURSE_PIC_URL ?><?= $course_list->getCourseImg() ?>" class="img-circle tilt" width="150" height="150">
                </a>
                <div class="caption">
                    <br>
                    <h4 class="text-center text-primary"><?=strtoupper($course_list->getCourseTitle())?></h4>
                </div>
                <br><br><br>
            </div>
            <?php
        }
        ?>
    </div>
</div>

<?php include_once (PUBLIC_LOC."layouts/footer.php");?>

