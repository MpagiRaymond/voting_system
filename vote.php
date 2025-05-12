<div class="lables">Vote your candidate here</div>


<?php
require "backend/conn.php";

$voter_name = $_SESSION['name'];
$vid = $_SESSION['vid'];
// echo $vid;
$sql_positions = "SELECT DISTINCT position FROM candidate ORDER BY position";
$positions_result = $conn->query($sql_positions);

$votes = "select distinct position from done_voting where voter_name ='$voter_name'"; 
$voter = $conn->query($votes);
// print_r($voter);
if ($positions_result && $positions_result->num_rows > 0) {
    while ($position_row = $positions_result->fetch_assoc()) {
        // print_r($position_row);
        if($voter->num_rows > 0){
            if($erase_position = $voter->fetch_assoc()){
            print_r($erase_position);
            echo '<div class="alerts">You have already voted</div>';
            continue;
            }
        }
        $position = $position_row['position'];
        echo "<h2>Position: $position</h2>"; 
        echo '<div class="wrapping">';
        
        $sql_candidates = "SELECT candidate.id as cid,
                                    candidate.name AS candidatename, 
                                  candidate.position AS position, 
                                  candidate.slogan AS candidateslogan, 
                                  party.name AS partyname 
                           FROM candidate 
                           LEFT JOIN party ON candidate.party_id = party.id
                           WHERE candidate.position = '$position'";

        $candidates_result = $conn->query($sql_candidates);

        if ($candidates_result && $candidates_result->num_rows > 0) {
            while ($row = $candidates_result->fetch_assoc()) {
                // print_r($row);
                ?>
                <div class="flex-container card">
                    <h1><?php echo $row['candidatename']; ?></h1>
                    <p><?php echo $row['position']; ?></p>
                    <p><?php echo $row['partyname']; ?></p>
                    <?php 
                    // echo '<a href="./backend/votes.php/?v=' . $row['cid'] . '&voter='. $_SESSION['vid'] .'">Click to vote</a>'
                    echo '<a href="./backend/votes.php/?v=' . $row['cid'] . '&voter='.$vid.'">Click to vote</a>'
                     ?>
                </div>
                <?php
            }
        } else {
            echo "<p>No candidates for this position.</p>";
        }
        
        echo '</div>';  
    }
}
?>
