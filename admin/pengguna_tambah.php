<?php

$title = 'Pengguna';
require 'admin.php';
$outlet = ambildata($conn,'SELECT * FROM outlet');
if(isset($_POST['btn-simpan'])){
  $nama     = $_POST['nama_user'];
  $username = $_POST['username'];
  $pass     = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $role     = $_POST['role'];
  if($role == 'Kasir' || $role == 'Owner') {
    $outlet_id = $_POST['outlet_id'];
    $query = "INSERT INTO user (nama_user,username,password,role,outlet_id) values ('$nama','$username','$pass','$role','$outlet_id')";
  }else{
    $query = "INSERT INTO user (nama_user,username,password,role) values ('$nama','$username','$pass','$role')";
  }
  $execute = bisa($conn,$query);
  if($execute == 1){
    $success = 'true';
    $title = 'Berhasil';
    $message = 'Berhasil menambahkan ' .$role. ' baru';
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
      <li class="active">Tambah <?= $title; ?></li>
    </ol>
  </div><!--/.row-->
  
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Tambah <?= $title; ?></h1>
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
              <input type="text" name="nama_user" class="form-control">
            </div>
            <div class="form-group">
              <label>Username</label>
              <input type="text" name="username" class="form-control">
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="text" name="password" class="form-control">
            </div>
            <div class="form-group">
              <label>Role</label>
              <select name="role" class="form-control">
                <option value="Admin">Admin</option>
                <option value="Owner">Owner</option>
                <option value="Kasir">Kasir</option>
              </select>
            </div>
            <div class="form-group">
              <label>Jika Role Nya Kasir Maka Pilih Outlet Dimana Dia Akan Ditempatkan</label>
              <select name="outlet_id" class="form-control">
              <?php foreach ($outlet as $key): ?>
                <option value="<?= $key['id_outlet'] ?>"><?= $key['nama_outlet'] ?></option>
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