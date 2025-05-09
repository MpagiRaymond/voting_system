<?php
session_start();
if(!isset($_SESSION['name'])){
    header("location: login.php");
    exit();
}
$nav = isset($_GET['p']) ? $_GET['p'] . ".php" : "home.php";
$nav = basename($nav);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>voting system</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        <?php require "style.css"; ?>
    </style>
</head>
<body>
    <header>
        <div class="flex-container flex-column g-3">
            <div class="logo-circle">
                <img src="../images/images.png" alt="Website Logo">
            </div>
            <div class="logo">VOTING SYSTEM</div>
        </div>
        <ul class="lists">
            <li><a href="dashboard.php?p=home">Home</a></li>
            <li><a href="dashboard.php?p=Notifications">Notifications</a></li>
            <li><a href="dashboard.php?p=help"><?php echo $_SESSION['name']; ?><i class="fa fa-user"></i></a></li>
            <li><i class="fa fa-sign-out"></i><a href="./backend/logout.php">logout</a></li>
            <li><a href="#"></a></li>
            <button id="darkModeToggle" class="dark-mode-toggle">🌙 Dark Mode</button>
        </ul>
    </header>
    <section class="sidebar flex-container">
      <div class="flex-container">
        <?php 
        if(isset($_SESSION['status']) && $_SESSION['status']=="admin"){?>
            <div class="flex"><i class="fa fa-search"></i><a href="dashboard.php?p=add_party">Add parties</a></div>
            <div class="flex"><i class="fa fa-search"></i><a href="dashboard.php?p=add_voter">Add voters</a></div>
            <div class="flex"><i class="fa fa-search"></i><a href="dashboard.php?p=add_position">Add Position</a></div>
        <?php } ?>
        <div class="flex"><i class="fa fa-search"></i><a href="dashboard.php?p=home">Voting status</a></div>
        <div class="flex"><i class="fa fa-search"></i><a href="dashboard.php?p=vote">vote</a></div>
        <div class="dropdown">
            <button class="dropbtn"><i class="fa fa-search"></i>Candidate<i class="fa fa-caret-down"></i></button>
            <div class="dropdown-content flex-container">
                <a href="dashboard.php?p=add_candidate"><i class="fa fa-user"></i>view candidates</a>
                <a href="dashboard.php?p=candidate_profiles"><i class="fa fa-user"></i>Candidate profile</a>
                <a href="dashboard.php?p=vote"><i class="fa fa-user"></i>Results</a>
            </div>
        </div>
        <div class="flex"><i class="fa fa-home"></i><a href="dashboard.php?p=Notiications">Notifications</a></div>
        <div class="flex"><i class="fa fa-home"></i><a href="dashboard.php?p=user_profile">Update profile</a></div>
      </div>
      <div class="flex-container">
        <div class="flex"><i class="fa fa-sign-out"></i><a href="./backend/logout.php">logout.....................</a></div>
      </div>
    </section>
    <section class="main flex-container">
        <?php 
            if(file_exists($nav)){
                require $nav;
            }else{
                echo "<h1>Page not found</h1>";
            }
        ?>
    </section>
</body>
<script>
  const toggleBtn = document.getElementById('darkModeToggle');

  // Load preference
  if (localStorage.getItem('theme') === 'dark') {
    document.body.classList.add('dark-mode');
    toggleBtn.textContent = '☀️ Light Mode';
  }

  toggleBtn.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode');
    const isDark = document.body.classList.contains('dark-mode');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
    toggleBtn.textContent = isDark ? '☀️ Light Mode' : '🌙 Dark Mode';
  });
</script>

</html>
