<?php 
    if(session()->getFlashdata('error') != null){
        $err = session()->getFlashData('error');
    }
?>
<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">Wali Santri</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Wali Santri</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <?php if(session()->getFlashdata('error-header')){  ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('error-header') ?>
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Data Wali Santri</h3>
                        </div>
                        <form action="<?= url_to('update.walisantri', $walisantri['id']) ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">ID Admin</label>
                                    <input type="text" id="id_admin" class="form-control" name="id_admin" placeholder="ID Admin" value="<?= old('id_admin', $walisantri['no_telepon']) ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Nama Wali Santri</label>
                                    <input type="text" id="nama_walisantri" class="form-control <?= isset($err['nama_walisantri']) ? $err['nama_walisantri'] ? 'is-invalid' : '' : ''; ?>" name="nama_walisantri" placeholder="Nama Wali Santri" value="<?= old('nama_walisantri', $walisantri['nama_walisantri']) ?>">
                                    <?php  if(isset($err['nama_walisantri'])){  ?>
                                        <div class="invalid-feedback">
                                            <?=  $err['nama_walisantri']; ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">NIS Santri</label>
                                    <select name="nis" id="nis" class="form-control <?= isset($err['nis']) ? $err['nis'] ? 'is-invalid' : '' : ''; ?>">
                                        <option value="" selected disabled class="text-center">Pilih Santri</option>
                                        <?php foreach($santri as $row): ?>
                                        <option value="<?= $row['nis'] ?>" <?= (old('nis', $walisantri['nis']) ? 'selected' : '')?>><?= $row['nis'].' | '.$row['nama_santri'] ?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <?php  if(isset($err['nis'])){  ?>
                                        <div class="invalid-feedback">
                                            <?=  $err['nis']; ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control <?= isset($err['jenis_kelamin']) ? $err['jenis_kelamin'] ? 'is-invalid' : '' : ''; ?>">
                                        <option value="" selected disabled class="text-center">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki" <?= (old('jenis_kelamin', $walisantri['jenis_kelamin']) == 'Laki-laki' ? 'selected' : '')?>>Laki-Laki</option>
                                        <option value="Perempuan" <?= (old('jenis_kelamin', $walisantri['jenis_kelamin']) == 'Perempuan' ? 'selected' : '')?>>Perempuan</option>
                                    </select>
                                    <?php  if(isset($err['jenis_kelamin'])){  ?>
                                        <div class="invalid-feedback">
                                            <?=  $err['jenis_kelamin']; ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Tempat Lahir</label>
                                    <input type="text" id="tempat" class="form-control <?= isset($err['tempat']) ? $err['tempat'] ? 'is-invalid' : '' : ''; ?>" name="tempat" value="<?= old('tempat', $walisantri['tempat']) ?>" placeholder="Tempat Lahir">
                                    <?php  if(isset($err['tempat'])){  ?>
                                        <div class="invalid-feedback">
                                            <?=  $err['tempat']; ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Tanggal Lahir</label>
                                    <input type="date" id="tanggal_lahir" class="form-control <?= isset($err['tanggal_lahir']) ? $err['tanggal_lahir'] ? 'is-invalid' : '' : ''; ?>" name="tanggal_lahir" value="<?= old('tanggal_lahir', $walisantri['tanggal_lahir']) ?>">
                                    <?php  if(isset($err['tanggal_lahir'])){  ?>
                                        <div class="invalid-feedback">
                                            <?=  $err['tanggal_lahir']; ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Usia Santri</label>
                                    <input type="number" id="usia_santri" class="form-control <?= isset($err['usia_santri']) ? $err['usia_santri'] ? 'is-invalid' : '' : ''; ?>" name="usia_santri" value="<?= old('usia_santri', $walisantri['usia_santri']) ?>" placeholder="Tempat Lahir">
                                    <?php  if(isset($err['usia_santri'])){  ?>
                                        <div class="invalid-feedback">
                                            <?=  $err['usia_santri']; ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Alamat</label>
                                    <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control <?= isset($err['alamat']) ? $err['alamat'] ? 'is-invalid' : '' : ''; ?>" placeholder="Alamat Lengkap"><?= old('alamat', $walisantri['alamat'])?></textarea>
                                    <?php  if(isset($err['alamat'])){  ?>
                                        <div class="invalid-feedback">
                                            <?=  $err['alamat']; ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Nama Ayah</label>
                                    <input type="text" id="nama_ayah" class="form-control <?= isset($err['nama_ayah']) ? $err['nama_ayah'] ? 'is-invalid' : '' : ''; ?>" name="nama_ayah" value="<?= old('nama_ayah', $walisantri['nama_ayah']) ?>" placeholder="Nama Ayah">
                                    <?php  if(isset($err['nama_ayah'])){  ?>
                                        <div class="invalid-feedback">
                                            <?=  $err['nama_ayah']; ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Pekerjaan Ayah</label>
                                    <input type="text" id="pekerjaan_ayah" class="form-control <?= isset($err['pekerjaan_ayah']) ? $err['pekerjaan_ayah'] ? 'is-invalid' : '' : ''; ?>" name="pekerjaan_ayah" value="<?= old('pekerjaan_ayah', $walisantri['pekerjaan_ayah']) ?>" placeholder="Pekerjaan Ayah">
                                    <?php  if(isset($err['pekerjaan_ayah'])){  ?>
                                        <div class="invalid-feedback">
                                            <?=  $err['pekerjaan_ayah']; ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Nama Ibu</label>
                                    <input type="text" id="nama_ibu" class="form-control <?= isset($err['nama_ibu']) ? $err['nama_ibu'] ? 'is-invalid' : '' : ''; ?>" name="nama_ibu" value="<?= old('nama_ibu', $walisantri['nama_ibu']) ?>" placeholder="Nama Ibu">
                                    <?php  if(isset($err['nama_ibu'])){  ?>
                                        <div class="invalid-feedback">
                                            <?=  $err['nama_ibu']; ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Pekerjaan Ibu</label>
                                    <input type="text" id="pekerjaan_ibu" class="form-control <?= isset($err['pekerjaan_ibu']) ? $err['pekerjaan_ibu'] ? 'is-invalid' : '' : ''; ?>" name="pekerjaan_ibu" value="<?= old('pekerjaan_ibu', $walisantri['pekerjaan_ibu']) ?>" placeholder="Pekerjaan Ibu">
                                    <?php  if(isset($err['pekerjaan_ibu'])){  ?>
                                        <div class="invalid-feedback">
                                            <?=  $err['pekerjaan_ibu']; ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">No Telepon</label>
                                    <input type="number" id="no_telepon" class="form-control <?= isset($err['no_telepon']) ? $err['no_telepon'] ? 'is-invalid' : '' : ''; ?>" name="no_telepon" value="<?= old('no_telepon', $walisantri['no_telepon']) ?>" placeholder="Nomor Telepon">
                                    <?php  if(isset($err['no_telepon'])){  ?>
                                        <div class="invalid-feedback">
                                            <?=  $err['no_telepon']; ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-block">Simpan</button>
                                </div>
                            </div>
                        </form>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
<?= $this->section('footer') ?>
    <script>
        $(document).ready(function() {
            $('#jenis_kelamin').select2();
            $('#nis').select2();
        });
    </script>
<?= $this->endSection() ?>