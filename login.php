 <?php 
 session_start();
if (isset($_POST['login'])){
$username = $_POST['username'];
 $password = $_POST['password'];
 
 
 $mysqli = new mysqli("localhost","root","1","dmc");
 if ($mysqli->connect_error){
  die ("HINDI KONEKTADO BOBO: ".$mysqli->connect_error);
 }else{
  $stmt = $mysqli->prepare("SELECT * FROM accountsv2 WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
  $stmt_result = $stmt->get_result();
  if ($stmt_result->num_rows > 0){
   $data = $stmt_result->fetch_assoc();
   $_SESSION['username'] = $username;
   if ($data['password'] === $password){
    header("location:dashboard.php");
   }else{
   $baka = array();
   $baka['baka'] = "<h5>Mali ata ang User or Pass mo Pre</h5>";
}
  }else{
$baka = array();
   $baka['baka'] = "<h5>DMC|ilogin mo ung ginawa mong account pre </h5>";
}

 }
 
 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <link href="css/style.css" rel="stylesheet">
 <link href="css/banner.css" rel="stylesheet">
  <title>DMC|Login</title>
</head>
<body class="body">
 <center>
      <div class="topBanner">
       <div class="nameBanner">
 <img src="img/bannerName.png">
</div></div>
</center>
<br><br><br><br><br>
  <center>
     <!--error messagees-->
          <div class="errorPos"><h6><?php if(isset($baka['baka'])) echo $baka['baka']; ?></h6></div><br>
  <div><h1>DMC|Login</h1></div>
 
  <div class="form_background">
    <form method="post">
      <label for="username">Username</label><br>
      <input class="box_size" type="txt" name="username" value="<?= htmlspecialchars($_POST["username"] ?? "") ?>">
 <br><br>
      <label for="password">Password</label><br>
      <input class="box_size" type="password" name="password">
  <br><br><br>
<button class="logIn" type="submit" name="login">Login</button>
      <br> <br>

    </form>
    <br>
        <form action="index.php">
     <button class="mainPage">Main Page</button>
    </form>
  </div>
  </center>
  
</body>
</html>