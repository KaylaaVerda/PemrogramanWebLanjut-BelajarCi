<?php

if (!function_exists('hitung_biaya_admin')) {
    function hitung_biaya_admin($total_harga)
    {
        $total = (float) $total_harga;

        if ($total <= 20000000) {
            $persentase = 0.5;
        } else {
            $persentase = 0.75;
        }

        return (int) round($total * $persentase / 100);
    }
}

if (!function_exists('hitung_diskon_kupon')) {
    function hitung_diskon_kupon($total_harga, $kupon_code)
    {
        $total = (float) $total_harga;
        $kode = strtoupper(trim((string) ($kupon_code ?? '')));

        $persentase = 0;
        if ($kode === 'HEMAT') {
            $persentase = 15;
        } elseif ($kode === 'SUPER') {
            $persentase = 20;
        }

        return [
            'kode' => $kode !== '' ? $kode : null,
            'persentase' => $persentase,
            'diskon' => (int) round($total * $persentase / 100),
            'valid' => $persentase > 0,
        ];
    }
}

if (!function_exists('hitung_cashback')) {
    function hitung_cashback($total_harga)
    {
        $total = (float) $total_harga;

        if ($total > 10000000) {
            return (int) round($total * 2 / 100);
        }

        return 0;
    }
}
