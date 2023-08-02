<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function beranda()
    {
        // Penampung Tahun jika kosong
        $tahun = '';

        // Masuk ke halaman App
        return view('app', compact('tahun'));
    }

    public function ambilData(Request $request)
    {

        // Mengambil Value dari select tahun
        $tahun = $request->tahun;

        // Parameter nilai sebagai penampung total
        $nilai = 0;

        // Ambil API
        $apiMenu = Http::get('http://tes-web.landa.id/intermediate/menu');
        $apiTransaksi = Http::get('http://tes-web.landa.id/intermediate/transaksi?tahun=' . $tahun);

        // Format API Menu ke JSON
        $menu = json_decode($apiMenu);


        // Format API Transaksi ke JSON
        $transaksi = json_decode($apiTransaksi);

        // Merubah Format Dalam Bahasa Indonesia
        setlocale(LC_ALL, 'id-ID', 'id_ID');


        // Jika berhasil mengambil Value Tahun
        if ($tahun) {

            // MENGHITUNG TOTAL KESELURUHAN
            foreach ($transaksi as $hasil) {
                $nilai += $hasil->total;
            }

            // MEMBUAT PENAMPUNG UNTUK MENGHITUNG TOTAL MENU PERBULAN
            foreach ($menu as $item) {
                for ($i = 1; $i <= 12; $i++) {
                    $result[$item->menu][$i] = 0;
                }
            }

            // MENGHITUNG TOTAL MENU PERBULAN
            foreach ($transaksi as $data) {
                $bulan = date('n', strtotime($data->tanggal));
                $result[$data->menu][$bulan] += $data->total;
            }

            // MEMBUAT PENAMPUNG UNTUK JUMLAH TRANSAKSI PER BULAN
            foreach ($transaksi as $jml) {
                for ($i = 1; $i <= 12; $i++) {
                    $jumlah[$i] = 0;
                }
            }

            // MENGHITUNG JUMLAH TOTAL TRANSAKSI PERBULAN
            foreach ($transaksi as $perbulan) {
                $hari = date('n', strtotime($perbulan->tanggal));
                $jumlah[$hari] += $perbulan->total;
            }

            
            // MEMBUAT PENAMPUNG UNTUK TOTAL MENU PERTAHUN
            foreach ($menu as $permenu) {
                $jumlahmenu[$permenu->menu] = 0;
            }

            // MENGHITUNG TOTAL MENU PERTAHUN
            foreach ($transaksi as $jmltrans) {
                $jumlahmenu[$jmltrans->menu] += $jmltrans->total;
            }

            // Sebagai Pengecekan Seluruh Data
            $data = [
                'a' => $menu,
                'b' => $transaksi,
                'c' => $jumlahmenu,
                'd' => $jumlah,
                'e' => $result,
            ];

            return view('app', compact('tahun', 'menu', 'transaksi', 'result', 'nilai', 'jumlah', 'jumlahmenu','data'));
        } else {
            return redirect('/');
        }

    }


}
