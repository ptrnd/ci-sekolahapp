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
            <input type="hidden" name="id" value="<?= $mapel['id']; ?>">
            <div class="form-group">
                <label for="nama_mapel">Nama Mata Pelajaran</label>
                <input type="text" name="nama_mapel" id="nama_mapel" class="form-control"
                    value="<?= $mapel['nama_mapel']; ?>" />
            </div>
            <div class="form-group">
                <label for="guru">Nama Guru</label>
                <select class="custom-select" id="guru" name="guru">
                    <option selected value="">Pilih</option>
                    <?php foreach ($guru as $guru) { ?>
                    <?php if ($guru['id'] == $guru1['id']) : ?>
                    <option value="<?= $guru['id'] ?>" selected><?= $guru['nama'] ?></option>
                    <?php else : ?>
                    <option value="<?= $guru['id'] ?>"><?= $guru['nama'] ?></option>
                    <?php endif; ?>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <input type="submit" value="Simpan" name="submit" class="btn btn-success" />
    <a href="<?= base_url() ?>admin/mapel" class="btn btn-secondary">Batal</a>
</form>