<?php
    
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/11/2016
     * Time: 3:44 PM
     */
    require_once ('C:\wamp\www\course_manager\classes\functions.php');
    require_once ('C:\wamp\www\course_manager\classes\notice.php');
    require_once ('C:\wamp\www\course_manager\models\course_model.php');
    require_once ('C:\wamp\www\course_manager\classes\session.php');

    class CourseController
    {
        public function addCourse(Course $course)
        {
            $func = new Functions();
            $notice = new Notice();
            $course_model = new CourseModel();

            $tmp_file = $course->getUploadedImg()['tmp_name'];
            $file_name = $course->getUploadedImg()['name'];
            $size = $course->getUploadedImg()['size'];
            $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $target_file =  $func->DateString() . '_' . $course->getCourseCode() .'.'. $ext;
            $file_path = COURSE_PIC_PATH . $target_file;

            if(!$func->validateCode($course->getCourseCode()))
            {
                $notice->type = "danger";
                $notice->message = "Please Provide a Valid Course Code";
                return $notice;
            }

            if(!$func->validateName($course->getCourseTitle()))
            {
                $notice->type = "danger";
                $notice->message = "Please Fill the Course Title field";
                return $notice;
            }

            if(!$func->validateUnit($course->getCourseUnit()))
            {
                $notice->type = "danger";
                $notice->message = "Please Provide a Valid Course Unit";
                return $notice;
            }

            if($course->getUploadedImg()['error'] == 0 && $course->getUploadedImg()['size'] > 0)
            {
                if(!$func->validateImageUploadSize($size))
                {
                    $notice->type = "danger";
                    $notice->message = "Invalid Image file: Too Large";
                    return $notice;
                }
                if(!$func->validateImageUpload($ext))
                {
                    $notice->type = "danger";
                    $notice->message = "Invalid Image File: Upload JPG, PNG or JPEG Only";
                    return $notice;
                }
                if(move_uploaded_file($tmp_file, $file_path))
                {
                    echo $course->getCourseImg();
                    if($course->getCourseImg() != COURSE_PIC_DEFAULT) {
                        unlink(COURSE_PIC_DEFAULT . $course->getCourseImg());
                    }
                    $course->setCourseImg($target_file);
                    echo $course->getCourseImg();
                }
            }

            //insert
            $id = $course_model->insertCourse($course);

            //check if last insert id is zero
            if($id == 0)
            {
                $notice->type = "danger";
                $notice->message = "Course Already Exists";
                return $notice;
            }
            $course->setId($id);

            $notice->type = "success";
            $notice->message = $course->getCourseTitle() ." has been added successfully!!!...<br>You may assign a lecturer to this course";
            return $notice;
        }

        public function assignCourse(Course $course, Lecturer $lecturer)
        {
            $notice = new Notice();
            $course_mod = new CourseModel();
            $id = $course_mod->assign($course, $lecturer);

            if($id == 0)
            {
                $notice->type = "danger";
                $notice->message = "Course has Previously been Assigned";
                return $notice;
            }
            else
            {
                $notice->type = "success";
                $notice->message = "Course has been Assigned Successfully";
                return $notice;
            }
        }

        public function editCourse(Course $course)
        {
            $notice = new Notice();
            $func = new Functions();
            $course_mod = new CourseModel();

            $tmp_file = $course->getUploadedImg()['tmp_name'];
            $file_name = $course->getUploadedImg()['name'];
            $size = $course->getUploadedImg()['size'];
            $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $target_file =  $func->DateString() . '_' . $course->getCourseCode() .'.'. $ext;
            $file_path = COURSE_PIC_PATH . $target_file;

            if(!$func->validateCode($course->getCourseCode()))
            {
                $notice->type = "danger";
                $notice->message = "Please Provide a Valid Course Code";
                return $notice;
            }

            if(!$func->validateName($course->getCourseTitle()))
            {
                $notice->type = "danger";
                $notice->message = "Please Fill the Course Title field";
                return $notice;
            }

            if(!$func->validateUnit($course->getCourseUnit()))
            {
                $notice->type = "danger";
                $notice->message = "Please Provide a Valid Course Unit";
                return $notice;
            }

            if($course->getUploadedImg()['error'] == 0 && $course->getUploadedImg()['size'] > 0)
            {
                if(!$func->validateImageUploadSize($size))
                {
                    $notice->type = "danger";
                    $notice->message = "Invalid Image file: Too Large";
                    return $notice;
                }
                if(!$func->validateImageUpload($ext))
                {
                    $notice->type = "danger";
                    $notice->message = "Invalid Image File: Upload JPG, PNG or JPEG Only";
                    return $notice;
                }
                if(move_uploaded_file($tmp_file, $file_path))
                {
                    echo $course->getCourseImg();
                    if($course->getCourseImg() != COURSE_PIC_DEFAULT) {
                        unlink(COURSE_PIC_DEFAULT . $course->getCourseImg());
                    }
                    $course->setCourseImg($target_file);
                    echo $course->getCourseImg();
                }
            }

            $id = $course_mod->updateCourse($course);

            //check if last insert id is zero
            if($id <= 0)
            {
                $notice->type = "danger";
                $notice->message = "Course Update Failed!!!";
                return $notice;
            }

            $notice->type = "success";
            $notice->message = $course->getCourseTitle() ." has been Edited successfully!!!...";
            return $notice;
        }
    }