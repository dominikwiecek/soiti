<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usertype".
 *
 * @property integer $idUserType
 * @property string $Name
 *
 * @property User[] $users
 */
class UserType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usertype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUserType'], 'required'],
            [['idUserType'], 'integer'],
            [['Name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idUserType' => 'Id User Type',
            'Name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['idUserType' => 'idUserType']);
    }
}
