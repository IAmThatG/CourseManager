<?php
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/7/2016
     * Time: 4:49 PM
     */

    //set page title
    $page_title = "E-Learner/register";

    //require all necessary file path
    //require_once ('C:\wamp\www\course_manager\includes\directories.php');
    require_once('C:\wamp\www\course_manager\classes\session.php');
    require_once('C:\wamp\www\course_manager\classes\lecturer.php');
    require_once('C:\wamp\www\course_manager\classes\student.php');
    require_once('C:\wamp\www\course_manager\classes\notice.php');
    require_once('C:\wamp\www\course_manager\classes\functions.php');
    require_once('C:\wamp\www\course_manager\controllers\lecturer_controller.php');
    require_once('C:\wamp\www\course_manager\controllers\student_controller.php');
    require_once ('C:\wamp\www\course_manager\classes\admin.php');
    require_once ('C:\wamp\www\course_manager\controllers\admin_controller.php');

    //set allowed roles
    $allowed_roles = array('unauth');

    //start a new session
    $session = new Session();
    $session->setUserRole("unauth");
    $session->setSiteRole($allowed_roles);

    //create new Student object
    $student = new Student();

    //create new lecturer object;
    $lecturer = new Lecturer();

    //create new Admin object
    $admin = new Admin();

    //create new Notice object
    $notice = new Notice();

    //create new Functions object
    $func = new Functions();

    //create a new StudentController object
    $stud_controller = new StudentController();

    //create a LecturerController object
    $lect_controller = new LecturerController();

    $admin_ctrl = new AdminController();

    //declare variables to hold post data and initialize them to empty string;
    $first_name = $last_name = $email = $password = $confirm_password = "";

    if(isset($_POST['register']))
    {
//        var_dump($_POST);

        //clean the input data
        $first_name = $func->cleanInputData($_POST['first_name']);
        $last_name = $func->cleanInputData($_POST['last_name']);
        $email = $func->cleanInputData($_POST['email']);
        $password = $func->cleanInputData($_POST['password']);
        $confirm_password = $func->cleanInputData($_POST['confirm_password']);

        //set Student property with the cleaned input data
        $lecturer->setFirstName($first_name);
        $lecturer->setLastName($last_name);
        $lecturer->setEmail($email);
        $lecturer->setPassword($password);
        $lecturer->setConfirmPassword($confirm_password);

        $notice = $lect_controller->registerLecturer($lecturer);
    }

    $email = $password = "";
    if(isset($_POST['login']))
    {
        if($_POST['loginAs'] == "student")
        {
            $email = $func->cleanInputData($_POST['email']);
            $password = $func->cleanInputData($_POST['password']);

            $student->setEmail($email);
            $student->setPassword($password);

            $notice = $stud_controller->Login($student);
        }
        if($_POST['loginAs'] == "lecturer")
        {
            $email = $func->cleanInputData($_POST['email']);
            $password = $func->cleanInputData($_POST['password']);

            $lecturer->setEmail($email);
            $lecturer->setPassword($password);

            $notice = $lect_controller->Login($lecturer);
        }
        if($_POST['loginAs'] == "admin")
        {
            $email = $func->cleanInputData($_POST['email']);
            $password = $func->cleanInputData($_POST['password']);

            $admin->setEmail($email);
            $admin->setPassword($password);

            $notice = $admin_ctrl->Login($admin);
        }
    }
?>
<?php
    include_once(PUBLIC_LOC . "layouts/index_header.php");
    include_once(PUBLIC_LOC . "layouts/nav.php");
    include_once(PUBLIC_LOC . "layouts/register_modal.php");
?>

<div id="blue">
    <div class="container">
        <div class="row centered">
            <div class="col-lg-8 col-lg-offset-2">
                <h4><b>JOIN OUR NETWORK OF LECTURERS AND IMPART KNOWLEDGE</b></h4>
                <p>JUST SIGNUP AND GET PLUGGED-IN</p>
            </div>
        </div><!-- row -->
    </div><!-- container -->
</div><!-- blue wrap -->

<div class="col-md-12 text-center h4"><h4><b><?=$notice->display();?></b></h4></div>

<div class="container w">
    <div class="col-md-offset-3 col-md-6">
        <form class="form-horizontal" role="form" action="<?=SITE_ROOT?>public/register.php" method="post">
            <div class="form-group">
                <div class="col-md-5">
                    <label for="first_name">First Name</label>
                </div>
                <div class="col-md-7">
                    <input type="text" class="form-control" name="first_name" placeholder="Enter First Name" value="<?=$lecturer->getFirstName();?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-5">
                    <label for="last_name">Last Name</label>
                </div>
                <div class="col-md-7">
                    <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" value="<?=$lecturer->getLastName();?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-5">
                    <label for="email">Email</label>
                </div>
                <div class="col-md-7">
                    <input type="email" class="form-control" name="email" placeholder="Enter Email" value="<?=$lecturer->getEmail();?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-5">
                    <label for="password">Password</label>
                </div>
                <div class="col-md-7">
                    <input type="password" class="form-control" name="password" placeholder="Enter Password" value="">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-5">
                    <label for="password">Confirm Password</label>
                </div>
                <div class="col-md-7">
                    <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" value="">
                </div>
            </div>
            <br><br>
            <div class="form-group">
                <div class="col-md-offset-5">
                    <button type="submit" class="btn btn-primary" name="register"><b>Register</b></button>
                </div>
            </div>
        </form>
    </div>
</div>
<br><br><br><br><br><br><br><br>
<?php
    include_once(PUBLIC_LOC."layouts/index_footer.php");
?>