<?php

/**
 * @author: nguyentinh
 * @create: 06/20/20, 8:21 PM
 */

namespace App\Traits;

trait ExcelTrait
{
    public function colA(): int
    {
        return 0;
    }

    public function colB(): int
    {
        return 1;
    }

    public function colC(): int
    {
        return 2;
    }

    public function colD(): int
    {
        return 3;
    }

    public function colE(): int
    {
        return 4;
    }

    public function colF(): int
    {
        return 5;
    }

    public function colG(): int
    {
        return 6;
    }

    public function colH(): int
    {
        return 7;
    }

    public function colI(): int
    {
        return 8;
    }

    public function colJ(): int
    {
        return 9;
    }

    public function colK(): int
    {
        return 10;
    }

    public function colL(): int
    {
        return 11;
    }

    public function colM(): int
    {
        return 12;
    }

    public function colN(): int
    {
        return 13;
    }

    public function colO(): int
    {
        return 14;
    }

    public function colP(): int
    {
        return 15;
    }

    public function colQ(): int
    {
        return 16;
    }

    public function colR(): int
    {
        return 17;
    }

    public function colS(): int
    {
        return 18;
    }

    public function colT(): int
    {
        return 19;
    }

    public function colU(): int
    {
        return 20;
    }

    public function colV(): int
    {
        return 21;
    }

    public function colW(): int
    {
        return 22;
    }

    public function colX(): int
    {
        return 23;
    }

    public function colY(): int
    {
        return 24;
    }

    public function colZ(): int
    {
        return 25;
    }

    public function colAA(): int
    {
        return 26;
    }

    public function colAB(): int
    {
        return 27;
    }

    public function colAC(): int
    {
        return 28;
    }

    public function colAD(): int
    {
        return 29;
    }

    public function colAE(): int
    {
        return 30;
    }

    public function colAF(): int
    {
        return 31;
    }

    public function colAG(): int
    {
        return 32;
    }

    public function colAH(): int
    {
        return 33;
    }

    public function colAI(): int
    {
        return 34;
    }

    public function colAJ(): int
    {
        return 35;
    }

    /**
     * @param string $string
     * -    format excel: ngay/thang/nam gio:phut
     * @return string
     */
    private function formatDateTime(string $string): string
    {
        if (empty($string)) {
            return '';
        }

        $string = trim($string);
        $arr = explode(' ', $string);
        $date = $arr[0];
        $time = $arr[1];
        $date = explode('/', $date);

        $date = $date[2] . '-' . $date[1] . '-' . $date[0] . ' ' . $time;

        return date('Y-m-d H:i:s', strtotime($date));
    }

    /**
     * @param string $string
     * -    format excel: ngay/thang/nam
     *
     * @return string
     */
    private function formatDate(string $string): string
    {
        if (empty($string)) {
            return '';
        }

        $string = trim($string);
        $date = explode('/', $string);

        $date = $date[2] . '-' . $date[1] . '-' . $date[0];

        return $date;
    }
}
