<?php

if (!function_exists('format_rupiah')) {

    function format_rupiah($amount) {
        if (!is_numeric($amount)) {
            return '0,-'; // Default value for non-numeric input
        }

        // Format number to two decimal places
        $formatted = number_format($amount, 0, ',', '.'); // No decimals
        return $formatted . ',-'; // Append the currency symbol
    }
    //if want return 0,00
//     function format_rupiah($amount) {
//     if (!is_numeric($amount)) {
//         return '0,00'; // or return a default value
//     }
//     $formatted = number_format($amount, 2, ',', '.');
//     return $formatted;
// }
}

if (!function_exists('format_rupiah_tanpa_simbol')) {

    function format_rupiah_tanpa_simbol($amount) {
        if (!is_numeric($amount)) {
            return '0'; // Default value for non-numeric input
        }

        // Format number without decimal and without currency symbol
        return number_format($amount, 0, ',', '.'); // No decimals, no symbol
    }
}

if (!function_exists('getCurrentLocale')) {
    function getCurrentLocale()
    {
        $segments = request()->segments(); // Mendapatkan segmen URL
        return in_array('en', $segments) ? 'en' : 'id'; // Jika 'en' ada di segmen, gunakan 'en', jika tidak, gunakan 'id'.
    }
}

if (!function_exists('capitalizeWords')) {
    function capitalizeWords($string)
    {
        return ucwords($string);
    }
}

if (!function_exists('capitalizeWordsFromUppercase')) {
    function capitalizeWordsFromUppercase($string)
    {
        // Ubah semua huruf menjadi kecil, lalu kapitalisasi setiap awal kata
        return ucwords(strtolower($string));
    }

}

if (!function_exists('formatHarga')) {
    function formatHarga($harga)
    {
        $harga = (float) $harga; // Konversi ke float agar bisa diolah

        if ($harga >= 1000000) {
            // Konversi ke JT dengan mempertahankan 1 angka desimal jika perlu
            return rtrim(rtrim(number_format($harga / 1000000, 1, '.', ','), '0'), '.') . 'JT';
        } elseif ($harga >= 1000) {
            // Konversi ke K dengan mempertahankan 1 angka desimal jika perlu
            return rtrim(rtrim(number_format($harga / 1000, 1, '.', ','), '0'), '.') . 'K';
        }

        // Jika kurang dari 1000, tetap tampilkan dalam format desimal 2 angka
        return number_format($harga, 2, '.', ',');
    }
}