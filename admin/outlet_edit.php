<?php

$title = 'Outlet';
require'admin.php';
$query = 'SELECT outlet.*, user.nama_user,user.id_user FROM outlet LEFT JOIN user ON user.outlet_id = outlet.id_outlet WHERE id_outlet = ' . stripslashes($_GET['id']);
$data = ambilsatubaris($conn,$query);
$query2 = 'SELECT user.*,outlet.nama_outlet FROM outlet RIGHT JOIN user ON user.outlet_id = outlet.id_outlet WHERE user.role = "Owner" order by user.outlet_id asc';
$query3 = 'SELECT * from user where role = "Owner"';
$data2 = ambildata($conn,$query2);
$data3 = ambildata($conn,$query3);

if(isset($_POST['btn-simpan'])){
  $nama   = stripslashes($_POST['nama_outlet']);
  $alamat = stripslashes($_POST['alamat_outlet']);
  $telp   = stripslashes($_POST['telp_outlet']);
  $query = "UPDATE outlet SET nama_outlet = '$nama' , alamat_outlet = '$alamat' , telp_outlet='$telp' WHERE id_outlet = " . stripslashes($_GET['id']);
  
  if($_POST['owner_id_new']){
    $query2 = "UPDATE user SET outlet_id = '" . stripslashes($_GET['id']) . "' WHERE id_user = " . $_POST['owner_id_new'];
    $query3 = "UPDATE user SET outlet_id = NULL WHERE id_user = " . stripslashes($data['id_user']);
    $execute3 = bisa($conn,$query3);
  } else {
    $query2 = "UPDATE user SET outlet_id = '" . stripslashes($_GET['id']) . "' WHERE id_user = " . stripslashes($_POST['owner_id']);
  }

  $execute = bisa($conn,$query);
  $execute2 = bisa($conn,$query2);

  if($execute == 1 && $execute2 == 1){
    $success = 'true';
    $title = 'Berhasil';
    $message = 'Berhasil Mengubah Data';
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
              <input type="text" value="<?= $data['nama_outlet']; ?>" name="nama_outlet" class="form-control">
            </div>
            <div class="form-group">
              <label>Alamat Outlet</label>
              <textarea name="alamat_outlet" class="form-control"><?= htmlspecialchars($data['alamat_outlet']); ?></textarea>
            </div>
            <div class="form-group">
              <label>Nomor Telepon</label>
              <input type="text" value="<?= htmlspecialchars($data['telp_outlet']); ?>" name="telp_outlet" class="form-control">
            </div>
      
            <?php if($data['nama_user']  == null): ?>
            <div class="form-group">
              <label>Belum Ada Owner (silahkan pilih owner)</label>
              <select name="owner_id" class="form-control">
              <?php foreach ($data3 as $owner): ?>
                <option value="<?= htmlspecialchars($owner['id_user']); ?>"><?= htmlspecialchars($owner['nama_user']); ?> 
                <?php if ($owner['outlet_id'] == null): ?>
                  ( Belum memiliki outlet )
                <?php else: ?>
                  ( Owner di <?= htmlspecialchars($owner['nama_outlet']); ?> )
                <?php endif ?>                                    
                </option>
              <?php endforeach ?>
              </select>
            </div>
      
            <?php else: ?>
            <div class="form-group">
              <label>Owner Sekarang : <?= htmlspecialchars($data['nama_user']); ?></label>
              <select name="owner_id_new" class="form-control">
                <option class="">Pilih Untuk Mengganti owner</option>
                <?php foreach ($data2 as $owner): ?>
                  <option value="<?= htmlspecialchars($owner['id_user']); ?>"><?= htmlspecialchars($owner['nama_user']); ?> 
                  <?php if ($owner['outlet_id'] == null): ?>
                    ( Belum memiliki outlet )
                  <?php else: ?>
                    ( Owner di <?= htmlspecialchars($owner['nama_outlet']); ?> )
                  <?php endif ?>                                    
                  </option>
                <?php endforeach ?>
              </select>
            </div>
            <?php endif; ?>
      
            <div class="text-right">
              <button type="reset" class="btn btn-danger">Reset</button>
              <button type="submit" name="btn-simpan" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php require 'footer.php'; ?>