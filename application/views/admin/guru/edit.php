<?php
// echo var_dump($guru);
?>

<form action="" method="post">
    <div class="row">
        <div class="col-lg-6">
            <input type="hidden" name="id" value="<?= $guru['id']; ?>">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="<?= $guru['nama'] ?>" />
            </div>
            <div class="form-group">
                <label for="asal">NIP</label>
                <input type="text" name="nip" id="nip" class="form-control" value="<?= $guru['nip'] ?>" />
            </div>
            <div class="form-group">
                <label for="status">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="form-control" value="<?= $guru['alamat'] ?>" />
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="nohp">No. Telepon</label>
                <input type="text" name="telp" id="telp" class="form-control" value="<?= $guru['telp'] ?>" />
            </div>
            <div class="form-group">
                <label for="username">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?= $guru['email'] ?>" />
            </div>
        </div>
    </div>
    <input type="submit" value="Simpan" name="submit" class="btn btn-success" />
    <a href="<?= base_url() ?>/admin/guru" class="btn btn-secondary">Batal</a>
</form>