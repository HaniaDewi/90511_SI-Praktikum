<?php

class AslabModel
{
    /**
     * function get untuk mengambil seluruh data praktikan dari database
     **/
    public function get($idAslab)
    {
        $sql = "SELECT praktikan.id as idPraktikan , praktikan.nama as namaPraktikan , praktikan.npm as npmPraktikan , praktikan.nomor_hp as nohpPraktikan , praktikum.nama as namaPraktikum FROM praktikan
        JOIN daftarprak ON daftarprak.praktikan_id = praktikan.id
        JOIN praktikum ON daftarprak.praktikum_id = praktikum.id
        WHERE daftarprak.status = 1
        AND daftarprak.aslab_id = $idAslab
        AND praktikum.status = 1";
        $query = koneksi()->query($sql);
        $hasil = [];
        while($data = $query->fetch_assoc()){
            $hasil = $data;
        }
        return $hasil;
    }

    /**
     * Function index untuk tampilan awal
     **/
    public function index(){
        $idAslab = $_SESSION['aslab']['id'];
        $data = $this->get($idAslab);
        extract($data);
        require_once("View/aslab/index.php");
    }

    /**
     * Function getModul untuk mengambil seluruh data dari modul
     **/
    public function getModul(){
        $sql = "SELECT modul.id as idModul , modul.nama as namaModul FROM modul
        JOIN praktikum ON praktikum.id = modul.praktikum_id
        WHERE praktikum.status = 1";
         $query = koneksi()->query($sql);
         $hasil = [];
         while($data = $query->fetch_assoc()) {
             $hasil = $data;
            }
        return $hasil;
    }

    /**
     * @param integer $idPraktikan berisi idPraktikan
     * function getNilaiPraktikan untuk mengambil seluruh data nilai praktikan dari database
     * sesuai dengan id nya
     **/
    public function getNilaiPraktikan($idPraktikan){
        $sql = "SELECT * from nilai
        JOIN modul on modul.id = nilai.modul_id
        WHERE praktikan_id = $idPraktikan
        ORDER BY modul.id";
          $query = koneksi()->query($sql);
          $hasil = [];
          while ($data = $query->fetch_assoc()) {
             $hasil = $data;
            }
         return $hasil;
    }

    /**
     * @param integer idModul berisi id modul
     * @param integer idPraktikan berisi id praktikan
     * @param integer nilai berisi nilai praktikan
     * function prosesStoreNilai untuk melakukan insert nilai praktikan ke database nilai sesuai dengan id praktikan dan id permodul
     */
    public function prosesStoreNilai($idModul, $idPraktikan, $nilai){
        $sqlCek = "SELECT * FROM nilai WHERE modul_id=$idModul and praktikan_id=$idPraktikan";
        $cek = koneksi()->query($sqlCek);
        if ($cek->fetch_assoc() == null){
            $sqlInsert = "INSERT INTO nilai(modul_id,praktikan_id,nilai) VALUES($idModul,$idPraktikan,$nilai)";
            $query = koneksi()->query($sqlInsert);
        } else {
            $sqlUpdate = "UPDATE nilai SET nilai='$nilai' WHERE modul_id=$idModul and praktikan_id=$idPraktikan";
            $query = koneksi()->query($sqlUpdate);
        }
        return $query;
    }

}
//$tes = new AslabModel();
//var_export($tes->prosesStoreNilai(1, 2, 80));
//die();
