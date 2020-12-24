<?php

$title = 'Transaksi';
require 'admin.php';
require 'header.php';
$query = "SELECT transaksi.*,member.nama_member , detail_transaksi.total_harga FROM transaksi INNER JOIN member ON member.id_member = transaksi.member_id INNER JOIN detail_transaksi ON detail_transaksi.transaksi_id = transaksi.id_transaksi WHERE transaksi.status_bayar='Belum' ORDER BY tgl DESC";
$data = ambildata($conn,$query);

?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="index.php">
        <em class="fa fa-home"></em>
      </a></li>
      <li class="active"><a href="transaksi.php">Transaksi</a></li>
      <li class="active">Pilih <?= $title; ?></li>
    </ol>
  </div><!--/.row-->
  
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Pilih <?= $title; ?></h1>
    </div>
  </div><!--/.row-->

  <div class="panel panel-container">
    <div class="row" style="padding: 0 15px 20px 15px;">
      <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        <div class="col-md-6">
          <a href="transaksi.php" class="btn btn-primary box-title"><i class="fa fa-arrow-left fa-fw"></i> Kembali</a>
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
                  <th>Total Harga</th>
                  <th width="15%">Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php if($data != 0): ?>
              <?php foreach($data as $transaksi): ?>
                  <tr>
                      <td></td>
                      <td><?= $transaksi['kode_invoice'] ?></td>
                      <td><?= $transaksi['nama_member'] ?></td>
                      <td><?= $transaksi['status'] ?></td>
                      <td><?= $transaksi['total_harga'] ?></td>
                      <td align="center">
                            <a href="transaksi_bayar.php?id=<?= $transaksi['id_transaksi']; ?>" data-toggle="tooltip" data-placement="bottom" title="Pilih" class="btn btn-primary btn-block">Pilih</a>
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
