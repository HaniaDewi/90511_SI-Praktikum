<?php
class AslabModel
{
    /**
     * @param integer $idAslab berisi idAslab
     * Function get berfungsi untuk mengambil seluruh data praktikan dari database
     */

    public function get($idAslab)
    {
        $sql = "SELECT praktikan_id as idPraktikan, praktikan.nama as namaPraktikan, praktikan.npm as npmPraktikan,
        praktikan.nomor_hp as nohpPraktikan, praktikum.nama as namaPraktikum from praktikan join daftarprak on
        daftarprak.praktikan_id = praktikan.id join praktikum on daftarprak.praktikum_id = praktikum.id where
        daftarprak.status = 1 and daftarprak.aslab_id = $idAslab and praktikum.status = 1";

        $query = koneksi()->query($sql);
        $hasil = [];
        while ($data = $query->fetch_assoc())
        {
            $hasil[] = $data;
        }
        return $hasil;
    }

    /**
     * Function getModul berfungsi untuk mengambil seluruh data modul
     */
    public function getModul()
    {
        $sql  = "SELECT modul.id as idModul, modul.nama as namaModul from modul join praktikum on praktikum.id
        = modul.praktikum_id where praktikum.status = 1";
        $query = koneksi()->query($sql);
        $hasil = [];
        while($data = $query->fetch_assoc())
        {
            $hasil[] = $data;
        }
        return $hasil;
    }

    /**
     * @param integer $idPraktikan berisi idPraktikan
     * Function getNilaiPraktikan berfungsi untuk mengambil seluruh data nilai praktikan dari database sesuai
     * dengan idnya
     */
    public function getNilaiPraktikan($idPraktikan)
    {
        $sql = "SELECT * from nilai join modul on modul.id = nilai.modul_id where praktikan_id  = $idPraktikan
        order by modul.id";
        $query = koneksi()->query($sql);
        $hasil = [];
        while ($data = $query->fetch_assoc())
        {
            $hasil[] = $data;
        }
        return $hasil;
    }

    /**
     * @param integer idModul berisi id Modul
     * @param integer idPraktikan berisi id praktikan
     * @param integer nilai berisi nilai praktikan
     * Function prosesStoreNilai berfungsi untuk melakukan insert nilai praktikan ke database nilai sesuai dengan
     * id praktikan dan id permodul 
     */
    public function prosesStoreNilai($idModul, $idPraktikan, $nilai)
    {
        $sqlCek = "SELECT * FROM nilai WHERE modul_id = $idModul and praktikan_id = $idPraktikan";
        $cek = koneksi()->query($sqlCek);
        if($cek->fetch_assoc() == null){
            $sqlInsert = "INSERT INTO nilai(modul_id, praktikan_id, nilai) VALUES ($idModul, $idPraktikan, $nilai)";
            $query = koneksi()->query($sqlInsert);
        }else{
            $sqlUpdate = "UPDATE nilai SET nilai = '$nilai' WHERE modul_id = $idModul and praktikan_id = $idPraktikan";
            $query = koneksi()->query($sqlUpdate);
        }
        return $query;
    }

    
}
// $tes = new AslabModel();
// var_export($tes->prosesStoreNilai(1, 1, 90));
// die();
?>