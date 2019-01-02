<?php

/**
 * ============
 * Class Input
 * ============
 * 
 * 
 *  Purpose 
 *  1. To get data/datas from get request 
 *  2. To get data/datas from post request
 * 
 */

class Input {
    
    private $get;
    private $post;

    public function get($param = NULL)
    {
        $output = array();
        # In case of param is || are specified as array
        if(is_array($param) && count($param) !== 0)
        {   
            # Convert key of $_GET to a value
            $index = array_keys($_GET);
            # Get the values of $index and $param which are same
            $matches = array_intersect($index,$param);
            foreach($matches as $v)
            {
                $output[$v] = $_GET[$v];
            }
            return $output;
        }
        elseif($param !== NULL)
            $this->get = $_GET[$param];
        else
            $this->get = $_GET;
        return $this->get;
    }

    public function post($param = NULL)
    {
        if(is_array($param) && count($param) !== 0)
        {   
            # Convert key of $_POST to a value
            $index = array_keys($_POST);
            # Get the values of $index and $param which are same
            $matches = array_intersect($index,$param);
            foreach($matches as $v)
            {
                $output[$v] = $_POST[$v];
            }
            return $output;
        }
        if($param !== NULL)
            $this->post = $_POST[$param];
        else
            $this->post = $_POST;
        return $this->post;
    }
}

$input = new Input;