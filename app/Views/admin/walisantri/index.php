<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">Wali santri</h1>
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
                            <h3 class="card-title">Data Wali Santri</h3>
                            <a href="/walisantri/tambah-walisantri" class="btn btn-success float-right">Tambah Data</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>ID User</th>
                                    <th>NIS</th>
                                    <th>ID Admin</th>
                                    <th>Nama Santri</th>
                                    <th>Tempat</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Usia Santri</th>
                                    <th>Alamat</th>
                                    <th>Nama Ayah</th>
                                    <th>Nama Ibu</th>
                                    <th>No Telp</th>
                                    <th>Pekerjaan Ayah</th>
                                    <th>Pekerjaan Ibu</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php  
                                $no = 1;
                                foreach($walisantri as $data): ?>
                                <tr>
                                    <th scope="row"><?= $no++ ?></th>
                                    <td><?= $data['nama_wali'] ?></td>
                                    <td>
                                        <a href="walisantri/<?= $data['id_walisantri']?>" class="btn btn-sm btn-success">Detail</a>
                                        <form action="/walisantri/<?= $data['id_walisantri'] ?>" method="post" class="d-inline">
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
                                <th>ID</th>
                                    <th>ID User</th>
                                    <th>NIS</th>
                                    <th>ID Admin</th>
                                    <th>Nama Santri</th>
                                    <th>Tempat</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Usia Santri</th>
                                    <th>Alamat</th>
                                    <th>Nama Ayah</th>
                                    <th>Nama Ibu</th>
                                    <th>No Telp</th>
                                    <th>Pekerjaan Ayah</th>
                                    <th>Pekerjaan Ibu</th>
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