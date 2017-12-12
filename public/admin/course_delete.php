<?php
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/13/2016
     * Time: 1:53 PM
     */
    require_once('C:\wamp\www\course_manager\classes\session.php');
    require_once('C:\wamp\www\course_manager\models\course_model.php');
    require_once('C:\wamp\www\course_manager\classes\functions.php');
    $allowed_roles = array('admin');

    $session = new Session();
    $course_model = new CourseModel();
    $func = new Functions();

    $uid = $session->getUserID();

    $role = $session->getUserRole();
    $session->setSiteRole($allowed_roles);

    $course_id = $_GET['course_id'];
    //var_dump($id);
    $course = $course_model->deleteCourse($course_id);
    $func->redirect_to("admin_home.php");
?>