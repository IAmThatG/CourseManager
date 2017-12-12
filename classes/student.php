<?php
    
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/1/2016
     * Time: 1:58 AM
     */
    class Student
    {
        //define database fields;
      private $id;
      private $first_name;
      private $last_name;
      private $email;
      private $matric_no;
      private $password;
      private $confirm_password;
      private $role;
      private $profile_pic;

        //initialize all Student properties to empty string
        //when a new instance of Student is created
        public function __construct()
        {
            $this->id = "";
            $this->first_name = "";
            $this->last_name = "";
            $this->email = "";
            $this->matric_no = "";
            $this->password = "";
            $this->confirm_password = "";
            $this->role = "";
            $this->profile_pic = "";
        }

        //set all database fields
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

        public function setMatricNo($matric_no)
        {
            $this->matric_no = $matric_no;
        }

        public function setPassword($password)
        {
            $this->password = $password;
        }

        public function encryptPassword()
        {
            $this->password = md5("$this->email . 'xyxyx' . $this->password . 'hdx%$56762934ysdvids9d78y4932'");
        }

        public function setConfirmPassword($confirm_password)
        {
            $this->confirm_password = $confirm_password;
        }

        public function setRole($role)
        {
            $this->role = $role;
        }

        public function setProfilePic($profile_pic)
        {
            $this->profile_pic = $profile_pic;
        }

        //get database fields
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

        public function getMatricNo()
        {
            return $this->matric_no;
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

        public function getProfilePic()
        {
            return $this->profile_pic;
        }

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
            $this->matric_no = $row['matric_no'];
            $this->password = $row['password'];
            $this->role = $row['role'];
            //remember to use the library app default profile pic
        }
    }