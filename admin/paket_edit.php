<?php

$title = 'Paket';
require 'admin.php';
$jenis = ['Kiloan','Selimut','Bedcover','Kaos','Lainnya'];

$id_paket = stripslashes($_GET['id']);
$queryedit = "SELECT * FROM paket WHERE id_paket = '$id_paket'";
$edit = ambilsatubaris($conn,$queryedit);
$query = 'SELECT * FROM outlet';
$data = ambildata($conn,$query);

if(isset($_POST['btn-simpan'])){
  $nama   = stripslashes($_POST['nama_paket']);
  $jenis_paket = stripslashes($_POST['jenis_paket']);
  $harga   = stripslashes($_POST['harga']);
  $outlet_id   = stripslashes($_POST['outlet_id']);

  $query = "UPDATE paket SET nama_paket='$nama',jenis_paket='$jenis_paket',harga='$harga',outlet_id='$outlet_id' WHERE id_paket = '$id_paket'";
  
  $execute = bisa($conn,$query);
  if($execute == 1){
    $success = 'true';
    $title = 'Berhasil';
    $message = 'Berhasil Ubah Data';
    $type = 'success';
    header('location: paket.php?crud='.$success.'&msg='.$message.'&type='.$type.'&title='.$title);
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
      <li><a href="paket.php"><?= $title; ?></a></li>
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
          <a href="paket.php" class="btn btn-primary box-title"><i class="fa fa-arrow-left fa-fw"></i> Kembali</a>
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
              <label>Nama Paket</label>
              <input type="text" name="nama_paket" class="form-control" value="<?= htmlspecialchars($edit['nama_paket']); ?>">
            </div>
            <div class="form-group">
              <label>Jenis Paket</label>
              <select name="jenis_paket" class="form-control">
              <?php foreach ($jenis as $key): ?>
              <?php if ($key == $edit['jenis_paket']): ?>
                <option value="<?= htmlspecialchars($key); ?>" selected><?= htmlspecialchars($key); ?></option>    
              <?php endif ?>
                <option value="<?= htmlspecialchars($key); ?>"><?= htmlspecialchars($key); ?></option>
              <?php endforeach ?>
              </select>
            </div>
            <div class="form-group">
              <label>Harga</label>
              <input type="text" name="harga" class="form-control" value="<?= htmlspecialchars($edit['harga']); ?>">
            </div>
            <div class="form-group">
              <label>Pilih Outlet</label>
              <select name="outlet_id" class="form-control">
              <?php foreach ($data as $outlet): ?>
              <?php if ($data['id_outlet'] == $edit['outlet_id']): ?>
                <option value="<?= htmlspecialchars($outlet['id_outlet']); ?>" selected><?= htmlspecialchars($outlet['nama_outlet']); ?></option>
              <?php endif ?>
                <option value="<?= htmlspecialchars($outlet['id_outlet']); ?>"><?= htmlspecialchars($outlet['nama_outlet']); ?></option>
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