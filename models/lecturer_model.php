<?php
    
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/7/2016
     * Time: 5:27 PM
     */
    require_once ('C:\wamp\www\course_manager\classes\database.php');
    require_once ('C:\wamp\www\course_manager\classes\lecturer.php');

    class LecturerModel
    {
        //check if email exist
        public function IsEmailExist($email)
        {
            $sql = "select * from lecturer where email = :em";
            $conn = new PDOConnection();
            $conn->SetSQL($sql);
            $conn->AddParam(":em", $email);
            $conn->Select();
            if($conn->num_rows > 0)
                return true;
            else
                return false;
        }

        public function insertLecturer(Lecturer $lecturer)
        {
            if($this->IsEmailExist($lecturer->getEmail()))
            {
                return 0;
            }
            else
            {
                $sql = "INSERT INTO lecturer (first_name, last_name, email, password, role, token_id)
                    VALUES (:first_name, :last_name, :email, :password, :role, :token_id)";
                $conn = new PDOConnection();
                $conn->SetSQL($sql);
                $conn->AddParam(":first_name", $lecturer->getFirstName());
                $conn->AddParam(":last_name", $lecturer->getLastName());
                $conn->AddParam(":email", $lecturer->getEmail());
                $conn->AddParam(":password", $lecturer->getPassword());
                $conn->AddParam(":role", $lecturer->getRole());
                $conn->AddParam(":token_id", $lecturer->getTokenId());
                //$conn->AddParam(":profile_pic", $student->profile_pic);
                $id = $conn->Insert();
                return $id;
            }
        }

        public function getLecturerByEmail($email)
        {
            $sql = "select * from lecturer where email = :em";
            $conn = new PDOConnection();
            $conn->SetSQL($sql);
            $conn->AddParam(":em", $email);
            $row = $conn->Select();
            if($conn->num_rows <= 0)
                return null;
            else
            {
                $found_lect = new Lecturer();
                $found_lect->setRow($row[0]);
                return $found_lect;
            }
        }

        public function getLectById($id)
        {
            $sql = "select * from lecturer where id = :refid";
            $conn = new PDOConnection();
            $conn->SetSQL($sql);
            $conn->AddParam(":refid", $id);
            $row = $conn->Select();
            if($conn->num_rows <= 0)
                return null;
            else
            {
                $found_lect = new Lecturer();
                $found_lect->setRow($row[0]);
                return $found_lect;
            }
        }

        public function getAllLecturers()
        {
            $sql = "Select * from lecturer order by first_name";
            $conn = new PDOConnection();
            $conn->SetSQL($sql);
            $rows = $conn->Select();
            if($conn->num_rows <= 0) return null;

            $lecturers = array();
            for($i = 0; $i < count($rows); $i++)
            {
                $lecturer = new Lecturer();
                $lecturer->setRow($rows[$i]);
                $lecturers[] = $lecturer;
            }
            return $lecturers;
        }
    }