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
                <td>Jumlah Iuran</td>  
                <td>Tanggal Iuran</td>  
                <td>Keterangan</td>  
            </tr>    
        </thead>    
        <tbody>
            <?php $no = 1;
                foreach($santri as $row): 
                    if(empty($row)){
                        $spp = $db->query(
                            "SELECT * FROM spp
                            WHERE nis = 0 AND MONTH(tanggal) = ".$bulan.""
                        );
                    }else{
                        $spp = $db->query(
                            "SELECT * FROM spp
                            WHERE nis = ".$row['nis']." AND MONTH(tanggal) = ".$bulan.""
                        )->getResultArray();
                    }
                foreach($spp as $dt): 
                ?>
            <tr>
                <td><?= $no++ ?></td>  
                <td><?= $dt['nis'] ?></td>  
                <td><?= $dt['nama_santri'] ?></td>  
                <td><?= $dt['jumlah_iuran'] ?></td>  
                <td><?= $dt['tanggal'] ?></td>  
                <td><?= $dt['keterangan'] ?></td>  
            </tr>
            <?php endforeach ?>
            <?php endforeach ?>
        </tbody>
</table>  
</body>  

</html>