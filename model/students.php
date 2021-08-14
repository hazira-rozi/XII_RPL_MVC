<?php

class students
{
    // table fields
    public $id;
    public $nama;
    public $panggilan;
    public $ttl;
    public $alamat;
    public $no_hp;
    public $kelas;
    public $nisn;
    public $sekolah;
    public $jurusan;
    // message string
    public $id_msg;
    public $nama_msg;
    public $panggilan_msg;
    public $ttl_msg;
    public $alamat_msg;
    public $no_hp_msg;
    public $kelas_msg;
    public $nisn_msg;
    public $sekolah_msg;
    public $jurusan_msg;
    // constructor set default value
    function __construct()
    {
        $id=0;$nama=$panggilan=$ttl=$alamat=$no_hp=$kelas= $nisn= $sekolah= $jurusan="";
        $id_msg=$nama_msg=$panggilan_msg= $ttl_msg= $alamat_msg= $no_hp_msg= $kelas_msg= $nisn_msg = $sekolah_msg = $jurusan_msg="";
    }
}

?>