<?php
const SITE_TIMEZONE 				= "Europe/Paris";
const SITE_DATE_FORMAT 				= "d/m/Y";
const SITE_DATETIME_FORMAT 			= "d/m/Y H:i:s";
// Set the default timezone
date_default_timezone_set(SITE_TIMEZONE);

//Function to validate the input data
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//Function db empty 2 null
function empty2null($data)
{
    if (empty($data)) {
        return null;
    } else {
        return trim($data);
    }
}
