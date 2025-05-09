<?php
require "backend/conn.php";

// Step 1: Query distinct positions (you may want to order them as needed)
$positions_sql = "SELECT DISTINCT position FROM candidate ORDER BY position";
$positions_result = $conn->query($positions_sql);

if ($positions_result && $positions_result->num_rows > 0) {
    // Loop through each distinct position
    while ($pos_row = $positions_result->fetch_assoc()) {
        $position = $pos_row['position'];
        ?>
        <!-- Display the title for the position -->
        <div class="titles"><?php echo $position; ?></div>
        <div class="wrapping">
            <?php
            // Step 2: Now query candidates for this specific position
            $sql = "SELECT candidate.name AS candidatename, 
                           candidate.position AS position, 
                           candidate.slogan AS candidateslogan, 
                           party.name AS partyname 
                    FROM candidate 
                    LEFT JOIN party ON candidate.party_id = party.id 
                    WHERE candidate.position = '" . $conn->real_escape_string($position) . "'";
            $results = $conn->query($sql);

            if ($results && $results->num_rows > 0) {
                while ($row = $results->fetch_assoc()) {
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
                echo "<p>No candidates available for this position.</p>";
            }
            ?>
        </div>
        <?php
    }
}
?>





<div class="lables">Vote your candidate here</div>
<div class="titles">Guild President</div>

<?php
require "backend/conn.php";

// Step 1: Get all unique positions
$sql_positions = "SELECT DISTINCT position FROM candidate ORDER BY position";
$positions_result = $conn->query($sql_positions);

if ($positions_result && $positions_result->num_rows > 0) {
    // Step 2: Loop through each unique position
    while ($position_row = $positions_result->fetch_assoc()) {
        $position = $position_row['position'];
        
        echo '<div class="wrapping">';
        echo "<h2>Position: $position</h2>";  // Title for each position group
        
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




































































<?php
require "backend/conn.php";

$sql = "select distinct position from candidate order by position";
$results = $conn->query($sql);
if($results && $results->num_rows > 0){
    while($rows = $results->fetch_assoc()){
        print_r($rows);
        $position = $rows['position'];
    ?>
            <!-- <div class="titles">Guild President</div> -->
        <div class="titles"><?php echo $rows['position']; ?></div>
        <div class="wrapping">
            <?php
            require "backend/conn.php";
            // $sql = "SELECT c.party_id, c.name AS candidate_name, p.id AS party_id, p.name AS party_name, c.slogan,c.id FROM candidate c LEFT JOIN party p ON p.id = c.party_id";
            $sql = "select candidate.name as candidatename,candidate.position as position,candidate.slogan as candidateslogan,party.name as partyname from candidate left join party on candidate.party_id=party.id where candidate.position = '$position'";
            $results = $conn->query($sql);
            
            if($result = $results->num_rows >0){
                while($rows = $results->fetch_assoc()){
                    // print_r($rows);
                    ?>
                    <div class="flex-container card">
                        <h1><?php echo$rows['candidatename']; ?></h1>
                        <p><?php echo$rows['position']; ?></p>
                        <p><?php echo$rows['partyname']; ?></p>
                        <a href="">Click to vote</a>
                    </div>
                    <?php
                }
            }
        ?>
        </div>
<?php
    }
}

?>

<?php ?>
<!-- repeat the class of wrapping basing on the voting posts available -->
<div class="titles">Guild President</div>
<div class="wrapping">
<?php
    require "backend/conn.php";

    $sql = "select * from candidate";
    $results = $conn->query($sql);
    
    if($result = $results->num_rows >0){
        while($rows = $results->fetch_assoc()){
            // print_r($rows);
            ?>
            <div class="flex card"><?php echo$rows['name']; ?></div>
            <?php
        }
    }
?>
</div>


