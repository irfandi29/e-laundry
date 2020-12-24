<?php

$title = 'Pelanggan';
require 'kasir.php';
require 'header.php';
$query = 'SELECT * FROM member';
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
          <a href="pelanggan_tambah.php" class="btn btn-primary box-title"><i class="fa fa-plus fa-fw"></i> Tambah</a>
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
                  <th width="5%">#</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>JK</th>
                  <th>Telepon</th>
                  <th>No KTP</th>
                  <th width="15%">Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php if($data != 0): ?>
              <?php $no = 1; foreach($data as $member): ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $member['nama_member'] ?></td>
                  <td><?= $member['alamat_member'] ?></td>
                  <td><?= $member['jenis_kelamin'] ?></td>
                  <td><?= $member['telp_member'] ?></td>
                  <td><?= $member['no_ktp'] ?></td>
                  <td align="center">
                    <div class="btn-group" role="group" aria-label="Basic example">
                      <a href="pelanggan_edit.php?id=<?= $member['id_member']; ?>" data-toggle="tooltip" data-placement="bottom" title="Edit" class="btn btn-success"><i class="fa fa-edit"></i></a>
                      <a href="pelanggan_hapus.php?id=<?= $member['id_member']; ?>" onclick="return confirm('Yakin hapus data ? ');" data-toggle="tooltip" data-placement="bottom" title="Hapus" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </div>
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