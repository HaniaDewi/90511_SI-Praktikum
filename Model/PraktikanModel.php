<?php
class PraktikanModel
{
    /**
     * Function get untuk mengambil seluruh data praktikan
     * @param integer id berisi id praktikan
     **/
    public function get($id)
    {
        $sql = "SELECT * FROM praktikan WHERE id = $id";
        $query = koneksi()->query($sql);
        return $query->fetch_assoc();
    }  

    /**
     * Funtion ini untuk mengatur tampilan awal halaman praktikan
     */
    public function index(){
        $id = $_SESSION['praktikan']['id'];
        $data = $this->get($id);
        extract($data);
        require_once("View/praktikan/index.php");
    }

    /**
     * Funtion getPraktikum berfungsi untuk mengambil data praktikum yang aktif
     */
    public function getPraktikum(){
        $sql = "SELECT * FROM praktikum WHERE status = 1";
        $query = koneksi()->query($sql);
         $hasil = [];
         while($data = $query->fetch_assoc()){
             $hasil = $data;
            }
        return $hasil;
    }

    /**
     * Funtion daftarPraktikum untuk mengatur tampilan halaman daftar praktikum 
     */
    public function daftarPraktikum(){
        $data = $this->getPraktikum();
        extract($data);
        require_once("View/praktikan/daftarPraktikum.php");
    }

    /**
     * Function getPendaftaranPraktikum untuk mengambil data pendaftaran praktikum yang dilakukan praktikan
     * @param integer idPraktikan berisi id Praktikan
     */
    public function getPendaftaranPraktikum($idPraktikan)
    {
        $sql = "SELECT daftarprak.id as idDaftar , praktikum.nama as namaPraktikum , praktikum.id as idPraktikum , daftarprak.status FROM daftarprak
        JOIN praktikum on praktikum.id = daftarprak.praktikum_id
        WHERE daftarprak.praktikan_id = $idPraktikan";
        $query = koneksi()->query($sql);
        $hasil = [];
        while($data = $query->fetch_assoc()){
            $hasil = $data;
           }
       return $hasil;
    }

    /**
     * Function praktikum untuk mengatur tampilan halam praktikum praktikan
     */
    public function praktikum(){
        $idPraktikan = $_SESSION['praktikan']['id'];
        $data = $this->getPendaftaranPraktikum($idPraktikan);
        extract($data);
        require_once("View/praktikan/praktikum.php");
    }

    /**
     * Function getModul untuk mengambil data modul dari praktikum yang aktif
     */
    public function getModul(){
        $sql = "SELECT modul.id as idModul , modul.nama as namaModul FROM modul
        JOIN praktikum on praktikum.id = modul.praktikum_id
        WHERE praktikum.status = 1";
        $query = koneksi()->query($sql);
        $hasil = [];
        while($data = $query->fetch_assoc()){
            $hasil = $data;
           }
       return $hasil;
    }

    /**
     * Function getNilaiPraktikan untuk mengambil data nilai praktikan dari setiap praktikum
     * @param integer idPraktikan berisi id praktikan
     * @param integer idPraktikum berisi id praktikum
    */
    public function getNilaiPraktikan($idPraktikan, $idPraktikum){
        $sql = "SELECT * FROM nilai
        JOIN modul on modul.id = nilai.modul_id
        WHERE praktikan_id = $idPraktikan
        AND praktikum_id = $idPraktikum
        ORDER BY modul.id";
        $query = koneksi()->query($sql);
        $hasil = [];
        while($data = $query->fetch_assoc()){
            $hasil = $data;
           }
       return $hasil;
    }

    /**
     * Function nilaiPraktikan untuk mengatur halaman nilai praktikum yang dilakukan oleh praktikan
     */
    public function nilaiPraktikan(){
        $idPraktikan = $_SESSION['praktikan']['id'];
        $idPraktikum = $_GET['idPraktikum'];
        $modul = $this->getModul();
        $nilai = $this->getNilaiPraktikan($idPraktikan, $idPraktikum);
        extract($modul);
        extract($nilai);
        require_once("View/praktikan/nilaiPraktikan.php");
    }
    
}

$tes = new PraktikanModel ();
var_export(tes->get(1));
die();