<?php
namespace App\Repositories;

use Illuminate\Support\Str;

class Encryptor
{
    
    public function __construct($key, $increase)
    {
        $this->key = (string) $key;
        $this->increase = $increase;
    }

    public function hash(string $plainText)
    {
        $plainText = "{$this->key}|{$plainText}"; 

        $splitted = str_split($plainText);
        
        $converted = null;
        
        foreach($splitted as $character) {
            $converted .= ord($character) + 5 . ":";
        }

        return $this->shuffle($converted);
    }

    public function shuffle(string $converted)
    {
        $characters = strlen($converted);
        $minusRight = $characters - 9;
        $minusLeft = 9;
        $appKey = str_replace('base64:', '', config('app.key'));
        $left  = substr($appKey, 0, $minusLeft);
        $right = substr($appKey, -9, $minusRight);
        $stamp = time() * 3;
        $converted = rtrim($converted, ":");
        return "{$stamp}{$left}{$converted}{$right}{$stamp}";
    }
}