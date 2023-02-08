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
            <h1 class="m-0 text-dark">Santri</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item">Santri</li>
                <li class="breadcrumb-item active">Tambah Santri</li>
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
                            <h3 class="card-title">Tambah Data Santri</h3>
                        </div>
                        <form action="/santri/tambah-santri" method="POST" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">ID Admin</label>
                                    <input type="text" id="id_admin" class="form-control" name="id_admin" placeholder="ID Admin" value="<?= old('id_admin') ? old('id_admin') : $id_admin ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">NIS Santri</label>
                                    <input type="text" id="nis" class="form-control <?= isset($err['nis']) ? $err['nis'] ? 'is-invalid' : '' : ''; ?>" name="nis" placeholder="NIS Santri" value="<?= old('nis') ?>" >
                                    <?php  if(isset($err['nis'])){  ?>
                                        <div class="invalid-feedback">
                                            <?=  $err['nis']; ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Nama Santri</label>
                                    <input type="text" id="nama_santri" class="form-control <?= isset($err['nama_santri']) ? $err['nama_santri'] ? 'is-invalid' : '' : ''; ?>" name="nama_santri" placeholder="Nama Santri" value="<?= old('nama_santri') ?>" >
                                    <?php if(isset($err['nama_santri'])){ ?>
                                        <div class="invalid-feedback">
                                            <?=  $err['nama_santri']; ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control <?= isset($err['jenis_kelamin']) ? $err['jenis_kelamin'] ? 'is-invalid' : '' : ''; ?>">
                                        <option value="" selected disabled class="text-center">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    <?php if(isset($err['jenis_kelamin'])){ ?>
                                        <div class="invalid-feedback">
                                            <?=  $validation->getError('jenis_kelamin'); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Kelas</label>
                                    <select name="id_kelas" id="id_kelas" class="form-control <?= isset($err['id_kelas']) ? $err['id_kelas'] ? 'is-invalid' : '' : ''; ?>">
                                        <option value="" selected disabled class="text-center">Pilih Kelas</option>
                                        <?php foreach($kelas as $row){ ?>
                                            <option value="<?= $row['id_kelas'] ?>"><?= $row['nama_kelas'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php if(isset($err['id_kelas'])){ ?>
                                        <div class="invalid-feedback">
                                            <?=  $err['id_kelas'] ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Status Santri</label>
                                    <input type="text" id="status_santri" class="form-control <?= isset($err['status_santri']) ? $err['status_santri'] ? 'is-invalid' : '' : ''; ?>" name="status_santri" value="<?= old('status_santri') ?>">
                                    <?php if(isset($err['status_santri'])){  ?>
                                        <div class="invalid-feedback">
                                            <?=  $err['status_santri']; ?>
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
            $('#id_kelas').select2();
        });
    </script>
<?= $this->endSection() ?>