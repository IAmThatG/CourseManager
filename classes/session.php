<?php
    
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/2/2016
     * Time: 5:29 AM
     */

    class Session
    {
        private $logged_in = false;
        private $user_role;
        private $user_id;
        public $message;
        public $type;

        function __construct()
        {
            session_start();
            $this->check_login();
            $this->check_message();
            $this->check_role();
//            if($this->logged_in)
//            {
//                //do these actions if user is logged in
//            }
//            else
//            {
//                //do these if user is not logged in
//            }
        }

        public function setUserRole($user_role)
        {
            if($user_role)
            {
                $this->user_role = $_SESSION['role'] = $user_role;
            }

        }

        public function getUserRole()
        {
            if(isset($this->user_role))
            {
                return $this->user_role;
            }
            else
                return "";
        }

        public function setSiteRole($allowed_roles)
        {
            if($allowed_roles)
            {
                if(!in_array($this->getUserRole(), $allowed_roles))
                {
                    $msg = '<h1>UNAUTHORIZED!!!</h1>';
                    die($msg);
                }
            }
        }

        public function is_logged_in()
        {
            return $this->logged_in;
        }

        public function login($user_id)
        {
            //database should find user based on username/password
            if($user_id)
            {
                $this->user_id = $_SESSION['user_id'] = $user_id;
                $this->logged_in = true;
            }
        }

//        public function setUserID($user_id)
//        {
//            $this->user_id = $user_id;
//        }

        public function getUserID()
        {
            if(isset($this->user_id))
            {
                return $this->user_id;
            }
            else
                return "";
        }

        private function check_login()
        {
            if(isset($_SESSION['user_id']))
            {
                $this->user_id = $_SESSION['user_id'];
                $this->logged_in = true;
            }
            else
            {
                unset($this->user_id);
                $this->logged_in = false;
            }
        }

        private function check_message()
        {
            //is there a message stored in the session?
            if(isset($_SESSION['message']))
            {
                //add it as an attribute and erase the stored version
                $this->message = $_SESSION['message'];
                unset($_SESSION['message']);
            }
            else
            {
                $this->message = "";
            }
        }

        private function check_role()
        {
            if(isset($_SESSION['role']))
            {
                $this->user_role = $_SESSION['role'];
            }
            else
            {
                unset($this->user_role);
            }
        }

        public function setMsg($msg = "", $type = "")
        {
            if(!empty($msg))
            {
                //then this is set "message"
                //make sure you understand why $this->message = #msg won't work
                //the message has to be stored in the session
                $this->message = $_SESSION['message'] = $msg;
                $this->type = $_SESSION['type'] = $type;
            }
        }

        public function getMsg()
        {
            $text = '<div class="alert alert-'. $this->type .'" role="alert">'. $this->message .'</div>';
            return $text;
        }
//        public function message($msg = "", $type = "")
//        {
//            if(!empty($msg))
//            {
//                //then this is set "message"
//                //make sure you understand why $this->message = #msg won't work
//                //the message has to be stored in the session
//                $_SESSION['message'] = $msg;
//                $_SESSION['type'] = $type;
//            }
//            else
//            {
//                //then this is "get message"
//                return $this->message;
//                return $this->type;
//            }
//        }

        public function logout()
        {
//            unset($_SESSION['user_id']);
//            unset($this->user_id);
            session_unset();
            session_destroy();
            $this->logged_in = false;
        }
    }