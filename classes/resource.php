<?php
    
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/27/2016
     * Time: 8:04 AM
     */
    class CourseResource
    {
        private $id;
        private $week_id;
        private $title;
        private $summary;
        private $url;
        private $resource_type;
        private $added_at;
        private $uploaded_file;

        /**
         * Resource constructor.
         */
        public function __construct()
        {
            $this->id = "";
            $this->week_id = "";
            $this->title = "";
            $this->summary = "";
            $this->url = "";
            $this->resource_type = "";
            $this->added_at = "";
            $this->uploaded_file = "";
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
        public function getWeekId()
        {
            return $this->week_id;
        }

        /**
         * @return string
         */
        public function getTitle()
        {
            return $this->title;
        }

        /**
         * @return string
         */
        public function getSummary()
        {
            return $this->summary;
        }

        /**
         * @return string
         */
        public function getUrl()
        {
            return $this->url;
        }

        /**
         * @return string
         */
        public function getResourceType()
        {
            return $this->resource_type;
        }

        /**
         * @return string
         */
        public function getUploadedFile()
        {
            return $this->uploaded_file;
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
         * @param string $week_id
         */
        public function setWeekId($week_id)
        {
            $this->week_id = $week_id;
        }

        /**
         * @param string $title
         */
        public function setTitle($title)
        {
            $this->title = $title;
        }

        /**
         * @param string $summary
         */
        public function setSummary($summary)
        {
            $this->summary = $summary;
        }

        /**
         * @param string $url
         */
        public function setUrl($url)
        {
            $this->url = $url;
        }

        /**
         * @param string $resource_type
         */
        public function setResourceType($resource_type)
        {
            $this->resource_type = $resource_type;
        }

        /**
         * @param string $uploaded_file
         */
        public function setUploadedFile($uploaded_file)
        {
            $this->uploaded_file = $uploaded_file;
        }

        public function setRow($row)
        {
            $this->id = $row['id'];
            $this->week_id = $row['week_id'];
            $this->title = $row['title'];
            $this->summary = $row['summary'];
            $this->url = $row['url'];
            $this->resource_type = $row['resource_type'];
            $this->added_at = $row['added_at'];
        }
    }