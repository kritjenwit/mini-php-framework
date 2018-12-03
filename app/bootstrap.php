<?php

/**
 *  Load Core Library
 *
 *
 */

foreach(glob('../app/core/helpers/*_helper.php') as $helper)
{
//    echo 'Core helper => '. $helper;
    require_once $helper;
}

foreach(glob('../app/core/databases/*.php') as $db)
{
//    echo 'Core Database => ' . $db;
    require_once $db;
}


foreach(glob('../app/core/libraries/*.php') as $lib)
{
//    echo 'Core library => '. $lib;
    require_once $lib;
}


/**
 *  Load User Library
 *
 *
 */

foreach(glob('../app/helpers/*_helper.php') as $helper)
{
//    echo 'helper => '. $helper;
    require_once $helper;
}

foreach(glob('../app/libraries/*.php') as $class)
{
//    echo 'libraries => ' . $class;
    require_once $class;
}

// spl_autoload_register(function($className){
//   // require_once 'libraries/' . $className . '.php';
//   $core_dir = ['app/core/databases','app/core/helpers','app/core/libraries'];
//   $user_dir = ['app/databases','app/helpers','app/libraries'];

//   foreach($core_dir as $core)
//   {
//     require_once $core.'/'.$classname.'.php';
//   }  
//   foreach($user_dir as $user)
//   {
//     require_once $user.'/'.$classname.'.php';
//   } 
// });