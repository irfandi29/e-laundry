<?php
session_start();
$conn = mysqli_connect('localhost','root','','e_laundry');

$username = stripslashes($_POST['username']);
$query = "SELECT * FROM user where username='$username'";
$row = mysqli_query($conn,$query);
$data = $row->fetch_assoc();

if(password_verify($_POST['password'], $data['password'])){
    if($data['role'] == 'Admin'){
        $_SESSION['role'] = 'Admin';
        $_SESSION['username'] = $data['username'];
        $_SESSION['user_id'] = $data['id_user'];
        header('location:admin/index.php');
    }else if($data['role'] == 'Kasir'){
        $_SESSION['role'] = 'Kasir';
        $_SESSION['username'] = $data['username'];
        $_SESSION['user_id'] = $data['id_user'];
        $_SESSION['outlet_id'] = $data['outlet_id'];
        header('location:kasir/transaksi.php');
    }else if($data['role'] == 'Owner'){
        $_SESSION['role'] = 'Owner';
        $_SESSION['username'] = $data['username'];
        $_SESSION['user_id'] = $data['id_user'];
        $_SESSION['outlet_id'] = $data['outlet_id'];
        header('location:owner/index.php');
    }
}else{
    $msg = 'Username Atau Password Salah';
    header('location:index.php?msg='.$msg);
}
