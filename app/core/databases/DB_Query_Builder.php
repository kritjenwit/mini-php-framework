<?php


require_once 'DB_Core.php';

class DB_Query_Builder extends DB_Core
{

    public function __construct()
    {
        
    }

    # ------------------------------------------------------------------------------

    /**
     * -----------------------
     * Get All function
     * -----------------------
     * 
     * 
     * To get all data from the particular table
     * 
     * @param  string  $table_name  Table name
     * 
     * @return array   $result      Set of data from Database
     * 
     */

    public function get_all($table_name)
    {
        $sql = parent::select('*',$table_name);
        $result = parent::fetch($sql);
        return $result;
    }
    
    # ------------------------------------------------------------------------------

    /**
     * ----------------------
     * Get Where function
     * ----------------------
     * 
     * 
     * Get a particular item or items from database
     * 
     * @param string $table_name    Table name 
     * @param array  $where         EX. ['id' => 1,'name' => 'John'];
     * @param mixed  $select        By default it will fetch all column 
     *                              Can be changed by using "array" => ['id','name'] 
     *                              OR "string" => 'id,name'
     * 
     * @return array $result        Set of data from Database
     */
    public function get_where($table_name,$where,$select='*')
    {
        $sql = parent::select($select,$table_name,$where);
        $bind = parent::bind($where);
        $result = parent::fetch($sql,$bind);
        return $result;
    }

    # ------------------------------------------------------------------------------

    /**
     * ----------------
     * Insert function
     * ----------------
     *
     *
     * This function helps to insert data into a table.
     *
     * @param   string      $table_name                 Table name
     * @param   array       $column_name_with_value     Column name with value in a form of an array
     *                                                  Example. ['firstname' => 'John','lastname' => 'Doe']
     *
     * @return  string                                  SQL Insert into Query
     */
    public function insert_into($table_name,$column_name_with_value)
    {
        # To convert key and value into string
        # key = $column
        # value = $val
        $column_name = array();
        $value = array();
        # Store a key and value in each array
        foreach($column_name_with_value as $column => $val)
        {
            array_push($column_name,$column);
            array_push($value,"'".$val."'");
        }
        # Array of column name convert into string with ',' as a glue
        $column_name = implode(',',$column_name);
        # Array of value convert into string with ',' as a glue
        $value = implode(',',$value);
        # Add a parenthesis to both string of $column_name and $value
        $column_name = '('.$column_name.')';
        $value = '('.$value.')';
        # Call a function insert_template and then return a SQL Insert into Query
        $sql = parent::insert_template($table_name,$column_name,$value);
        # If $conn->exec execute successfull return true else return false
        return $this->connection->exec($sql) ? true : false;
    }

    # ------------------------------------------------------------------------------

    public function update($table_name,$set,$where)
    {

    }

    public function DB_builder_insert($sql)
    {
        return $this->connection->exec($sql) ? true : false;
    }

    # ------------------------------------------------------------------------------

    public function DB_builder_update($sql,$bind_value)
    {

    }

    # ------------------------------------------------------------------------------

    public function DB_builder_delete($sql,$bind_value)
    {

    }

    # ------------------------------------------------------------------------------

    public function DB_builder_select($sql,$bind = NULL)
    {
        if($bind === NULL)
            return parent::fetch($sql);
        else
            return parent::fetch($sql,$bind);
    }

    public function DB_Query($sql)
    {
        return parent::fetch($sql);
    }

    public function show_database()
    {
        $sql = 'SHOW DATABASES';
        $db_list = $this->DB_Query($sql);
        $list = array();
        foreach ($db_list as $v)
        {
            array_push($list,$v['Database']);
        }
        return $list;
    }

}


$db = new DB_Query_Builder;