<?php
require __DIR__ . '/../bootstrap.php';

if(isset($_POST['login']))
{
    $status='1';
    $email=$_POST['username'];
    $password=md5($_POST['password']);
    $sql ="SELECT email,password FROM users WHERE email=:email and password=:password and status=(:status)";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> bindParam(':status', $status, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
        $_SESSION['alogin']=$_POST['username'];
        echo "<script type='text/javascript'> document.location = 'profile.php'; </script>";
    } else{

        echo "<script>alert('Invalid Details Or Account Not Confirmed');</script>";

    }

}
