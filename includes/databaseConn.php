<?php
    
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 8/15/2016
     * Time: 4:42 AM
     */
    require_once('../includes/config.php');

    if(!class_exists('MYSQLIConnection'))
    {
        class MYSQLIConnection
        {
            private $DBHost = DB_HOST;
            private $DBUser = DB_USER;
            private $DBPass = DB_PASS;
            private $DBName = DB_NAME;
            private $link;
            private $magic_quotes_active;
            private $real_escape_string_exist;

            public $last_query; //variable that holds last executed query
            //private $params;
            //private $types;
            //private $query;

            public function __construct()
            {
                $this->link = new mysqli($this->DBHost, $this->DBUser, $this->DBPass,  $this->DBName);
                if($this->link->connect_error)
                {
                    die( "database connection failed " . $this->link->connect_errno . " : " . $this->link->connect_error);
                }
                else
                {
                    echo  "database connection successful";
                }
                $this->magic_quotes_active = false;
                $this->real_escape_string_exist = function_exists("mysqli_real_escape_string");
            }

            public function prepare($sql)
            {
                return $this->link->prepare($sql);
            }

            public function execute($stmt)
            {
                if(!mysqli_stmt_execute($stmt))
                {
                    echo "database query execution failed";
                    exit();
                }
            }

            public function query($sql)
            {
                $this->last_query = $sql;
                $query = $this->prepare($sql);
                $result = $this->link->query($query);
                $this->confirm_query($result);
                return $result;
            }

            private function confirm_query($result)
            {
                if(!$result)
                {
                    $output = "Database query failed: " . $this->link->error;
                    $output .= "<br>Last SQL query: " . $this->last_query;
                    die($output);
                }
                else
                {
                    echo "Database query executed successfully";
                }
            }

            public function escape_value($value)
            {
                if($this->real_escape_string_exist) //PHP v4.3.0 or higher
                {
                    //undo any magic quote effects so mysql_real_escape_string can do the work
                    if($this->magic_quotes_active)
                    {
                        $value = stripslashes($value);
                    }
                    $value = mysqli_real_escape_string($this->link,$value);
                }
                return $value;
            }

            public function fetchArray($result)
            {
                return mysqli_fetch_array($result);
            }

            Public function num_rows($result_set)
            {
                //return the number of rows in a result set
                return mysqli_num_rows($result_set);
            }

            public function  insert_id()
            {
                //return the id of the last insert query
                return mysqli_insert_id($this->link);
            }

            public function affected_rows()
            {
                //returns the number of rows affected by the previous MYSQL operation
                return mysqli_affected_rows($this->link);
            }

            public function close()
            {
                if(isset($this->mysqli))
                {
                    mysqli_close($this->mysqli);
                    unset($this->mysqli);
                    //$this->mysqli->close();
                }

            }

            //My other MYSQLI connection attempt

            /*        public function setQuery($query)
                    {
                        $this->query = $query;
                    }

                    public function getQuery()
                    {
                        return $this->query;
                    }

                    public function setTypes($types = "")
                    {
                        $this->types = $types;
                    }

                    public function getTypes()
                    {
                        return $this->types;
                    }

                    public function setParams($params = array())
                    {
                        $this->params = $params;
                        //var_dump($this->params);
                    }

                    public function getParams()
                    {
                        $params = $this->params;
                        return join(", ", array_values($params));
                    }*/

            /*public function insert()
            {
                $stmt = $this->prepare($this->getQuery());
                $values = $this->getParams();
                //$values = implode(",", $this->getParams());
                $types = $this->getTypes();
                $stmt->bind_param($types, $values);
                if($stmt->execute())
                {
                    echo "data inserted successfully";
                }
                else
                {
                    die("could not insert to the database");
                }
            }*/
        }
    }



