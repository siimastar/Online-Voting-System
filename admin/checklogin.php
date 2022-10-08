<?php
session_start();
ob_start();
require('../connection.php');

?>

<!DOCTYPE html>
<html>
<body style="background-color:powderblue;">

<?php
if(isset($_POST['myusername'], $_POST['mypassword'])){
    $tbl_name="tbAdministrators"; // Table name


    $myusername=$_POST['myusername'];
    $mypassword=$_POST['mypassword'];
    $encrypted_mypassword=md5($mypassword); 

    $myusername = stripslashes($myusername);
    $mypassword = stripslashes($mypassword);
    $myusername = mysqli_real_escape_string($conn, $_POST['myusername']);
    $mypassword = mysqli_real_escape_string($conn, $_POST['mypassword']);

    $sql="SELECT * FROM $tbl_name WHERE email='$myusername' and password='$encrypted_mypassword'";
    $result= $conn->query($sql);
    if($result){
        if($result->num_rows>0){
            if(isset($_POST['remember'])){
                setcookie('$email',$_POST['myusername'], time()+30*24*60*60); // 30 days
                setcookie('$pass', $_POST['mypassword'],time()+30*24*60*60); // 30 days
                $_SESSION['curname']=$myusername;
                $_SESSION['curpass']=$mypassword;

                $user = $result->fetch_assoc();
                $_SESSION['admin_id'] = $user['admin_id'];
                header("Location:admin.php");
            }else{
                $log1=11;
                $_SESSION['log1'] = $log1;
                $_SESSION['curname']=$myusername;
                $_SESSION['curpass']=$mypassword;

                $user = $result->fetch_assoc();
                $_SESSION['admin_id'] = $user['admin_id'];
                
                header("Location:admin.php");
            }
        }else{
            echo "<br> <br> <br> ";
            echo "<center> <h3>Wrong Username or Password<br><br>Return to <a href=\"index.php\">login</a> </h3></center>";
        }
    }else{
        echo $conn->error;
    }
}else{

}
ob_end_flush();

?> 




</body>
</html>
