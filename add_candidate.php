<?php
require "backend/conn.php";
    if($_SERVER['REQUEST_METHOD']=="POST"){
            $name = $_POST['candidate'];
            $slogan = $_POST['slogan'];
            $id = $_POST['id'];

        if(empty($name) || empty($slogan)){
            $_SESSION['error'] = "fill in the missing fields";
        }else{
            
            $sql = "insert into voters(name,slogan,party_id) values('$name','$slogn','$id')";
            if($conn->query($sql)){
                $_SESSION['success'] = "Your data updated";
            }
        }
    }
?>
<div class="titles">Add partyless candidate</div>
    <?php 
    if(isset($_SESSION['error'])){
        echo '<div class="alerts">'. $_SESSION['error']. '</div>';
        unset($_SESSION['error']);
    }elseif(isset($_SESSION['success'])){
        echo '<div class="alerts">'. $_SESSION['success']. '</div>';
        unset($_SESSION['success']);
    }?>
<form class="flex add_c" action="<?php echo $_SERVER['PHP_SELF'] ?>?p=add_candidate" method="post">
   <input class="flex" type="text" name="candidate" placeholder="name">
   <input class="flex" type="text" name="slogan" placeholder="slogan">
   <input class="flex" type="number" name="id" placeholder="Id">
   <button class="flex" type="submit">SUBMIT</button>
</form>
<div class="titles views">View all candidate</div>
<table class="tables">
    <thead>
        <tr>
            <th>NAME</th>
            <th>SLOGAN</th>
            <th>PARTY_ID</th>
            <th>party</th>
            <th>DELETE</th>
        </tr>
    </thead>
    <?php
        require "backend/conn.php";

        // $sql = "select c.party_id, c.name, p.id,c.slogan from candidate c join party p on p.id=c.party_id";
        $sql = "SELECT c.party_id, c.name AS candidate_name, p.id AS party_id, p.name AS party_name, c.slogan,c.id FROM candidate c JOIN party p ON p.id = c.party_id";
        $results = $conn->query($sql);
        
        if($result = $results->num_rows >0){
            while($rows = $results->fetch_assoc()){
                // print_r($rows);
                ?>
                <tbody>
                    <tr>
                        <td><?php echo $rows['candidate_name']; ?></td>
                        <td><?php echo $rows['slogan']; ?></td>
                        <td><?php echo $rows['party_id']; ?></td>
                        <td><?php echo $rows['party_name']; ?></td>
                        <?php 
                        echo '<td><a href="backend/delete.php?u=' . urlencode($rows['id']) . '">Delete</a></td>';
                        ?>
                    </tr>
                </tbody>
                <?php
            }
        }

    ?>
</table>