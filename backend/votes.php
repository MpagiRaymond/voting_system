<?php
    require "conn.php";
    $candidate_id =  $_GET['v'];
    $voter_id = $_GET['voter'];
    // echo $candidate_id;
    // echo $_GET['voter'];
$sql = "insert into done_voting(voter_name, candidate_party_name,candidate_name,position)
        SELECT v.name AS votername, p.name AS partyname, c.name AS candidatename, c.position AS position
        FROM candidate c
        JOIN party p ON c.party_id = p.id
        JOIN voters v ON v.id = $voter_id
        WHERE c.id = $candidate_id
        ";

        $results = $conn->query($sql);
        if($results){
            echo '<script>alert("candidate voted successfully")</script>';
            header("location: http://localhost/user/dashboard.php?p=vote");
            exit();
        }

    
?>