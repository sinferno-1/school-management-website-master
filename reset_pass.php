<?php
include("./config.php");

if($_GET['key'] && $_GET['reset'] && $_GET['category'])
{
  $email=$_GET['key'];
  $pass=$_GET['reset'];
 
  if ($category == "student") {
    $find_user = "SELECT * FROM students WHERE email = '$email' and active = '1'";  
} else if($category == "teacher"){
    $find_user = "SELECT * FROM teachers WHERE email = '$email' and active = '1'";
}else{
    $find_user = "SELECT * FROM miscellaneous WHERE email = '$email' and active = '1'";
}

$response = mysqli_query($conn, $find_user) or die(mysqli_error($conn));
if (mysqli_num_rows($response) == 1) {
    $user_details = mysqli_fetch_array($response, MYSQLI_ASSOC);
    if ($user_details["password"] == sha1($password)) {
        $_SESSION["user_email"] = $user_details["email"];
        $_SESSION["user_category"] = $category;
        if($_SESSION["user_category"] == "admin"){
            header('Location: ./admin/admin.php');
        }else{
            header('Location: ./index.php');
        }
    }
}

//   $select=mysql_query("select email,password from user where md5(email)='$email' and md5(password)='$pass'");
  if(mysql_num_rows($select)==1)
  {
    ?>
    <form method="post" action="submit_new.php">
    <input type="hidden" name="email" value="<?php echo $email;?>">
    <p>Enter New password</p>
    <input type="password" name='password'>
    <input type="submit" name="submit_password">
    </form>
    <?php
  }
}
?>