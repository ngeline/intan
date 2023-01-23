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
            <?php if(session()->getFlashdata('success')){  ?>
                <div class="alert alert-primary" role="alert">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php }else if(session()->getFlashdata('success-delete')){ ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('success-delete') ?>
                </div>
            <?php }else if(session()->getFlashdata('error')){ ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Santri</h3>
                            <a href="/santri/tambah" class="btn btn-success float-right">Tambah Data</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID Santri</th>
                                    <th>NIS</th>
                                    <th>Nama Santri</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Status Santri</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php  
                                $no = 1;
                                foreach($santri as $data): ?>
                                <tr>
                                    <th scope="row"><?= $no++ ?></th>
                                    <td><?= $data['nama_santri'] ?></td>
                                    <td>
                                        <a href="santri/<?= $data['id_santri']?>" class="btn btn-sm btn-success">Detail</a>
                                        <form action="/santri/<?= $data['id_santri'] ?>" method="post" class="d-inline">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Anda Yakin Menghapus Data Ini?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                <th>ID Santri</th>
                                    <th>NIS</th>
                                    <th>Nama Santri</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Status Santri</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>