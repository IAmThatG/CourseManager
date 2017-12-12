<?php
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 8/26/2016
     * Time: 2:06 PM
     */
    require_once('database.php');

    //$first_name = "Gabriel";
    //$last_name = "Lecturer";
    //$email = "gabe@example.com";
    /*$password = "1111";
    $sql = "INSERT INTO lecturer (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)";
    $conn = new PDOConnection();
    $conn->SetSQL($sql);
    $conn->AddParam(":first_name", $first_name);
    $conn->AddParam("last_name", $last_name);
    $conn->AddParam("email", $email);
    $conn->AddParam(":password", $password);
    $id = $conn->Insert();
    echo $id;*/
    $sql = "SELECT * FROM lecturer";
    $conn = new PDOConnection();
    $conn->SetSQL($sql);
   /* $conn->AddParam(":first_name", $first_name);
    $conn->AddParam(":email", $email);*/
    $rows = $conn->Select();
    if($conn->num_rows <= 0)
    {
        return null;
    }
    echo $conn->num_rows;
    $row = array();

    for($i = 0; $i < count($rows); $i++)
    {
        $row = $rows[$i];
        //$first_name = $row['first_name'];
        //$last_name1 = $row['last_name'];
        //$email1 = $row['email'];
        echo $row['first_name'] . " " . $row['email'] . "<br>";
    }

