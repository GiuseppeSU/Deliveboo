<?php

namespace App\Functions;

use Illuminate\Support\Str;
class Helpers
{
    // Funzione che legge il contenuto di un file csv esportandoli in una variabile
    public static function getCsvContent(string $path)
    {
        $data = [];

        $file = fopen($path, 'r');

        if ($file === false) {
            exit('Error. Missing or corrupted file.');
        }

        while (($row = fgetcsv($file)) !== FALSE) {
            $data[] = $row;
        }

        return $data;
    }

    // Funzione che genera uno slug
    public static function generateSlug(string $string) {
        return Str::slug($string, '-');
    }
}