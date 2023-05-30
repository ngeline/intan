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
                            <a href="<?= url_to('create.walisantri') ?>" class="btn btn-success float-right">Tambah Data</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NIS | Nama Santri</th>
                                    <th>Nama Wali Santri</th>
                                    <th>Email Wali Santri</th>
                                    <th>TTL</th>
                                    <th>Usia Santri</th>
                                    <th>Alamat</th>
                                    <th>No Telp</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php  
                                $no = 1;
                                foreach($walisantri as $data): ?>
                                <tr>
                                    <th scope="row"><?= $no++ ?></th>
                                    <td><?= $data['nis'].' | '.$data['nama_santri'] ?></td>
                                    <td><?= $data['nama_walisantri'] ?></td>
                                    <td><?= $data['email'] ?></td>
                                    <td><?= $data['tempat'].', '.$data['tanggal_lahir'] ?></td>
                                    <td><?= $data['usia_santri'].' Tahun' ?></td>
                                    <td><?= $data['alamat'] ?></td>
                                    <td><?= $data['no_telepon'] ?></td>
                                    <td>
                                        <a href="<?= url_to('edit.walisantri', $data['id_walisantri']) ?>" class="btn btn-sm btn-success">Detail</a>
                                        <form action="<?= url_to('delete.walisantri', $data['id_walisantri']) ?>" method="post" class="d-inline">
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
                                    <th>NIS</th>
                                    <th>Nama Santri</th>
                                    <th>TTL</th>
                                    <th>Usia Santri</th>
                                    <th>Alamat</th>
                                    <th>No Telp</th>
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