<?php
// include 'libs/functions.php'; // Check Login
include './core/database.php'; // Load database: admin/core/database.php
include './core/class-user.php'; // Load truy vấn user: admin/core/class-user.php

if (!islogin()) {
    header('location: login.php');
}

function getRole()
{
    // global $result;
    // foreach ($result as $user) {
    //     if ($_SESSION['user'] == $user->username) {
    //         return trim($user->role);
    //     }
    // }
}
