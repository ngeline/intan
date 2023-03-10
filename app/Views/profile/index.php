
<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">My Profile</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Edit Profile</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <?php if(session()->getFlashdata('success')){  ?>
                <div class="alert alert-warning" role="alert">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php }else if(session()->getFlashdata('error')){ ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit My Profile</h3>
                        </div>
                        <?php if($u_group['group_id'] == 1 ){ ?>
                            <form action="<?= url_to('update.profile', $user['id']) ?>" method="POST" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputName">Email</label>
                                        <input type="text" id="email" class="form-control" name="email" placeholder="Email" value="<?= old('email') ? old('email') : $user['email'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">Username</label>
                                        <input type="text" id="username" class="form-control" name="username" placeholder="Username" value="<?= old('username') ? old('username') : $user['username'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">Password</label>
                                        <input type="password" id="password" class="form-control  <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" name="password" placeholder="Password" value="<?= old('password') ?>">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-block">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        <?php }else{ ?>
                            <form action="<?= isset($walisantri['id_admin']) ?  url_to('update.profile', $user['id']) : url_to('updateInsert.profile', $user['id']) ?>" method="POST" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputName">Email</label>
                                        <input type="text" id="email" class="form-control" name="email" placeholder="Email" value="<?= old('email') ? old('email') : $user['email']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">Username</label>
                                        <input type="text" id="username" class="form-control" name="username" placeholder="Username" value="<?= old('username') ? old('username') : $user['username'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">Password</label>
                                        <input type="password" id="password" class="form-control  <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" name="password" placeholder="Password" value="<?= old('password') ?>">
                                    </div>
                                </div>
                                <hr class="bg-danger">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputName">ID Admin</label>
                                        <input type="text" id="id_admin" class="form-control" name="id_admin" placeholder="ID Admin" value="<?= old('id_admin') ? old('id_admin') : (isset($walisantri['id_admin']) ? $walisantri['id_admin'] : 3);  ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">Nama Wali Santri</label>
                                        <input type="text" id="nama_walisantri" class="form-control  <?= ($validation->hasError('nama_walisantri')) ? 'is-invalid' : ''; ?>" name="nama_walisantri" placeholder="Nama Wali Santri" value="<?= old('nama_walisantri', (isset($walisantri['nama_walisantri']) ? $walisantri['nama_walisantri'] : '')) ?>">
                                        <?php if($validation->hasError('nama_walisantri')){ ?>
                                            <div class="invalid-feedback">
                                                <?=  $validation->getError('nama_walisantri'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">NIS Santri</label>
                                        <?php if(isset($walisantri['nis'])){ ?>
                                            <input type="text" name="nis" class="form-control" value="<?= $walisantri['nis'] ?>" readonly>
                                        <?php }else{ ?>
                                            <select name="nis" id="nis-walisantri" class="form-control <?= ($validation->hasError('nis') ? 'is-invalid' : ''); ?>">
                                                <option value="" selected disabled class="text-center">Pilih Santri</option>
                                                <?php foreach($santri as $row): ?>
                                                <option value="<?= $row['nis'] ?>" <?= (old('nis', (isset($walisantri['nis']) ? $walisantri['nama_walisantri'] : '')) ? 'selected' : '')?>><?= $row['nis'].' | '.$row['nama_santri'] ?></option>
                                                <?php endforeach;?>
                                            </select>
                                        <?php } ?>
                                        <?php if($validation->hasError('nis')){ ?>
                                            <div class="invalid-feedback">
                                                <?=  $validation->getError('nis'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control <?= ($validation->hasError('jenis_kelamin') ? 'is-invalid' : ''); ?>">
                                            <option value="" selected disabled class="text-center">Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki" <?= (old('jenis_kelamin', (isset($walisantri['jenis_kelamin']) ? $walisantri['jenis_kelamin'] : '')) == 'Laki-laki' ? 'selected' : '')?>>Laki-Laki</option>
                                            <option value="Perempuan" <?= (old('jenis_kelamin', (isset($walisantri['jenis_kelamin']) ? $walisantri['jenis_kelamin'] : '')) == 'Perempuan' ? 'selected' : '')?>>Perempuan</option>
                                        </select>
                                        <?php if($validation->hasError('jenis_kelamin')){ ?>
                                            <div class="invalid-feedback">
                                                <?=  $validation->getError('jenis_kelamin'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">Tempat Lahir</label>
                                        <input type="text" id="tempat" class="form-control <?= ($validation->hasError('tempat') ? 'is-invalid' : ''); ?>" name="tempat" value="<?= old('tempat', isset($walisantri['tempat']) ? $walisantri['tempat'] : '') ?>" placeholder="Tempat Lahir">
                                        <?php if($validation->hasError('tempat')){ ?>
                                            <div class="invalid-feedback">
                                                <?=  $validation->getError('tempat'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">Tanggal Lahir</label>
                                        <input type="date" id="tanggal_lahir" class="form-control <?= ($validation->hasError('tanggal_lahir') ? 'is-invalid' : ''); ?>" name="tanggal_lahir" value="<?= old('tanggal_lahir', isset($walisantri['tanggal_lahir']) ? $walisantri['tanggal_lahir'] : '') ?>">
                                        <?php if($validation->hasError('jenis_kelamin')){ ?>
                                            <div class="invalid-feedback">
                                                <?=  $validation->getError('jenis_kelamin'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">Usia Santri</label>
                                        <input type="number" id="usia_santri" class="form-control <?= ($validation->hasError('usia_santri') ? 'is-invalid' : ''); ?>" name="usia_santri" value="<?= old('usia_santri', isset($walisantri['usia_santri']) ? $walisantri['usia_santri'] : '') ?>" placeholder="Tempat Lahir">
                                        <?php if($validation->hasError('usia_santri')){ ?>
                                            <div class="invalid-feedback">
                                                <?=  $validation->getError('usia_santri'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">Alamat</label>
                                        <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control <?= ($validation->hasError('alamat') ? 'is-invalid' : ''); ?>" placeholder="Alamat Lengkap"><?= old('alamat', isset($walisantri['alamat']) ? $walisantri['alamat'] : '')?></textarea>
                                        <?php if($validation->hasError('alamat')){ ?>
                                            <div class="invalid-feedback">
                                                <?=  $validation->getError('alamat'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">Nama Ayah</label>
                                        <input type="text" id="nama_ayah" class="form-control <?= ($validation->hasError('nama_ayah') ? 'is-invalid' : ''); ?>" name="nama_ayah" value="<?= old('nama_ayah', isset($walisantri['nama_ayah']) ? $walisantri['nama_ayah'] : '') ?>" placeholder="Nama Ayah">
                                        <?php if($validation->hasError('nama_ayah')){ ?>
                                            <div class="invalid-feedback">
                                                <?=  $validation->getError('nama_ayah'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">Pekerjaan Ayah</label>
                                        <input type="text" id="pekerjaan_ayah" class="form-control <?= ($validation->hasError('pekerjaan_ayah') ? 'is-invalid' : ''); ?>" name="pekerjaan_ayah" value="<?= old('pekerjaan_ayah', isset($walisantri['pekerjaan_ayah']) ? $walisantri['pekerjaan_ayah'] : '') ?>" placeholder="Pekerjaan Ayah">
                                        <?php if($validation->hasError('pekerjaan_ayah')){ ?>
                                            <div class="invalid-feedback">
                                                <?=  $validation->getError('pekerjaan_ayah'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">Nama Ibu</label>
                                        <input type="text" id="nama_ibu" class="form-control <?= ($validation->hasError('nama_ibu') ? 'is-invalid' : ''); ?>" name="nama_ibu" value="<?= old('nama_ibu', isset($walisantri['nama_ibu']) ? $walisantri['nama_ibu'] : '') ?>" placeholder="Nama Ibu">
                                        <?php if($validation->hasError('nama_ibu')){ ?>
                                            <div class="invalid-feedback">
                                                <?=  $validation->getError('nama_ibu'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">Pekerjaan Ibu</label>
                                        <input type="text" id="pekerjaan_ibu" class="form-control <?= ($validation->hasError('pekerjaan_ibu') ? 'is-invalid' : ''); ?>" name="pekerjaan_ibu" value="<?= old('pekerjaan_ibu', isset($walisantri['pekerjaan_ibu']) ? $walisantri['pekerjaan_ibu'] : '') ?>" placeholder="Pekerjaan Ibu">
                                        <?php if($validation->hasError('pekerjaan_ibu')){ ?>
                                            <div class="invalid-feedback">
                                                <?=  $validation->getError('pekerjaan_ibu'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">No Telepon</label>
                                        <input type="number" id="no_telepon" class="form-control <?= ($validation->hasError('no_telepon') ? 'is-invalid' : ''); ?>" name="no_telepon" value="<?= old('no_telepon', isset($walisantri['no_telepon']) ? $walisantri['no_telepon'] : '') ?>" placeholder="Nomor Telepon">
                                        <?php if($validation->hasError('no_telpon')){ ?>
                                            <div class="invalid-feedback">
                                                <?=  $validation->getError('no_telpon'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-block">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        <?php } ?>
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
        $(document).ready(function() {
            $('#jenis_kelamin').select2();
            $('#nis-walisantri').select2();
        });
    </script>
<?= $this->endSection() ?>