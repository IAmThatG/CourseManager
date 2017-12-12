<?php
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 8/31/2016
     * Time: 11:00 PM
     */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>
        <?php
            if(isset($page_title))
            {
                echo $page_title;
            }
        ?>
    </title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--<link href="assets/css/font-awesome.min.css" rel="stylesheet">-->

    <!-- Custom styles for this template -->
    <link href="assets/css/site.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/html5shiv.min.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->
</head>
<body>