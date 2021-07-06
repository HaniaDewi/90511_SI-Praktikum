<?php
class PraktikumModel
{
    /**
     * Function get berfungsi untuk mengambil seluruh data dari database
     */
    public function get()
    {
        $sql = "SELECT  * from praktikum";
        $query = koneksi()->query($sql);
        $hasil = [];
        while  ($data = $query->fetch_assoc())
        {
            $hasil[] = $data;
        }
        return $hasil;
    }


    /**
     * Function prosesStore berfungsi untuk input data praktikum
     * @param String $nama berisi nama praktikum
     * @param String $tahun berisi nama praktikum
     */

     public function prosesStore($nama, $tahun)
     {
         $sql = "INSERT INTO praktikum(nama, tahun) VALUES ('$nama', '$tahun')";
         return koneksi()->query($sql);
     }


    /**
     * Function update berungsi untuk mengubah data di database
     * @param String $nama berisi data nama
     * @param String $tahun berisi data tahun
     * @param Integer $id  berisi id dari suatu data di database
     */

     public function storeUpdate($nama, $tahun, $id)
     {
         $sql = "UPDATE praktikum SET nama='$nama', tahun = '$tahun' WHERE id = $id";
         return koneksi()->query($sql);
     }


    /**
     * Function aktifkan ini untuk merubah salah satu field di storage
     * @param Integer $id berisi id dari suatu data di database
     */

     public function prosesAktifkan($id)
     {
         koneksi()->query(("UPDATE praktikum SET status=0")); // Merubah status praktikum yang aktif menjadi tidak aktif
         $sql = "UPDATE praktikum SET status=1 WHERE id = $id";
         return koneksi()->query($sql);
     }


     /**
     * Function aktifkan ini untuk merubah salah satu field di storage
     * @param Integer $id berisi id dari suatu data di database
     */

    public function prosesNonAktifkan($id)
    {
        $sql = "UPDATE praktikum SET status=0 WHERE id = $id";
        return koneksi()->query($sql);
    }


    /**
     * Function getById berfungsi untuk mengambil satu data dari database
     * @param Integer $id berisi id dari suatu data di database
     */

     public function getById($id)
     {
         $sql = "SELECT * FROM praktikum WHERE id = $id";
         $query = koneksi()->query($sql);
         return $query->fetch_assoc();
     }
    
}
// $tes = new PraktikumModel();
// var_export($tes->prosesAktifkan(1));
// die();
?>