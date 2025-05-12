<?php
require "backend/conn.php";
    if($_SERVER['REQUEST_METHOD']=="POST"){
            $name = $_POST['party'];
            $slogan = $_POST['slogan'];

        if(empty($name) || empty($slogan)){
            $_SESSION['error'] = "fill in the missing fields";
        }else{
            
            $sql = "insert into party(name,slogan) values('$name','$slogan')";
            if($conn->query($sql)){
                $_SESSION['success'] = "Your data updated";
            }
        }
    }
?>
<div class="titles">Add party</div>
    <?php 
    if(isset($_SESSION['error'])){
        echo '<div class="alerts">'. $_SESSION['error']. '</div>';
        unset($_SESSION['error']);
    }elseif(isset($_SESSION['success'])){
        echo '<div class="alerts">'. $_SESSION['success']. '</div>';
        unset($_SESSION['success']);
    }?>
<form class="flex add_c" action="<?php echo $_SERVER['PHP_SELF'] ?>?p=add_party" method="post">
   <input class="flex" type="text" name="party" placeholder="party name">
   <input class="flex" type="text" name="slogan" placeholder="party slogan">
   <!-- <input class="flex" type="number" name="id" placeholder="Id"> -->
   <button class="flex" type="submit">SUBMIT</button>
</form>
<div class="titles views">View all parties</div>
<table class="tables">
    <thead>
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>SLOGAN</th>
            <th>DELETE</th>
        </tr>
    </thead>
    <?php
        require "backend/conn.php";
        $current_url = urlencode($_GET['p']);
        // echo $current_url;
        $sql = "SELECT * FROM party";
        $results = $conn->query($sql);
        
        if($result = $results->num_rows >0){
            while($rows = $results->fetch_assoc()){
                // print_r($rows);
                ?>
                <tbody>
                    <tr>
                        <td><?php echo $rows['id']; ?></td>
                        <td><?php echo $rows['name']; ?></td>
                        <td><?php echo $rows['slogan']; ?></td>
                        <?php 
                        echo '<td><a href="backend/delete.php?u=' . urlencode($rows['id']) . '&table=party&redirect=' . $current_url . '">Delete</a></td>';
                        // echo '<td><a href="backend/delete.php?u=' . urlencode($rows['id']) . '">Delete</a></td>';
                        ?>
                    </tr>
                </tbody>
                <?php
            }
        }

    ?>
</table>