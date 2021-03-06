<?php

namespace App\Models;

use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FakeData extends Model
{
    use HasFactory;

    function getData(){
        $faker = Faker::create('ru_RU');
        $gender = $faker->randomElement(['male', 'female']);
        $name = $faker->lastName($gender)." ".$faker->firstName($gender) . " " . $faker->middleName($gender);
        $phone = $this->getPhone();
        $date = $this->getDate();
        $email = $this->getEmail($name);
        $pos = DB::table('positions')->inRandomOrder()->first();
        $pos_name = $pos->name;
        $salary = $faker->numberBetween(10000, 500000);
        $photo = $faker->imageUrl(640, 640);
        return array($name, $date, $phone, $email, $pos_name, $salary, $photo);
    }

    function getDate(){
        $faker = Faker::create();
        $dt = $faker->dateTimeBetween('-10 years', 'now');
        return $dt;
    }

    function getPhone(){
        $faker = Faker::create();
        $code = $faker->randomElement([
            '38067',
            '38069',
            '38096',
            '38097',
            '38098',
            '38050',
            '38066',
            '38095',
            '38099',
            '38063',
            '38073',
            '38093',
        ]);
        $phone = $code.$this->getP1().$this->getP2().$this->getP2();
        $out = preg_replace(
            '/^(\d{2})(\d{3})(\d{3})(\d{2})(\d{2})$/',
            '+\1(\2)\3-\4-\5',
            (string)$phone
        );

        return $out;
    }

    function getEmail($name){
        $faker = Faker::create();
        $domain = $faker->randomElement([
            'yahoo.com',
            'gmail.com',
            'hotmail.com',
            'outlook.com',
            'ukr.net'
        ]);
        $ghost = $this->getCyr($name);
        $email_name = explode(" ", $ghost);
        $l_name = strtolower($email_name[0]);
        $f_name = strtolower($email_name[1]);
        $email = $l_name.".".$f_name."@".$domain;

        return $email;
    }
    function getCyr($name){
        $gost = array(
            "??"=>"a","??"=>"b","??"=>"v","??"=>"g","??"=>"d",
            "??"=>"e", "??"=>"yo","??"=>"j","??"=>"z","??"=>"i",
            "??"=>"i","??"=>"k","??"=>"l", "??"=>"m","??"=>"n",
            "??"=>"o","??"=>"p","??"=>"r","??"=>"s","??"=>"t",
            "??"=>"y","??"=>"f","??"=>"h","??"=>"c","??"=>"ch",
            "??"=>"sh","??"=>"sh","??"=>"i","??"=>"e","??"=>"u",
            "??"=>"ya",
            "??"=>"A","??"=>"B","??"=>"V","??"=>"G","??"=>"D",
            "??"=>"E","??"=>"Yo","??"=>"J","??"=>"Z","??"=>"I",
            "??"=>"I","??"=>"K","??"=>"L","??"=>"M","??"=>"N",
            "??"=>"O","??"=>"P","??"=>"R","??"=>"S","??"=>"T",
            "??"=>"Y","??"=>"F","??"=>"H","??"=>"C","??"=>"Ch",
            "??"=>"Sh","??"=>"Sh","??"=>"I","??"=>"E","??"=>"U",
            "??"=>"Ya",
            "??"=>"","??"=>"","??"=>"","??"=>"",
            "??"=>"j","??"=>"i","??"=>"g","??"=>"ye",
            "??"=>"J","??"=>"I","??"=>"G","??"=>"YE"
        );
        return strtr($name, $gost);
    }

    function getP1(){
        $three = 0;

        while (strlen($three) < 3){
            $three = mt_rand('000', '999');
        }

        return $three;
    }

    function getP2(){
        $three = 0;

        while (strlen($three) < 2){
            $three = mt_rand('00', '99');
        }

        return $three;
    }
}
