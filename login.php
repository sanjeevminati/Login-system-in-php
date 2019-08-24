<?php
session_start();

?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
       
       
      
            <form action="login.php" method="post">
            <h1> Login </h1>
           
              <input type="text" name="email" placeholder="email">
                <input type="password" name="password1" placeholder="password">
          
                <button type="submit" name="submit">submit</button>
                <form action="logout.php" method="post">
                    <button type="submit" name="submit">logout</button>
                </form>
        </form>
        
     
        
    </body>
</html>
<?php
if(isset($_POST['submit'])) {
 include_once 'dbh.inc.php';
  $email =      mysqli_real_escape_string($conn, $_POST['email']);  
  $pass1 =      mysqli_real_escape_string($conn, $_POST['password1']);  
// Error handlers
  // check empty inputs 
  if (empty($email)  || empty($pass1) ) {
       header("Location:../index.php?login=empty ");
      exit();
  }
  else {
      $sql="SELECT * FROM user Where email='$email'";
        $result= mysqli_query($conn,$sql);
        $resultCheck= mysqli_num_rows($result);
        if ($resultCheck < 1) {
      header("Location:../index.php?login=error ");
      exit();
            
        }
        else {
            if($row= mysqli_fetch_assoc($result)) {
                //De hasihng pwd
                
                $hashPwdCheck = password_verify($pass1,$row['password1']);
                if($hashPwdCheck==FALSE)  {
                     header("Location:../index.php?login=False ");
      exit();
                    
                } elseif ($hashPwdCheck== TRUE) {  
                    //log in the user here
                    $_SESSION['id']= $row['id'];
                    $_SESSION['email']= $row['email'];
                        header("Location:../index.php?login=success");
                        exit();
            }
              
                    
                }
 }
}
}
?>
