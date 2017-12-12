<?php
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/7/2016
     * Time: 6:33 PM
     */
    require_once ('C:\wamp\www\course_manager\includes\directories.php');
?>

<!-- Fixed navbar -->
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=PUBLIC_PATH?>index.php">E-learner</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="<?=PUBLIC_PATH?>index.php">HOME</a></li>
                <li><a href="#" data-toggle="modal" data-target="#loginModal">LOGIN</a></li>
                <li><a href="#">ABOUT</a></li>
                <li><a href="#">COURSES</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>