<?php
    
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 8/29/2016
     * Time: 3:20 PM
     */
    require_once ('C:\wamp\www\course_manager\includes\config.php');
    class PDOConnection
    {
        private $link; //This is a variable that holds a new PDO connection
        private $res; //Tis variable holds the result of the executed sql
        private $DBHost = DB_HOST; //DBHost holds the value of the DBHOST constant defined in config.php;
        private $DBUser = DB_USER; //DBUser holds the value of the DBUSER constant defined in config.php;
        private $DBPassword = DB_PASS; //DBPassword holds the value of the DBPWD constant defined in config.php;
        private $DBName = DB_NAME; //DBName holds the value of the DBNAME constant defined in config.php;
        private $params;   /*Array var that holds the data input value. it is used in function AddParam()
                        which is called in UserRepository class*/

        public $sql;
        public $num_rows; //holds the number of roles returned after executing a select statement
        public $Persist = false; //$boolean var that shows if the connection is still in use, initialized to false

        function __construct() //anywhere our connect class is instantiated, this method gets called
        {
            try
            {
                $l = "mysql:host=".$this->DBHost.";dbname=".$this->DBName;
                $this->link = new PDO($l,$this->DBUser,$this->DBPassword); // This creates a new database connection using PDO and assigns it to $link
            }
                //if there is an error in setting up the connection
            catch (PDOException $e)
            {
                echo 'Connection failed: ' . $e->getMessage();
                new ErrorLog($e);
            }
        }

        function SetSQL($sql) //whenever this function is called it gets the sql and assigns it to the sql variable in this class
        {
            $this->sql = $sql;
            $this->params = array(); //declares params as an empty array initially
        }

        //this function is called in UserRepository class
        function AddParam($key, $val)
        {
            $this->params[$key] = $val; //populates the params array by assigning value to their respective keys
        }

        /**
         * selects records from database
         * @return array
         */
        function Select()
        {
            $this->num_rows = -1; //initially, the number of row has a default value of -1. but why?
            try
            {
                $this->res = $this->link->prepare($this->sql); //predefined PDO function. it prepares the sql string
                if ($this->params && count($this->params) > 0) {//what does this do?
                    $this->res->execute($this->params);
                }
                else
                {
                    $this->res->execute();
                }
                $rows = $this->res->fetchAll();//gets all rows from the result...connect class
                $this->num_rows = count($rows);//counts the rows and assigns the numerical value to num_rows
            }
            catch (PDOException $e)
            {
                new ErrorLog($e);
            }
            $this->Close();
            return $rows; //returns all rows
        }

        function SelectObject() //what does it do?
        {
            $this->num_row = -1;
            try
            {
                $this->res = $this->link->prepare($this->sql);
                if ($this->params && count($this->params) > 0) {
                    $this->res->execute($this->params);
                }
                else
                {
                    $this->res->execute();
                }
            }
            catch (PDOException $e)
            {
                new ErrorLog($e);
            }
            $arr = array();
            while($row = $this->res->fetchObject()){
                $arr[] = $row;
            }
            $this->num_rows = count($arr);
            $this->Close();
            return $arr;
        }

        function SelectScalar()
        {
            $this->num_row = -1;
            try
            {
                $this->res = $this->link->prepare($this->sql);
                if ($this->params && count($this->params) > 0) {
                    $this->res->execute($this->params);
                }
                else
                {
                    $this->res->execute();
                }
            }
            catch (PDOException $e)
            {
                new ErrorLog($e);
            }
            $row = $this->res->fetch();//fetches the data of the result and assigns it to row
            $v = $row[0]; //gets the first row in the array and assigns it to $v
            $this->Close();
            return $v; //returns $v
        }

        function Update()
        {
            $cnt = -1; //initially $cnt is -1
            try
            {
                $this->res = $this->link->prepare($this->sql);
                if ($this->params && count($this->params) > 0) {
                    $this->res->execute($this->params);
                }
                else
                {
                    $this->res->execute();
                }
                $cnt = $this->res->rowCount(); //counts the num of rows updated and assigns it to $cnt
            }
            catch (PDOException $e)
            {
                new ErrorLog($e);
            }
            $this->Close();
            return $cnt; //returns $cnt
        }

        function Delete()
        {
            $this->Update();
        }

        /**
         * @return int|string
         */
        function Insert()
        {
            $cnt = -1;
            try
            {
                $this->res = $this->link->prepare($this->sql); //prepares the sql statement for execution and returns the prepared statement
                if ($this->params && count($this->params) > 0) {
                    $this->res->execute($this->params);
                }
                else
                {
                    $this->res->execute();
                }
                $cnt = $this->link->lastInsertId(); //returns the id of the last inserted row and assigns it to $cnt
            }
            catch (PDOException $e)
            {
                echo $this->sql;
                new ErrorLog($e);
            }
            $this->Close();
            return $cnt; //returns $cnt
        }

        // predefined PDO function that closes connection
        function Close()
        {
            //if connection persists return nothing ie: don't do anything
            if($this->Persist)
            {
                return;
            }
            //else set link and result to null
            $this->link = null;
            $this->res = null;
        }

        function CloseAll() //what is the difference btw Close and CloseAll
        {
            $this->link = null;
            $this->res = null;
        }
    }