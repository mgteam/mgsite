<?php
App::uses('CakeTime', 'Utility');
class DateTimeLib {
    
    public function setFormat($date = null, $format = TimeFormat::CustomDateTime) {
        if(empty($date)) {
            return false;
        }
        
        if(!DateTimeLib::checkCorrectDate($date)) {
            return '--------';
        }
        return CakeTime::format($format, $date);
    }
    
/**
 *  check is date format is correct or not.
 *
 **/
    public function checkCorrectDate($date) {
        $isCorrectDate = CakeTime::toUnix($date);
        if ($isCorrectDate == false) {
           return false;
        }
        return true;
    }
}