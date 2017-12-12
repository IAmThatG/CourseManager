<?php
    
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/13/2016
     * Time: 2:04 PM
     */
    require_once ('C:\wamp\www\course_manager\classes\database.php');
    require_once ('C:\wamp\www\course_manager\classes\lecturer.php');
    require_once ('C:\wamp\www\course_manager\classes\functions.php');
    require_once ('C:\wamp\www\course_manager\classes\course.php');
    require_once ('C:\wamp\www\course_manager\classes\week.php');

    class WeekModel
    {
        public function isWeekExist($week, $course_id)
        {
            $sql = "select * from week where week = :week AND course_id = :course_id";
            $conn = new PDOConnection();
            $conn->SetSQL($sql);
            $conn->AddParam(":week", $week);
            $conn->AddParam(":course_id", $course_id);
            $conn->Select();
            if($conn->num_rows > 0)
                return true;
            else
                return false;
        }

        public function insertWeek(Week $week)
        {
            if($this->isWeekExist($week->getWeek(), $week->getCourseId()))
            {
                return 0;
            }
            else
            {
                $func = new Functions();
                $sql = "INSERT INTO week (course_id, week, topic, body, created, updated) VALUES (:course_id, :week, :topic, :body, :created, :updated)";
                $conn = new PDOConnection();
                $conn->SetSQL($sql);
                $conn->AddParam(":course_id", $week->getCourseId());
                $conn->AddParam(":week", $week->getWeek());
                $conn->AddParam(":topic", $week->getTopic());
                $conn->AddParam(":body", $week->getBody());
                $conn->AddParam(":created", $func->DateDB());
                $conn->AddParam(":updated", $func->DateDB());
                $id = $conn->Insert();
                return $id;
            }
        }

        public function updateWeek(Week $week)
        {
            $func = new Functions();
            $sql = "UPDATE week SET
            course_id = :course_id, week = :week, topic = :topic, body = :body, updated = :updated  WHERE id = :id";
            $conn = new PDOConnection();
            $conn->SetSQL($sql);
            $conn->AddParam(":course_id", $week->getCourseId());
            $conn->AddParam(":week", $week->getWeek());
            $conn->AddParam(":topic", $week->getTopic());
            $conn->AddParam(":body", $week->getBody());
            $conn->AddParam(":updated", $func->DateDB());
            $conn->AddParam(":id", $week->getId());
            $id = $conn->Update();
            //var_dump($id);
            return $id;
        }

        public function getWeekById($id)
        {
            $sql = "select * from week where id = :refid";
            $conn = new PDOConnection();
            $conn->SetSQL($sql);
            $conn->AddParam(":refid", $id);
            $row = $conn->Select();
            if($conn->num_rows <= 0)
                return null;
            else
            {
                $found_week = new Week();
                $found_week->setRow($row[0]);
                return $found_week;
            }
        }

        public function getAllWeeks($course_id)
        {
            $sql = "Select * from week WHERE course_id = :course_id ORDER BY week ASC";
            $conn = new PDOConnection();
            $conn->SetSQL($sql);
            $conn->AddParam(":course_id", $course_id);
            $rows = $conn->Select();
            if($conn->num_rows <= 0)
                return null;
            $weeks = array();
            for($i = 0; $i < count($rows); $i++)
            {
                $week = new Week();
                $week->setRow($rows[$i]);
                $weeks[] = $week;
            }
            return $weeks;
        }
    }