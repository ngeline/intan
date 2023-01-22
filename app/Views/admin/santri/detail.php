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
                <li class="breadcrumb-item active">Santri</li>
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
                        <form action="/santri/update/<?= $santri['id_santri'] ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">ID Santri</label>
                                    <input type="text" id="id_santri" class="form-control" name="id_santri" value="<?= $santri['id_santri'] ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">ID Admin</label>
                                    <input type="text" id="id_admin" class="form-control" name="id_admin" value="<?= $santri['id_admin'] ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Nama Santri</label>
                                    <input type="text" id="nama_santri" class="form-control <?= ($validation->hasError('nama_santri') ? 'is-invalid' : ''); ?>" name="nama_santri" value="<?= $santri['nama_santri'] ?>">
                                    <?php if($validation->hasError('nama_santri')){ ?>
                                        <div class="invalid-feedback">
                                            <?=  $validation->getError('nama_santri'); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Jenis Kelamin</label>
                                    <input type="text" id="jenis_kelamin" class="form-control" name="jenis_kelamin" value="<?= $santri['jenis_kelamin'] ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Status Santri</label>
                                    <input type="text" id="status_santri" class="form-control" name="status_santri" value="<?= $santri['id_admin'] ?>" readonly>
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