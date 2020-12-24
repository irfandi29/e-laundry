<?php

$title = 'Transaksi';
require 'kasir.php';
require 'header.php';
$query = 'SELECT transaksi.*,member.nama_member , detail_transaksi.total_harga FROM transaksi INNER JOIN member ON member.id_member = transaksi.member_id INNER JOIN detail_transaksi ON detail_transaksi.transaksi_id = transaksi.id_transaksi WHERE transaksi.id_transaksi = ' . $_GET['id'];
$data = ambilsatubaris($conn,$query);

?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="index.php">
        <em class="fa fa-home"></em>
      </a></li>
      <li><a href="transaksi.php"><?= $title; ?></a></li>
      <li class="active"><a href="transaksi_cari_member.php">Pilih Pelanggan</a></li>
      <li class="active"><a href="javascript:void(0);" onclick="window.history.back()">Tambah <?= $title; ?></a></li>
      <li class="active"><?= $title; ?> Sukses</li>
    </ol>
  </div><!--/.row-->

  <div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
      <div class="panel panel-container">
        <div style="padding: 30px 0 30px 0;">
          <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 text-center" style="padding-left: 50px;padding-right: 50px;">
              <div class="bg-success" style="font-size: 125px; border-radius: 20px">
                <i class="fa fa-check text-white"></i>
              </div>
            </div>
            <div class="col-md-4"></div>
          </div>
          <div class="row">
            <div class="col-md-12 text-center">
              <h3>Pesanan Atas Nama <br/><b><?= $data['nama_member'] ?></b><br/> Behasil Di Simpan</h3>
              <strong>Kode Invoice <?= $data['kode_invoice'] ?></strong><br>
              <strong>Total Pembayaran Rp. <?= $data['total_harga'] ?></strong><br><br>
              <a href="transaksi.php" class="btn btn-primary">Kembali Ke Menu Utama</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php require 'footer.php'; ?>