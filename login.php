<?php
    require "backend/conn.php";
    if(isset($_SESSION['name'])){
        session_destroy();
        unset($_SESSION['name']);
    }
    session_start();
    if($_SERVER['REQUEST_METHOD']=="POST"){
       $fields = [
        'full_names' => trim($_POST['full_names']),
        'email' => trim($_POST['email']),
        'pwd' => $_POST['pwd']
    ];
    $full_names = trim($_POST['full_names']);
    $pwd = trim($_POST['pwd']);

    $empty_fields = [];
    foreach($fields as $field => $value){
        if(empty($value)){
            $empty_fields[] = $field;
        }
    }
    
        if(!empty($empty_fields)){
            $_SESSION['error'] = "fill in the missing fields: ".implode(', ', $empty_fields); 
        }else{
            $sql = "select * from voters where name='$full_names'";
            $result = $conn->query($sql);
            if($results = $result->num_rows > 0){
                $row = $result->fetch_assoc();
                // print_r($row);
                $hashedpwd = password_verify($_POST['pwd'], $row['password']);
                $_SESSION = [
                    'name' => $row['name'],
                    'success'  => "your Welcome",
                    'status' => $row['status'],
                    'vid' => $row['id'],
                ];
                echo "<script>alert('you are welcome {$_SESSION['status']}');</script>";
                // echo $_SESSION['vid'];
                header("location: dashboard.php");
                exit();
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="logins">
    
<form class="flex-container user_profile login" action="<?php $_SERVER['PHP_SELF'];?>" method="post">
    <div class="lables">VOTING SYSTEM LOGIN</div>
    <?php 
    if(isset($_SESSION['error'])){
        echo '<div class="alerts">'. $_SESSION['error']. '</div>';
        unset($_SESSION['error']);
    }elseif(isset($_SESSION['success'])){
        echo '<div class="alerts">'. $_SESSION['success']. '</div>';
        unset($_SESSION['success']);
    }?>
    <input class="flex" type="text" name="full_names" placeholder="full names">
    <input class="flex" type="email" name="email" placeholder="email">
    <input class="flex" type="password" name="pwd" placeholder="password">
    <button class="flex" type="submit">SUBMIT</button>
    <div class="flex">New voter should <a href="./add_voter.php">Register</a></div>
</form>

</body>
</html>