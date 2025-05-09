<div class="lables">Vote your candidate here</div>
<div class="titles">Guild President</div>
<div class="wrapping">
    <?php
    require "backend/conn.php";
    
    $sql = "select candidate.name,candidate.slogan,party.name from candidate join party on candidate.party_id=party.id";
    $results = $conn->query($sql);
    
    if($result = $results->num_rows >0){
        while($rows = $results->fetch_assoc()){
            // print_r($rows);
            ?>
            <div class="flex-container card">
                <h1><?php echo$rows['name']; ?></h1>
                <p><?php echo$rows['slogan']; ?></p>
                <a href="">Click to vote</a>
            </div>
            <?php
        }
    }
?>
</div>
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