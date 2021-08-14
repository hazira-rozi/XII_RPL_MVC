<?php session_unset();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="~/../libs/fontawesome/css/font-awesome.css" rel="stylesheet" />    
    <link rel="stylesheet" href="~/../libs/bootstrap.css"> 
    <script src="~/../libs/jquery.min.js"></script>
    <script src="~/../libs/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 1280;
            
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <br/>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <a href="index.php" class="btn btn-success pull-left">Home</a>
                        <h2 class="pull-left">Detail Siswa</h2>
                        <a href="view/insert.php" class="btn btn-success pull-right">Tambahkan Siswa Baru</a>
                    </div>
                    <?php
                        if($result->num_rows > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";                                        
                                        echo "<th>Nama Lengkap</th>";
                                        echo "<th>Panggilan</th>";
                                        echo "<th>Tanggal Lahir</th>";
                                        echo "<th>Alamat</th>";
                                        echo "<th>Nomor HP</th>";
                                        echo "<th>Kelas</th>";
                                        echo "<th>NISN</th>";
                                        echo "<th>Sekolah</th>";
                                        echo "<th>Jurusan</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";                                        
                                        echo "<td>" . $row['nama'] . "</td>";
                                        echo "<td>" . $row['panggilan'] . "</td>";
                                        echo "<td>" . $row['ttl'] . "</td>";                                        
                                        echo "<td>" . $row['alamat'] . "</td>";
                                        echo "<td>" . $row['no_hp'] . "</td>";
                                        echo "<td>" . $row['kelas'] . "</td>";                                        
                                        echo "<td>" . $row['nisn'] . "</td>";
                                        echo "<td>" . $row['sekolah'] . "</td>";
                                        echo "<td>" . $row['jurusan'] . "</td>";
                                        echo "<td>";
                                        echo "<a href='index.php?act=update&id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><i class='fa fa-edit'></i></a>";
                                        echo "<a href='index.php?act=delete&id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><i class='fa fa-trash'></i></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>