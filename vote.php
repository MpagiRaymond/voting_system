<div class="lables">Vote your candidate here</div>


<?php
require "backend/conn.php";

// Step 1: Get all unique positions
$sql_positions = "SELECT DISTINCT position FROM candidate ORDER BY position";
$positions_result = $conn->query($sql_positions);

if ($positions_result && $positions_result->num_rows > 0) {
    // Step 2: Loop through each unique position
    while ($position_row = $positions_result->fetch_assoc()) {
        $position = $position_row['position'];
        echo "<h2>Position: $position</h2>"; 
        echo '<div class="wrapping">';
        
        // Step 3: Get candidates for this position
        $sql_candidates = "SELECT candidate.name AS candidatename, 
                                  candidate.position AS position, 
                                  candidate.slogan AS candidateslogan, 
                                  party.name AS partyname 
                           FROM candidate 
                           LEFT JOIN party ON candidate.party_id = party.id
                           WHERE candidate.position = '$position'";

        $candidates_result = $conn->query($sql_candidates);

        if ($candidates_result && $candidates_result->num_rows > 0) {
            // Step 4: Display the candidates for this position
            while ($row = $candidates_result->fetch_assoc()) {
                ?>
                <div class="flex-container card">
                    <h1><?php echo $row['candidatename']; ?></h1>
                    <p><?php echo $row['position']; ?></p>
                    <p><?php echo $row['partyname']; ?></p>
                    <a href="">Click to vote</a>
                </div>
                <?php
            }
        } else {
            echo "<p>No candidates for this position.</p>";
        }
        
        echo '</div>';  // Close the wrapping div for the position
    }
}
?>
