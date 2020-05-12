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
            <input type="hidden" name="id" value="<?= $jadwal['id']; ?>">
            <div class="form-group">
                <label for="hari">Hari</label>
                <select class="custom-select" id="hari" name="hari">
                    <option value="0" selected="selected">Pilih</option>
                    <?php foreach ($hari as $hari) : ?>
                    <?php if ($hari == $jadwal['hari']) : ?>
                    <option value="<?= $hari ?>" selected><?= $hari ?></option>
                    <?php else : ?>
                    <option value="<?= $hari ?>"><?= $hari ?></option>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="mapel">Nama Mata Pelajaran</label>
                <select class="custom-select" id="mapel" name="mapel">
                    <option value="0" selected="selected">Pilih</option>
                    <?php foreach ($mapel as $mapel) : ?>
                    <?php if ($mapel['id'] == $jadwal['mapel_id']) : ?>
                    <option value="<?= $mapel['id'] ?>" selected><?= $mapel['nama_mapel'] ?></option>
                    <?php else : ?>
                    <option value="<?= $mapel['id'] ?>"><?= $mapel['nama_mapel'] ?></option>
                    <?php endif;
					endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="kelas">Kelas</label>
                <select class="custom-select" id="kelas" name="kelas">
                    <option value="0" selected="selected">Pilih</option>
                    <?php foreach ($kelas as $kelas) : ?>
                    <?php if ($kelas['id'] == $jadwal['kelas_id']) : ?>
                    <option value="<?= $kelas['id'] ?>" selected><?= $kelas['nama_kelas'] ?></option>
                    <?php else : ?>
                    <option value="<?= $kelas['id'] ?>"><?= $kelas['nama_kelas'] ?></option>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="jam_ke">Jam Ke-?</label>
                <input type="number" name="jam_ke" id="jam_ke" class="form-control"
                    value="<?php echo $jadwal['jam_ke']; ?>" />
            </div>
            <div class="form-group">
                <label for="jumlah_jam">Jumlah Jam</label>
                <input type="number" name="jumlah_jam" id="jumlah_jam" class="form-control"
                    value="<?php echo $jadwal['jumlah_jam']; ?>" />
            </div>
        </div>
    </div>
    <input type="submit" value="Simpan" name="submit" class="btn btn-success" />
    <a href="<?= base_url() ?>admin/jadwal" class="btn btn-secondary">Batal</a>
</form>