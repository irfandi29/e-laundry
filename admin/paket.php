<?php

$title = 'Paket';
require 'admin.php';
require 'header.php';
$query = 'SELECT outlet.nama_outlet ,paket.* FROM paket INNER JOIN outlet ON paket.outlet_id = outlet.id_outlet';
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
          <a href="paket_tambah.php" class="btn btn-primary box-title"><i class="fa fa-plus fa-fw"></i> Tambah</a>
        </div>
        <div class="col-md-6 text-right">
          <button id="btn-refresh" class="btn btn-primary box-title text-right" title="Refresh Data"><i class="fa fa-refresh" id="ic-refresh"></i></button>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-container">
        <div style="padding: 0 30px 30px 30px;">
          <div class="table-responsive">
            <table class="table table-bordered thead-dark" id="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama Paket</th>
                  <th>Jenis</th>
                  <th>Harga</th>
                  <th>Outlet</th>
                  <th width="15%">Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php if($data != 0): ?>
              <?php $no = 1; foreach($data as $paket): ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= htmlspecialchars($paket['nama_paket']); ?></td>
                  <td><?= htmlspecialchars($paket['jenis_paket']); ?></td>
                  <td><?= htmlspecialchars($paket['harga']); ?></td>
                  <td><?= htmlspecialchars($paket['nama_outlet']); ?></td>
                  <td align="center">
                    <div class="btn-group" role="group" aria-label="Basic example">
                      <a href="paket_edit.php?id=<?= htmlspecialchars($paket['id_paket']); ?>" data-toggle="tooltip" data-placement="bottom" title="Edit" class="btn btn-success"><i class="fa fa-edit"></i></a>
                      <a href="paket_hapus.php?id=<?= htmlspecialchars($paket['id_paket']); ?>" onclick="return confirm('Yakin hapus data ? ');" data-toggle="tooltip" data-placement="bottom" title="Hapus" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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