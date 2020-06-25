<?php
include 'libs/functions.php'; // Check Login
include 'core/users-core.php'; // Load data
if (!islogin()) {
    header('location: login.php');
}
function getRole()
{
    $ar_acc = loaddata('data/account.txt');
    foreach ($ar_acc as $member) {
        if ($member['username'] == $_SESSION['user']) {
            return trim($member['role']);
        }
    }
}
