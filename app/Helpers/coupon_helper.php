<?php

if (!function_exists('hitung_kupon')) {
    /**
     * Hitung diskon kupon berdasarkan kode yang dimasukkan.
     *
     * @param float|int $total
     * @param string|null $kode
     * @return array{kode:string|null, valid:bool, persentase:int, diskon:float}
     */
    function hitung_kupon($total, $kode = null)
    {
        $total = (float) $total;
        $kodeInput = trim((string) ($kode ?? ''));
        $kodeUpper = strtoupper($kodeInput);

        $kupon = [
            'kode' => $kodeUpper !== '' ? $kodeUpper : null,
            'valid' => false,
            'persentase' => 0,
            'diskon' => 0,
        ];

        if ($kodeUpper === 'HEMAT') {
            $kupon['valid'] = true;
            $kupon['persentase'] = 15;
        } elseif ($kodeUpper === 'SUPER') {
            $kupon['valid'] = true;
            $kupon['persentase'] = 20;
        }

        if ($kupon['valid']) {
            $kupon['diskon'] = round($total * $kupon['persentase'] / 100, 2);
        }

        return $kupon;
    }
}
