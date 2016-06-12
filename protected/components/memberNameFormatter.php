<?php
class memberNameFormatter {

//    public $name_formats = array(
//    '1'=>'Firstname Surname',
//    '2'=>'SurnameFirstname',
//    '3'=>'Title Firstname Surname',
//    '4'=>'Surname, Firstname',
//    '5'=>'Surname, Title Firstname',
//    );

    public $name_formats = array();

    public function __construct() {

        $this->name_formats = array(
                                '1'=>'Firstname Surname',
                                '2'=>'SurnameFirstname',
                                '3'=>'Title Firstname Surname',
                                '4'=>'Surname, Firstname',
                                '5'=>'Surname, Title Firstname',
                                );
    }


    public static function get_formatted_name($format_id,$fname,$lname,$title) {

        $formatted_name = '';

        switch ($format_id) {
            case 1:
                $formatted_name = "$fname $lname";
                break;
            case 2:
                $formatted_name = "$lname"."$fname";
                break;
            case 3:
                $formatted_name = "$title $fname $lname";
                break;
            case 3:
                $formatted_name = "$title $fname $lname";
                break;
            case 4:
                $formatted_name = "$lname, $fname";
                break;
            case 5:
                $formatted_name = "$lname, $title $fname";
                break;

        }

        return $formatted_name;

    }

    public function getNameDisplayFormats(){
        //$this->__construct();
        return $this->name_formats;
    }

}

?>
