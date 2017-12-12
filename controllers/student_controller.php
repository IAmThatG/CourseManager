<?php
    
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/1/2016
     * Time: 3:59 AM
     */
    require_once('C:\wamp\www\course_manager\classes\functions.php');
    require_once ('C:\wamp\www\course_manager\classes\notice.php');
    require_once ('C:\wamp\www\course_manager\models\student_model.php');
    require_once ('C:\wamp\www\course_manager\classes\session.php');

    class StudentController
    {
        /**
         * @param Student $student
         * @return Notice
         */
        public function registerStudent(Student $student)
        {
            $func = new Functions();
            $notice = new Notice();

            if(!$func->validateMatricNo($student->getMatricNo()))
            {
                $notice->type = "danger";
                $notice->message = "Invalid Matriculation Number";
                return $notice;
            }

            elseif(!$func->validateName($student->getFirstName()))
            {
                $notice->type = "danger";
                $notice->message = "Please fill the First Name field";
                return $notice;
            }

            elseif(!$func->validateName($student->getLastName()))
            {
                $notice->type = "danger";
                $notice->message = "Please fill the Last Name field";
                return $notice;
            }

            elseif(!$func->validateEmail($student->getEmail()))
            {
                $notice->type = "danger";
                $notice->message = "Invalid Email Address";
                return $notice;
            }

            elseif(!$func->validatePassword($student->getPassword()))
            {
                $notice->type = "danger";
                $notice->message = "Please provide password";
                return $notice;
            }

            elseif(!$func->isPasswordMatch($student->getPassword(), $student->getConfirmPassword()))
            {
                $notice->type = "danger";
                $notice->message = "Passwords Do Not Match";
                return $notice;
            }

            else
            {
                //on registration set role to student
                $role = "student";
                $student->setRole($role);
                //encrypt password
                $student->encryptPassword();
                //insert
                $stud_model = new StudentModel();
                $id = $stud_model->insertStudent($student);

                if($id <= 0)
                {
                    $notice->type = "danger";
                    $notice->message = "Matriculation number has already been used";
                    return $notice;
                }

                $student->setId($id);

//                $_SESSION["role"] = $student->getRole();
//                $_SESSION["user"] = $student;


                $notice->type = "success";
                $notice->message ="Congrats, " . $student->fullName() ."! Your account has been created successfully. You may Login";
                return $notice;
            }
        }

        public function Login(Student $student)
        {
            $func = new Functions();
            $notice = new Notice();
            $stud_model = new StudentModel();
            $student->encryptPassword();

            $found_stud = $stud_model->getStudentByEmail($student->getEmail());

            if($found_stud == null)
            {
                $notice->type = "danger";
                $notice->message = "Invalid Credentials";
                return $notice;
            }
            elseif($found_stud->getPassword() != $student->getPassword())
            {
                $notice->type = "danger";
                $notice->message ="Invalid credentials";
                return $notice;
            }
            else
            {
                $session = new Session();
                $session->login($found_stud->getId());
                $session->setUserRole($found_stud->getRole());

                $func->redirect_to("student/student_home.php");

                $notice->type = "success";
                $notice->message ="Login Successful";
                return $notice;
            }
        }
    }