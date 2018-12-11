<?php

/**
 * Database Config section
 *
 */
$config['DB_HOST'] = 'localhost';
$config['DB_USER'] = 'root';
$config['DB_PASS'] = '';

/**
 * Application Config section
 *
 */
$config['BASE_URL'] = 'http://localhost/krit/public/';
$config['URL_ROOT'] = 'http://localhost/krit/';
$config['ASSET_PATH'] = $config['URL_ROOT'].'assets/';
$config['APP_ROOT'] = dirname(dirname(__FILE__));


foreach ($config as $k => $v)
{
    define($k,$v,true);
}
