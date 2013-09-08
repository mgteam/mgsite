<?php
App::uses('CakeTime', 'Utility');
class DateTimeLib {
    
    public function setFormat($date = null, $format = TimeFormat::CustomDateTime) {
        if(empty($date)) {
            return false;
        }
        return CakeTime::format($format, $date);
    }
}