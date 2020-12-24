<?php

$title = 'Paket';
require 'admin.php';
$query = 'SELECT * FROM outlet';
$data = ambildata($conn,$query);

if(isset($_POST['btn-simpan'])){
  $nama   = stripslashes($_POST['nama_paket']);
  $jenis_paket = stripslashes($_POST['jenis_paket']);
  $harga   = stripslashes($_POST['harga']);
  $outlet_id   = stripslashes($_POST['outlet_id']);

  $query = "INSERT INTO paket (nama_paket,jenis_paket,harga,outlet_id) values ('$nama','$jenis_paket','$harga','$outlet_id')";
    
  $execute = bisa($conn,$query);
  if($execute == 1){
    $success = 'true';
    $title = 'Berhasil';
    $message = 'Berhasil Simpan Data';
    $type = 'success';
    header('location: paket.php?crud='.$success.'&msg='.$message.'&type='.$type.'&title='.$title);
  } else {
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
              <input type="text" name="nama_paket" class="form-control">
            </div>
            <div class="form-group">
              <label>Jenis Paket</label>
              <select name="jenis_paket" class="form-control">
                <option value="kiloan">Kiloan</option>
                <option value="selimut">Selimut</option>
                <option value="bedcover">Bedcover</option>
                <option value="kaos">Kaos</option>
                <option value="lainnya">Lainnya</option>
              </select>
            </div>
            <div class="form-group">
              <label>Harga</label>
              <input type="text" name="harga" class="form-control">
            </div>
            <div class="form-group">
              <label>Pilih Outlet</label>
              <select name="outlet_id" class="form-control">
              <?php foreach ($data as $outlet): ?>
                <option value="<?= $outlet['id_outlet'] ?>"><?= htmlspecialchars($outlet['nama_outlet']); ?></option>
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