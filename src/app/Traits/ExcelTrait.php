<?php

/**
 * @author: nguyentinh
 * @create: 06/20/20, 8:21 PM
 */

namespace App\Traits;

trait ExcelTrait
{
    public function colA()
    {
        return 0;
    }

    public function colB()
    {
        return 1;
    }

    public function colC()
    {
        return 2;
    }

    public function colD()
    {
        return 3;
    }

    public function colE()
    {
        return 4;
    }

    public function colF()
    {
        return 5;
    }

    public function colG()
    {
        return 6;
    }

    public function colH()
    {
        return 7;
    }

    public function colI()
    {
        return 8;
    }

    public function colJ()
    {
        return 9;
    }

    public function colK()
    {
        return 10;
    }

    public function colL()
    {
        return 11;
    }

    public function colM()
    {
        return 12;
    }

    public function colN()
    {
        return 13;
    }

    public function colO()
    {
        return 14;
    }

    public function colP()
    {
        return 15;
    }

    public function colQ()
    {
        return 16;
    }

    public function colR()
    {
        return 17;
    }

    public function colS()
    {
        return 18;
    }

    public function colT()
    {
        return 19;
    }

    public function colU()
    {
        return 20;
    }

    public function colV()
    {
        return 21;
    }

    public function colW()
    {
        return 22;
    }

    public function colX()
    {
        return 23;
    }

    public function colY()
    {
        return 24;
    }

    public function colZ()
    {
        return 25;
    }

    public function colAA()
    {
        return 26;
    }

    public function colAB()
    {
        return 27;
    }

    public function colAC()
    {
        return 28;
    }

    public function colAD()
    {
        return 29;
    }

    public function colAE()
    {
        return 30;
    }

    public function colAF()
    {
        return 31;
    }

    public function colAG()
    {
        return 32;
    }

    public function colAH()
    {
        return 33;
    }

    public function colAI()
    {
        return 34;
    }

    public function colAJ()
    {
        return 35;
    }

    /**
     * @param $string
     * -    format excel: ngay/thang/nam gio:phut
     * @return string|null
     */
    private function formatDateTime($string)
    {
        if (empty($string)) {
            return null;
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
     * @param $string
     * -    format excel: ngay/thang/nam
     * @return string|null
     */
    private function formatDate($string)
    {
        if (empty($string)) {
            return null;
        }

        $string = trim($string);
        $date = explode('/', $string);

        $date = $date[2] . '-' . $date[1] . '-' . $date[0];

        return $date;
    }
}
