<?php 
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login_Registration</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>


<?php 

$conn = mysqli_connect("localhost", "root", "", "mohima");
if(!$conn){
    echo 'Connection error: '. mysqli_connect_error();
}
?>


<?php

if(isset($_POST['submit'])){
    $emp_id = $_POST['emp_id'];
    $pwd = $_POST['pwd'];

    $emp_search = "SELECT * FROM employee WHERE emp_id='$emp_id'";
    $query = mysqli_query($conn, $emp_search);

    $emp_count = mysqli_num_rows($query);
    if($emp_count){
        $emp_pass = mysqli_fetch_assoc($query);
        $db_pass = $emp_pass['pwd'];
        //$pass_decode = password_verify($pwd, $db_pass);

        $_SESSION['en_name'] = $emp_pass['en_name'];

       /* if($db_pass){
            echo "Login Successful";
            header('location:nav.php');
        }
        else{
            echo "Password Incorrect";
        }*/

        if($emp_pass["usertype"]=="user"){
           // $_SESSION["username"]=$username;
            echo "Login Successful"; 
            header("location:home.php");
         }
     
         elseif($emp_pass["usertype"]=="admin"){
            // $_SESSION["username"]=$username; 
             echo "Admin Login Successful";
             header("location:nav.php");
         }
     
         else{
            echo "Password Incorrect";
         }


    }else{
        echo "Invalid Employee ID";
    }
}

?>
    
    <div class="container">
        <div class="card">
            <div class="inner-box" id="card">             
                <div class="card-front">
                    <h2>LOGIN</h2>
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
                        <input type="text" class="input-box" placeholder="Employee ID" name="emp_id" required>
                        <input type="password" class="input-box" placeholder="Password" name="pwd" required>
                        <button type="submit" class="submit-btn" name="submit">Submit</button>
                        <input type="checkbox"><span>Remember Me</span>
                    </form>           
                    <a href="">Forget Password</a>
                </div>
            </div>  
        </div> 
    </div>

</body>
</html>

