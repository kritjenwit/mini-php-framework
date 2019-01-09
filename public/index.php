<?php require_once '../app/bootstrap.php'; 

$idx = 2342342342;

if(is_string($idx) || is_numeric($idx))
{
   $idx = is_numeric($idx) ? strval($idx) : $idx;
   
}
else
{
   echo 'NOT String or Numeric';
}