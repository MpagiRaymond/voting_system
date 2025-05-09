<?php
require "conn.php";
session_start(); // make sure sessions are enabled

if (isset($_GET['u'])) {
    $candidate_id = $_GET['u'];
    $tablename = $_GET['table'];
    $pagename = $_GET['redirect'];

    // Security: validate table
    $allowed = ['positions', 'candidate', 'party','user_profiles'];
    if (!in_array($tablename, $allowed)) {
        die("Invalid table name.");
    }

    $sql = "DELETE FROM $tablename WHERE id='$candidate_id'";
    $conn->query($sql);

    // Set success alert in session
    $_SESSION['alert'] = "Record deleted successfully.";

    header("Location: http://localhost/user/dashboard.php?p={$pagename}");
    exit();
}
?>
