<div class="flex-container flex">
    <div class="flex-container box">
        <h2>Products</h2>
        <div>3</div>
    </div>
    <div class="flex-container box">
        <h2>cart</h2>
        <div>4</div>
    </div>
    <div class="flex-container box">
        <h2>Alerts</h2>
        <div>3</div>
    </div>
    <div class="flex-container box">
        <h2>Details</h2>
        <div>3</div>
    </div>
</div>
<table class="tables">
    <thead>
        <tr>
            <th>email</th>
            <th>password</th>
            <th>confirm password</th>
            <th>tel</th>
            <th>vote</th>
        </tr>
    </thead>
    <?php
        require "backend/conn.php";

        $sql = "select * from user_profiles";
        $results = $conn->query($sql);
        
        if($result = $results->num_rows >0){
            while($rows = $results->fetch_assoc()){
                // print_r($rows);
                ?>
                <tbody>
                    <tr>
                        <td><?php echo $rows['email']; ?></td>
                        <td><?php echo $rows['pwd']; ?></td>
                        <td><?php echo $rows['confirm_pwd']; ?></td>
                        <td><?php echo $rows['tel']; ?></td>
                        <!-- <?php 
                        // echo '<td><a href="backend/delete.php/?u={<?php echo $rows['id']; ?>}">Delete</a></td>';
                        ?> -->
                    </tr>
                </tbody>
                <?php
            }
        }

    ?>
</table>