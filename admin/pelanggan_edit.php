<?php

$title = 'Pelanggan';
require 'admin.php';

$id_member = $_GET['id'];
$queryedit = "SELECT * FROM member WHERE id_member = '$id_member'";
$edit = ambilsatubaris($conn,$queryedit);

if(isset($_POST['btn-simpan'])){
  $nama     = $_POST['nama_member'];
  $alamat_member = $_POST['alamat_member'];
  $no_ktp     = $_POST['no_ktp']; 
  $telp_member     = $_POST['telp_member']; 
  $jenis_kelamin     = $_POST['jenis_kelamin']; 
  $query = "UPDATE member SET nama_member = '$nama', alamat_member = '$alamat_member', no_ktp = '$no_ktp', telp_member = '$telp_member', jenis_kelamin = '$jenis_kelamin' WHERE id_member ='$id_member'";
  
  $execute = bisa($conn,$query);
  if($execute == 1){
    $success = 'true';
    $title = 'Berhasil';
    $message = 'Berhasil mengubah pelanggan';
    $type = 'success';
    header('location: pelanggan.php?crud='.$success.'&msg='.$message.'&type='.$type.'&title='.$title);
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
      <li><a href="pelanggan.php"><?= $title; ?></a></li>
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
          <a href="pelanggan.php" class="btn btn-primary box-title"><i class="fa fa-arrow-left fa-fw"></i> Kembali</a>
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
              <label>No KTP Member</label>
              <input type="text" name="no_ktp" class="form-control" value="<?= $edit['no_ktp'] ?>">
            </div>
            <div class="form-group">
              <label>Nama Member</label>
              <input type="text" name="nama_member" class="form-control" value="<?= $edit['nama_member'] ?>">
            </div>
            <div class="form-group">
              <label>Alamat Member</label>
              <input type="text" name="alamat_member" class="form-control" value="<?= $edit['alamat_member'] ?>">
            </div>
            <div class="form-group">
              <label>No Telepon</label>
              <input type="text" name="telp_member" class="form-control" value="<?= $edit['telp_member'] ?>">
            </div>
            <div class="form-group">
              <label>Jenis Kelamin</label>
              <select name="jenis_kelamin" class="form-control">
                <option value="L" <?php if($edit['jenis_kelamin']  == 'L'){echo "selected";} ?>>Laki-laki</option>
                <option value="P" <?php if($edit['jenis_kelamin']  == 'P'){echo "selected";} ?>>Perempuan</option>
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