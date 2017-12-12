<?php
    
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/11/2016
     * Time: 7:15 AM
     */
    require_once ('C:\wamp\www\course_manager\classes\database.php');
    require_once ('C:\wamp\www\course_manager\classes\admin.php');

    class AdminModel
    {
        public function IsEmailExist($email)
        {
            $sql = "select * from admin where email = :em";
            $conn = new PDOConnection();
            $conn->SetSQL($sql);
            $conn->AddParam(":em", $email);
            $conn->Select();
            if($conn->num_rows > 0)
                return true;
            else
                return false;
        }

        public function insertAdmin(Admin $admin)
        {
            if($this->IsEmailExist($admin->getEmail()))
            {
                return 0;
            }
            else
            {
                $sql = "INSERT INTO admin (first_name, last_name, email, password, role, token_id)
                    VALUES (:first_name, :last_name, :email, :password, :role, :token_id)";
                $conn = new PDOConnection();
                $conn->SetSQL($sql);
                $conn->AddParam(":first_name", $admin->getFirstName());
                $conn->AddParam(":last_name", $admin->getLastName());
                $conn->AddParam(":email", $admin->getEmail());
                $conn->AddParam(":password", $admin->getPassword());
                $conn->AddParam(":role", $admin->getRole());
                $conn->AddParam(":token_id", $admin->getTokenId());
                //$conn->AddParam(":profile_pic", $student->profile_pic);
                $id = $conn->Insert();
                return $id;
            }
        }

        public function updateAdmin(Admin $admin)
        {
            $func = new Functions();
            $sql = "UPDATE admin SET
            first_name = :first_name, last_name = :last_name, email = :email, profile_pic = :profile_pic WHERE id = :id";
            $conn = new PDOConnection();
            $conn->SetSQL($sql);
            $conn->AddParam(":first_name", $admin->getFirstName());
            $conn->AddParam(":last_name", $admin->getLastName());
            $conn->AddParam(":email", $admin->getEmail());
            $conn->AddParam(":profile_pic", $admin->getProfilePic());
            $conn->AddParam(":id", $admin->getId());
            $id = $conn->Update();
            //var_dump($id);
            return $id;
        }

        public function getAdminByEmail($email)
        {
            $sql = "select * from admin where email = :em";
            $conn = new PDOConnection();
            $conn->SetSQL($sql);
            $conn->AddParam(":em", $email);
            $row = $conn->Select();
            if($conn->num_rows <= 0)
                return null;
            else
            {
                $found_admin = new Admin();
                $found_admin->setRow($row[0]);
                return $found_admin;
            }
        }

        public function getAdminById($id)
        {
            $sql = "select * from admin where id = :refid";
            $conn = new PDOConnection();
            $conn->SetSQL($sql);
            $conn->AddParam(":refid", $id);
            $row = $conn->Select();
            if($conn->num_rows <= 0)
                return null;
            else
            {
                $found_admin = new Admin();
                $found_admin->setRow($row[0]);
                return $found_admin;
            }
        }
    }