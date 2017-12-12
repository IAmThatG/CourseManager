<?php
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/12/2016
     * Time: 11:17 PM
     */
    $page_title = "E-learner/admin/assign";

    require_once ('C:\wamp\www\course_manager\models\lecturer_model.php');
    require_once ('C:\wamp\www\course_manager\controllers\course_controller.php');
    require_once ('C:\wamp\www\course_manager\models\course_model.php');
    require_once ('C:\wamp\www\course_manager\classes\notice.php');
    require_once ('C:\wamp\www\course_manager\classes\session.php');
    require_once ('C:\wamp\www\course_manager\classes\functions.php');

    $allowed_roles = array('admin');

    $session = new Session();
    $func = new Functions();
    $notice = new Notice();
    $lecturer = new Lecturer();
    $course = new Course();

    $uid = $session->getUserID();
    $role = $session->getUserRole();
    $session->setSiteRole($allowed_roles);

    $course_id = "";
    @$course_id = isset($_GET['course_id']) ?  $func->cleanInputData($_GET['course_id']) : '';

    $course_ctrl = new CourseController();
    $course_model = new CourseModel();
    $lect_model = new LecturerModel();


    $found_course = $course_model->getCourseById($course_id);
//    var_dump($found_course);
    $lecturers = $lect_model->getAllLecturers();
//    var_dump($lecturers);

    $lect_id = $id = "";
    if(isset($_GET['course_id']) and isset($_GET['lect_id']))
    {
//        var_dump($_GET);
//        var_dump($_GET['lect_id']);
//        var_dump($_GET['course_id']);
        $lect_id = isset($_GET['lect_id']) ?  $func->cleanInputData($_GET['lect_id']) : '';
        $id = isset($_GET['course_id']) ?  $func->cleanInputData($_GET['course_id']) : '';

        $course->setId($id);
        $lecturer->setId($lect_id);

        $notice = $course_ctrl->assignCourse($course, $lecturer);
    }
?>
<?php
    include_once (PUBLIC_LOC."layouts/header.php");
    include_once (PUBLIC_LOC."layouts/nav_admin.php");
?>

<div id="blue">
    <div class="container">
        <div class="row centered">
            <div class="col-lg-8 col-lg-offset-2">
                <h4><b>ASSIGN <?=strtoupper($found_course->getCourseTitle());?> TO A LECTURER</b></h4>
            </div>
        </div><!-- row -->
    </div><!-- container -->
</div><!-- blue wrap -->

<div class="container w">
    <br>
    <div class="col-md-12 text-center h4"><h4><b><?=$notice->display();?></b></h4></div>
    <div class="row">
        <div class="col-md-offset-1 col-md-9">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th><h4 class="text-center text-info">FIRST NAME</h4></th>
                        <th><h4 class="text-center text-info">LAST NAME</h4></th>
                        <th><h4 class="text-center text-info">EMAIL</h4></th>
                        <th><h4 class="text-center text-info">OPTIONS</h4></th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                        for($i = 0; $i < count($lecturers); $i++)
                        {
                            $lect_list = $lecturers[$i];
                            ?>
                            <tr>
                                <td><h4 class="text-center text-info"><?=$lect_list->getFirstName();?></h4></td>
                                <td><h4 class="text-center text-info"><?=$lect_list->getLastName();?></h4></td>
                                <td><h4 class="text-center text-info"><?=$lect_list->getEmail();?></h4></td>
                                <td>
                                    <div class="text-center">
                                        <a href="<?=PUBLIC_PATH?>admin/assign.php?course_id=<?=$found_course->getId();?>&lect_id=<?=$lect_list->getId();?>"><button class="btn btn-primary text-center"><b>Assign</b></button></a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <button class="btn btn-danger text-center"><b>UnAssign</b></button>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                    ?>
<!--                    --><?php //require_once ('C:\wamp\www\course_manager\public\admin\assign_process.php'); ?>
                    </tbody>
                </table>
                <br><br><br><br><br>
            </div>
        </div>
    </div>
</div>

<?php include_once (PUBLIC_LOC."layouts/footer.php"); ?>
