<?php 

if(!function_exists('set_attribute'))
{
    /**
     * =======================
     * Set Attribute function
     * =======================
     * 
     * 
     * An attribute is given a form of function.
     * This function convert form given atttribute into a string.
     * 
     * And then return a attribute in a form of string
     * 
     * @param   array   $attribute  Attribute in a form of array
     * @return  string              Attribute in a form of a string
     * 
     */
    function set_attribute($attribute)
    {
        $a = '';
        foreach($attribute as $k => $v)
        {
            $a .= $k.'='.$v.' ';
        }
        return $a;
    }
}

# --------------------------------------------------------------------

if(!function_exists('form_open'))
{
    /**
     * ======================
     * Form open function
     * ======================
     * 
     * To create a <form> tag with its attribute.
     * All attribute come in a form of an array.
     * => a key as a attribute name ,
     * => a value as a attribute value 
     * 
     * Default method is 'POST'
     * 
     * @param   string  $action       form 'POST' or 'GET' to that action or destination
     * @param   array   $attribute    <form> attribute
     * @param   string  $method       form method DEFAULT as 'POST'
     * 
     * @return  string                <form> tag with attribute, action and method
     * 
     */
    function form_open($action,$attribute = NULL,$method = 'POST')
    {
        $a = '';
        if($attribute !== NULL)
            $a .= set_attribute($attribute);
        return '<form method="'.$method.'"  action="'.$action.'.php" '. $a .'>';
    }
}

# --------------------------------------------------------------------


if(!function_exists('form_close'))
{
    /**
     * Form close function
     *
     *
     * echo '</form>';
     */
    function form_close()
    {
        return '</form>';
    }
}

# --------------------------------------------------------------------

if(!function_exists('btn_submit'))
{
    /**
     * 
     * Btn submit function
     * =====================
     * 
     * 
     * Create a <input:submit> tag.
     * 
     * All attribute come in a form of an array.
     * => a key as a attribute name ,
     * => a value as a attribute value  
     * 
     * @param   string    $value        Label name on button
     * @param   array     $attribute    <input> attribute
     * 
     * @return  string                  <input> with value and attribute
     */
    function btn_submit($value,$attribute = NULL)
    {
        $a = '';
        if($attribute !== NULL)
            $a .= set_attribute($attribute);
        return '<input type="submit" value="'.$value.'" '.$a.'>';
    }
}