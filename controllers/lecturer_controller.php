<?php
    
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/7/2016
     * Time: 5:24 PM
     */
    require_once ('C:\wamp\www\course_manager\classes\functions.php');
    require_once ('C:\wamp\www\course_manager\classes\notice.php');
    require_once ('C:\wamp\www\course_manager\models\lecturer_model.php');
    require_once ('C:\wamp\www\course_manager\classes\session.php');
    class LecturerController
    {
        public function registerLecturer(Lecturer $lecturer)
        {
            $func = new Functions();
            $notice = new Notice();
            $lect_model = new LecturerModel();

            if(!$func->validateName($lecturer->getFirstName()))
            {
                $notice->type = "danger";
                $notice->message = "Please fill the First Name field";
                return $notice;
            }

            elseif(!$func->validateName($lecturer->getLastName()))
            {
                $notice->type = "danger";
                $notice->message = "Please fill the Last Name field";
                return $notice;
            }

            elseif(!$func->validateEmail($lecturer->getEmail()))
            {
                $notice->type = "danger";
                $notice->message = "Invalid Email Address";
                return $notice;
            }

            if(!$func->validatePassword($lecturer->getPassword()))
            {
                $notice->type = "danger";
                $notice->message = "Please provide password";
                return $notice;
            }

            elseif(!$func->isPasswordMatch($lecturer->getPassword(), $lecturer->getConfirmPassword()))
            {
                $notice->type = "danger";
                $notice->message = "Passwords Do Not Match";
                return $notice;
            }

            else
            {
                //on registration set role to student
                $role = "lecturer";
                $lecturer->setRole($role);
                //encrypt password
                $lecturer->encryptPassword();
                //insert
                $id = $lect_model->insertLecturer($lecturer);

                //check if last insert id is zero
                if($id <= 0)
                {
                    $notice->type = "danger";
                    $notice->message = "Email has already been used";
                    return $notice;
                }

                $lecturer->setId($id);

//                $_SESSION["role"] = $lecturer->getRole();
//                $_SESSION["user"] = $lecturer;//$user

                $notice->type = "success";
                $notice->message ="Congrats, " . $lecturer->fullName() ."!...Your account has been created successfully. You may Login";
                return $notice;
            }
        }

        public function Login(Lecturer $lecturer)
        {
            $func = new Functions();
            $notice = new Notice();
            $lect_model = new LecturerModel();

            $lecturer->encryptPassword();
            $found_lect = $lect_model->getLecturerByEmail($lecturer->getEmail());

            if($found_lect == null)
            {
                $notice->type = "danger";
                $notice->message = "Invalid Credentials";
                return $notice;
            }
            elseif($found_lect->getPassword() != $lecturer->getPassword())
            {
                $notice->type = "danger";
                $notice->message ="Invalid credentials";
                return $notice;
            }
            else
            {
                $session = new Session();
                $session->login($found_lect->getId());
                $session->setUserRole($found_lect->getRole());

//                $_SESSION["role"] = $found_lect->getRole();
//                $_SESSION["user"] = $found_lect->getId();//$user

                $func->redirect_to("lecturer/lecturer_home.php");

                return $notice;
            }
        }
    }