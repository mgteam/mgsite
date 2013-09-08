<?php
class SetUserSocialDetail {
    
    public function setFacebookUserDetail($raw_data = null) {
        $detail = array();
        if(!empty($raw_data)) {
            $raw_data = json_decode($raw_data);
            $detail['Language'] = SetUserSocialDetail::setLanguages($raw_data);
            $detail['Work'] = SetUserSocialDetail::setWorkDetail($raw_data);
            $detail['Education'] = SetUserSocialDetail::setEducationDetail($raw_data);
            //$detail['Gender'] = SetUserSocialDetail::getGender($raw_data);
            //$detail['Contact']['email'] = SetUserSocialDetail::getEmail($raw_data);
        }
        return $detail;
    }
    
    public function setLanguages($raw_data = array()) {
        $languages = array();
        if(isset($raw_data->languages) && !empty($raw_data->languages)) {
            foreach($raw_data->languages as $key => $val) {
                $languages[]['title'] = $val->name;
            }
        }
        return $languages;
    }
    
/**
 *  function for set user education detail.
 *
 *  @author Lucky Saini.
 *  @param array of raw data.
 *  @return array of education detail.
 **/
    public function setEducationDetail($raw_data = array()) {
        $education_detail = $education = array();
        if(isset($raw_data->education) && !empty($raw_data->education)) {
            foreach($raw_data->education as $key => $value) {
                $data = array();
                foreach($value as $detailKey => $detailVal) {
                    if (gettype($detailVal) == 'object') {                      // check is object
                        $data[$detailKey] = $detailVal->name;
                    } else if (gettype($detailVal) == 'string') {               // check is string
                        $data[$detailKey] = $detailVal;
                    } else if (gettype($detailVal) == 'array') {                // check is array
                        if (isset($detailVal[0]) && !empty($detailVal[0])) {
                            if($detailKey == 'concentration') {
                                $detailKey = 'course';
                            }
                            $data[$detailKey] = $detailVal[0]->name;
                        }
                    }
                }
                $education[] = $data;
            }
            
            // set education detail for saving.
            foreach($education as $key => $val) {
                if (isset($val['school']) && !empty($val['school'])) {
                    $education_detail[$key]['university'] = $val['school'];
                }
                if (isset($val['year']) && !empty($val['year'])) {
                    $education_detail[$key]['end_date'] = $val['year'];
                }
                if (isset($val['course']) && !empty($val['course'])) {
                    $education_detail[$key]['class'] = $val['course'];
                }
            }
        }
        return $education_detail;
    }
    
/**
 *  function for set user work detail.
 *
 *  @author Lucky Saini.
 *  @param array of raw data.
 *  @return array of work detail.
 **/
    public function setWorkDetail($raw_data = array()) {
        $work = $work_detail = array();
        if(isset($raw_data->work) && !empty($raw_data->work)) {
            foreach($raw_data->work as $key => $value) {
                $data = array();
                foreach($value as $detailKey => $detailVal) {
                    if (gettype($detailVal) == 'object') {
                        $data[$detailKey] = $detailVal->name;
                    } else if (gettype($detailVal) == 'string') {
                        $data[$detailKey] = $detailVal;
                    }
                }
                $work[] = $data;
            }
            
            // set data for saving
            foreach($work as $key => $val) {
                if (isset($val['employer']) && !empty($val['employer'])) {
                    $work_detail[$key]['employer'] = $val['employer'];
                }
                if (isset($val['position']) && !empty($val['position'])) {
                    $work_detail[$key]['position'] = $val['position'];
                }
                if (isset($val['start_date']) && !empty($val['start_date'])) {
                    $work_detail[$key]['start_date'] = $val['start_date'];
                }
                if (isset($val['location']) && !empty($val['location'])) {
                    $work_detail[$key]['location'] = $val['location'];
                }
                if (isset($val['description']) && !empty($val['description'])) {
                    $work_detail[$key]['description'] = $val['description'];
                }
                if (isset($val['end_date']) && !empty($val['end_date'])) {
                    $work_detail[$key]['end_date'] = $val['end_date'];
                }
            }
        }
        return $work_detail;
    }
    
/**
 *  get gender of user.
 **/
    public function getGender($raw_data = array()) {
        $gender = isset($raw_data->gender) ? $raw_data->gender : 0;
        return $gender;
    }
    
/**
 *  get email id of user.
 **/
    public function getEmail($raw_data = array()) {
        $email = isset($raw_data->email) ? $raw_data->email : null;
        return $email;
    }
    
/**
 *  get location of user.
 **/
    /*public function getLocation($raw_data = array()) {
        $location = null;
        if(isset($raw_data->location) && !empty($raw_data->location)) {
            foreach($raw_data->location as $key => $val) {
                if(gettype($key) == 'string' && $key == 'name'){
                    $location = $val;
                }
            }
        }
        return $location;
    }*/
}