<?php


if(!function_exists('alert'))
{
    /**
     * Alert Function
     *
     *
     * Print Array in a pretty form
     *
     * @param array $array
     *
     *
     */
    function alert($array)
    {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }
}


if(!function_exists('to_json'))
{
    /**
     * Convert Array to JSON
     *
     *
     * @param array $array
     * @return string
     */
    function to_json($array)
    {
        # Check that $array is an array
        return is_array($array) ? json_encode($array) : false;
    }
}


if(!function_exists('is_json'))
{
    /**
     * To check variable is json or not
     *
     * @param $string
     * @return bool
     */
    function is_json($string) {
        return ((is_string($string) &&
            (is_object(json_decode($string)) ||
                is_array(json_decode($string))))) ? true : false;
    }
}

if(!function_exists('to_array'))
{
    /**
     * Covert JSON to php array
     *
     * @param $json
     * @return mixed
     */
    function to_array($json)
    {
        return is_json($json) ? json_decode($json,true) : false;
    }
}

if(!function_exists('line_break'))
{
    /**
     * Line Break 
     * 
     * echo '<br>'
     * 
     */
    function line_break()
    {
        echo '<br>';
    }
}


if(!function_exists('redirect'))
{
    /**
     * Redirect to base path
     *
     *
     * @param string $path
     *
     */
    function redirect($path)
    {
        header('Location: '.$path.'.php');
    }
}


if(!function_exists('base_url'))
{
    function base_url($path = NULL)
    {
        return BASE_URL . $path;
    }
}

if(!function_exists('str_validate'))
{
    function str_validate($string)
    {
        return preg_match('/^[\w|\-]+$/', $string);
    }
}