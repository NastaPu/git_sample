<?php

namespace app\models;

use yii\helpers\ArrayHelper;
use Yii;

/**
 * This is the model class for table "lookup".
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property int $code
 */
class Lookup extends \yii\db\ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'lookup';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'code', 'type'], 'required'],
            [['code'], 'integer'],
            [['name'], 'string', 'max' => 20],
            [['type'], 'string', 'max' => 15],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
            'code' => 'Code',
        ];
    }

    public static function items() {
        $status = Lookup::find()->where(['type' => 'PostStatus'])->all();
        $items = ArrayHelper::map($status, 'code', 'name');
        return $items;
    }
}
