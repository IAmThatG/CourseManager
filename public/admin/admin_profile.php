<?php
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/28/2016
     * Time: 4:43 AM
     */
    $page_title = "E-Learner/admin_profile";
    require_once ('C:\wamp\www\course_manager\classes\notice.php');
    require_once ('C:\wamp\www\course_manager\classes\session.php');
    require_once ('C:\wamp\www\course_manager\classes\functions.php');
    require_once ('C:\wamp\www\course_manager\classes\admin.php');
    require_once ('C:\wamp\www\course_manager\controllers\admin_controller.php');
    require_once ('C:\wamp\www\course_manager\models\admin_model.php');

    $allowed_roles = array('admin');

    $session = new Session();
    $func = new Functions();
    $notice = new Notice();
    $admin = New Admin();
    $admin_model = new AdminModel();
    $admin_ctrl = new AdminController();

    $uid = $session->getUserID();

    $role = $session->getUserRole();
    $session->setSiteRole($allowed_roles);

//    var_dump($uid);
//    var_dump($role);

    $found_admin = $admin_model->getAdminById($uid);
//    var_dump($found_admin);

$id = $first_name = $last_name = $email = $uploaded_pic = "";
    if(isset($_POST['edit']))
    {
//        var_dump($_POST);
//        var_dump($_FILES);

        $id = $func->cleanInputData($uid);
        $first_name = $func->cleanInputData($_POST['first_name']);
        $last_name = $func->cleanInputData($_POST['last_name']);
        $email = $func->cleanInputData($_POST['email']);
        $uploaded_pic = $_FILES['uploaded_pic'];

        $admin->setId($id);
        $admin->setFirstName($first_name);
        $admin->setLastName($last_name);
        $admin->setEmail($email);
        if(empty($uploaded_pic))
            $admin->setUploadedPic($found_admin->getProfilePic());
        else
            $admin->setUploadedPic($uploaded_pic);
        $admin->setPreviousPic($found_admin->getProfilePic());
        echo $admin->getProfilePic();

        $notice = $admin_ctrl->editAdmin($admin);
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
                <h4><b><?=strtoupper($found_admin->fullName())?></b></h4>
            </div>
        </div><!-- row -->
    </div><!-- container -->
</div><!-- blue wrap -->

<div class="col-md-12 text-center h4"><h4><b><?=$notice->display()?></b></h4></div>

<div class="container w">
    <div class="row">
        <div class="text-center">
            <img src="<?= PROFILE_PIC_URL ?><?= $found_admin->getProfilePic(); ?>" class="img-circle tilt" width="150" height="150">
        </div>
    </div>
    <br><br>
    <form class="form-horizontal" role="form" action="<?=PUBLIC_PATH?>admin/admin_profile.php?admin_id=<?=$uid?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-offset-3 col-md-7">
                <div class="form-group">
                    <div class="col-md-5">
                        <label for="first_name">First Name</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="first_name" value="<?=$found_admin->getFirstName()?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-5">
                        <label for="last_name">Last Name</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="last_name" value="<?=$found_admin->getLastName()?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-5">
                        <label for="email">Email</label>
                    </div>
                    <div class="col-md-7">
                        <input type="email" class="form-control" name="email" value="<?=$found_admin->getEmail()?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-5">
                        <label for="uploaded_pic">Change Profile Picture</label>
                    </div>
                    <div class="col-md-7">
                        <input type="file" name="uploaded_pic">
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="form-group">
                <div class="col-md-offset-6">
                    <button type="submit" class="btn btn-primary btn-lg" name="edit"><b>EDIT</b></button>
                    <!--<button type="submit" class="btn btn-primary btn-lg" name="edit_course"><b>Edit Course</b></button>-->
                </div>
            </div>
        </div>
    </form>
    <br><br><br><br><br><br><br>

</div>

<?php include_once (PUBLIC_LOC."layouts/footer.php");?>
