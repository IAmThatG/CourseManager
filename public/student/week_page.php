<?php
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 11/3/2016
     * Time: 11:38 AM
     */

    $page_title = "E-Learner:week_page";

    require_once ('C:\wamp\www\course_manager\classes\session.php');
    require_once ('C:\wamp\www\course_manager\classes\functions.php');
    require_once ('C:\wamp\www\course_manager\controllers\lecturer_controller.php');
    require_once ('C:\wamp\www\course_manager\models\lecturer_model.php');
    require_once ('C:\wamp\www\course_manager\classes\week.php');
    require_once ('C:\wamp\www\course_manager\models\course_model.php');
    require_once ('C:\wamp\www\course_manager\models\week_model.php');
    require_once ('C:\wamp\www\course_manager\controllers\week_controller.php');
    require_once ('C:\wamp\www\course_manager\classes\resource.php');
    require_once ('C:\wamp\www\course_manager\controllers\resource_controller.php');
    require_once ('C:\wamp\www\course_manager\models\resource_model.php');

    $allowed_roles = array('student');

    $session = new Session();
    $func = new Functions();
    $notice = new Notice();
    $lecturer = new Lecturer();
    $new_week = new Week();
    $resource = new CourseResource();

    $uid = $session->getUserID();
//    var_dump($uid);
    $role = $session->getUserRole();
//    var_dump($role);
    $session->setSiteRole($allowed_roles);

    $week_id = "";
    $week_id = isset($_GET['week_id']) ?  $func->cleanInputData($_GET['week_id']) : '';
//    if(isset($week_id))
//        var_dump($week_id);

    $course_id = "";
    $course_id = isset($_GET['course_id']) ?  $func->cleanInputData($_GET['course_id']) : '';
//    if(isset($course_id))
//        var_dump($course_id);

    $week_ctrl = new WeekController();
    $week_model = new WeekModel();
    $resource_mod = new ResourceModel();

    $weeks = $week_model->getAllWeeks($course_id);
    $found_week = $week_model->getWeekById($week_id);
    $documents = $resource_mod->getResourceByType("Document", $week_id);
    $videos = $resource_mod->getResourceByType("Video", $week_id);
//    var_dump($weeks);
//    var_dump($found_week);
//    var_dump($documents);
//    var_dump($videos);
?>
<?php
    include_once (PUBLIC_LOC."layouts/header.php");
    include_once (PUBLIC_LOC."layouts/nav_student.php");
?>
<div id="blue">
    <div class="container">
        <div class="row centered">
            <div class="col-lg-8 col-lg-offset-2">
                <h4><b><?=strtoupper($found_week->getWeek())?>: <?=strtoupper($found_week->getTopic())?></b></h4>
            </div>
        </div><!-- row -->
    </div><!-- container -->
</div><!-- blue wrap -->

<div class="col-md-12 text-center h4"><h4><b><?=$notice->display()?></b></h4></div>

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
                                <li><a href="<?=PUBLIC_PATH?>student/week_page.php?course_id=<?=$course_id?>&week_id=<?=$week_list->getId()?>$"><?=strtoupper($week_list->getWeek())?></a></li>
                                <?php
                            }
                        ?>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>

        <div class="col-md-10">
            <div class="col-md-offset-1">
                <h4><?=$found_week->getBody()?></h4>
                <br><br>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="page-header"><h3 class="text-primary">Documents</h3></div>
                    <?php
                        if(empty($documents))
                            echo "<h4>No Document Available...</h4>";
                        for($i = 0; $i < count($documents); $i++)
                        {
                            $doc_list = $documents[$i];
                            ?>
                            <div class="col-md-4">
                                <h4 class="text-primary">Title: <?= ($doc_list->getTitle()) ?></h4>
                                <h4 class="text-primary">Summary: <?= ($doc_list->getSummary()) ?></h4>
                                <a href="<?= RESOURCE_URL . $doc_list->getUrl() ?>"><h4 class="">Download</h4></a>
                            </div>
                            <?php
                        }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-11 col-md-offset-1">
                    <div class="page-header"><h3 class="text-primary">Videos</h3></div>
                    <?php
                        if(empty($videos))
                            echo "<h4>No Video Available...</h4>";
                        for($i = 0; $i < count($videos); $i++)
                        {
                            $video_list = $videos[$i];
                            ?>
                            <div class="col-md-11">
                                <video width="700" height="400" controls>
                                    <source src="<?=RESOURCE_URL . $video_list->getUrl()?>">
                                    Your browser does not support the video tag.
                                </video>
                                <h4 class="text-primary">Title: <?=($video_list->getTitle())?></h4>
                                <h4 class="text-primary">Summary: <?=($video_list->getSummary())?></h4>
                                <a href="<?=RESOURCE_URL . $video_list->getUrl()?>"> <h4 class="">Download</h4></a>
                            </div>
                            <?php
                        }
                    ?>
                </div>
            </div>
            <br><br><br>
        </div>
    </div>
</div>

<?php include_once (PUBLIC_LOC."layouts/footer.php");?>

