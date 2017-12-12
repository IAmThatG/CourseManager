<?php
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/10/2016
     * Time: 3:36 PM
     */
    require_once ('C:\wamp\www\course_manager\includes\directories.php');
    $session = new Session();
    $session->logout();
    header('location: index.php');