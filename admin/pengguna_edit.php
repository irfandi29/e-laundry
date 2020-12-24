<?php

$title = 'Pengguna';
require 'admin.php';
$role = ['Admin','Owner','Kasir'];

$id_user = $_GET['id'];
$queryedit = "SELECT * FROM user WHERE id_user = '$id_user'";
$edit = ambilsatubaris($conn,$queryedit);

if(isset($_POST['btn-simpan'])){
  $nama     = $_POST['nama_user'];
  $username = $_POST['username'];
  $role     = $_POST['role'];
  if($_POST['password'] != null || $_POST['password'] == ''){
    $pass     = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $query = "UPDATE user SET nama_user = '$nama' , username = '$username' , role = '$role' , password ='$pass' WHERE id_user = '$id_user'";    
  }else{
    $query = "UPDATE user SET nama_user = '$nama' , username = '$username' , role = '$role' WHERE id_user = '$id_user'";
  }
  
  $execute = bisa($conn,$query);
  if($execute == 1){
    $success = 'true';
    $title = 'Berhasil';
    $message = 'Berhasil mengubah ' .$role;
    $type = 'success';
    header('location: pengguna.php?crud='.$success.'&msg='.$message.'&type='.$type.'&title='.$title);
  }else{
    echo "Gagal Tambah Data";
  }
}

require 'header.php';

?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="index.php">
        <em class="fa fa-home"></em>
      </a></li>
      <li><a href="pengguna.php"><?= $title; ?></a></li>
      <li class="active">Edit <?= $title; ?></li>
    </ol>
  </div><!--/.row-->
  
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Edit <?= $title; ?></h1>
    </div>
  </div><!--/.row-->

  <div class="panel panel-container">
    <div class="row" style="padding: 0 15px 20px 15px;">
      <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        <div class="col-md-6">
          <a href="pengguna.php" class="btn btn-primary box-title"><i class="fa fa-arrow-left fa-fw"></i> Kembali</a>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
      <div class="panel panel-container">
        <div style="padding: 0 30px 30px 30px;">
          <form method="post" action="">
            <div class="form-group">
              <label>Nama Pengguna</label>
              <input type="text" name="nama_user" class="form-control" value="<?= $edit['nama_user'] ?>">
            </div>
            <div class="form-group">
              <label>Username</label>
              <input type="text" name="username" class="form-control" value="<?= $edit['username'] ?>">
            <div class="form-group">
              <label>Password</label>
              <input type="text" name="password" class="form-control">
              <small class="text-danger">Kosongkan saja jika tidak akan mengubah password</small>
            </div>
            <div class="form-group">
              <label>Role</label>
              <select name="role" class="form-control">
              <?php foreach ($role as $key): ?>
              <?php if ($key == $edit['role']): ?>
                <option value="<?= $key ?>" selected><?= $key ?></option>    
              <?php endif ?>
                <option value="<?= $key ?>"><?= ucfirst($key) ?></option>
              <?php endforeach ?>
              </select>
            </div>
            <div class="text-right">
              <button type="reset" class="btn btn-danger">Reset</button>
              <button type="submit" name="btn-simpan" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php require 'footer.php'; ?>