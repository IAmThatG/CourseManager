<?php
    
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/13/2016
     * Time: 1:34 PM
     */
    class Week
    {
        private $id;
        private $course_id;
        private $week;
        private $topic;
        private $body;
        private $created;
        private $updated;

        /**
         * Week constructor.
         */
        public function __construct()
        {
            $this->id = "";
            $this->course_id = "";
            $this->week = "";
            $this->topic = "";
            $this->body = "";
            $this->created = "";
            $this->updated = "";
        }

        //setters for WEEK fields
        /**
         * @param string $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }

        /**
         * @param string $course_id
         */
        public function setCourseId($course_id)
        {
            $this->course_id = $course_id;
        }

        /**
         * @param string $week
         */
        public function setWeek($week)
        {
            $this->week = $week;
        }

        /**
         * @param string $topic
         */
        public function setTopic($topic)
        {
            $this->topic = $topic;
        }

        /**
         * @param string $body
         */
        public function setBody($body)
        {
            $this->body = $body;
        }

        //getters for WEEK fields
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
        public function getCourseId()
        {
            return $this->course_id;
        }

        /**
         * @return string
         */
        public function getWeek()
        {
            return $this->week;
        }

        /**
         * @return string
         */
        public function getTopic()
        {
            return $this->topic;
        }

        /**
         * @return string
         */
        public function getBody()
        {
            return $this->body;
        }

        public function setRow($row)
        {
            $this->id = $row['id'];
            $this->course_id = $row['course_id'];
            $this->week = $row['week'];
            $this->topic = $row['topic'];
            $this->body = $row['body'];
            $this->created = $row['created'];
            $this->updated = $row{'updated'};
        }
    }