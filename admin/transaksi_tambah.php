<?php

$title = 'Transaksi';
require 'admin.php';
$tgl_sekarang = date('Y-m-d h:i:s');
$tujuh_hari   = mktime(0,0,0,date("n"),date("j")+7,date("Y"));
$batas_waktu  = date("Y-m-d h:i:s", $tujuh_hari);

$invoice   = 'DRY'.Date('Ymdsi');
$user_id   = $_SESSION['user_id']; 
$member_id = $_GET['id'];

$outlets = ambildata($conn,'SELECT * from outlet');
$member = ambilsatubaris($conn,'SELECT nama_member from member WHERE id_member = ' . $member_id);
$paket = ambildata($conn,'SELECT id_paket, nama_paket, outlet.nama_outlet FROM paket INNER JOIN outlet ON paket.outlet_id = outlet.id_outlet;');


if(isset($_POST['btn-simpan'])){   
  $kode_invoice = $_POST['kode_invoice'];
  $biaya_tambahan = $_POST['biaya_tambahan'];
  $diskon = $_POST['diskon'];
  $pajak = $_POST['pajak'];
  $outlet_id = $_POST['outlet'];
  
  $query = "INSERT INTO transaksi (outlet_id,kode_invoice,member_id,tgl,batas_waktu,biaya_tambahan,diskon,pajak,status,status_bayar,user_id) VALUES ('$outlet_id','$kode_invoice','$member_id','$tgl_sekarang','$batas_waktu','$biaya_tambahan','$diskon','$pajak','Baru','Belum','$user_id')";

  $execute = bisa($conn,$query);
  if ($execute == 1) {
    $paket_id = $_POST['paket_id'];
    $qty = $_POST['qty'];
    $hargapaket = ambilsatubaris($conn,'SELECT harga from paket WHERE id_paket = ' . $paket_id);
    $total_harga = $hargapaket['harga'] * $qty;
    $kode_invoice;
    $transaksi = ambilsatubaris($conn,"SELECT * FROM transaksi WHERE kode_invoice = '" . $kode_invoice ."'");
    $transaksi_id = $transaksi['id_transaksi'];
        
    $sqlDetail = "INSERT INTO detail_transaksi (transaksi_id,paket_id,qty,total_harga) VALUES ('$transaksi_id','$paket_id','$qty','$total_harga')";

    $executeDetail = bisa($conn,$sqlDetail);
    if($executeDetail == 1){
      header('location: transaksi_sukses.php?id='.$transaksi_id);
    }else{
      echo "Gagal Tambah Data";
    }
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
      <li><a href="transaksi.php"><?= $title; ?></a></li>
      <li class="active"><a href="transaksi_cari_member.php">Pilih Pelanggan</a></li>
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
          <a href="transaksi_cari_member.php" class="btn btn-primary box-title"><i class="fa fa-arrow-left fa-fw"></i> Kembali</a>
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
          <form method="post" action="">
            <div class="form-group">
              <label>Kode Invoice</label>
              <input type="text" name="kode_invoice" class="form-control" readonly="" value="<?= $invoice ?>">
            </div>
            <div class="form-group">
              <label>Outlet</label>
              <select name="outlet" class="form-control">
              <?php foreach($outlets as $outlet): ?>
                <option value="<?= $outlet['id_outlet']; ?>"><?= $outlet['nama_outlet']; ?></option>
              <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label>Pelanggan</label>
              <input type="text" name="pelanggan" class="form-control" readonly="" value="<?= $member['nama_member'] ?>"> 
            </div>
            <div class="form-group">
              <label>Pilih Paket</label>
              <select name="paket_id" class="form-control">
              <?php foreach ($paket as $key): ?>
                <option value="<?= $key['id_paket'] ?>"><?= $key['nama_paket']." - ".$key['nama_outlet']  ?></option>
              <?php endforeach ?>
              </select>
            </div>
            <div class="form-group">
              <label>Jumlah</label>
              <input type="text" name="qty" class="form-control"> 
            </div>
            <div class="form-group">
              <label>Biaya Tambahan</label>
              <input type="text" name="biaya_tambahan" class="form-control" value="0"> 
            </div>
            <div class="form-group">
              <label>Diskon (%)</label>
              <input type="text" name="diskon" class="form-control" value="0"> 
            </div>
            <div class="form-group">
              <label>Pajak</label>
              <input type="text" name="pajak" class="form-control" value="0"> 
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