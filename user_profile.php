<?php
require "backend/conn.php";
    if($_SERVER['REQUEST_METHOD']=="POST"){
            $email = $_POST['email'];
            $password = $_POST['pwd'];
            $confirm_password = $_POST['cpwd'];
            $phone_number = $_POST['tel'];
            $set_image = $_POST['image'];

        if(empty($email) || empty($password) || empty($confirm_password) || empty($phone_number) || empty($set_image)){
            $_SESSION['error'] = "fill in the missing fields";
        }else{
            
            $sql = "UPDATE user_profiles SET email='$email', pwd='$password', confirm_pwd='$confirm_password', tel='$phone_number', images='$set_image' where id = 1";
            if($conn->query($sql)){
                $_SESSION['success'] = "Your data updated";
                // $_SESSION['infor'] = "data not edited";
            }
        }
    }
?>
<form class="flex-container user_profile" action="<?php echo $_SERVER['PHP_SELF']; ?>?p=user_profile " method="post">
<?php 
    if(isset($_SESSION['error'])){
        echo '<div class="alerts">'. $_SESSION['error']. '</div>';
        unset($_SESSION['error']);
    }elseif(isset($_SESSION['success'])){
        echo '<div class="alerts">'. $_SESSION['success']. '</div>';
        unset($_SESSION['success']);
    }elseif(isset($_SESSION['infor'])){
        echo '<div class="alerts">'. $_SESSION['infor']. '</div>';
    }?>
    <div class="lables">User Profile</div>
    <input class="flex" type="email" name="email" placeholder="email">
    <input class="flex" type="password" name="pwd" placeholder="password">
    <input class="flex" type="password" name="cpwd" placeholder="confirm password">
    <input class="flex" type="number" name="tel" placeholder="phone number">
    <input class="flex" type="file" name="image">
    <button class="flex" type="submit">SUBMIT</button>
</form>
