<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-chart-pie mr-1"></i>
            Data Guru
        </h3>
    </div><!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Alamat</th>
                    <th>No. HP</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
				$a = 1;
				foreach ($guru as $gr) :
				?>
                <tr>
                    <td><?= $a++ ?></td>
                    <td><?= $gr['nama'] ?></td>
                    <td><?= $gr['nip'] ?></td>
                    <td><?= $gr['alamat'] ?></td>
                    <td><?= $gr['telp'] ?></td>
                    <td><?= $gr['email'] ?></td>
                    <td>
                        <a href="<?= base_url() ?>admin/guru/edit/<?= $gr['id'] ?>" class="btn btn-warning btn-sm">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        <a href="<?= base_url() ?>admin/guru/hapus/<?= $gr['id'] ?>" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i> Hapus
                        </a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div><!-- /.card-body -->
</div>
<a href="<?= base_url() ?>admin/guru/tambah" class="btn btn-primary float-right">Tambah</a>