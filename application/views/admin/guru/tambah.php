<?php if (validation_errors()) : ?>
<div class="row mt-4">
    <div class="col-md-6">
        <div class="alert alert-warning" role="alert">
            <?php echo validation_errors(); ?>
        </div>
    </div>
</div>
<?php endif; ?>
<form action="" method="post">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control"
                    value="<?php echo set_value('nama'); ?>" />
            </div>
            <div class="form-group">
                <label for="asal">NIP</label>
                <input type="text" name="nip" id="nip" class="form-control" value="<?php echo set_value('nip'); ?>" />
            </div>
            <div class="form-group">
                <label for="status">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="form-control"
                    value="<?php echo set_value('alamat'); ?>" />
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="nohp">No. HP</label>
                <input type="text" name="telp" id="telp" class="form-control"
                    value="<?php echo set_value('telp'); ?>" />
            </div>
            <div class="form-group">
                <label for="username">Email</label>
                <input type="email" name="email" id="email" class="form-control"
                    value="<?php echo set_value('email'); ?>" />
            </div>
        </div>
    </div>
    <input type="submit" value="Simpan" name="submit" class="btn btn-success" />
    <a href="<?= base_url() ?>admin/guru" class="btn btn-secondary">Batal</a>
</form>