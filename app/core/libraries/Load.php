<?php 

class Load {

    public function view($view)
    {
        try
        {
            include_once '../app/views/'.$view.'.php';
        }
        catch(Exception $e)
        {
            
        }
    }

    

}

$load = new Load;