<?php
    
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/27/2016
     * Time: 8:38 AM
     */
    require_once ('C:\wamp\www\course_manager\classes\functions.php');
    require_once ('C:\wamp\www\course_manager\classes\notice.php');
    require_once ('C:\wamp\www\course_manager\models\resource_model.php');

    class ResourceController
    {
        public function addResource(CourseResource $resource)
        {
            $func = new Functions();
            $notice = new Notice();
            $resource_mod = new ResourceModel();

            $tmp_file = $resource->getUploadedFile()['tmp_name'];
            $file_name = $resource->getUploadedFile()['name'];
            $size = $resource->getUploadedFile()['size'];
            $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $target_file =  $func->DateString() . '_' . $resource->getTitle() .'.'. $ext;
            $file_path = RESOURCE_PATH . $target_file;

            if(!$func->validateTypeInput($resource->getResourceType()))
            {
                $notice->type = "danger";
                $notice->message = "Error: Invalid Type Provided";
                return $notice;
            }
            if($resource->getUploadedFile()['error'] == 0 && $resource->getUploadedFile()['size'] > 0)
            {
                if(!$func->validateResourceSize($size))
                {
                    $notice->type = "danger";
                    $notice->message = "Error: File Too Large";
                    return $notice;
                }
                if(!$func->validateResourceExt($ext))
                {
                    $notice->type = "danger";
                    $notice->message = "Error: Invalid Extension";
                    return $notice;
                }
                if(move_uploaded_file($tmp_file, $file_path))
                {
                    $resource->setUrl($target_file);
                    echo $resource->getUrl();
                }
            }
            $id = $resource_mod->insert($resource);

            //check if last insert id is zero
            if($id == 0)
            {
                $notice->type = "danger";
                $notice->message = "Error: File Already Exists";
                return $notice;
            }
            $resource->setId($id);

            $notice->type = "success";
            $notice->message = "File has been uploaded successfully";
            return $notice;
        }
    }