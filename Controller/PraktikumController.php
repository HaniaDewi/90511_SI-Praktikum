<?php

class PraktikumController
{
    private $model;

    /**
     * Function ini adalah konstruktor yang berguna menginisialisasi Obyek PraktikumModel
     */
    public function __construct()
    {
        $this->model = new PraktikumModel();
    }

    /**
     * Function index berfungsi untuk mengatur tampilan awal
     */
    public function index()
    {
        $data = $this->model->get();
        extract($data);
        require_once("View/praktikum/index.php");
    }

    /**
     * Function create berfungsi untuk mengatur tampilan tambah data
     */

    public function create()
    {
        require_once("View/praktikum/create.php");
    }

    /**
     * Function store berfungsi untuk memproses data untuk ditambahkan
     * Fungsi ini membutuhkan data nama, npm, email dengan metode http request POST
     */

    public function store()
    {
        $nama = $_POST['nama'];
        $tahun = $_POST['tahun'];
        if($this->model->prosesStore($nama, $tahun))
        {
            header("location:index.php?page=praktikum&aksi=view&pesan=Berhasil Menambah Data");
        } else
        {
            header("location:index.php?page=praktikum&aksi=create&pesan=Gagal Menambah Data");
        }
    }

    /**
     * Function ini berfungsi untuk menampilkan halaman edit
     * juga mengambil salah data dari database berdasarkan id
     * funciton ini membutuhkan data id dengan metode http request GET
     */

    public function edit()
    {
        $id = $_GET['id'];
        $data = $this->model->getById($id);

        extract($data);
        require_once("View/praktikum/edit.php");
    }

    /**
     * Function update berfungsi untuk memproses data untuk di update
     * Fungsi ini membutuhkan data nama, tahun dengan metode http request POST
     */

    public function update()
    {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $tahun = $_POST['tahun'];

        if($this->model->storeUpdate($nama, $tahun, $id))
        {
            header("location:index.php?page=praktikum&aksi=view&pesan=Berhasil Mengubah data");
        } else
        {
            header("location:index.php?page=praktikum&aksi=edit&pesan=Gagal Mengubah data&id=$id");
        }
    }

    /**
     * Function ini berfungsi untuk memproses update salah satu field data
     * Function ini membutuhkan data id dengan metode http request GET
     */

    public function aktifkan()
    {
        $id = $_GET['id'];
        if($this->model->prosesAktifkan($id))
        {
            header("location:index.php?page=praktikum&aksi=view&pesan=Berhasil Meng-aktifkan data");
        } else
        {
            header("location:index.php?page=praktikum&aksi=edit&pesan=Gagal Meng-aktifkan data&id=$id");
        }
    }

    /**
     * Function ini berfungsi untuk memproses update salah satu field data
     * Function ini membutuhkan data id dengan metode http request GET
     */

    public function nonAktifkan()
    {
        $id = $_GET['id'];
        if($this->model->prosesNonAktifkan($id))
        {
            header("location:index.php?page=praktikum&aksi=view&pesan=Berhasil Non-Aktifkan data");
        } else
        {
            header("location:index.php?page=praktikum&aksi=edit&pesan=Gagal Non-Aktifkan data&id=$id");
        }
    }
}

?>