<?php
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/13/2016
     * Time: 2:23 PM
     */
    $page_title = "E-Learner/admin/course_edit";

    require_once ('C:\wamp\www\course_manager\classes\course.php');
    require_once ('C:\wamp\www\course_manager\controllers\course_controller.php');
    require_once ('C:\wamp\www\course_manager\models\course_model.php');
    require_once ('C:\wamp\www\course_manager\classes\notice.php');
    require_once ('C:\wamp\www\course_manager\classes\session.php');
    require_once ('C:\wamp\www\course_manager\classes\functions.php');

    //var_dump($course_id);
    $allowed_roles = array('admin');

    $session = new Session();
    $func = new Functions();
    $notice = new Notice();
    $course = new Course();

    $course_ctrl = new CourseController();
    $course_model = new CourseModel();

    $uid = $session->getUserID();
    $role = $session->getUserRole();
    $session->setSiteRole($allowed_roles);

    //var_dump($_GET['course_id']);
    $course_id = "";
    $course_id = isset($_GET['course_id']) ?  $func->cleanInputData($_GET['course_id']) : '';

    $found_course = $course_model->getCourseById($course_id);

    //var_dump($course);


    $id = $course_code = $course_title = $course_unit = $description = $course_img = "";
    if(isset($_POST['edit_course']))
    {
        $id = $func->cleanInputData($_POST['id']);
        $course_code = $func->cleanInputData($_POST['course_code']);
        $course_title = $func->cleanInputData($_POST['course_title']);
        $course_unit = $func->cleanInputData($_POST['course_unit']);
        $description = $func->cleanInputData($_POST['description']);
        $course_img = $_FILES['course_img'];

        //var_dump($course_img);

        $course->setId($id);
        $course->setCourseCode($course_code);
        $course->setCourseTitle($course_title);
        $course->setCourseUnit($course_unit);
        $course->setDescription($description);
        $course->setUploadedImg($course_img);

        $notice = $course_ctrl->editCourse($course);
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
                    <h4><b>EDIT <?=strtoupper($found_course->getCourseTitle());?></b></h4>
                </div>
            </div><!-- row -->
        </div><!-- container -->
    </div><!-- blue wrap -->

    <div class="col-md-12 text-center h4"><h4><b><?=$notice->display();?></b></h4></div>

    <div class="container w">
            <form class="form-horizontal" role="form" action="<?=PUBLIC_PATH?>admin/course_edit.php?course_id=<?=$course_id?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?=$course_id;?>">
                <div class="row">
                    <div class="col-md-offset-1 col-md-6">
                        <div class="form-group">
                            <div class="col-md-5">
                                <label for="course_code">Course Code</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="course_code" placeholder="Enter Course Code" value="<?=$found_course->getCourseCode();?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-5">
                                <label for="course_title">Course Title</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="course_title" placeholder="Enter Course Title" value="<?=$found_course->getCourseTitle();?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-5">
                                <label for="course_unit">Course Unit:</label>
                            </div>
                            <div class="col-md-7">
                                <select class="form-control" name="course_unit">
                                    <option><?=$found_course->getCourseUnit();?></option>
                                    <option>0</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                    <option>7</option>
                                    <option>8</option>
                                    <option>9</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-5">
                                <label for="description">Course Description</label>
                            </div>
                            <div class="col-md-7">
                                <textarea class="form-control" rows="10" name="description" placeholder="Describe Course"><?=$found_course->getDescription();?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="panel panel-primary text-center">
                            <div class="panel panel-heading">
                                <div class="panel-title">
                                    <b>Course Cover Image</b>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <div class="col-md-2"></div>
                                    <!--<label for="image_url"><h4>Book Cover</h4></label>-->
                                    <div class="col-md-8">
                                        <br>
                                        <img src="<?= COURSE_PIC_URL ?><?= $found_course->getCourseImg(); ?>" class="img-rounded tilt" width="300" height="200">
                                        <br/><br/>
                                        <input type="file" name="course_img">
                                    </div>
                                    <div class="col-md-2"></div>
                                    <!--<input type="url" class="form-control" id="image_url" placeholder="Book Image url" name="image_url" value="<?/*=$book->image_url*/?>" >-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <br><br>
                        <div class="col-md-offset-5">
                            <input type="submit" class="btn btn-primary btn-lg" name="edit_course" value="Edit Course">
                            <!--<button type="submit" class="btn btn-primary btn-lg" name="edit_course"><b>Edit Course</b></button>-->
                        </div>
                    </div>
                </div>
            </form>
            <br><br><br><br><br><br><br>
    </div>

<?php include_once (PUBLIC_LOC."layouts/footer.php");?>