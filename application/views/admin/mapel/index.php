<?php if ($this->session->flashdata('flash-data')) : ?>
<div class="row mt-4">
    <div class="col-md-6">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Mata Pelajaran<strong> berhasil </strong> <?= $this->session->flashdata('flash-data'); ?>
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
            Data Mata Pelajaran
        </h3>
    </div><!-- /.card-header -->
    <div class="row my-3 ml-2">
        <div class="col-lg-4">
            <form action="" method="post">
                <div class="input-group">
                    <input type="text" class="form-control" name="key" id="key" placeholder="Cari Data Mata Pelajaran">
                    <div class="input-group-append">
                        <button class="btn btn-primary">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <?php if (empty($mapel)) : ?>
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
                    <th>Nama Mata Pelajaran</th>
                    <th>Nama Guru</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
				$a = 1;
				foreach ($mapel as $mapel) :
				?>
                <tr>
                    <td><?= $a++ ?></td>
                    <td><?= $mapel['nama_mapel'] ?></td>
                    <td><?= $mapel['nama_guru'] ?></td>
                    <td>
                        <a href="<?= base_url() ?>admin/mapel/edit/<?= $mapel['id_mapel'] ?>"
                            class="btn btn-warning btn-sm">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        <a href="<?= base_url() ?>admin/mapel/hapus/<?= $mapel['id_mapel'] ?>"
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
<a href="<?= base_url() ?>admin/mapel/tambah" class="btn btn-primary float-right">Tambah</a>