<?php
    
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/1/2016
     * Time: 4:00 AM
     */
    require_once ('C:\wamp\www\course_manager\classes\database.php');
    require_once ('C:\wamp\www\course_manager\classes\student.php');

    class StudentModel
    {
        //check if the matric number input exists in the database
        /**
         * @param $matric_no
         * @return bool
         */
        public function isMatricNumExist($matric_no)
        {
            $sql = "select * from student WHERE matric_no = :matric_no";
            $conn = new PDOConnection();
            $conn->SetSQL($sql);
            $conn->AddParam(":matric_no", $matric_no);
            $conn->Select();
            if($conn->num_rows > 0)
                return true;
            else
                return false;
        }

        public function insertStudent(Student $student)
        {
            //if matric number exists, exit
            if($this->isMatricNumExist($student->getMatricNo()))
            {
                return 0;
            }

            //insert
            $sql = "INSERT INTO student (first_name, last_name, email, password, matric_no, role)
                    VALUES (:first_name, :last_name, :email, :password, :matric_no, :role)";
            $conn = new PDOConnection();
            $conn->SetSQL($sql);
            $conn->AddParam(":first_name", $student->getFirstName());
            $conn->AddParam(":last_name", $student->getLastName());
            $conn->AddParam(":email", $student->getEmail());
            $conn->AddParam(":password", $student->getPassword());
            $conn->AddParam(":matric_no", $student->getMatricNo());
            $conn->AddParam(":role", $student->getRole());
            //$conn->AddParam(":profile_pic", $student->profile_pic);
            $id = $conn->Insert();
            return $id;
        }

        public function getStudentByEmail($email)
        {
            $sql = "select * from student where email = :em";
            $conn = new PDOConnection();
            $conn->SetSQL($sql);
            $conn->AddParam(":em", $email);
            $row = $conn->Select();
            if($conn->num_rows <= 0)
                return null;
            else
            {
                $found_stud = new Student();
                $found_stud->setRow($row[0]);
                return $found_stud;
            }
        }

        public function getStudById($id)
        {
            $sql = "select * from student where id = :refid";
            $conn = new PDOConnection();
            $conn->SetSQL($sql);
            $conn->AddParam(":refid", $id);
            $row = $conn->Select();
            if($conn->num_rows <= 0)
                return null;
            else
            {
                $found_stud = new Student();
                $found_stud->setRow($row[0]);
                return $found_stud;
            }
        }
    }