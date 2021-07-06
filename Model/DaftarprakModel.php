<?php
class DaftarPrakModel
{
    /**
     * Function get berfungsi untuk mengambil seluruh data praktikan yang telah mendaftar praktikum
     */
    public function get()
    {
        $sql = "SELECT daftarprak.id as idDaftar, daftarprak.praktikan_id as id_Praktikan,
        praktikan.nama as namaPraktikan, daftarprak.status as status, praktikum.nama as namaPraktikum
        from daftarprak
        join praktikan on praktikan.id = daftarprak.praktikan_id
        join praktikum on praktikum.id = daftarprak.praktikum_id
        where praktikum.status = 1";
        $query = koneksi()->query($sql);
        $hasil = [];
        while ($data = $query->fetch_assoc())
        {
            $hasil[] = $data;
        }
        return $hasil;
    }

    /**
     * Function prosesVerif berfungsi untuk mengupdate status pada database yang telah diverifikasi
     * @param integer id berisi id
     * @param integer idAslab berisi id aslab
     */

    public function prosesVerif($id, $idAslab)
    {
        $sql = "UPDATE daftarprak SET status = 1, aslab_id = $idAslab WHERE id = $id";
        $query = koneksi()->query($sql);
        return $query;
    }

    /**
     * Function unVerif berfungsi untuk membatalkan status verifikasi
     * @param integer id berisi id
     * @param integer idPraktikan berisi id praktikan
     */
    public function prosesUnVerif($id, $idPraktikan)
    {
        // echo $id,$idPraktikan;
        $sqlDelete = "DELETE FROM nilai WHERE praktikan_id = $idPraktikan";
        koneksi()->query($sqlDelete);

        $sqlUpdate = "UPDATE daftarprak SET status = 0, aslab_id = NULL WHERE id = $id";
        $query = koneksi()->query($sqlUpdate);
        return $query;
    }

    
}
// $tes = new DaftarPrakModel();
// var_export($tes->prosesUnVerif(3,3));
// die();
?>