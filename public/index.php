<?php
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 8/31/2016
     * Time: 10:57 PM
     */
    //set page title
    $page_title = "E-Learner/Home";

    //require all necessary file path
    require_once ('C:\wamp\www\course_manager\classes\session.php');
    require_once ('C:\wamp\www\course_manager\classes\student.php');
    require_once ('C:\wamp\www\course_manager\classes\notice.php');
    require_once ('C:\wamp\www\course_manager\classes\functions.php');
    require_once ('C:\wamp\www\course_manager\controllers\student_controller.php');
    require_once ('C:\wamp\www\course_manager\classes\lecturer.php');
    require_once ('C:\wamp\www\course_manager\controllers\lecturer_controller.php');
    require_once ('C:\wamp\www\course_manager\classes\admin.php');
    require_once ('C:\wamp\www\course_manager\controllers\admin_controller.php');

    //set allowed roles
    $allowed_roles = array('unauth');

    //start a new session
    $session = new Session();

    $session->setUserRole("unauth");
    $session->setSiteRole($allowed_roles);

//    var_dump($uid);
//    var_dump($session->getUserRole());
    //create new Student object
    $student = new Student();

    $lecturer = new Lecturer();

    $admin = new Admin();

    //create new Notice object
    $notice = new Notice();

    //create new Functions object
    $func = new Functions();

    //create a new StudentController object
    $stud_controller = new StudentController();

    $lect_ctrl = new LecturerController();

    $admin_ctrl = new AdminController();

    //declare variables to hold post data and initialize them to empty string;
    $matric_no = $first_name = $last_name = $email = $password = $confirm_password = "";

    //if form is submitted, do the following;
    if (isset($_POST['submit']))
    {
//        var_dump($_POST);

        //clean the input data
        $matric_no = $func->cleanInputData($_POST['matric_no']);
        $first_name = $func->cleanInputData($_POST['first_name']);
        $last_name = $func->cleanInputData($_POST['last_name']);
        $email = $func->cleanInputData($_POST['email']);
        $password = $func->cleanInputData($_POST['password']);
        $confirm_password = $func->cleanInputData($_POST['confirm_password']);

        //set Student property with the cleaned input data
        $student->setMatricNo($matric_no);
        $student->setFirstName($first_name);
        $student->setLastName($last_name);
        $student->setEmail($email);
        $student->setPassword($password);
        $student->setConfirmPassword($confirm_password);

        $notice = $stud_controller->registerStudent($student);
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

            $notice = $lect_ctrl->Login($lecturer);
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
    include_once (PUBLIC_LOC."layouts/index_header.php");
    include_once (PUBLIC_LOC."layouts/nav.php");
    include_once(PUBLIC_LOC . "layouts/index_modal.php");
?>
    <div class="col-md-12 text-center h4"><h4><b><?=$notice->display();?></b></h4></div>

    <div id="headerwrap">
        <div class="container">
            <div class="row centered">
                <div class="col-md-8 col-md-offset-2">
                    <h1>Welcome to the world's best <b>E-learning</b> center</h1>
                    <h2>we make learning fun</h2>
                </div>
            </div><!-- row -->
        </div><!-- container -->
    </div><!-- headerwrap -->

    <div class="container w">
        <div class="row centered">
            <br><br>
            <div class="col-md-4">
                <i class="fa fa-heart"></i>
                <h4>DESIGN</h4>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even believable.</p>
            </div><!-- col-lg-4 -->

            <div class="col-lg-4">
                <i class="fa fa-laptop"></i>
                <h4>BOOTSTRAP</h4>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even believable.</p>
            </div><!-- col-lg-4 -->

            <div class="col-lg-4">
                <i class="fa fa-trophy"></i>
                <h4>SUPPORT</h4>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even believable.</p>
            </div><!-- col-lg-4 -->
        </div><!-- row -->
        <br>
        <br>
    </div><!-- container -->

    <!-- PORTFOLIO SECTION -->
    <div id="dg">
        <div class="container">
            <div class="row centered">
                <h4>LATEST COURSES</h4>
                <br>
<!--                <div class="col-lg-4">-->
<!--                    <div class="tilt">-->
<!--                        <a href="#"><img src="assets/images/p01.png" alt=""></a>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <div class="col-lg-4">-->
<!--                    <div class="tilt">-->
<!--                        <a href="#"><img src="assets/images/p03.png" alt=""></a>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <div class="col-lg-4">-->
<!--                    <div class="tilt">-->
<!--                        <a href="#"><img src="assets/images/p02.png" alt=""></a>-->
<!--                    </div>-->
<!--                </div>-->
            </div><!-- row -->
        </div><!-- container -->
    </div><!-- DG -->

    <!-- FEATURE SECTION -->
    <div class="container wb">
        <div class="row centered">
            <br><br>
            <div class="col-lg-8 col-lg-offset-2">
                <h2><b>Register</b> with us and begin your learning journey</h2>
                <p>pls provide your details by filling the form below</p>
                <p><br/></p>
            </div>
<!--            <div class="col-md-2"></div>-->
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="page-header"></div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" action="index.php" method="post">
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="matric_no">Matric Number</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="number" maxlength="9" class="form-control" id="matric_no" name="matric_no" placeholder="Enter matriculation number" value="<?= $student->getMatricNo(); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="first_name">First Name</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" value="<?= $student->getFirstName();?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="last_name">Last Name</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" value="<?= $student->getLastName(); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="email">Email</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="<?= $student->getEmail(); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="password">Password</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="confirm_password">Confirm Password</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-primary btn-block" value="Submit"/>
                            </div>
                        </form>
                        <br>
                        <p>Do you love to impart knowlege? Register as a <a href="register.php"><h3>Lecturer</h3></a></p>
                    </div>
                </div>
            </div>
        </div><!-- row -->
    </div><!-- container -->

    <div id="lg">
        <div class="container">
            <div class="row centered">
                <h4>OUR AWESOME CLIENTS</h4>
                <div class="col-lg-2 col-lg-offset-1">
                    <img src="assets/images/c01.gif" alt="">
                </div>
                <div class="col-lg-2">
                    <img src="assets/images/c02.gif" alt="">
                </div>
                <div class="col-lg-2">
                    <img src="assets/images/c03.gif" alt="">
                </div>
                <div class="col-lg-2">
                    <img src="assets/images/c04.gif" alt="">
                </div>
                <div class="col-lg-2">
                    <img src="assets/images/c05.gif" alt="">
                </div>
            </div><!-- row -->
        </div><!-- container -->
    </div><!-- dg -->

<?php
    include_once (PUBLIC_LOC."layouts/index_footer.php");
//    include('C:\wamp\www\course_manager\public\layouts\index_footer.php');
?>

