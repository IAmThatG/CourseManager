<?php
    
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/1/2016
     * Time: 5:42 AM
     */
    require_once ('C:\wamp\www\course_manager\includes\directories.php');

    class Functions
    {
        //function to clean input data
        /**
         * @param $data
         * @return string
         */
        public function cleanInputData($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        /**
         * @param $matric_no
         * @return bool
         */
        public function validateMatricNo($matric_no)
        {
            if(strlen($matric_no == 0))
                return false;
            else
                return true;
        }

        public function validateWeek($week)
        {
            if(strlen($week) == 0)
                return false;
            elseif($week > 10)
                return false;
            else
                return true;
        }

        public function validateTopic($topic)
        {
            if(strlen($topic) == 0)
                return false;
            elseif($topic > 100)
                return false;
            else
                return true;
        }

        public function validateName($name)
        {
            if(strlen($name) == 0)
                return false;
            elseif(strlen($name) > 50)
                return false;
            //check if name fields contain only letters and whitespaces
            elseif(!preg_match("/^[a-zA-Z ]*$/",$name))
                return false;
            else
                return true;
        }

        public function validateEmail($email)
        {
            return filter_var($email, FILTER_VALIDATE_EMAIL);
        }

        public function validatePassword($password)
        {
            if($password == '')
                return false;
            else
                return true;
        }

        public function isPasswordMatch($password, $confirm_password)
        {
            if($confirm_password == '')
                return false;
            elseif($password != $confirm_password)
                return false;
            else
                return true;
        }

        public function validateCode($course_code)
        {
            if($course_code == "")
                return false;
            elseif(strlen($course_code) > 10)
                return false;
            else
                return true;
        }

        public function validateUnit($course_unit)
        {
            if($course_unit == "")
                return false;
            else
                return true;
        }

        public function validateImageUploadSize($imageSize)
        {
            if ($imageSize > 1024000) {
                return false;
            }
            else
                return true;
        }

        //check if an uploaded file is the right extension
        public function validateImageUpload($type)
        {
            strtolower($type);
            if($type != "jpg" && $type != "png" && $type != "jpeg")
            {
                return false;
            }
            else
                return true;
        }

        public function validateTypeInput($type)
        {
            if($type == "")
                return false;
            else
                return true;
        }

        public function validateResourceExt($ext)
        {
            if($ext != "jpg" and $ext != "png" and $ext != "jpeg" and $ext != "gif" and $ext != "mp3" and
                $ext != "mp4" and $ext != "flv" and $ext != "docx" and $ext != "pdf" and $ext != "txt")
                return false;
            else
                return true;
        }

        public function validateResourceSize($size)
        {
            if($size == 0 or $size > 1024000000)
                return false;
            else
                return true;
        }

        public function redirect_to($location = "")
        {
                header("Location: $location");
                exit;
        }

        public function display_message($message = "", $type = "")
        {
            if(empty($type))
                return "";
            elseif(empty($message))
                return "";
            else
                //html that displays enroled and assigns it to $txt
                $text = '<div class="alert alert-'. $type .'" role="alert">'. $message .'</div>';
            return $text;
        }

        public function DateDB()
        {

            return date("Y-m-d H:i:s");
        }

        public function DateString()
        {

            return date("dmY");
        }

//        public function passwordStrength($password)
//        {
//        }
    }