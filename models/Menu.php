<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property int $ID
 * @property string $Naam
 * @property int $Prijs
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Naam', 'Prijs'], 'required'],
            [['Prijs'], 'integer'],
            [['Naam'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Naam' => 'Naam',
            'Prijs' => 'Prijs',
        ];
    }
}
