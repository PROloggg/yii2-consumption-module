<?php

namespace halumein\consumption\models;

use Yii;

/**
 * This is the model class for table "cashbox_income".
 *
 * @property integer $id
 * @property string $date
 * @property integer $resource_id
 * @property string $income
 * @property string $cost
 * @property string $balance
 */
class Income extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consumption_income';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'resource_id', 'income', 'cost', 'user_id'], 'required'],
            [['date'], 'safe'],
            [['resource_id', 'user_id'], 'integer'],
            [['income', 'cost'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Дата',
            'resource_id' => 'Ресурс',
            'income' => 'Кол-во прихода',
            'cost' => 'Сумма',
            'user_id' => 'Пользователь',
        ];
    }

    public function getResource()
    {
        return $this->hasOne(Resource::className(), ['id' => 'resource_id']);
    }

    public function getUser()
    {
        $userForConsumption = Yii::$app->getModule('consumption')->userForConsumption;
        return $this->hasOne($userForConsumption::className(), ['id' => 'user_id']);
    }
}