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
            <h1 class="m-0 text-dark">SPP</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item">Sumbangan Pembinaan Pendidikan</li>
                <li class="breadcrumb-item active">Tambah Data</li>
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
                            <h3 class="card-title">General</h3>
                        </div>
                        <form action="<?= url_to('store.spp') ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">ID Admin</label>
                                    <input type="text" id="id_admin" class="form-control" name="id_admin" placeholder="ID Admin" value="<?= old('id_admin') ? old('id_admin') : $id_admin ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">NIS | Nama Santri</label>
                                    <select name="nis" id="nis" class="form-control <?= isset($err['nis']) ? $err['nis'] ? 'is-invalid' : '' : ''; ?>" <?= ($u_group['group_id'] == 2) ? 'readonly' : '' ?>>
                                        <option value="" selected disabled class="text-center">PILIH SISWA</option>
                                        <?php if($u_group['group_id'] == 1) {?>
                                            <?php foreach($santri as $row): ?>
                                                <option value="<?= $row['nis'] ?>" <?= old('nis') ? 'selected' : '' ?>><?= $row['nis'].' | '.$row['nama_santri'] ?></option>
                                            <?php endforeach;?>
                                        <?php }else{?>
                                            <?php foreach($santri as $row): ?>
                                                <option value="<?= $row['nis'] ?>" <?= ($row['nis'] == $walisantri['nis']) ? 'selected' : '' ?>><?= $row['nis'].' | '.$row['nama_santri'] ?></option>
                                            <?php endforeach;?>
                                        <?php }?>
                                    </select>
                                    <?php  if(isset($err['nis'])){  ?>
                                        <div class="invalid-feedback">
                                            <?=  $err['nis']; ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Pembayaran</label>
                                    <input type="date" name="tanggal" id="tanggal" class="form-control <?= isset($err['tanggal']) ? $err['tanggal'] ? 'is-invalid' : '' : ''; ?>" placeholder="Tanggal" value="<?= old('tanggal') ?>">
                                    <?php  if(isset($err['tanggal'])){  ?>
                                        <div class="invalid-feedback">
                                            <?=  $err['tanggal']; ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Jumlah Iuran</label>
                                    <input type="number" name="jumlah_iuran" id="jumlah_iuran" class="form-control <?= isset($err['jumlah_iuran']) ? $err['jumlah_iuran'] ? 'is-invalid' : '' : ''; ?>" placeholder="Jumlah Iuran" value="<?= old('jumlah_iuran') ?>">
                                    <?php  if(isset($err['jumlah_iuran'])){  ?>
                                        <div class="invalid-feedback">
                                            <?=  $err['jumlah_iuran']; ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" cols="30" rows="10" class="form-control <?= isset($err['keterangan']) ? $err['keterangan'] ? 'is-invalid' : '' : ''; ?>"><?= old('keterangan') ?></textarea>
                                    <?php  if(isset($err['keterangan'])){  ?>
                                        <div class="invalid-feedback">
                                            <?=  $err['keterangan']; ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <input type='file' name="bukti_pembayaran" id="bukti_pembayaran" class="form-control  mb-2" required />
                                    <img src="<?= base_url('img/default.jpg') ?>" id="preview" src="#" alt="your image" width="200px"/>
                                    <?php  if(isset($err['bukti_pembayaran'])){  ?>
                                        <div class="invalid-feedback">
                                            <?=  $err['bukti_pembayaran']; ?>
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
<?php if($u_group['group_id'] == 1 || $u_group['group_id'] == 2){?>
    <?= $this->section('footer') ?>
        <script>
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#preview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            
            $(document).ready(function() {
                $('#jenis_kelamin').select2();

                $("#bukti_pembayaran").change(function() {
                    readURL(this);
                });

            });
        </script>
    <?= $this->endSection() ?>
<?php }?>