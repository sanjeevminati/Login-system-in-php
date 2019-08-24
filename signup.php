<?php
if(isset($_POST['submit'])) {
    include_once 'dbh.inc.php';
  
    $email =      mysqli_real_escape_string($conn, $_POST['email']);  
    $pass1 =      mysqli_real_escape_string($conn, $_POST['password1']);  
    $pass2 =      mysqli_real_escape_string($conn, $_POST['password2']);
    
    //Error handlers
    //check confirm pass match or not
    if($pass1!=$pass2){
         header("Location:../index.php?signup=matches abort "); 
    exit();
        
    } else{
        

    //check for empty fields
    if ( empty($email)|| empty($pass1)|| empty($pass2)) {
        
     header("Location:../index.php?signup=empty ");
    exit();
        
    } 
 else {
    //check email valid
     if (!filter_var($email,FILTER_VALIDATE_EMAIL))  {
         header("Location:../index.php?signup=emailvalid ");
    exit();
         
     }
 else { 			//sql query
        $sql="SELECT * FROM user Where email='$email' ";
        $result= mysqli_query($conn,$sql);
        $resultCheck= mysqli_num_rows($result);
        if ($resultCheck >0) {
      header("Location:../index.php?signup=already exist ");
      exit();
            
        } 
        else {
            //Hashing the password
            
            $hashPwd= password_hash($pass1, PASSWORD_DEFAULT) ;
             $hashPwd2= password_hash($pass2, PASSWORD_DEFAULT) ;
            //iNSERT THE USER INTO THE DATABASE
            $sql="INSERT INTO user(email,password1,password2) VALUES ('$email','$hashPwd','$hashPwd2');";
            $result = mysqli_query($conn, $sql);
            header("Location:../index.php?signup=success ");
      exit();
            
         }
         }
         } 
         } 
         }
    
    
    
    

else {
    header("Location:../index.php ");
    exit();
}
















?>