<?php 

class Session {

    public function __construct()
    {
        $_SESSION = NULL;
    }

    /**
     * _set function
     * 
     * 
     * This function is to set a session
     * 
     * @param mixed     $session        Data for storing into $_SESSION
     * @param string    $session_name   Normally, $_SESSION is stored in data
     *                                  If $session_name is mentioned, data will store in given name.
     * 
     */
    public function _set($session,$session_name = NULL)
    {
        if($session_name !== NULL)
            $_SESSION[$session_name] = $session;
        elseif(is_array($session))
            $_SESSION['data'] = $session;
        else
            $_SESSION['data'] = $session;
         
    }

    /**
     * _get function
     * 
     * 
     * This function is get a or all sessions in a program
     * 
     * @param   string      $session    Session name => $_SESSION[name]
     * @return  array       $_SESSION   With or without parameter 
     * 
     */
    public function _get($session = NULL)
    {
        if($session === NULL)
            return isset($_SESSION) ? $_SESSION : NULL ;
        else
            return $_SESSION[$session];
    }  
    
    /**
     * Destroy function 
     * 
     * 
     * This function will remove all sessions exist in a program
     * 
     */
    public function destroy()
    {
        unset($_SESSION);
    }

    /**
     * Session_unset 
     * 
     * 
     * This function will remove a particular session metion in a parameter
     * 
     * @param string $session   Session name
     * 
     */
    public function session_unset($session)
    {
        unset($_SESSION[$session]);
    }
}

$session = new Session;