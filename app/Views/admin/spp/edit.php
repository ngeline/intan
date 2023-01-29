<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">Kelas</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item">Sumbangan Pembinaan Pendidikan</li>
                <li class="breadcrumb-item active">Edit Data</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <?php if(session()->getFlashdata('error')){  ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">General</h3>
                        </div>
                        <form action="<?= url_to('update.spp', $spp['id']) ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">ID Admin</label>
                                    <input type="text" id="id_admin" class="form-control" name="id_admin" placeholder="ID Admin" value="<?= old('id_admin', $spp['id_admin']) ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">NIS | Nama Santri</label>
                                    <select name="nis" id="nis" class="form-control <?= ($validation->hasError('nis')) ? 'is-invalid' : ''; ?>">
                                        <option value="" selected disabled class="text-center">PILIH SISWA</option>
                                        <?php foreach($santri as $row): ?>
                                            <option value="<?= $row['nis'] ?>" <?= old('nis', $spp['nis']) ? 'selected' : '' ?>><?= $row['nis'].' | '.$row['nama_santri'] ?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <?php if($validation->hasError('nis')){ ?>
                                        <div class="invalid-feedback">
                                            <?=  $validation->getError('nis'); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Pembayaran</label>
                                    <input type="date" name="tanggal" id="tanggal" class="form-control <?= ($validation->hasError('tanggal')) ? 'is-invalid' : ''; ?>" placeholder="Tanggal" value="<?= old('tanggal', $spp['tanggal']) ?>">
                                    <?php if($validation->hasError('tanggal')){ ?>
                                        <div class="invalid-feedback">
                                            <?=  $validation->getError('tanggal'); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Jumlah Iuran</label>
                                    <input type="number" name="jumlah_iuran" id="jumlah_iuran" class="form-control <?= ($validation->hasError('tanggal')) ? 'is-invalid' : ''; ?>" placeholder="Jumlah Iuran" value="<?= old('jumlah_iuran', $spp['jumlah_iuran']) ?>">
                                    <?php if($validation->hasError('jumlah_iuran')){ ?>
                                        <div class="invalid-feedback">
                                            <?=  $validation->getError('jumlah_iuran'); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" cols="30" rows="10" class="form-control"><?= old('keterangan', $spp['keterangan']) ?></textarea>
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