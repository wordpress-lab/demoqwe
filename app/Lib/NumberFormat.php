<?php
/**
 * Created by PhpStorm.
 * User: Ontik Technology 3
 * Date: 06-08-17
 * Time: 10.28
 */

namespace App\Lib;



class NumberFormat {

    public function toText($amt) {
        if (is_numeric($amt)) {
            echo '' . number_format($amt, 0, '.', ',') . '';
            $sign = $amt > 0 ? '' : 'Negative ';
            return $sign . $this->toQuadrillions(abs($amt));
        } else {
            throw new Exception('Only numeric values are allowed.');
        }
    }

    private function toOnes($amt) {
        $words = array(
            0 => 'Zero',
            1 => 'One',
            2 => 'Two',
            3 => 'Three',
            4 => 'Four',
            5 => 'Five',
            6 => 'Six',
            7 => 'Seven',
            8 => 'Eight',
            9 => 'Nine'
        );

        if ($amt >= 0 && $amt < 10)
            return $words[$amt];
        else
            throw new Exception('Array Index not defined');
    }

    private function toTens($amt) { // handles 10 - 99
        $firstDigit = intval($amt / 10);
        $remainder = $amt % 10;

        if ($firstDigit == 1) {
            $words = array(
                0 => 'Ten',
                1 => 'Eleven',
                2 => 'Twelve',
                3 => 'Thirteen',
                4 => 'Fourteen',
                5 => 'Fifteen',
                6 => 'Sixteen',
                7 => 'Seventeen',
                8 => 'Eighteen',
                9 => 'Nineteen'
            );

            return $words[$remainder];
        } else if ($firstDigit >= 2 && $firstDigit <= 9) {
            $words = array(
                2 => 'Twenty',
                3 => 'Thirty',
                4 => 'Fourty',
                5 => 'Fifty',
                6 => 'Sixty',
                7 => 'Seventy',
                8 => 'Eighty',
                9 => 'Ninety'
            );

            $rest = $remainder == 0 ? '' : $this->toOnes($remainder);
            return $words[$firstDigit] . ' ' . $rest;
        }
        else
            return $this->toOnes($amt);
    }

    private function toHundreds($amt) {
        $ones = intval($amt / 100);
        $remainder = $amt % 100;

        if ($ones >= 1 && $ones < 10) {
            $rest = $remainder == 0 ? '' : $this->toTens($remainder);
            return $this->toOnes($ones) . ' Hundred ' . $rest;
        }
        else
            return $this->toTens($amt);
    }

    private function toThousands($amt) {
        $hundreds = intval($amt / 1000);
        $remainder = $amt % 1000;

        if ($hundreds >= 1 && $hundreds < 1000) {
            $rest = $remainder == 0 ? '' : $this->toHundreds($remainder);
            return $this->toHundreds($hundreds) . ' Thousand ' . $rest;
        }
        else
            return $this->toHundreds($amt);
    }

    private function toMillions($amt) {
        $hundreds = intval($amt / pow(1000, 2));
        $remainder = $amt % pow(1000, 2);

        if ($hundreds >= 1 && $hundreds < 1000) {
            $rest = $remainder == 0 ? '' : $this->toThousands($remainder);
            return $this->toHundreds($hundreds) . ' Million ' . $rest;
        }
        else
            return $this->toThousands($amt);
    }

    private function toBillions($amt) {
        $hundreds = intval($amt / pow(1000, 3));
        /* Note:taking the modulos results in a negative value, but
          this seems to work pretty fine */

        $remainder = $amt - $hundreds * pow(1000, 3);

        if ($hundreds >= 1 && $hundreds < 1000) {
            $rest = $remainder == 0 ? '' : $this->toMillions($remainder);
            return $this->toHundreds($hundreds) . ' Billion ' . $rest;
        }
        else
            return $this->toMillions($amt);
    }

    private function toTrillions($amt) {
        $hundreds = intval($amt / pow(1000, 4));
        $remainder = $amt - $hundreds * pow(1000, 4);

        if ($hundreds >= 1 && $hundreds < 1000) {
            $rest = $remainder == 0 ? '' : $this->toBillions($remainder);
            return $this->toHundreds($hundreds) . ' Trillion ' . $rest;
        }
        else
            return $this->toBillions($amt);
    }

    private function toQuadrillions($amt) {
        $hundreds = intval($amt / pow(1000, 5));
        $remainder = $amt - $hundreds * pow(1000, 5);

        if ($hundreds >= 1 && $hundreds < 1000) {
            $rest = $remainder == 0 ? '' : $this->toTrillions($remainder);
            return $this->toHundreds($hundreds) . ' Quadrillion ' . $rest;
        }
        else
            return $this->toTrillions($amt);
    }

}