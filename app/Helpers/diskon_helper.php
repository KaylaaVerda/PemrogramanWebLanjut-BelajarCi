<?php

if (!function_exists('hitung_diskon')) {
    /**
     * Hitung diskon berdasarkan total pembelian sebelum ongkir.
     *
     * @param float|int $total
     * @return array{diskon:int,persentase:int}
     */
    function hitung_diskon($total)
    {
        $total = (float) $total;

        if ($total >= 50000000) {
            $persentase = 15;
        } elseif ($total >= 30000000) {
            $persentase = 10;
        } elseif ($total >= 10000000) {
            $persentase = 5;
        } else {
            $persentase = 0;
        }

        $diskon = (int) round($total * $persentase / 100);

        return [
            'diskon'     => $diskon,
            'persentase' => $persentase,
        ];
    }
}
