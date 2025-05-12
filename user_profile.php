<?php
require "backend/conn.php";
$vid = $_SESSION['vid'];
// echo $_SESSION['vid'];
    if($_SERVER['REQUEST_METHOD']=="POST"){
            $names = $_POST['names'];
            $email = $_POST['email'];
            $password = $_POST['pwd'];
            $confirm_password = $_POST['cpwd'];
            
    
    
    // File upload handling
    if(isset($_FILES['image'])) {  // Note: It's $_FILES not $_file
        $fileName = $_FILES['image']['name'];
        $tmpName = $_FILES['image']['tmp_name'];
        $images = 'images/';
        
        // Create directory if it doesn't exist
        if(!is_dir($images)) {
            mkdir($images, 0755, true);  // Added permissions and recursive flag
        }
        
        $location = $images . $fileName;
        
        // Move the uploaded file
        if(move_uploaded_file($tmpName, $location)) {
            // File uploaded successfully
            $set_image = $fileName;
        } else {
            // Handle upload error
            $set_image = ''; // or some default image
        }
    } else {
        $set_image = ''; // No file uploaded
    }
    
   
}

        if(empty($email) || empty($password) || empty($confirm_password) || empty($name) || empty($location)){
            $_SESSION['error'] = "fill in the missing fields";
        }else{
            if(isset($_SESSION['name']) && $_SESSION['name']=="admin"){
                $sql = "UPDATE voters SET name=$names, email='$email', pwd='$password', confirm_pwd='$confirm_password', images='$location' where name = $name";
            }else{
                $sql = "UPDATE voters SET name=$names, email='$email', pwd='$password', confirm_pwd='$confirm_password', images='$location' where id = $vid";
            }
            if($conn->query($sql)){
                $_SESSION['success'] = "Your data updated";
            }
        }
?>
<form class="flex-container user_profile" action="<?php echo $_SERVER['PHP_SELF']; ?>?p=user_profile " method="post" enctype="multipart/form-data">
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
    <input class="flex" type="text" name="names" placeholder="name">
    <input class="flex" type="email" name="email" placeholder="email">
    <input class="flex" type="password" name="pwd" placeholder="password">
    <input class="flex" type="password" name="cpwd" placeholder="confirm password">
    <input class="flex" type="file" name="image">
    <button class="flex" type="submit">SUBMIT</button>
</form>
