<?php


require_once 'DB_Core.php';

class DB_Query_Builder extends DB_Core
{

    public function __construct()
    {
        
    }

    # ------------------------------------------------------------------------------

    /**
     * Get All function
     * 
     * 
     * To get all data from the particular table
     * 
     * @param  string  $table_name
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
     * Get Where
     * 
     * 
     * Get a particular item or items from database
     * 
     * @param string $table_name  
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


    public function DB_builder_insert($sql,$bind_value)
    {

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


    public function DB_builder_select($sql,$bind = FALSE)
    {
        if($bind === FALSE)
            return parent::fetch($sql);
        else
            return parent::fetch($sql,$bind);
    }

}


$db = new DB_Query_Builder;