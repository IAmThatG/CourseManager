<?php
    
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/27/2016
     * Time: 8:43 AM
     */
    require_once ('C:\wamp\www\course_manager\classes\database.php');
    require_once ('C:\wamp\www\course_manager\classes\functions.php');
    require_once ('C:\wamp\www\course_manager\classes\resource.php');

    class ResourceModel
    {
        public function isResourceExist($title)
        {
            $sql = "select * from resources where title = :title";
            $conn = new PDOConnection();
            $conn->SetSQL($sql);
            $conn->AddParam(":title", $title);
            $conn->Select();
            if($conn->num_rows > 0)
                return true;
            else
                return false;
        }

        public function insert(CourseResource $resource)
        {
            if($this->isResourceExist($resource->getTitle()))
            {
                return 0;
            }
            else
            {
                $func = new Functions();
                $sql = "INSERT INTO resources (week_id, title, summary, url, resource_type, added_at)
                    VALUES (:week_id, :title, :summary, :url, :resource_type, :added_at)";
                $conn = new PDOConnection();
                $conn->SetSQL($sql);
                $conn->AddParam(":week_id", $resource->getWeekId());
                $conn->AddParam(":title", $resource->getTitle());
                $conn->AddParam(":summary", $resource->getSummary());
                $conn->AddParam(":url", $resource->getUrl());
                $conn->AddParam(":resource_type", $resource->getResourceType());
                $conn->AddParam(":added_at", $func->DateDB());
                $id = $conn->Insert();
                return $id;
            }
        }

        public function getResourceByType($type, $week_id)
        {
            $sql = "select * from resources where resource_type = :resource_type AND week_id = :week_id";
            $conn = new PDOConnection();
            $conn->SetSQL($sql);
            $conn->AddParam(":resource_type", $type);
            $conn->AddParam(":week_id", $week_id);
            $rows = $conn->Select();
            if($conn->num_rows <= 0)
                return null;

            $resources = array();
            for($i = 0; $i < count($rows); $i++)
            {
                $resource = new CourseResource();
                $resource->setRow($rows[$i]);
                $resources[] = $resource;
            }
            return $resources;
        }
    }