<?php
namespace MarkusGehrig\Diary\Date;

use \Exception;

class DateUtility {
    public function getDate($timestamp) {
        return date('d.m.Y', $timestamp);
    }

    public function getToday() {
        return date('Y-m-d');
    }

    public function setTimezone($timezone = 'Europe/Zurich') {
        $timezone_isset = date_default_timezone_set($timezone);

        if( $timezone_isset === false ){
            throw new Exception('Timezon couldn\'t set');
        }

        return $this;
    }
}
