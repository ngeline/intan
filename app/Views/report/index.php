<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">Rekap</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Rekap</li>
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
                        <div class="card-header bg-warning">
                            <h3 class="card-title">Filter Data</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="card-title">PILIH TIPE LAPORAN</h4>
                                    <select name="tipe" id="tipe" class="form-control">
                                        <option value="" selected disabled class="text-center">========== Pilih Tipe Laporan ==========</option>
                                        <option value="kelas">Kelas</option>
                                        <option value="spp">Sumbangan Pembinaan Pendidikan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="card-footer">
                            <button type="button" class="btn btn-secondary float-right" id="btn-select">Tampilkan Form</button>
                        </div> -->
                    </div>
                    <div class="card mt-2" id="kelas" style="display:none;">
                        <div class="card-header bg-primary">
                            <h3 class="card-title">Report Kelas</h3>
                        </div>
                        <form action="<?= url_to('laporanKelas') ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <select name="nama_kelas" id="nama_kelas" class="form-control">
                                            <option class="text-center" value="" selected disabled> === Pilih Kelas === </option>
                                            <?php foreach($kelas as $dt):  ?>
                                                <option value="<?= $dt['id_kelas'] ?>"><?= $dt['nama_kelas'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Cetak</button>
                            </div>
                        </form>
                    </div>
                    <div class="card mt-2" id="spp" style="display:none;">
                        <div class="card-header bg-primary">
                            <h3 class="card-title">Report Sumbangan Pembinaan Pendidikan</h3>
                        </div>
                        <form action="<?= url_to('laporanSPP') ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="bulan">Bulan</label>
                                            <input type="text" id="bulan" name="bulan" placeholder="Pilih Bulan" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kelas">Kelas</label>
                                            <select name="kelas" id="kelas" class="form-control">
                                                <option class="text-center" value="" selected disabled> === Pilih Kelas === </option>
                                                <?php foreach($kelas as $dt):  ?>
                                                    <option value="<?= $dt['id_kelas'] ?>"><?= $dt['nama_kelas'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Cetak</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>

<?= $this->section('footer') ?>
    <script>
        $(document).ready(function(){
            let kelas = document.createAttribute('action');
            kelas.value = null;
            let spp = document.createAttribute('action');
            spp.value = null;

            $('#tipe').on('click', function(e){
                e.preventDefault();
                let dt = $(this).val();
                console.log(dt)
                if(dt === 'kelas'){
                    $('#kelas').each(function(){
                        $(this).show();
                    })
                    $('#spp').each(function(){
                        $(this).hide();
                    })
                }
                if(dt === 'spp'){
                    $('#spp').each(function(){
                        $(this).show();
                    })
                    $('#kelas').each(function(){
                        $(this).hide();
                    })
                }
            })
        });
    </script>
    <script>
        $("#bulan").datepicker({
            format: "MM",
            viewMode: "months", 
            minViewMode: "months"
        });
    </script>
<?= $this->endSection() ?>