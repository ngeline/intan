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
                <li class="breadcrumb-item active">Sumbangan Pembinaan Pendidikan</li>
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
                <?php if($role == 1){ ?>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h3 class="card-title">Filter Data</h3>
                        </div>
                        <form action="<?= url_to('spp.search') ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4 class="card-title">Dari Tanggal</h4>
                                        <input type="date" value="<?= (isset($fromDate)) ? $fromDate : date('Y-m-d') ?>" name="fromDate" id="fromDate" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <h4 class="card-title">Ke Tanggal</h4>
                                        <input type="date" value="<?= (isset($toDate)) ? $toDate : date('Y-m-d') ?>" name="toDate" id="fromDate" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <h4 class="card-title">Status</h4>
                                        <select name="status" id="status" class="form-control">
                                            <option value="1" <?= (isset($status) && $status == 1) ? 'Selected' : '' ?>>Terkonfirmasi</option>
                                            <option value="0" <?= (isset($status) && $status == 0) ? 'Selected' : '' ?>>Belum Terkonfirmasi</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-secondary float-right" id="cari">Cari Data</button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php } ?>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data SPP</h3>
                            <a href="<?= url_to('create.spp') ?>" class="btn btn-success float-right">Tambah Data</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama Santri</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah Iuran</th>
                                    <th>Keterangan</th>
                                    <th>Bukti Pembayaran</th>
                                    <?php if($status == 0) {?>
                                    <th>Action</th>
                                    <?php }?>
                                </tr>
                            </thead>
                            <tbody>
                            <?php  
                                $no = 1;
                                foreach($spp as $data): ?>
                                <tr>
                                    <th scope="row"><?= $no++ ?></th>
                                    <td><?= $data['nis'] ?></td>
                                    <td><?= $data['nama_santri'] ?></td>
                                    <td><?= $data['tanggal'] ?></td>
                                    <td><?= $data['jumlah_iuran'] ?></td>
                                    <td><?= $data['keterangan'] ?></td>
                                    <td><img src="<?= ($data['foto'] != null) ? base_url('img/'.$data['foto']) : base_url('img/default.jpg') ?>" alt="" width="150"></td>
                                    <?php if($status == 0) {?>
                                    <td>
                                            <a href="<?= url_to('edit.spp', $data['id']) ?>" class="btn btn-sm btn-success">Detail</a>
                                                <button type="button" class="btn btn-sm btn-warning" onclick="konfirmasi(<?= $data['id'] ?>)">Konfirmasi</button>
                                            <form action="<?= url_to('delete.spp', $data['id']) ?>" method="post" class="d-inline">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Anda Yakin Menghapus Data Ini?')">Delete</button>
                                            </form>
                                        </td>
                                    <?php }?>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama Santri</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah Iuran</th>
                                    <th>Keterangan</th>
                                    <th>Bukti Pembayaran</th>
                                    <?php if($status == 0) {?>
                                    <th>Action</th>
                                    <?php }?>
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

<?= $this->section('footer') ?>
    <script>
        function konfirmasi(id){
            var konfirm = confirm('Anda Yakin Konfirmasi SPP Ini?')
            if(konfirm == true){
                window.location = '<?= site_url('/sumbangan-pembinaan-pendidikan/konfirmasi') ?>/'+id
            }
        }
    </script>
<?= $this->endSection() ?>