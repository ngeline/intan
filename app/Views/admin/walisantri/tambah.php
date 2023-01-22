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
            <?php if(session()->getFlashdata('error')){  ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Data Wali Santri</h3>
                        </div>
                        <form action="/kelas/tambah-kelas" method="POST" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">ID Admin</label>
                                    <input type="text" id="id_admin" class="form-control" name="id_admin" placeholder="ID Admin" value="<?= old('id_admin') ? old('id_admin') : 2 ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Nama Santri</label>
                                    <input type="text" id="nama_santri" class="form-control <?= ($validation->hasError('nama_santri') ? 'is-invalid' : ''); ?>" name="nama_santri" placeholder="Nama Wali Santri" value="<?= old('nama_santri') ?>" >
                                    <?php if($validation->hasError('nama_santri')){ ?>
                                        <div class="invalid-feedback">
                                            <?=  $validation->getError('nama_santri'); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Jenis Kelamin</label>
                                    <input type="text" id="jenis_kelamin" class="form-control" name="jenis_kelamin" value="<?= $walisantri['jenis_kelamin'] ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Tempat</label>
                                    <input type="text" id="tempat" class="form-control" name="tempat" value="<?= $walisantri['tempat'] ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Tanggal Lahir</label>
                                    <input type="date" id="tanggal_lahir" class="form-control" name="tanggal_lahir" value="<?= $walisantri['tanggal_lahir'] ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Alamat</label>
                                    <input type="text" id="alamat" class="form-control" name="alamat" value="<?= $walisantri['alamat'] ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Nama Ayah</label>
                                    <input type="text" id="nama_ayah" class="form-control" name="nama_ayah" value="<?= $walisantri['nama_ayah'] ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Pekerjaan Ayah</label>
                                    <input type="text" id="pekerjaan_ayah" class="form-control" name="pekerjaan_ayah" value="<?= $walisantri['pekerjaan_ayah'] ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Nama Ibu</label>
                                    <input type="text" id="nama_ibu" class="form-control" name="nama_ibu" value="<?= $walisantri['nama_ibu'] ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Pekerjaan Ibu</label>
                                    <input type="text" id="pekerjaan_ibu" class="form-control" name="pekerjaan_ibu" value="<?= $walisantri['pekerjaan_ibu'] ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Nama Wali Santri</label>
                                    <input type="text" id="nama_walisantri" class="form-control <?= ($validation->hasError('nama_walisantri') ? 'is-invalid' : ''); ?>" name="nama_walisantri" placeholder="Nama Wali Santri" value="<?= old('nama_walisantri') ?>" >
                                    <?php if($validation->hasError('nama_walisantri')){ ?>
                                        <div class="invalid-feedback">
                                            <?=  $validation->getError('nama_walisantri'); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">No Telepon</label>
                                    <input type="number" id="no_telepon" class="form-control" name="no_telepon" value="<?= $walisantri['no_telepon'] ?>" readonly>
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