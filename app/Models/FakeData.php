<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;
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
        $photo = $faker->imageUrl(640,640);
        return array($name, $date, $phone, $email, $pos_name, $salary, $photo);
    }

    function getDate(){
        $faker = Faker::create();
        $dt = $faker->dateTimeBetween('-10 years', 'now');
        $date = $dt->format("d.m.Y");

        return $date;
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
            "а"=>"a","б"=>"b","в"=>"v","г"=>"g","д"=>"d",
            "е"=>"e", "ё"=>"yo","ж"=>"j","з"=>"z","и"=>"i",
            "й"=>"i","к"=>"k","л"=>"l", "м"=>"m","н"=>"n",
            "о"=>"o","п"=>"p","р"=>"r","с"=>"s","т"=>"t",
            "у"=>"y","ф"=>"f","х"=>"h","ц"=>"c","ч"=>"ch",
            "ш"=>"sh","щ"=>"sh","ы"=>"i","э"=>"e","ю"=>"u",
            "я"=>"ya",
            "А"=>"A","Б"=>"B","В"=>"V","Г"=>"G","Д"=>"D",
            "Е"=>"E","Ё"=>"Yo","Ж"=>"J","З"=>"Z","И"=>"I",
            "Й"=>"I","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N",
            "О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T",
            "У"=>"Y","Ф"=>"F","Х"=>"H","Ц"=>"C","Ч"=>"Ch",
            "Ш"=>"Sh","Щ"=>"Sh","Ы"=>"I","Э"=>"E","Ю"=>"U",
            "Я"=>"Ya",
            "ь"=>"","Ь"=>"","ъ"=>"","Ъ"=>"",
            "ї"=>"j","і"=>"i","ґ"=>"g","є"=>"ye",
            "Ї"=>"J","І"=>"I","Ґ"=>"G","Є"=>"YE"
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
