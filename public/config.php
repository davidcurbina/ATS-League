<?php

//Set Debug On
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Creating Conf Class to be used for database connection
class Conf
{
 const DEF_APP = 'Test Application';
 /* Testing
 const DB_HOST = 'localhost';
 const DB_NAME   = 'kiosk';
 const DB_USERNAME = 'davidcurbina';
 const DB_PASSWORD = 'Password';
 */
 $url=parse_url(getenv("CLEARDB_DATABASE_URL"));

  const DB_HOST = $url["host"];
  const DB_USERNAME = $url["user"];
  const DB_PASSWORD = $url["pass"];
  const DB_NAME = substr($url["path"],1);
}
?>