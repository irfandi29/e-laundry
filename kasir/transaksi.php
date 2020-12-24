<?php

$title = 'Transaksi';
require 'kasir.php';
require 'header.php';
$outlet_id = $_SESSION['outlet_id'];
$query = "SELECT transaksi.*, member.nama_member, detail_transaksi.total_harga FROM transaksi INNER JOIN member ON member.id_member = transaksi.member_id INNER JOIN detail_transaksi ON detail_transaksi.transaksi_id = transaksi.id_transaksi WHERE transaksi.outlet_id = $outlet_id ORDER BY status_bayar ASC";
$data = ambildata($conn,$query);

?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="index.php">
        <em class="fa fa-home"></em>
      </a></li>
      <li class="active"><?= $title; ?></li>
    </ol>
  </div><!--/.row-->
  
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header"><?= $title; ?></h1>
    </div>
  </div><!--/.row-->

  <div class="panel panel-container">
    <div class="row" style="padding: 0 15px 20px 15px;">
      <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        <div class="col-md-6">
          <a href="transaksi_cari_member.php" class="btn btn-primary box-title"><i class="fa fa-plus fa-fw"></i> Tambah</a>
          <a href="transaksi_konfirmasi.php" class="btn btn-primary box-title"><i class="fa fa-check fa-fw"></i> Konfirmasi Pembayaran</a>
        </div>
        <div class="col-md-6 text-right">
          <button id="btn-refresh" class="btn btn-primary box-title text-right" title="Refresh Data"><i class="fa fa-refresh" id="ic-refresh"></i></button>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
      <div class="panel panel-container">
        <div style="padding: 0 30px 30px 30px;">
          <div class="table-responsive">
            <table class="table table-bordered thead-dark" id="table">
              <thead class="thead-dark">
                <tr>
                  <th>#</th>
                  <th>Invoice</th>
                  <th>Member</th>
                  <th>Status</th>
                  <th>Pemabayaran</th>
                  <th>Total Harga</th>
                  <th width="15%">Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php if($data != 0): ?>
              <?php $no = 1; foreach($data as $transaksi): ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $transaksi['kode_invoice'] ?></td>
                  <td><?= $transaksi['nama_member'] ?></td>
                  <td><?= $transaksi['status'] ?></td>
                  <td><?= $transaksi['status_bayar'] ?></td>
                  <td><?= $transaksi['total_harga'] ?></td>
                  <td align="center">
                    <a href="transaksi_detail.php?id=<?= $transaksi['id_transaksi']; ?>" data-toggle="tooltip" data-placement="bottom" title="Edit" class="btn btn-success btn-block">Detail</a>
                  </td>
                </tr>
              <?php endforeach; ?>
              <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php require 'footer.php'; ?>