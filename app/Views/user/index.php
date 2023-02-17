<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">User Aplikasi</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">User Aplikasi</li>
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
                            <h3 class="card-title">Data User Pengguna Aplikasi</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role User</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php  
                                $no = 1;
                                foreach($user as $data): ?>
                                <tr>
                                    <th scope="row"><?= $no++ ?></th>
                                    <td><?= $data['username'] ?></td>
                                    <td><?= $data['email'] ?></td>
                                    <td><?= $data['role'] ?></td>
                                    <td><?= ($data['active'] == 0) ? '<span class="p-1 bg-danger">Belum Aktivasi</span>' : '<span class="p-1 bg-primary">Aktivasi</span>' ?></td>
                                    <td>
                                        <?php if($data['role'] != 'admin'){ ?>
                                            <?= ($data['active'] == 0) ? '<button type="submit" class="btn btn-sm btn-primary" onclick="aktivasi('.$data["u_id"].')">Aktivasi</button>' : '<button type="submit" class="btn btn-sm btn-danger" onclick="blokir('.$data["u_id"].')">Blokir User</button>'; ?>
                                        <?php }else{ ?>
                                            <span class="p-1 bg-warning text-sm" disabled><small> Teraktivasi</small></span>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role User</th>
                                    <th>Status</th>
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

<?= $this->section('footer') ?>
<script>
    function aktivasi(id){
        confirm = confirm('Aktivasi User Ini?')
        if(confirm == true){
            window.location = '<?= site_url('user/aktivasi') ?>/'+id
        }
    }

    function blokir(id){
        confirm = confirm('Blokir User Ini?')
        if(confirm == true){
            window.location = '<?= site_url('user/blokir') ?>/'+id
        }
    }
</script>
<?= $this->endSection() ?>