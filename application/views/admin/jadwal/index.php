<?php if ($this->session->flashdata('flash-data')) : ?>
<div class="row mt-4">
    <div class="col-md-6">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Jadwal<strong> berhasil </strong> <?= $this->session->flashdata('flash-data'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-chart-pie mr-1"></i>
            Data Jadwal
        </h3>
    </div><!-- /.card-header -->
    <div class="row my-3 ml-2">
        <div class="col-lg-4">
            <form action="" method="post">
                <div class="input-group">
                    <input type="text" class="form-control" name="key" id="key" placeholder="Cari Data Jadwal">
                    <div class="input-group-append">
                        <button class="btn btn-primary">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <?php if (empty($jadwal)) : ?>
        <div class="alert alert-danger" role="alert">
            <strong>maaf.. pencarian tidak ditemukan :( </strong>
        </div>
        <?php endif; ?>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Hari</th>
                    <th>Nama Mata Pelajaran</th>
                    <th>Kelas</th>
                    <th>Jam Ke</th>
                    <th>Jumlah Jam</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
				$a = 1;
				foreach ($jadwal as $jdw) :
				?>
                <tr>
                    <td><?= $a++ ?></td>
                    <td><?= $jdw['hari'] ?></td>
                    <td><?= $jdw['nama_mapel'] ?></td>
                    <td><?= $jdw['nama_kelas'] ?></td>
                    <td><?= $jdw['jam_ke'] ?></td>
                    <td><?= $jdw['jumlah_jam'] ?></td>
                    <td>
                        <a href="<?= base_url() ?>admin/jadwal/edit/<?= $jdw['id_jadwal'] ?>"
                            class="btn btn-warning btn-sm">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        <a href="<?= base_url() ?>admin/jadwal/hapus/<?= $jdw['id_jadwal'] ?>"
                            class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i> Hapus
                        </a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div><!-- /.card-body -->







</div>
<a href="<?= base_url() ?>admin/jadwal/tambah" class="btn btn-primary float-right">Tambah</a>