<?php
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/22/2016
     * Time: 5:00 AM
     */
    $page_title = "E-Learner: course_details";

    require_once ('C:\wamp\www\course_manager\classes\session.php');
    require_once ('C:\wamp\www\course_manager\classes\functions.php');
    require_once ('C:\wamp\www\course_manager\models\course_model.php');
    require_once ('C:\wamp\www\course_manager\models\week_model.php');
    require_once ('C:\wamp\www\course_manager\classes\notice.php');
    require_once ('C:\wamp\www\course_manager\classes\enrolment.php');
    require_once ('C:\wamp\www\course_manager\controllers\enrolment_controller.php');

    $allowed_roles = array('student');

    $session = new Session();
    $func = new Functions();
    $enrolment = new Enrolment();
    $notice = new Notice();

    $course_model = new CourseModel();
    $week_model = new WeekModel();
    $enrolment_ctrl = new EnrolmentController();

    $uid = $session->getUserID();
    $role = $session->getUserRole();
    $session->setSiteRole($allowed_roles);

    $course_id = "";
    $course_id = isset($_GET['course_id']) ?  $func->cleanInputData($_GET['course_id']) : '';
//    if(isset($course_id))
//    {
//        var_dump($course_id);
//    }

    $found_course = $course_model->getCourseById($course_id);
    $weeks = $week_model->getAllWeeks($course_id);

    $id = $stud_id = "";
    if(isset($_POST['enrol']))
    {
        var_dump($_POST);
        $id = $func->cleanInputData($_POST['id']);
        $stud_id = $func->cleanInputData($_POST['stud_id']);

        $enrolment->setStudentId($stud_id);
        $enrolment->setCourseId($id);

        $notice = $enrolment_ctrl->enrol($enrolment);
    }
?>
<?php
    include_once (PUBLIC_LOC."layouts/header.php");
    include_once (PUBLIC_LOC."layouts/nav_student.php");
?>

<div id="blue">
    <div class="container">
        <div class="row centered">
            <div class="col-lg-8 col-lg-offset-2">
                <h4><b><?=strtoupper($found_course->getCourseCode() . ": " . $found_course->getCourseTitle())?></b></h4>
            </div>
        </div><!-- row -->
    </div><!-- container -->
</div><!-- blue wrap -->

<div class="col-md-12 text-center h4"><h4><b><?=$notice->display();?></b></h4></div>

<div class="container w">
    <div class="text-center">
        <img src="<?= COURSE_PIC_URL ?><?= $found_course->getCourseImg() ?>" class="img-circle tilt" width="100" height="100">
        <form role="form" action="course_details.php?course_id=<?=$course_id?>" method="post">
            <input type="hidden" name="id" value="<?=$course_id?>">
            <input type="hidden" name="stud_id" value="<?=$uid?>"><br>
            <input type="submit" class="btn btn-primary" name="enrol" value="Enrol">
        </form>
    </div>
    <div class="col-md-offset-2 col-md-8">
        <div class="page-header"><h3 class="text-primary">About Course</h3></div>
        <div class="h4 text-primary">Units: <?=$found_course->getCourseUnit()?></div>
        <div class="h4"><?=$found_course->getDescription()?></div>
        <br><br>
        <div class="h4 text-primary">Here Are The Topics For This Course</div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th><h4 class="text-center text-primary">WEEK</h4></th>
                <th><h4 class="text-center text-primary">TOPIC</h4></th>
            </tr>
            </thead>
            <tbody>
            <?php
                for($i = 0; $i < count($weeks); $i++)
                {
                    $week_list = $weeks[$i];
                    ?>
                    <tr>
                        <td><h4 class="text-center text-primary"><?=$week_list->getWeek()?></h4></td>
                        <td><h4 class="text-center text-primary"><?=$week_list->getTopic()?></h4></td>
                    </tr>
                    <?php
                }
            ?>
            </tbody>
        </table>
    </div>
</div>

<?php include_once (PUBLIC_LOC."layouts/footer.php");?>
