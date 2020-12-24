<?php

$title = 'Outlet';
require'admin.php';

if(isset($_POST['btn-simpan'])){
  $nama   = stripslashes($_POST['nama_outlet']);
  $alamat = stripslashes($_POST['alamat_outlet']);
  $telp   = stripslashes($_POST['telp_outlet']);
  $query = "INSERT INTO outlet (nama_outlet, alamat_outlet, telp_outlet) values ('$nama', '$alamat', '$telp')";
  
  $execute = bisa($conn,$query);
  if($execute == 1){
    $success = 'true';
    $title = 'Berhasil';
    $message = 'Berhasil Simpan Data';
    $type = 'success';
    header('location: outlet.php?crud='.$success.'&msg='.$message.'&type='.$type.'&title='.$title);
  }else{
    echo "Gagal Tambah Data";
  }
}

require'header.php';

?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="index.php">
        <em class="fa fa-home"></em>
      </a></li>
      <li><a href="outlet.php"><?= $title; ?></a></li>
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
          <a href="outlet.php" class="btn btn-primary box-title"><i class="fa fa-arrow-left fa-fw"></i> Kembali</a>
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
              <label>Nama Outlet</label>
              <input type="text" name="nama_outlet" class="form-control">
            </div>
            <div class="form-group">
              <label>Alamat Outlet</label>
              <textarea name="alamat_outlet" class="form-control"></textarea>
            </div>
            <div class="form-group">
              <label>Nomor Telepon</label>
              <input type="text" name="telp_outlet" class="form-control">
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