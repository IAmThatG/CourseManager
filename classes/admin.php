<?php
    
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 8/30/2016
     * Time: 12:42 PM
     */
    class Admin
    {
        //define all admin table fields
        private $id;
        private $first_name;
        private $last_name;
        private $email;
        private $password;
        private $confirm_password;
        private $role;
        private $token_id;
        private $profile_pic;
        private $previous_pic;
        private $uploaded_pic;

        public function __construct()
        {
            $this->id = "";
            $this->first_name = "";
            $this->last_name = "";
            $this->email = "";
            $this->password = "";
            $this->confirm_password = "";
            $this->role = "";
            $this->token_id = "";
//            $this->profile_pic = PROFILE_PIC_DEFAULT;
        }

        //set all lecturer fields
        public function setId($id)
        {
            $this->id = $id;
        }

        public function setFirstName($first_name)
        {
            $this->first_name = $first_name;
        }

        public function setLastName($last_name)
        {
            $this->last_name = $last_name;
        }

        public function setEmail($email)
        {
            $this->email = $email;
        }

        public function setPassword($password)
        {
            $this->password = $password;
        }

        //encrypt password
        public function encryptPassword()
        {
            $this->password = md5($this->password);
        }

        public function setConfirmPassword($confirm_password)
        {
            $this->confirm_password = $confirm_password;
        }

        public function setRole($role)
        {
            $this->role = $role;
        }

        public function setTokenId($token_id)
        {
            $this->token_id = $token_id;
        }

        /**
         * @param string $profile_pic
         */
        public function setProfilePic($profile_pic)
        {
            $this->profile_pic = $profile_pic;
        }

        /**
         * @param string $previous_pic
         */
        public function setPreviousPic($previous_pic)
        {
            $this->previous_pic = $previous_pic;
        }

        /**
         * @param string $uploaded_pic
         */
        public function setUploadedPic($uploaded_pic)
        {
            $this->uploaded_pic = $uploaded_pic;
        }

        //return all lecturer fields
        public function getId()
        {
            return $this->id;
        }

        public function getFirstName()
        {
            return $this->first_name;
        }

        public function getLastName()
        {
            return $this->last_name;
        }

        public function getEmail()
        {
            return $this->email;
        }

        public function getPassword()
        {
            return $this->password;
        }

        public function getConfirmPassword()
        {
            return $this->confirm_password;
        }

        public function getRole()
        {
            return $this->role;
        }

        public function getTokenId()
        {
            return $this->token_id;
        }

        /**
         * @return string
         */
        public function getProfilePic()
        {
            return $this->profile_pic;
        }

        /**
         * @return string
         */
        public function getPreviousPic()
        {
            return $this->previous_pic;
        }

        /**
         * @return string
         */
        public function getUploadedPic()
        {
            return $this->uploaded_pic;
        }

        //return full name
        public function fullName()
        {
            return $this->first_name . " " . $this->last_name;
        }

        public function setRow($row)
        {
            $this->id = $row['id'];
            $this->first_name = $row['first_name'];
            $this->last_name = $row['last_name'];
            $this->email = $row['email'];
            $this->password = $row['password'];
            $this->role = $row['role'];
            $this->token_id = $row['token_id'];
            $this->profile_pic = $row['profile_pic'];
            if($this->profile_pic == "")
            {
                $this->profile_pic = PROFILE_PIC_DEFAULT;
            }
        }
    }