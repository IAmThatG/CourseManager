<?php
    
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/13/2016
     * Time: 1:46 PM
     */
    require_once ('C:\wamp\www\course_manager\classes\functions.php');
    require_once ('C:\wamp\www\course_manager\classes\notice.php');
    require_once ('C:\wamp\www\course_manager\models\week_model.php');
    //require_once ('C:\wamp\www\course_manager\classes\session.php');

    class WeekController
    {
        public Function addWeek(Week $week)
        {
            $notice = new Notice();
            $func = new Functions();
            $week_model = new WeekModel();

            if(!$func->validateWeek($week->getWeek()))
            {
                $notice->type = "danger";
                $notice->message = "Invalid Week";
                return $notice;
            }
            elseif(!$func->validateTopic($week->getTopic()))
            {
                $notice->type = "danger";
                $notice->message = "Invalid Topic";
                return $notice;
            }
           else
           {
               //insert
               $id = $week_model->insertWeek($week);

               //check if last insert id is zero
               if($id == 0)
               {
                   $notice->type = "danger";
                   $notice->message = "Week Already Exists";
                   return $notice;
               }
               $week->setId($id);

               $notice->type = "success";
               $notice->message = $week->getWeek() ." has been added successfully!!!...";
               return $notice;
           }
        }

        public function editWeek(Week $week)
        {
            $notice = new Notice();
            $func = new Functions();
            $week_model = new WeekModel();

            if(!$func->validateWeek($week->getWeek()))
            {
                $notice->type = "danger";
                $notice->message = "Invalid Week";
                return $notice;
            }
            elseif(!$func->validateTopic($week->getTopic()))
            {
                $notice->type = "danger";
                $notice->message = "Invalid Topic";
                return $notice;
            }
            else
            {
                $id = $week_model->updateWeek($week);

                //check if last insert id is zero
                if($id == 0)
                {
                    $notice->type = "danger";
                    $notice->message = "Week Edit Failed";
                    return $notice;
                }
                $week->setId($id);

                $notice->type = "success";
                $notice->message = strtoupper($week->getWeek()) ." has been Edited successfully!!!...";
                return $notice;
            }
        }
    }