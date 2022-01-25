<?php
/**
 * Check if user is logged in 
 * 
 * @return true if session is active and valid, then will return true. 
 */
function isloggedIn()
{
    return isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'];
}
