<?php
class Rute
{
    // koneksi DB
    public $koneksi;

    /**
     * before Action
     */
    public function __construct()
    {
        $k = new Koneksi();
        $this->koneksi = $k->connect();
    }

    /**
     * MENENTUKAN RUTE YANG DILEWATI JALUR SHORTEST PATH
     * @RETURN JSON KOORDINAT RUTE
     */
    public function rute_shortest_path($exp_dijkstra, $old_simpul_awal, $old_simpul_akhir, $maxRow0, $maxRow1)
    {

        // misal exp_dijkstra[] = 1->5->6->7

        $m = 0;
        $old_awal = explode('-', $old_simpul_awal); // misal 4-5
        $old_akhir = explode('-', $old_simpul_akhir); // misal 8-7

        $ganti_a = 0;
        $ganti_b = 0;
        $simpulAwalDijkstra = $exp_dijkstra[0]; // 1

        $gabungSimpul_all = "";
        $listRuteUmum = array();
        $listSimpulRute = array();

        // CARI SIMPUL_OLD (misal 4->6->5) SEBELUM KOORDINAT DIPECAH
        // misal 4-5 dipecah menjadi 4-6-5, berarti simpul_old awal = 4, simpul_old akhir = 5
        // total perulangannnya dikurang 1
        for ($e = 0; $e < (count($exp_dijkstra) - 1); $e++) {
            if ($e == 0) // awal
            {
                // dijalankan jika hasil algo hanya 2 simpul, example : 4->5
                if (count($exp_dijkstra) == 2/* 2 simpul (4->5)*/) {
                    // ada simpul baru di awal (10) dan di akhir (11), example 10->11
                    if ($exp_dijkstra[0] == $maxRow0 && $exp_dijkstra[1] == $maxRow1) {

                        $ganti_b = ($maxRow0 == $old_akhir[0]) ? $old_akhir[1] : $old_akhir[0];

                        $ganti_a = ($ganti_b == $old_awal[0]) ? $old_awal[1] : $old_awal[0];
                    } else {
                        // ada simpul baru di awal (10), example 10->5
                        // maka cari simpul awal yg oldnya
                        if ($exp_dijkstra[0] == $maxRow0) {

                            $ganti_a = ($exp_dijkstra[1] == $old_awal[1]) ? $old_awal[0] : $old_awal[1];

                            $ganti_b = $exp_dijkstra[1];
                        }
                        // ada simpul baru di akhir (10), example 5->10
                        // maka cari simpul akhir yg oldnya
                        else if ($exp_dijkstra[1] == $maxRow0) {

                            $ganti_b = ($exp_dijkstra[0] == $old_akhir[0]) ? $old_akhir[1] : $old_akhir[0];

                            $ganti_a = $exp_dijkstra[0];
                        }
                        // tidak ada penambahan simpul sama sekali
                        else {
                            $ganti_a = $exp_dijkstra[0];
                            $ganti_b = $exp_dijkstra[1];
                        }
                    }
                }
                // hasil algo lebih dr 2 : 4->5->8->7->9 etc ..
                else {

                    // ada simpul baru di awal (10), example 10->5
                    // maka cari simpul awal yg oldnya
                    /*5 == 5*/
                    if ($exp_dijkstra[0] == $maxRow0) {
                        $ganti_a = ($exp_dijkstra[1] == $old_awal[1]) ? $old_awal[0]/*4*/ : $old_awal[1]/*5*/;
                    }
                    // tidak ada simpul baru di awal
                    else {
                        $ganti_a = $exp_dijkstra[0];
                    }

                    $ganti_b = $exp_dijkstra[++$m];
                }
            }
            // akhir
            else if ($e == count($exp_dijkstra) - 2) {
                // simpul terkhir dijkstra
                $simpul_akhir_dijkstra = $exp_dijkstra[(count($exp_dijkstra) - 1)];

                // simpul sebelum terakhir dijkstra
                $simpul_sblm_akhir_dijkstra = $exp_dijkstra[(count($exp_dijkstra) - 2)];

                // ga ada simpul baru
                // array_search() sama seperti in_array(),
                // bedanya return-nya $key/index yg dicari.
                if (false !== $key = array_search($simpul_akhir_dijkstra, $old_akhir)) {
                    $ganti_b = $old_akhir[$key]; // hasil 8 or 7
                }
                // ada simpul baru
                else if ($simpul_akhir_dijkstra == $maxRow0 || $simpul_akhir_dijkstra == $maxRow1) {
                    $ganti_b = ($simpul_sblm_akhir_dijkstra == $old_akhir[0]) ? $old_akhir[1] : $old_akhir[0];
                }
                /*else
                {
                $ganti_b = $old_akhir[1]; // hasil 7
                }*/

                $ganti_a = $exp_dijkstra[$m];

            } else // tengah tengah
            {
                $ganti_a = $exp_dijkstra[$m];
                $ganti_b = $exp_dijkstra[++$m];
            }

            // GABUNG SIMPUL GAK BOLEH SAMA! --> ,5-5,
            //if($ganti_a != $ganti_b){
            $gabung_a_b = "," . $ganti_a . "-" . $ganti_b . ","; // ,1-5,
            //}else{
            //    $gabung_a_b = "";
            //}
            // GABUNG SIMPUL
            $gabungSimpul_all .= $gabung_a_b;
            $gabungSimpul = $gabung_a_b;

            // GET NOMOR TRAYEK RUTE
            $select = "SELECT * FROM rute where simpul like '%" . $gabungSimpul . "%'";
            $query = mysqli_query($this->koneksi, $select);
            //$fetch  = mysqli_fetch_array($query, MYSQLI_ASSOC);

            $listRute = array();
            while ($fetch = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                array_push($listRute, $fetch['no_trayek']);
            }

            // add no_trayek rute
            $listRuteUmum["rute" . $e] = $listRute;
            // add simpul rute
            array_push($listSimpulRute, $exp_dijkstra[$e]);
        }

        $replace_jalur = str_replace(',,', ',', $gabungSimpul_all); //  ,1-5,,5-6,,6-7, => ,1-5,5-6,6-7,
        $select1 = "SELECT count(*) as jml_rute, no_trayek FROM rute where simpul like '%" . $replace_jalur . "%'";
        $query1 = mysqli_query($this->koneksi, $select1);
        $fetch1 = mysqli_fetch_array($query1);

        // SEKALI NAIK RUTE
        // ADA 1/LEBIH RUTE YG MELEWATI JALUR DARI AWAL SAMPEK AKHIR
        // cukup gambar 1 koordinat rute saja
        // die() sampai if ini
        if ($fetch1['jml_rute'] >= 1) {

            $siRute = $fetch1['no_trayek'];

            // get coordinate
            $select2 = "SELECT jalur FROM graph where simpul_awal = '" . $simpulAwalDijkstra . "'";
            $query2 = mysqli_query($this->koneksi, $select2);
            $fetch2 = mysqli_fetch_array($query2);

            $json_coordinate = $fetch2['jalur'];

            // manipulate JSON
            $jObject = json_decode($json_coordinate, true);
            $jArrCoordinates = $jObject["coordinates"];
            $latlngs = $jArrCoordinates[0];

            // first latlng
            $lats = $latlngs[0];
            $lngs = $latlngs[1];

            $return_array = [['koordinat_rute' => ['lat' => $lats, 'lng' => $lngs], 'no_rute' => $siRute]];

            return $return_array;
            die();
        }

        // BERKALI-KALI GANTI RUTE
        // ADA 1/LEBIH RUTE YG MELEWATI JALUR DARI AWAL SAMPEK AKHIR
        // PERINGKAS NOMOR TRAYEK
        $banyakRute = 0;
        $indexUrut = 0;
        $indexSimpulRute = 1;
        $lengthRute = count($listRuteUmum);
        $ruteFix = array();

        for ($en = 0; $en < $lengthRute; $en++) {
            // FIRST LOOPING
            // temporary sementara sebelum di array_intersect()
            $temps = array();
            for ($u = 0; $u < count($listRuteUmum['rute0']); $u++) {
                array_push($temps, $listRuteUmum['rute0'][$u]);
            }

            // SENCOND LOOPING
            if ($en > 0) {
                $listSekarang = $listRuteUmum['rute0'];
                $listSelanjutnya = $listRuteUmum['rute' . $en];

                // INTERSECTION
                // cari elemen yg ada di kedua array, yg tidak ada dihapus di $listSekarang
                // http://php.net/manual/en/function.array-intersect.php
                $listSekarang = array_intersect($listSekarang, $listSelanjutnya);
                $listSekarang = array_values($listSekarang); // 'reindex' array

                if (count($listSekarang) > 0) {

                    unset($listSimpulRute[$indexSimpulRute]);
                    $listSimpulRute = array_values($listSimpulRute); // 'reindex' array
                    --$indexSimpulRute;

                    unset($listRuteUmum['rute' . $en]);

                    // sebelum akhir
                    if ($en == ($lengthRute - 1)) {
                        $tempDalam = array();

                        for ($es = 0; $es < count($listSekarang); $es++) {
                            array_push($tempDalam, $listSekarang[$es]);
                        }

                        $ruteFix['ruteFix' . $indexUrut] = $tempDalam;
                        ++$indexUrut;
                    }
                } else if (count($listSekarang) == 0) {
                    $ruteFix['ruteFix' . $indexUrut] = $temps;

                    $tempDalam = array();
                    for ($es = 0; $es < count($listSelanjutnya); $es++) {
                        array_push($tempDalam, $listSelanjutnya[$es]);
                    }

                    $listRuteUmum['rute0'] = $tempDalam;
                    unset($listRuteUmum['rute' . $en]);

                    ++$indexUrut;

                    if ($en == ($lengthRute - 1)) {
                        $tempDalam2 = array();
                        for ($es = 0; $es < count($listSelanjutnya); $es++) {
                            array_push($tempDalam2, $listSelanjutnya[$es]);
                        }

                        $ruteFix['ruteFix' . $indexUrut] = $tempDalam2;
                        ++$indexUrut;
                    }
                }
                ++$indexSimpulRute;
            }
        }

        // buat return
        $return_array = [];

        // GAMBAR 2 ATAU LEBIH KOORDINAT RUTE UMUM
        foreach ($listSimpulRute as $r => $simpulx) {
            // get coordinate simpulRute
            $select = "SELECT jalur FROM graph where simpul_awal = '" . $simpulx . "'";
            $query = mysqli_query($this->koneksi, $select);
            $fetch = mysqli_fetch_array($query, MYSQLI_ASSOC);

            // dapatkan koordinat Lat,Lng dari field koordinat (3)
            $json_db = $fetch['jalur'];

            // get JSON
            $jObject = json_decode($json_db, true);
            $jArrCoordinates = $jObject['coordinates'];

            // get first coordinate JSON
            $latlngs = $jArrCoordinates[0];
            $lats = $latlngs[0];
            $lngs = $latlngs[1];

            $json['lat'] = $lats;
            $json['lng'] = $lngs;
            $rute = $ruteFix['ruteFix' . $r];

            $gabung_array = ['koordinat_rute' => $json, 'no_rute' => $rute];
            array_push($return_array, $gabung_array);
        }

        return $return_array;
    }
}
