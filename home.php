<style>
    .main{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: start;
    }
     .views{
        margin: 1rem -1.5rem 2rem 0;
    }
</style>
<div class="flex-container flex">
    <div class="flex-container box">
        <h2>Parties</h2>
        <div>3</div>
    </div>
    <div class="flex-container box">
        <h2>Voting Posts</h2>
        <div>4</div>
    </div>
    <div class="flex-container box">
        <h2>Voters</h2>
        <div>3</div>
    </div>
    <div class="flex-container box">
        <h2>Alerts</h2>
        <div>3</div>
    </div>
</div>
<div class="titles views">View all voter profiles</div>
<table class="tables">
    <thead>
        <tr>
            <th>EMAIL</th>
            <th>PASSWORD</th>
            <th>CONFIRM PASSWORD</th>
            <th>TEL</th>
            <?php if(isset($_SESSION['name']) && $_SESSION['name'] == 'admin'){ ?>
            <th>DELETE</th>
            <?php }?>
        </tr>
    </thead>
    <?php
        require "backend/conn.php";
        if(isset($_GET['p']) && isset($_SESSION['name']) && $_SESSION['name']=="admin"){
            $current_url = urlencode($_GET['p']);
        }
        // echo $current_url;
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
                        <?php 
                        if(isset($_SESSION['name']) && $_SESSION['name'] == 'admin'){
                            echo '<td><a href="backend/delete.php?u=' . urlencode($rows['id']) . '&table=user_profiles&redirect=' . $current_url . '">Delete</a></td>';
                        }?>
                    </tr>
                </tbody>
                <?php
            }
        }

    ?>
</table>