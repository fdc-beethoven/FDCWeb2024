<?php

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'pm') {
        include_once ('./view_partials/dashboard/pm.php');
    } else if ($_SESSION['role'] == 'member') {
        include_once ('./view_partials/dashboard/member.php');
    } else {
        echo '<h1>No such role</h1>';
    }
} else {
    echo '<h1>Access Denied</h1>';
}