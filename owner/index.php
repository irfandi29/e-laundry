<?php

$title = 'Dashboard';
require 'owner.php';
require 'header.php';
$outlet_id = $_SESSION['outlet_id'];
$nama_outlet = ambilsatubaris($conn, "SELECT * FROM outlet WHERE id_outlet = $outlet_id");
$transaksi = ambilsatubaris($conn,'SELECT COUNT(id_transaksi) as jumlahtransaksi FROM transaksi');
$pelanggan = ambilsatubaris($conn,'SELECT COUNT(id_member) as jumlahmember FROM member');
$outlet = ambilsatubaris($conn,'SELECT COUNT(id_outlet) as jumlahoutlet FROM outlet');
$query = "SELECT transaksi.*,member.nama_member , detail_transaksi.total_harga FROM transaksi INNER JOIN member ON member.id_member = transaksi.member_id INNER JOIN detail_transaksi ON detail_transaksi.transaksi_id = transaksi.id_transaksi AND transaksi.outlet_id = $outlet_id ORDER BY transaksi.id_transaksi DESC LIMIT 10";
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
    <div class="row">
      <div class="col-xs-6 col-md-4 col-lg-4 no-padding">
        <div class="panel panel-teal panel-widget border-right">
          <div class="row no-padding"><i class="fa fa-xl fa-store color-blue"></i>
            <div class="large"><?= htmlspecialchars($outlet['jumlahoutlet']); ?></div>
            <div class="text-muted">Outlet</div>
          </div>
        </div>
      </div>
      <div class="col-xs-6 col-md-4 col-lg-4 no-padding">
        <div class="panel panel-blue panel-widget border-right">
          <div class="row no-padding"><i class="fa fa-xl fa-users color-orange"></i>
            <div class="large"><?= htmlspecialchars($pelanggan['jumlahmember']); ?></div>
            <div class="text-muted">Pelanggan</div>
          </div>
        </div>
      </div>
      <div class="col-xs-6 col-md-4 col-lg-4 no-padding">
        <div class="panel panel-orange panel-widget border-right">
          <div class="row no-padding"><i class="fa fa-xl fa-shopping-cart color-teal"></i>
            <div class="large"><?= htmlspecialchars($transaksi['jumlahtransaksi']); ?></div>
            <div class="text-muted">Transaksi</div>
          </div>
        </div>
      </div>
    </div><!--/.row-->
  </div>
  
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-container">
        <div style="padding: 0 30px 30px 30px;">
          <h3 style="padding: 0 0 20px 0;">10 Transaksi <strong><?= $nama_outlet['nama_outlet']; ?></strong> Terbaru</h3>
          <div class="table-responsive">
            <table class="table table-bordered thead-dark" id="table">
              <thead>
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
                <?php $no=1; foreach($data as $transaksi): ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($transaksi['kode_invoice']); ?></td>
                    <td><?= htmlspecialchars($transaksi['nama_member']); ?></td>
                    <td><?= htmlspecialchars($transaksi['status']); ?></td>
                    <td><?= htmlspecialchars($transaksi['status_bayar']); ?></td>
                    <td><?= "Rp. ".htmlspecialchars($transaksi['total_harga']); ?></td>
                    <td align="center">
                      <a href="transaksi_detail.php?id=<?= htmlspecialchars($transaksi['id_transaksi']); ?>" data-toggle="tooltip" data-placement="bottom" title="Edit" class="btn btn-success btn-block disabled">Detail</a>
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