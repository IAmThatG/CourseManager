<?php
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 11/3/2016
     * Time: 12:24 PM
     */

    $page_title = "E-Learner:course_view";

    require_once ('C:\wamp\www\course_manager\classes\session.php');
    require_once ('C:\wamp\www\course_manager\classes\functions.php');
    require_once ('C:\wamp\www\course_manager\classes\week.php');
    require_once ('C:\wamp\www\course_manager\models\week_model.php');
    require_once ('C:\wamp\www\course_manager\controllers\week_controller.php');
    require_once ('C:\wamp\www\course_manager\models\course_model.php');

    $allowed_roles = array('student');

    $session = new Session();
    $func = new Functions();
    $notice = new Notice();
    $new_week = new Week();

    $uid = $session->getUserID();
    $role = $session->getUserRole();
    $session->setSiteRole($allowed_roles);

    $course_id = "";
    $course_id = isset($_GET['course_id']) ?  $func->cleanInputData($_GET['course_id']) : '';
//    if(isset($course_id))
//        var_dump($course_id);

    $week_ctrl = new WeekController();
    $week_model = new WeekModel();
    $course_model = new CourseModel();
    $found_course = $course_model->getCourseById($course_id);

    $weeks = $week_model->getAllWeeks($course_id);
//    var_dump($weeks);
?>
<?php
    include_once (PUBLIC_LOC."layouts/header.php");
    include_once (PUBLIC_LOC."layouts/nav_student.php");
?>

<div id="blue">
    <div class="container">
        <div class="row centered">
            <div class="col-lg-8 col-lg-offset-2">
                <h4><b><?=strtoupper($found_course->getCourseTitle())?></b></h4>
            </div>
        </div><!-- row -->
    </div><!-- container -->
</div><!-- blue wrap -->

<div class="col-md-12 text-center h4"><h4><b><?=$notice->display();?></b></h4></div>

<div class="container w">
    <div class="row">
        <div class="col-md-2">
            <div class="navbar navbar-inverse">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse">
                    <h3 class="text-primary">WEEKS</h3>
                    <ul class="nav navbar-nav">
                        <?php
                            for($i = 0; $i < count($weeks); $i++)
                            {
                                $week_list = $weeks[$i];
                                ?>
                                <li><a href="<?=PUBLIC_PATH?>student/week_page.php?course_id=<?=$course_id?>&week_id=<?=$week_list->getId()?>"><?=strtoupper($week_list->getWeek())?></a></li>
                                <?php
                            }
                        ?>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>

        <div class="col-md-10">
            <div class="text-center">
                <img src="<?= COURSE_PIC_URL ?><?= $found_course->getCourseImg() ?>" class="img-circle tilt" width="100" height="100">
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
    </div>
</div>
<?php include_once (PUBLIC_LOC."layouts/footer.php");?>
