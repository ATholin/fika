<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class Recipe extends Model
{
    use Sushi;

    protected array $rows = [
        [
            'name' => 'Kanelbulle',
            'description' => 'Inget går upp emot nybakade kanelbullar och ett glas kall mjölk. Klassiska kanelbullar är lika gott till kall mjölk på sommaren som till varm choklad på vintern.',
            'source' => 'Kanelbulle Inc.',
            'source_url' => 'https://www.arla.se/recept/kanelbullar/',
            'image_url' => 'https://cdn-rdb.arla.com/Files/arla-se/1241947592/9d614be5-0a2f-421f-af5e-61bb3e7f4962.jpg?mode=crop&w=1269&h=545&ak=f525e733&hm=a9bc2d42'
        ],
        [
            'name' => 'Kladdig kladdkaka',
            'description' => 'En extra kladdig kladdkaka blir resultatet av den här smeten och chansen är stor att du kommer baka världens godaste kladdkaka. Smaksätt den med det du gillar mest, kanske polkagris eller saltlakrits?',
            'source' => 'Arla',
            'source_url' => 'https://www.arla.se/recept/kladdig-kladdkaka/',
            'image_url' => 'https://cdn-rdb.arla.com/Files/arla-se/3619297742/3fb70bc5-82ef-4e14-9da0-a4f0d8baf8bc.jpg?mode=crop&w=1269&h=545&ak=f525e733&hm=a9bc2d42'
        ],
    ];
}
