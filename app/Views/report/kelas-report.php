<!DOCTYPE html>  
<html lang="en">  

<head>  
    <meta charset="UTF-8">  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title><?= $title ?></title>  
    <style>
        .title{
            text-align: center;
        }

        .table{
            text-align: center;
            margin: auto;
        }
    </style>
</head>  

<body>  
    <h2 class="title">Data Santri</h2>
    <p class="title">Kelas <?= $kelas['nama_kelas']?></p>  
    <table border=1 width=80% cellpadding=4 cellspacing=0 class="table">  
        <thead>    
            <tr bgcolor=silver align=center>  
                <td>No</td>
                <td>NIS</td>  
                <td>Nama Santri</td>  
                <td>Jenis Kelamin</td>  
                <td>Status Santri</td>  
            </tr>    
        </thead>    
        <tbody>
            <?php $no = 1;
                foreach($siswa as $row): ?>
            <tr>
                <td><?= $no++ ?></td>  
                <td><?= $row['nis'] ?></td>  
                <td><?= $row['nama_santri'] ?></td>  
                <td><?= $row['jenis_kelamin'] ?></td>  
                <td><?= $row['status_santri'] ?></td>  
            </tr>
            <?php endforeach ?>
        </tbody>
</table>  
<p>Jumlah Siswa : <?= count($siswa) ?></p>  
</body>  

</html>