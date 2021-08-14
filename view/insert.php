<?php
        require '../model/students.php'; 
        session_start();             
        $studenttb=isset($_SESSION['studenttbl0'])?unserialize($_SESSION['studenttbl0']):new students();            
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Record</title>
    <link rel="stylesheet" href="../libs/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

    <div class="wrapper">
   
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Tambah Siswa</h2>
                    </div>
                    <p>Isilah form untuk menambahkan data pada database</p>
                    <form action="../index.php?act=add" method="post" >
                    
                        <div class="form-group <?php echo (!empty($studenttb->nama)) ? 'has-error' : ''; ?>">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" value="<?php echo $studenttb->nama; ?>">
                            <span class="help-block"><?php echo $studenttb->nama_msg;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($studenttb->panggilan_msg)) ? 'has-error' : ''; ?>">
                            <label>Nama Panggilan</label>
                            <input name="panggilan" class="form-control" value="<?php echo $studenttb->panggilan; ?>">
                            <span class="help-block"><?php echo $studenttb->panggilan_msg;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($studenttb->ttl_msg)) ? 'has-error' : ''; ?>">
                            <label>Tahun Lahir</label>
                            <input name="ttl" class="form-control" value="<?php echo $studenttb->ttl; ?>">
                            <span class="help-block"><?php echo $studenttb->ttl_msg;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($studenttb->alamat)) ? 'has-error' : ''; ?>">
                            <label>Alamat</label>
                            <input type="text" name="alamat" class="form-control" value="<?php echo $studenttb->alamat; ?>">
                            <span class="help-block"><?php echo $studenttb->alamat_msg;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($studenttb->no_hp)) ? 'has-error' : ''; ?>">
                            <label>Nomor HP</label>
                            <input type="text" name="no_hp" class="form-control" value="<?php echo $studenttb->no_hp; ?>">
                            <span class="help-block"><?php echo $studenttb->no_hp_msg;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($studenttb->kelas)) ? 'has-error' : ''; ?>">
                            <label>Kelas</label>
                            <input type="text" name="kelas" class="form-control" value="<?php echo $studenttb->kelas; ?>">
                            <span class="help-block"><?php echo $studenttb->kelas_msg;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($studenttb->nisn)) ? 'has-error' : ''; ?>">
                            <label>NISN</label>
                            <input type="text" name="nisn" class="form-control" value="<?php echo $studenttb->nisn; ?>">
                            <span class="help-block"><?php echo $studenttb->nisn_msg;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($studenttb->sekolah)) ? 'has-error' : ''; ?>">
                            <label>Sekolah</label>
                            <input type="text" name="sekolah" class="form-control" value="<?php echo $studenttb->sekolah; ?>">
                            <span class="help-block"><?php echo $studenttb->sekolah_msg;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($studenttb->jurusan)) ? 'has-error' : ''; ?>">
                            <label>Jurusan</label>
                            <input type="text" name="jurusan" class="form-control" value="<?php echo $studenttb->jurusan; ?>">
                            <span class="help-block"><?php echo $studenttb->jurusan_msg;?></span>
                        </div>
                        <br/>
                        <input type="submit" name="addbtn" class="btn btn-primary" value="Submit">
                        
                        <a href="../index.php" class="btn btn-default">Batal</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>