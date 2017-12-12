<?php
    
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/23/2016
     * Time: 3:56 AM
     */
    require_once ('C:\wamp\www\course_manager\classes\functions.php');
    require_once ('C:\wamp\www\course_manager\classes\notice.php');
    require_once ('C:\wamp\www\course_manager\models\enrolment_model.php');
    require_once ('C:\wamp\www\course_manager\classes\student.php');

    class EnrolmentController
    {
        public function enrol(Enrolment $enrolment)
        {
            $enrolment_mod = new EnrolmentModel();
            $notice = new Notice();

            $id = $enrolment_mod->insert($enrolment);

            if($id == 0)
            {
                $notice->type = "danger";
                $notice->message = "This Course Has Been Enroled Previously";
                return $notice;
            }
            else
            {
                $enrolment->setId($id);
                $notice->type = "success";
                $notice->message = "You have successfully enroled for this course";
                return $notice;
            }
        }

        public function showEnrolled($student_id)
        {
            $notice = new Notice();
            $enrolment_mod = new EnrolmentModel();
            $course_ids = $enrolment_mod->selectEnroled($student_id);
            return $course_ids;
        }
    }