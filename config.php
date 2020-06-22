<?php
    session_start();

    $errors = '';

    $dbhost = "localhost";
    $dbuser = "winjohan";
    $dbpass = "nahojs2630!";
    $dbname = "job_portal";

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if(!$conn)
    {
        die("Error connecting to database: " .mysqli_connect_error());
    }

    define('ROOT_PATH', realpath(dirname(__FILE__)));
    define('BASE_URL', 'http://localhost/phpsandbox/php-con-to-pro/jobs_portal/');
    