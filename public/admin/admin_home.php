<?php
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/11/2016
     * Time: 7:49 AM
     */
    $page_title = "E-Learner/admin_home";
    require_once ('C:\wamp\www\course_manager\classes\course.php');
    require_once ('C:\wamp\www\course_manager\controllers\course_controller.php');
    require_once ('C:\wamp\www\course_manager\models\course_model.php');
    require_once ('C:\wamp\www\course_manager\classes\notice.php');
    require_once ('C:\wamp\www\course_manager\classes\session.php');
    require_once ('C:\wamp\www\course_manager\classes\functions.php');
    require_once ('C:\wamp\www\course_manager\controllers\admin_controller.php');
    require_once ('C:\wamp\www\course_manager\models\admin_model.php');


    $allowed_roles = array('admin');

    $session = new Session();
    $func = new Functions();
    $notice = new Notice();
    $course = new Course();
    $course_ctrl = new CourseController();
    $course_model = new CourseModel();
    $admin_model = new AdminModel();

    $uid = $session->getUserID();

    $role = $session->getUserRole();
    $session->setSiteRole($allowed_roles);

//    var_dump($uid);
//    var_dump($role);

    $admin = $admin_model->getAdminById($uid);
//    var_dump($admin);

    //get all courses
    $courses = $course_model->getAllCourses();
//    var_dump($courses);

    $course_code = $course_title = $course_unit = $description = $course_img = "";
    if(isset($_POST['add_course']))
    {
        //var_dump($_POST);
        $course_code = $func->cleanInputData($_POST['course_code']);
        $course_title = $func->cleanInputData($_POST['course_title']);
        $course_unit = $func->cleanInputData($_POST['course_unit']);
        $description = $func->cleanInputData($_POST['description']);
        $course_img = $_FILES['course_img'];

        $course->setUploadedImg($course_img);
        $course->setCourseCode($course_code);
        $course->setCourseTitle($course_title);
        $course->setCourseUnit($course_unit);
        $course->setDescription($description);

        var_dump($course->getUploadedImg());
        $notice = $course_ctrl->addCourse($course);
        var_dump($notice);
    }
?>
<?php
    include_once (PUBLIC_LOC."layouts/header.php");
    include_once (PUBLIC_LOC."layouts/nav_admin.php");
    include_once (PUBLIC_LOC."admin/add_course_modal.php");
?>

<div id="blue">
    <div class="container">
        <div class="row centered">
            <div class="col-lg-8 col-lg-offset-2">
                <h4><b>Welcome <?=strtoupper($admin->fullName())?>!!!</b></h4>
            </div>
        </div><!-- row -->
    </div><!-- container -->
</div><!-- blue wrap -->

    <div class="col-md-12 text-center h4"><h4><b><?=$notice->display()?></b></h4></div>

<div class="container w">
    <br>
    <div class="row">
        <!-- Trigger add_course_modal -->
        <div class="col-md-offset-1">
            &nbsp;&nbsp;<button type="button" class="btn btn-info" data-toggle="modal" data-target="#addCourseModal"><b>ADD COURSE</b></button>
        </div>
        <br><br>
    </div>
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
                        for($i = 0; $i < count($courses); $i++)
                        {
                            $course_list = $courses[$i];
                            ?>
                                <tr>
                                    <td><h4 class="text-center text-info"><?=$course_list->getCourseCode();?></h4></td>
                                    <td><h4 class="text-center text-info"><?=$course_list->getCourseTitle();?></h4></td>
                                    <!--<td><h4 class="text-center text-info"><?/*= $course_list->getServiceName(); */?></h4></td>-->
                                    <td>
                                        <div class="text-center">
                                            <a href="<?=PUBLIC_PATH?>admin/assign.php?course_id=<?=$course_list->getId();?>" class="btn btn-primary"><b>Assign</b></a>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="course_edit.php?course_id=<?=$course_list->getId();?>"><button class="btn btn-primary text-center"><b>Edit</b></button></a>
                                            <!--<a href="course_edit.php?course_id=<?/*=$course_list->getId();*/?>" class="btn btn-primary"><b>Edit</b></a>-->
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="<?=PUBLIC_PATH?>admin/course_delete?course_id=<?=$course_list->getId();?>" class="btn btn-danger"><b>Delete</b></a>
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