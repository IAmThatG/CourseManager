<?php
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/14/2016
     * Time: 12:39 AM
     */

    $page_title = "E-Learner/week_edit";

    require_once ('C:\wamp\www\course_manager\classes\session.php');
    require_once ('C:\wamp\www\course_manager\classes\functions.php');
    require_once ('C:\wamp\www\course_manager\controllers\lecturer_controller.php');
    require_once ('C:\wamp\www\course_manager\models\lecturer_model.php');
    require_once ('C:\wamp\www\course_manager\classes\week.php');
    require_once ('C:\wamp\www\course_manager\models\course_model.php');
    require_once ('C:\wamp\www\course_manager\models\week_model.php');
    require_once ('C:\wamp\www\course_manager\controllers\week_controller.php');

    $allowed_roles = array('lecturer');

    $session = new Session();
    $func = new Functions();
    $notice = new Notice();
    $new_week = new Week();

    $uid = $session->getUserID();
    $role = $session->getUserRole();
    $session->setSiteRole($allowed_roles);

    $week_id = "";
    $week_id = isset($_GET['week_id']) ?  $func->cleanInputData($_GET['week_id']) : '';
//    if(isset($week_id))
//    {
//        var_dump($week_id);
//    }

    $course_id = "";
    $course_id = isset($_GET['course_id']) ?  $func->cleanInputData($_GET['course_id']) : '';
//    if(isset($course_id))
//    {
//        var_dump($course_id);
//    }

    $week_ctrl = new WeekController();
    $week_model = new WeekModel();

    $weeks = $week_model->getAllWeeks($course_id);
    $found_week = $week_model->getWeekById($week_id);
//    var_dump($weeks);
//    var_dump($found_week);

    $id1 = $id2 = $week = $topic = $body = "";
    if(isset($_POST['edit_week']))
    {
//        var_dump($_POST);
        $id1 = $func->cleanInputData($_POST['id1']);
        $id2 = $func->cleanInputData($_POST['id2']);
        $week = $func->cleanInputData($_POST['week']);
        $topic = $func->cleanInputData($_POST['topic']);
        $body = $func->cleanInputData($_POST['body']);

        $new_week->setCourseId($id1);
        $new_week->setId($id2);
        $new_week->setId($week_id);
        $new_week->setWeek($week);
        $new_week->setTopic($topic);
        $new_week->setBody($body);

        $notice = $week_ctrl->editWeek($new_week);
    }
?>
<?php
    include_once (PUBLIC_LOC."layouts/header.php");
    include_once (PUBLIC_LOC."layouts/nav_lecturer.php");
?>

<div id="blue">
    <div class="container">
        <div class="row centered">
            <div class="col-lg-8 col-lg-offset-2">
                <h4><b>EDIT <?=strtoupper($found_week->getWeek())?></b></h4>
            </div>
        </div><!-- row -->
    </div><!-- container -->
</div><!-- blue wrap -->

<div class="col-md-12 text-center h4"><h4><b><?=$notice->display();?></b></h4></div>

<div class="container w">
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
                    <li><a href="<?=PUBLIC_PATH?>lecturer/course_view.php?course_id=<?=$course_id?>">EDIT WEEK</a></li>
                    <?php
                        for($i = 0; $i < count($weeks); $i++)
                        {
                            $week_list = $weeks[$i];
                            ?>
                            <li><a href="<?=PUBLIC_PATH?>lecturer/week_page.php?course_id=<?=$course_id?>&week_id=<?=$week_list->getId()?>"><?=strtoupper($week_list->getWeek())?></a></li>
                            <?php
                        }
                    ?>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>

    <div class="col-md-10">
        <div class="col-md-offset-1">
            <div class="page-header"><h2 class="text-center text-primary">Edit Week</h2></div>
            <form class="form-horizontal" role="form" enctype="multipart/form-data" action="<?=PUBLIC_PATH?>lecturer/week_edit.php?course_id=<?=$course_id?>&week_id=<?=$week_id?>" method="post">
                <input type="hidden" name="id1" value="<?=$course_id?>">
                <input type="hidden" name="id2" value="<?=$week_id?>">
                <div class="form-group">
                    <div class="col-md-offset-1 col-md-3">
                        <label for="week">Week</label>
                    </div>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="week" placeholder="Enter Week" value="<?=$found_week->getWeek()?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-1 col-md-3">
                        <label for="topic">Topic</label>
                    </div>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="topic" placeholder="Enter Topic" value="<?=$found_week->getTopic()?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-1 col-md-3">
                        <label for="body">Topic Body</label>
                    </div>
                    <div class="col-md-8">
                        <textarea class="form-control text-justify" name="body" placeholder="Type Topic Body"><?=$found_week->getBody()?></textarea>
                    </div>
                </div>
                <br>
                <div class="col-md-offset-4"><input type="submit" name="edit_week" class="btn btn-lg btn-primary" value="Edit Week"></div>
            </form>
            <br><br>
        </div>
    </div>
</div>
<?php include_once (PUBLIC_LOC."layouts/footer.php");?>
