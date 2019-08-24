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
        
        <form action="includes/signup.php" method="post">
            <h1> Sign up</h1>
           
              <input type="text" name="email" placeholder="email">
                <input type="password" name="password1" placeholder="password">
                <input type="password" name="password2" placeholder="confirm password">
                <button type="submit" name="submit">submit</button>
                <a href="includes/login.php"> login</a>
                <?php 
              if(isset($_SESSION['email'])){
                  echo $_SESSION['email'];
              }
                ?>
            
        </form>
    </body>
</html>
