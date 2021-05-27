<?php
class AslabController
{
    private $model;
    /**
     * function construct berguna untuk menginisialisasi objek aslab model
     */
    public function __construct()
    {
        $this->model = new AslabModel();
    }
    /**
     * function index untuk mengatur tampilan awal
     */
    public function index()
    {
        $idAslab = $_SESSION['aslab']['id'];
        $data = $this->model->get ($idAslab);
        extract($data);
        require_once("View/aslab/index.php");
    }
    /**
     * Function nilai untuk mengatur tampilan halaman data nilai praktikan
     **/
    public function nilai(){
        $idPraktikan = $_GET['id'];
        $modul = $this->model->getModul();
        $nilai = $this->model->getNilaiPraktikan($idPraktikan);
        extract($modul);
        extract($nilai);
        require_once("View/aslab/nilai.php");
    }
    /**
     * function createNilai untuk mengatur halaman input nilai
     */
    public function createNilai()
    {
        $modul = $this->model->getModul();
        extract($modul);
        require_once('View/aslab/createNilai.php');
    }
    /**
     * function storeNilai untuk menyimpan data nilai sesuai dengan id praktikan dari form yang 
     * telah diisi aslab pada halam create nilai
     */
    public function storeNilai(){
        $idModul = $_POST['modul'];
        $idPraktikan = $_GET['id'];
        $nilai = $_POST['nilai'];
        if($this->model->prosesStoreNilai($idModul,$idPraktikan,$nilai)){
            header("location:index.php?page=aslab&aksi=nilai&pesan=Berhasil Tambah Data&id=$idPraktikan");
        } else{
            header("location:index.php?page=aslab&aksi=create&pesan=Gagal Tambah Data&id=$idPraktikan");
        }
    }
}
?>