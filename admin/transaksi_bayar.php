<?php

$title = 'Transaksi';
require'admin.php';
$query = 'SELECT transaksi.*,member.nama_member , detail_transaksi.total_harga FROM transaksi INNER JOIN member ON member.id_member = transaksi.member_id INNER JOIN detail_transaksi ON detail_transaksi.transaksi_id = transaksi.id_transaksi WHERE transaksi.id_transaksi = ' . $_GET['id'];
$data = ambilsatubaris($conn,$query);
if(isset($_POST['btn-simpan'])) {
    $total_bayar = $_POST['total_bayar'];
    if($total_bayar >= $data['total_harga']){
        $query = "UPDATE transaksi SET status ='Selesai', status_bayar = 'dibayar',tgl_pembayaran = '" . Date('Y-m-d h:i:s') . "' WHERE id_transaksi = " . $_GET['id'];
        $query2 = "UPDATE detail_transaksi SET total_bayar = '$total_bayar' WHERE transaksi_id = " . $_GET['id'];
        $execute = bisa($conn,$query);
        $execute2 = bisa($conn,$query2);
        if($execute == 1 && $execute2 == 1){
            echo "<script>alert('OK');</script>";
            header('location:transaksi_telah_dibayar.php?id='.$_GET['id']);
        }else{
            echo "Gagal Tambah Data";
        }   
    }else{
        $message = "Jumlah Uang Pembayaran Kurang";
        header('location:transaksi_bayar.php?id='.$_GET['id']. '&msg='.$message);
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
      <li><a href="transaksi.php">Transaksi</a></li>
      <li><a href="transaksi_konfirmasi.php">Pilih <?= $title; ?></a></li>
      <li class="active">Konfirmasi <?= $title; ?></li>
    </ol>
  </div><!--/.row-->
  
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Konfirmasi <?= $title; ?></h1>
    </div>
  </div><!--/.row-->
  
  <div class="panel panel-container">
    <div class="row" style="padding: 0 15px 20px 15px;">
      <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        <div class="col-md-6">
          <a href="transaksi_konfirmasi.php" class="btn btn-primary box-title"><i class="fa fa-arrow-left fa-fw"></i> Kembali</a>
        </div>  
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
      <div class="panel panel-container">
        <div style="padding: 0 30px 30px 30px;">
          <form method="post" action="transaksi_bayar.php?id=<?= $data['id_transaksi'] ?>" id="form-submit">
            <div class="form-group">
              <label>Kode Invoice</label>
              <input type="text" name="kode_invoice" value="<?= $data['kode_invoice'] ?>" class="form-control" readonly>
            </div>
            <div class="form-group">
              <label>Nama Member</label>
              <input type="text" name="nama_member" value="<?= $data['nama_member'] ?>" class="form-control" readonly>
            </div>
            <div class="form-group">
              <label>Total Yang Harus Di Bayar</label>
              <input type="text" name="total_harga" value="<?= $data['total_harga'] ?>" class="form-control" readonly>
            </div>
            <div class="form-group">
              <label>Masukan Jumlah Pembayaran</label>
              <input type="number" name="total_bayar" id="total_bayar"  class="form-control">
              <?php if (isset($_GET['msg'])): ?>
                <small class="text-danger"><?= $_GET['msg'] ?></small>
              <?php endif ?>
            </div>
            <div class="text-right">
              <button type="submit" name="btn-simpan" id="btn-simpan" class="btn btn-primary">Bayar</utton>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php require 'footer.php'; ?>