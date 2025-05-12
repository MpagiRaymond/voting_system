<style>
    <?php require "style.css"; ?>
</style>
<?php if(!isset($_SESSION['name'])){ ?>
    <style>
        body{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .user_profile{
            /* margin: 0 auto; */
            width: 30%;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .user_profile .lables{
            font-size: 2rem;
            text-align: center;
            margin-bottom: 20px;
        }
        .user_profile .flex{
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }
        .lables{
            color:black;
        }

    </style>
<?php } ?>


<?php
require "backend/conn.php";
    if($_SERVER['REQUEST_METHOD']=="POST"){
            $name = $_POST['name'];
            $regno = $_POST['regno'];
            $email = $_POST['email'];
            $password = $_POST['pwd'];
            $status = $_POST['status'];
            $phone_number = $_POST['tel'];

        if(empty($name) || empty($password) || empty($email) || empty($phone_number) || empty($status)|| empty($regno)){
            $_SESSION['error'] = "fill in the missing fields";
        }else{
            
            $sql = "insert into voters(name,Reg_number,email,password,status,phone_no) values('$name','$regno','$email','$password','$status','$phone_number')";
            if($conn->query($sql)){
                $_SESSION['success'] = "Your data updated";
            }
        }
    }
?>
<form class="flex-container user_profile" action="<?php echo $_SERVER['PHP_SELF']; ?>?p=add_voter" method="post">
<?php 
    if(isset($_SESSION['error'])){
        echo '<div class="alerts">'. $_SESSION['error']. '</div>';
        unset($_SESSION['error']);
    }elseif(isset($_SESSION['success'])){
        echo '<div class="alerts">'. $_SESSION['success']. '</div>';
        unset($_SESSION['success']);
    }?>
    <div class="lables">Register Voter</div>
    <input class="flex" type="text" name="name" placeholder="name">
    <input class="flex" type="text" name="regno" placeholder="registration number">
    <input class="flex" type="number" name="tel" placeholder="phone number">
    <input class="flex" type="email" name="email" placeholder="email">
    <input class="flex" type="password" name="pwd" placeholder="password">
    <input class="flex" type="text" name="status" placeholder="status">
    <button class="flex" type="submit">SUBMIT</button>
    <?php if(!isset($_SESSION['name'])){ ?>
    <div class="flex">Already finished registering then<a href="./login.php"> login</a></div>
    <?php } ?>
</form>