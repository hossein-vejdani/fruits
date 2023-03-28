<?php
namespace App\Doctrine\DBAL\Types;

use Doctrine\DBAL\Types\JsonType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use App\Entity\Nutrition;

class NutritionType extends JsonType
{
    
    const TYPE = 'nutrition';
 
    public function getName(): mixed
    {
        return 'nutrition';
    }


    public function convertToPHPValue($value, AbstractPlatform $platform): mixed
    {
        
        $data = parent::convertToPHPValue($value, $platform);
        if ($data === null) {
            return null;
        }
        $nutrition = new Nutrition();
        $nutrition
        ->setCarbohydrates($data['carbohydrates'])
        ->setProtein($data['protein'])
        ->setFat ($data['fat'])
        ->setCalories ($data['calories'])
        ->setSugar ($data['sugar']);
        return $nutrition;
    }


    public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        if ($value === null) {
            return null;
        }
        return parent::convertToDatabaseValue([
            'carbohydrates' => $value->carbohydrates,
            'protein' => $value->protein,
            'fat' => $value->fat,
            'calories' => $value->calories,
            'sugar' => $value->sugar,
        ], $platform);
    }
}
?>