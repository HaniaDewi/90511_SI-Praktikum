<?php

class PraktikanModel
{
    /**
     * Function get berfungsi untuk mengambil seluruh data praktikan
     * @param integer id berisi id praktikan
     */
    public function get($id)
    {
        $sql = "SELECT * from praktikan where id = $id";
        $query = koneksi()->query($sql);
        return $query->fetch_assoc();
    }


    /**
     * Function getPraktikum berfungsi untuk mengambil seluruh data praktikum yang aktif
     */
    public function getPraktikum()
    {
        $sql = "SELECT * from praktikum where status = 1";
        $query = koneksi()->query($sql);
        $hasil = [];
        while ($data = $query->fetch_assoc())
        {
            $hasil[] = $data;
        }
        return $hasil;
    }

    /**
     * Function getPendaftaranPraktikum berfungsi untuk mengambil data pendaftaran praktikum praktikan
     * @param integer idPraktikan berisi idpraktikan
     */
    public function getPendaftaranPraktikum($idPraktikan)
    {
        $sql = "SELECT daftarprak.id
        as idDaftar, praktikum.nama
        as namaPraktikum, praktikum.id
        as idPraktikum,
        daftarprak.status from daftarprak join praktikum on praktikum.id = daftarprak.praktikum_id
        where daftarprak.praktikan_id = $idPraktikan";

        $query = koneksi()->query($sql);
        $hasil = [];
        while ($data = $query->fetch_assoc())
        {
            $hasil[] = $data;
        }
        return $hasil;
    }


    /**
     * Function getModul berfungsi untuk mengambil data modul dari praktikan yang aktif
     */
    public function getModul($idPraktikum)
    {
        $sql = "SELECT modul.id as idModul, modul.nama as namaModul from modul join praktikum on praktikum.id
        = modul.praktikum_id where modul.praktikum_id = $idPraktikum";
        $query = koneksi()->query($sql);
        $hasil = [];
        while($data = $query->fetch_assoc())
        {
            $hasil[] = $data;
        }
        return $hasil;
    }

    /**
     * Function getNilaiPraktikan berfungsi untuk mengambil data nilai praktikan di tiap praktikum
     * @param integer idPraktikan berisi id praktikan
     */
    public function getNilaiPraktikan($idPraktikan, $idPraktikum)
    {
        $sql = "SELECT * from nilai join modul on modul.id = nilai.modul_id
        where praktikan_id = $idPraktikan
        and praktikum_id = $idPraktikum
        order by modul.id";
        $query = koneksi()->query($sql);
        $hasil = [];
        while($data = $query->fetch_assoc())
        {
            $hasil[] = $data;
        }
        return $hasil;
    }


    /**
     * Function update berfungsi untuk update data praktikan pada database
     * @param String nama berisi nama praktikan
     * @param String npm berisi npm praktikan
     * @param String password berisi password
     * @param String no_hp berisi nomor hp praktikan
     * @param String id berisi id praktikan
     */
    public function prosesUpdate($nama, $npm, $password, $no_hp, $id)
    {
        $sql = "UPDATE praktikan SET nama = '$nama', npm = '$npm', password='$password', nomor_hp = '$no_hp' WHERE
        id='$id'";
        $query = koneksi()->query($sql);
        return $query;
    }


    /**
     * Function StorePraktikum berfungsi untuk input data daftar praktikum ke database
     * @param integer idPraktikan berisi id praktikan
     * @param integer idPraktikum berisi id praktikum
     */
    public function prosesStorePraktikum($idPraktikan, $idPraktikum)
    {
        $sql = "INSERT INTO daftarprak(praktikan_id, praktikum_id, status) VALUES($idPraktikan, $idPraktikum,0)";
        $query = koneksi()->query($sql);
        return $query;
    }

    
}
// $tes = new PraktikanModel();
// var_export($tes->get(5));
// die();
?>