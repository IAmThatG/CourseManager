<?php
    
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/11/2016
     * Time: 3:45 PM
     */
    require_once ('C:\wamp\www\course_manager\classes\database.php');
    require_once ('C:\wamp\www\course_manager\classes\lecturer.php');
    require_once ('C:\wamp\www\course_manager\classes\functions.php');
    require_once ('C:\wamp\www\course_manager\classes\course.php');

    class CourseModel
    {
        public function isCourseExist($course_code)
        {
            $sql = "select * from course where course_code = :course_code";
            $conn = new PDOConnection();
            $conn->SetSQL($sql);
            $conn->AddParam(":course_code", $course_code);
            $conn->Select();
            if($conn->num_rows > 0)
                return true;
            else
                return false;
        }

        public function insertCourse(Course $course)
        {
            if($this->isCourseExist($course->getCourseCode()))
            {
                return 0;
            }
            else
            {
                $func = new Functions();
                $sql = "INSERT INTO course (course_code, course_title, course_unit, description, added_at, updated_at, course_img)
                    VALUES (:course_code, :course_title, :course_unit, :description, :added_at, :updated_at, :course_img)";
                $conn = new PDOConnection();
                $conn->SetSQL($sql);
                $conn->AddParam(":course_code", $course->getCourseCode());
                $conn->AddParam(":course_title", $course->getCourseTitle());
                $conn->AddParam(":course_unit", $course->getCourseUnit());
                $conn->AddParam(":description", $course->getDescription());
                $conn->AddParam(":added_at", $func->DateDB());
                $conn->AddParam(":updated_at", $func->DateDB());
                $conn->AddParam(":course_img", $course->getCourseImg());
                $id = $conn->Insert();
                return $id;
            }
        }

        public function updateCourse(Course $course)
        {
            $func = new Functions();
            $sql = "UPDATE course SET
            course_code = :course_code, course_title = :course_title, course_unit = :course_unit, description = :description,
            updated_at = :updated_at, course_img = :course_img  WHERE id = :id";
            $conn = new PDOConnection();
            $conn->SetSQL($sql);
            $conn->AddParam(":course_code", $course->getCourseCode());
            $conn->AddParam(":course_title", $course->getCourseTitle());
            $conn->AddParam(":course_unit", $course->getCourseUnit());
            $conn->AddParam(":description", $course->getDescription());
            $conn->AddParam(":updated_at", $func->DateDB());
            $conn->AddParam(":course_img", $course->getCourseImg());
            $conn->AddParam(":id", $course->getId());
            $id = $conn->Update();
            var_dump($id);
            return $id;
        }

        public function getCourseById($id)
        {
            $sql = "select * from course where id = :refid";
            $conn = new PDOConnection();
            $conn->SetSQL($sql);
            $conn->AddParam(":refid", $id);
            $row = $conn->Select();
            if($conn->num_rows <= 0)
                return null;
            else
            {
                $found_course = new Course();
                $found_course->setRow($row[0]);
                return $found_course;
            }
        }

        public function getAllCourses()
        {
            $sql = "Select * from course order by course_title";
            $conn = new PDOConnection();
            $conn->SetSQL($sql);
            $rows = $conn->Select();
            if($conn->num_rows <= 0) return null;

            $courses = array();
            for($i = 0; $i < count($rows); $i++)
            {
                $course = new Course();
                $course->setRow($rows[$i]);
                $courses[] = $course;
            }
            return $courses;
        }

        public function getCourseWeeks()
        {
            $sql = "Select * from week ORDER BY week ASC ";
            $conn = new PDOConnection();
            $conn->SetSQL($sql);
            $rows = $conn->Select();
            if($conn->num_rows <= 0)
                return null;
            $courses = array();
            for($i = 0; $i < count($rows); $i++)
            {
                $course = new Course();
                $course->setRow($rows[$i]);
                $courses[] = $course;
            }
            return $courses;
        }

        public function isAssigned($course_id)
        {
            $sql = "select * from course_lecturer where course_id = :course_id";
            $conn = new PDOConnection();
            $conn->SetSQL($sql);
            $conn->AddParam(":course_id", $course_id);
            $conn->Select();
            if($conn->num_rows > 0)
                return true;
            else
                return false;
        }

        public function assign(Course $course, Lecturer $lect)
        {
            $func = new Functions();
            if($this->isAssigned($course->getId()) == true)
            {
                return 0;
            }
            else
            {
                $sql = "INSERT INTO course_lecturer (course_id, lecturer_id, assign_date) VALUES (:course_id, :lect_id, :assign_date)";
                $conn = new PDOConnection();
                $conn->SetSQL($sql);
                $conn->AddParam(":course_id", $course->getId());
                $conn->AddParam(":lect_id", $lect->getId());
                $conn->AddParam(":assign_date", $func->DateDB());
                $id = $conn->Insert();
                return $id;
            }
        }

        public function checkAssigned($lect_id)
        {
            $sql = "SELECT * FROM course_lecturer WHERE lecturer_id = :lect_id";
            $conn = new PDOConnection();
            $conn->SetSQL($sql);
            $conn->AddParam(":lect_id", $lect_id);
            $rows = $conn->Select();
            if($conn->num_rows <= 0) return null;

            //var_dump($rows);
            $courses = array();
            for($i = 0; $i < count($rows); $i++)
            {
                $course = new Course();
                $found_course = $rows[$i];
                $course->setId($found_course['course_id']);
                $courses[] = $course;
                //$course->getId();
            }
            return $courses;
        }

        public function deleteCourse($course_id)
        {
            $sql = "delete from course WHERE id = :id";
            $conn = new PDOConnection();
            $conn->SetSQL($sql);
            $conn->AddParam(":id", $course_id);
            $rows = $conn->Delete();
            return $rows;
        }
    }