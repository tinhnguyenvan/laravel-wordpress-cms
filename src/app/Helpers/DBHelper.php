<?php
/**
 * Created by PhpStorm.
 * User: nguyentinh
 * Date: 2019-03-19
 * Time: 11:19.
 */

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class DBHelper
{
    /**
     * @param     $name
     * @param int $timeout
     *
     * @return bool
     */
    public static function getLock($name, $timeout = 1): bool
    {
        $results = DB::select('SELECT GET_LOCK(?, ?) as res', [$name, $timeout]);

        return !empty($results[0]) && 1 === $results[0]->res;
    }

    /**
     * @param $name
     */
    public static function releaseLock($name)
    {
        DB::select('SELECT RELEASE_LOCK(?)', [$name]);
    }

    /**
     * @param $name
     */
    public static function isFreeLock($name)
    {
        DB::select('SELECT IS_FREE_LOCK(?)', [$name]);
    }

    /**
     * @param $name
     */
    public static function isUsedLock($name)
    {
        DB::select('SELECT IS_USED_LOCK(?)', [$name]);
    }
}
