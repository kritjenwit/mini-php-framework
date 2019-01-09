<?php require_once '../app/bootstrap.php'; 

$idx = '123';

if((is_string($idx) && str_validate($idx)) || is_numeric($idx))
{
   $idx = is_numeric($idx) ? strval($idx) : $idx;
   echo $idx .' is String ';
   
}
else
{
   echo 'NOT String or Numeric';
}