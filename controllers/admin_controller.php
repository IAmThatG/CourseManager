<?php
    
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/11/2016
     * Time: 7:14 AM
     */
    require_once ('C:\wamp\www\course_manager\classes\functions.php');
    require_once ('C:\wamp\www\course_manager\classes\notice.php');
    require_once ('C:\wamp\www\course_manager\models\admin_model.php');
    require_once ('C:\wamp\www\course_manager\classes\session.php');

    class AdminController
    {
        public function Login(Admin $admin)
        {
            $func = new Functions();
            $notice = new Notice();
            $admin_model = new AdminModel();

            $admin->encryptPassword();
            $found_admin = $admin_model->getAdminByEmail($admin->getEmail());

            if($found_admin == null)
            {
                $notice->type = "danger";
                $notice->message = "Invalid Credentials";
                return $notice;
            }
            elseif($found_admin->getPassword() != $admin->getPassword())
            {
                $notice->type = "danger";
                $notice->message ="Invalid credentials";
                return $notice;
            }
            else
            {
                $session = new Session();
                $session->login($found_admin->getId());
                $session->setUserRole($found_admin->getRole());

                $func->redirect_to("admin/admin_home.php");

                return $notice;
            }
        }
        public function editAdmin(Admin $admin)
        {
            $func = new Functions();
            $notice = new Notice();
            $admin_mod = new AdminModel();

            $tmp_file = $admin->getUploadedPic()['tmp_name'];
            $file_name = $admin->getUploadedPic()['name'];
            $size = $admin->getUploadedPic()['size'];
            $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $target_file =  $func->DateString() . '_' . $file_name;
            $file_path = PROFILE_PIC_PATH . $target_file;

            if(!$func->validateName($admin->getFirstName()))
            {
                $notice->type = "danger";
                $notice->message = "Invalid First Name";
                return $notice;
            }
            if(!$func->validateName($admin->getLastName()))
            {
                $notice->type = "danger";
                $notice->message = "Invalid Last Name";
                return $notice;
            }
            if(!$func->validateEmail($admin->getEmail()))
            {
                $notice->type = "danger";
                $notice->message = "Invalid Email";
                return $notice;
            }
            if($admin->getUploadedPic()['error'] == 0 && $admin->getUploadedPic()['size'] > 0)
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
                    //echo $admin->getProfilePic();
                    if($admin->getProfilePic() != PROFILE_PIC_DEFAULT and $admin->getProfilePic() != null) {
                        unlink(PROFILE_PIC_PATH . $admin->getPreviousPic());
                    }
                    $admin->setProfilePic($target_file);
                    //echo $admin->getProfilePic();
                }
//                else
//                {
//                    $enroled->type = "danger";
//                    $enroled->message ="File could not be uploaded";
//                    return $enroled;
//                }
            }
            $id = $admin_mod->updateAdmin($admin);

            //check if last insert id is zero
            if($id <= 0)
            {
                $notice->type = "danger";
                $notice->message = "Course Profile Update Failed";
                return $notice;
            }

            $notice->type = "success";
            $notice->message = "Your Profile has been Edited successfully!!!...";
            return $notice;
        }
    }