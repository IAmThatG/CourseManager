<?php
    
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/23/2016
     * Time: 3:46 AM
     */
    class Enrolment
    {
        private $id;
        private $student_id;
        private $course_id;
        private $progress;
        private $enroled_at;

        /**
         * Enrolment constructor.
         */
        public function __construct()
        {
            $this->id = "";
            $this->student_id = "";
            $this->course_id = "";
            $this->progress = "";
            $this->enroled_at = "";
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
        public function getStudentId()
        {
            return $this->student_id;
        }

        /**
         * @return string
         */
        public function getCourseId()
        {
            return $this->course_id;
        }

        /**
         * @return string
         */
        public function getProgress()
        {
            return $this->progress;
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
         * @param string $student_id
         */
        public function setStudentId($student_id)
        {
            $this->student_id = $student_id;
        }

        /**
         * @param string $course_id
         */
        public function setCourseId($course_id)
        {
            $this->course_id = $course_id;
        }

        /**
         * @param string $progress
         */
        public function setProgress($progress)
        {
            $this->progress = $progress;
        }

        public function setRow($row)
        {
            $this->id = $row['id'];
            $this->student_id = $row{'student_id'};
            $this->course_id = $row['course_id'];
            $this->progress = $row['progress'];
        }
    }