<?php
    
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/23/2016
     * Time: 3:58 AM
     */
    require_once ('C:\wamp\www\course_manager\classes\database.php');
    require_once ('C:\wamp\www\course_manager\classes\course.php');
    class EnrolmentModel
    {
        public function isEnroled($student_id,$course_id)
        {
            $sql = "select * from enrolment where student_id = :student_id AND course_id = :course_id";
            $conn = new PDOConnection();
            $conn->SetSQL($sql);
            $conn->AddParam(":student_id", $student_id);
            $conn->AddParam(":course_id", $course_id);
            $conn->Select();
            if($conn->num_rows > 0)
                return true;
            else
                return false;
        }

        public function insert(Enrolment $enrolment)
        {
            if($this->isEnroled($enrolment->getStudentId(), $enrolment->getCourseId()))
            {
                return 0;
            }
            else
            {
                $func = new Functions();
                $sql = "INSERT INTO enrolment (student_id, course_id, enroled_at)
                    VALUES (:student_id, :course_id, :enroled_at)";
                $conn = new PDOConnection();
                $conn->SetSQL($sql);
                $conn->AddParam(":student_id", $enrolment->getStudentId());
                $conn->AddParam(":course_id", $enrolment->getCourseId());
                $conn->AddParam(":enroled_at", $func->DateDB());
                $id = $conn->Insert();
                return $id;
            }
        }

        public function selectEnroled($student_id)
        {
            $sql = "SELECT course_id FROM enrolment WHERE student_id = :student_id";
            $conn = new PDOConnection();
            $conn->SetSQL($sql);
            $conn->AddParam(":student_id", $student_id);
            $rows = $conn->Select();
            if($conn->num_rows <= 0) return null;

            $course_ids = array();
            for($i = 0; $i < count($rows); $i++)
            {
                $course = new Course();
                $found_course = $rows[$i];
                $course->setId($found_course['course_id']);
                $course_ids[] = $course;
            }
            return $course_ids;
        }
    }