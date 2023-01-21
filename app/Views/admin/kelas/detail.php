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
                <li class="breadcrumb-item active">Kelas</li>
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
                        <form action="/kelas/update/<?= $kelas['id_kelas'] ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">ID Kelas</label>
                                    <input type="text" id="id_kelas" class="form-control" name="id_kelas" value="<?= $kelas['id_kelas'] ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">ID Admin</label>
                                    <input type="text" id="id_admin" class="form-control" name="id_admin" value="<?= $kelas['id_admin'] ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Nama Kelas</label>
                                    <input type="text" id="nama_kelas" class="form-control <?= ($validation->hasError('nama_kelas') ? 'is-invalid' : ''); ?>" name="nama_kelas" value="<?= $kelas['nama_kelas'] ?>">
                                    <?php if($validation->hasError('nama_kelas')){ ?>
                                        <div class="invalid-feedback">
                                            <?=  $validation->getError('nama_kelas'); ?>
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