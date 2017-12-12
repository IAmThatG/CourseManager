<?php
    
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/1/2016
     * Time: 4:45 AM
     */
    class Notice
    {
        public $message = ""; //enroled message var
        public $type = ""; //enroled type var

        //function to display enroled
        /**
         * @return string|void
         */
        public function display()
        {
            if(!isset($this->type) or !isset($this->message))
                return "";
            //html that displays enroled and assigns it to $txt
            $text = '<div class="alert alert-'. $this->type .'" role="alert">'. $this->message .'</div>';
            return $text;
        }
    }