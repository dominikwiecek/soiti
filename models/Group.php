<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "group".
 *
 * @property integer $idGroup
 * @property string $Name
 * @property string $Description
 *
 * @property Groupuser[] $groupusers
 * @property Researchareas[] $researchareas
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name'], 'required'],
            [['idGroup'], 'integer'],
            [['Description'], 'string'],
            [['Name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idGroup' => 'Id Group',
            'Name' => 'Name',
            'Description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupusers()
    {
        return $this->hasMany(Groupuser::className(), ['idGroup' => 'idGroup']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResearchareas()
    {
        return $this->hasMany(Researchareas::className(), ['idGroup' => 'idGroup']);
    }
}
