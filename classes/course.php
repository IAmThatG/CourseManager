<?php
    
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/11/2016
     * Time: 1:41 PM
     */
    class Course
    {
        private $id;
        private $course_code;
        private $course_title;
        private $course_unit;
        private $description;
        private $added_at;
        private $updated_at;
        private $course_img;
        private $uploaded_img;

        /**
         * Course constructor.
         */
        public function __construct()
        {
            $this->id = "";
            $this->course_code = "";
            $this->course_title = "";
            $this->course_unit = "";
            $this->description = "";
            $this->added_at = "";
            $this->updated_at = "";
            $this->course_img = COURSE_PIC_DEFAULT;
        }

        //setters
        /**
         * @param string $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }

        /**
         * @param string $course_code
         */
        public function setCourseCode($course_code)
        {
            $this->course_code = $course_code;
        }

        /**
         * @param string $course_title
         */
        public function setCourseTitle($course_title)
        {
            $this->course_title = $course_title;
        }

        /**
         * @param string $course_unit
         */
        public function setCourseUnit($course_unit)
        {
            $this->course_unit = $course_unit;
        }

        /**
         * @param string $description
         */
        public function setDescription($description)
        {
            $this->description = $description;
        }

        /**
         * @param mixed $course_img
         */
        public function setCourseImg($course_img)
        {
            $this->course_img = $course_img;
        }

        /**
         * @param mixed $uploaded_img
         */
        public function setUploadedImg($uploaded_img)
        {
            $this->uploaded_img = $uploaded_img;
        }

        //getters
        /**
         * @return string
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @return string
         */
        public function getCourseCode()
        {
            return $this->course_code;
        }

        /**
         * @return string
         */
        public function getCourseTitle()
        {
            return $this->course_title;
        }

        /**
         * @return string
         */
        public function getCourseUnit()
        {
            return $this->course_unit;
        }

        /**
         * @return string
         */
        public function getDescription()
        {
            return $this->description;
        }

        /**
         * @return string
         */
        public function getAddedAt()
        {
            return $this->added_at;
        }

        /**
         * @return string
         */
        public function getUpdatedAt()
        {
            return $this->updated_at;
        }

        /**
         * @return mixed
         */
        public function getCourseImg()
        {
            return $this->course_img;
        }

        /**
         * @return mixed
         */
        public function getUploadedImg()
        {
            return $this->uploaded_img;
        }

        public function setRow($row)
        {
            $this->id = $row['id'];
            $this->course_code = $row["course_code"];
            $this->course_title = $row["course_title"];
            $this->course_unit = $row["course_unit"];
            $this->description = $row["description"];
            $this->added_at = $row["added_at"];
            $this->updated_at = $row["updated_at"];
            $this->course_img = $row["course_img"];
            if($this->course_img == "")
            {
                $this->course_img = COURSE_PIC_DEFAULT;
            }
        }
    }