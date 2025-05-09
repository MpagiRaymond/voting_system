<?php
require "backend/conn.php";
    if($_SERVER['REQUEST_METHOD']=="POST"){
            $name = $_POST['pname'];
            $status = $_POST['status'];

        if(empty($name) || empty($status)){
            $_SESSION['error'] = "fill in the missing fields";
        }else{
            
            $sql = "insert into positions(name,status) values('$name','$status')";
            if($conn->query($sql)){
                $_SESSION['success'] = "Position added";
            }
        }
    }
        if (isset($_SESSION['alert'])) {
            echo "<script>alert('{$_SESSION['alert']}');</script>";
            unset($_SESSION['alert']);
        }

?>
<div class="titles">Add Position</div>
    <?php 
    if(isset($_SESSION['error'])){
        echo '<div class="alerts">'. $_SESSION['error']. '</div>';
        unset($_SESSION['error']);
    }elseif(isset($_SESSION['success'])){
        echo '<div class="alerts">'. $_SESSION['success']. '</div>';
        unset($_SESSION['success']);
    }?>
<form class="flex add_c" action="<?php echo $_SERVER['PHP_SELF'] ?>?p=add_position" method="post">
   <input class="flex" type="text" name="pname" placeholder="position name">
   <input class="flex" type="text" name="status" placeholder="position status">
   <button class="flex" type="submit">SUBMIT</button>
</form>

<?php 
    $numbers = "select count(*) as records from positions";
    $results_count = $conn->query($numbers);
    if($result_count = $results_count->num_rows >0){
        $data = $results_count->fetch_assoc();
        $counts = $data['records'];
    }
?>

<div class="titles views">View all positions<span>Total: <?php echo $counts ?></span></div>
<table class="tables">
    <thead>
        <tr>
            <th>ID</th>
            <th>POSITION NAME</th>
            <th>STATUS</th>
            <th>DELETE</th>
        </tr>
    </thead>
    <?php
        $current_url = urlencode($_GET['p']);
        // echo $current_url;
        require "backend/conn.php";

        $sql = "SELECT * FROM positions";
        $results = $conn->query($sql);
        
        if($result = $results->num_rows >0){
            while($rows = $results->fetch_assoc()){
                // print_r($rows);
                ?>
                <tbody>
                    <tr>
                        <td><?php echo $rows['id']; ?></td>
                        <td><?php echo $rows['name']; ?></td>
                        <td><?php echo $rows['status']; ?></td>
                        <?php 
                        echo '<td><a href="backend/delete.php?u=' . urlencode($rows['id']) . '&table=positions&redirect=' . $current_url . '">Delete</a></td>';
                        ?>
                    </tr>
                </tbody>
                <?php
            }
        }

    ?>
</table>