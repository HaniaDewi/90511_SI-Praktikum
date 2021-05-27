<?php
class PraktikanController
{
    private $model;
    /**
     * function construct berguna untuk menginisialisasi objek PraktikanModel
     */
    public function __construct()
    {
        $this->model = new PraktikanModel();
    }
    /**
     * Function ini untuk mengatur tampilan awal halaman praktikan
     */
    public function index(){
        $id = $_SESSION['praktikan']['id'];
        $data = $this->model->get($id);
        extract($data);
        require_once("View/praktikan/index.php");
    }
    /**
     * function edit untuk menampilkan form edit
     */
    public function edit()
    {
        $id = $_SESSION['praktikan']['id'];
        $data = $this->model->get($id);
        extract($data);
        require_once("View/praktikan/edit.php");
    }
    /**
     * function update untuk menyimpan hasil edit
     */
    public function update()
    {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $npm = $_POST['npm'];
        $no_hp = $_POST['no_hp'];
        $password = $_POST['password'];

        if ($this->model->prosesUpdate($nama, $npm, $password, $no_hp, $id)) {
            header("location:index.php?page=praktikan&aksi=view&pesan=Berhasil Ubah Data");
        } else {
            header("location:index.php?page=praktikan&aksi=edit&pesan=Gagal Ubah Data");
        }
    }
    /**
     * Function praktikum untuk mengatur tampilan halam praktikum praktikan
     */
    public function praktikum(){
        $idPraktikan = $_SESSION['praktikan']['id'];
        $data = $this->model->getPendaftaranPraktikum($idPraktikan);
        extract($data);
        require_once("View/praktikan/praktikum.php");
    }
    /**
     * Function daftarPraktikum untuk mengatur tampilan halaman daftar praktikum 
     */
    public function daftarPraktikum(){
        $data = $this->model->getPraktikum();
        extract($data);
        require_once("View/praktikan/daftarPraktikum.php");
    }
    /**
     * function storePraktikan untuk memproses data praktikum yang dipilih untuk ditambahkan
     */
    public function storePraktikum()
    {
        $praktikum = $_POST['praktikum'];
        $idPraktikan = $_SESSION['praktikan']['id'];
        if ($this->model->prosesStorePraktikum($idPraktikan, $idPraktikum)) {
            header("location:index.php?page=praktikan&aksi=praktikum&pesan=Berhasil Daftar Praktikum");
        } else {
            header("location:index.php?page=praktikan&aksi=daftarPraktikum&pesan=Gagal Daftar Praktikum");
        }
    }
    /**
     * Function nilaiPraktikan untuk mengatur halaman nilai praktikum yang dilakukan oleh praktikan
     */
    public function nilaiPraktikan(){
        $idPraktikan = $_SESSION['praktikan']['id'];
        $idPraktikum = $_GET['idPraktikum'];
        $modul = $this->model->getModul();
        $nilai = $this->model->getNilaiPraktikan($idPraktikan, $idPraktikum);
        extract($modul);
        extract($nilai);
        require_once("View/praktikan/nilaiPraktikan.php");
    }
}
?>