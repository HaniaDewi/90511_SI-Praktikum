<?php

class ModulController
{
    private $model;

    /**
     * Function ini adalah konstruktor yang berguna menginisialisasi Obyek ModulModel
     */
    public function __construct()
    {
        $this->model = new ModulModel();
    }

    /**
     * Function index berfungsi untuk mengatur tampilan awal
     */
    public function index()
    {
        $data = $this->model->get();
        extract($data);
        require_once("View/modul/index.php");
    }

    /**
     * Function create berfungsi untuk mengatur ke halaman create modul
     */

    public function create()
    {
        $data = $this->model->getPraktikum();
        extract($data);
        require_once("View/modul/create.php");
    }

    /**
     * Function store berfungsi untuk menyimpan data modul yang telah di inputan oleh aslab
     */

    public function store()
    {
        $modul = $_POST['modul'];
        $praktikum = $_POST['praktikum'];
        $getLastData = $this->model->getLastData();

        if($getLastData == null)
        {
            for($i = 1; $i <=$modul; $i++){
                $nama = 'Modul ' . $i;//Modul 1
                $post = $this->model->prosesStore($nama, $praktikum);
            }
        } else
        {
            $modulLast = explode(" ", $getLastData['nama']);

            for($i = 1; $i<=$modul; $i++){
                $a = $modulLast['1']+=1;
                $nama = 'Modul ' . $a;//Modul 1
                $post = $this->model->prosesStore($nama, $praktikum);
            }
        }

        if($post)
        {
            header("location: index.php?page=modul&aksi=view&pesan=Berhasil Menambah Data");
        } else
        {
            header("location: index.php?page=modul&aksi=create&pesan=Gagal Menambah Data");
        }
    }

    /**
     * Function delete berfungsi untuk menghapus modul
     */

    public function delete()
    {
        $id = $_GET['id'];
        if($this->model->prosesDelete($id)){
            header("location: index.php?page=modul&aksi=view&pesan=Berhasil Delete Data");
        } else{
            header("location: index.php?page=modul&aksi=view&pesan=Gagal Delete Data");
        }
    }
}

?>