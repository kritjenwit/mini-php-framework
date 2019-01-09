<?php

class DB_Core {    

    protected $servername = DB_HOST;
    protected $username = DB_USER;
    protected $password = DB_PASS;
    protected $connection;
    public $db_name;

    /**
     * Initiate Connection to Database
     * 
     * 
     * @param string   $db_name   Database name
     * @return object  $conn      Return connection
     * 
     */
    public function connect($db_name)
    {
        try 
        {
            $conn = new PDO("mysql:host=$this->servername;dbname=$db_name", $this->username, $this->password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Set Database name for later use
            $this->set_db_name($db_name);
            // Set a connection of database
            $this->set_connection($conn);
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }
        return $conn;
    }

    # ------------------------------------------------------------------------------

    /**
     * Select function
     * 
     * 
     * Get 3 parameter
     * 
     * If $select is array it will be converted to string with comma.
     * From is the table name in specified database.
     * If $where is array it will be converted to string in PDO form and value will be binded. 
     * 
     * @param mixed   $select 
     * @param string  $from
     * @param array   $where
     *
     * @return string $this->select_template SQL Query
     */
    protected function select($select,$from = NULL,$where = NULL)
    {
        /*  
            IF 
                list of item come in a form of array then convert to string 
                Example ['id','name] => TO => 'id,name'
            ELSE
                Use it as a string
        */
        if(is_array($select))
            $select = implode(',',$select);
        
        /*
            IF
                list of item come in a form of array convert it into a string of PDO bind value 
                Example ['id' => 1,'name' => 'John'] => TO => ' ... where id=:id AND name=:name '
            ELSE
                Use it as a string
        */
        if(is_array($where))
            $where = $this->where($where);
        
        // Return a SQL "SELECT" Query
        return $this->select_template($select,$from,$where);

    }

    # ------------------------------------------------------------------------------

    /**
     * Where function 
     * 
     * 
     * This function is used to convert from Array to PDO binding value
     * 
     * @param array $where      In the future it migth accept string
     * @return string $return   Return string in a form of PDO binding value
     * 
     */
     protected function where($where)
    {
        if(is_array($where))
        {
            # Create a variable as array
            $output = array();
            # Extract an array into key and value
            foreach ($where as $key => $value) {
                # Push string of bind value into array
                # Example ['id' => 1] => TO => 'id=:id' and kept in an array $output = ['id=:id']
                array_push($output,$key.'=:'.$key);
            }
            # Check if only one element in array select that element
            if(count($output) === 1)
                $return = $output[0];
            # Else concat a string with "AND" to seperate a Where cause in Query 
            else
                $return = implode(' AND ', $output);
        }

        # Return a where cause as a string
        return $return;
    }

    # ------------------------------------------------------------------------------

    /**
     * Bind Function 
     * 
     * 
     * This function will return an array of binded data
     * 
     * @param array $where  Where cause ex. ['id' => 2]; But in future will also accept 
     *                      string and will convert string to array of binded value
     * 
     * @return  array $bind   array of binded value
     */
    protected function bind($where)
    {
        $bind = array();
        foreach($where as $k => $v)
        {
            $bind[$k] = $v;
        }
        return $bind;
    }

    # ------------------------------------------------------------------------------

    /** 
     * Select_Template function
     * 
     * 
     * It is a template of select statement 
     * It takes 3 arguments 
     * All of these are strings 
     * 
     * @param string $select 
     * @param string $from
     * @param string $where
     *
     * @return string $sql  SQL Query
     */

    protected function select_template($select,$from,$where)
    {
        $w = $where !== NULL ? ' where ' . $where : '';
        $sql = 'SELECT '. $select .' from '. $from . $w; 
        return $sql;
    }

    # ------------------------------------------------------------------------------

    /**
     * Test Connection function
     * 
     * It used to check connection of Database
     * 
     * @param string $db_name  Database name as parameter
     */

    public function test_connect($db_name)
    {
        if($this->connect($db_name))
        {
            echo 'Connection Successful';
        }
        else
        {
            echo 'Connection Error';
        }
    }

    # ------------------------------------------------------------------------------

    /**
     * Fetch function
     * 
     * 
     * This function is used to fetch data from database 
     * 
     * @param string $sql   SQL Query
     * @param array  $bind  PDO Bind
     *
     * @return object $result DB fetch Array
     * 
     */

    protected function fetch($sql,$bind = NULL)
    {
        $stmt = $this->connection->prepare($sql); 
        if($bind === NULL)
        {
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        else
        {
            $stmt->execute($bind);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    # ------------------------------------------------------------------------------

    # =========================
    # Insert into table section
    #==========================

    /**
     * ------------------
     * Insert Template
     * ------------------
     * 
     * 
     * 
     * @param   string    $table_name      Table's name
     * @param   string    $column_name
     * @param   string    $value
     *
     * @return  string                     Insert into Query
     */
    protected function insert_template($table_name,$column_name,$value)
    {
        return 'INSERT INTO '.$table_name.' '.$column_name.' VALUES '.$value.' ';
    }

    # ------------------------------------------------------------------------------

    private function set_db_name($db_name)
    {
        $this->db_name = $db_name;
    }

    # ------------------------------------------------------------------------------

    public function get_db_name()
    {
        return $this->db_name;
    }

    # ------------------------------------------------------------------------------


    private function set_connection($conn)
    {
        $this->connection = $conn;
    }

    # ------------------------------------------------------------------------------

    public function get_connection()
    {
        return $this->connection;
    }

    # ------------------------------------------------------------------------------

    /**
     * Set Database Environment
     * 
     * 
     * Database Environment includes of
     * 1. Server's name OR Host's name
     * 2. Username
     * 3. Password
     * 
     * By default database will establish as in a config file
     * 
     * This function is used to new Connection as we need
     * 
     * @param   string  $servername     Server's name OR Host's name
     * @param   string  $username       Username of $servername
     * @param   string  $password       Password of $servername
     * 
     */
    public function set_db_env($servername,$username,$password)
    {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
    }
}