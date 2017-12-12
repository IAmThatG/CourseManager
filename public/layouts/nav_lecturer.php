<?php
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/7/2016
     * Time: 6:49 PM
     */
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
            <a class="navbar-brand" href="<?=PUBLIC_PATH?>lecturer/lecturer_home.php">E-learner</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="<?=PUBLIC_PATH?>lecturer/lecturer_home.php">HOME</a></li>
                <li><a href="#">PROFILE</a></li>
                <li><a href="#">ABOUT</a></li>
                <li><a href="<?=PUBLIC_PATH?>logout.php">LOGOUT</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>
