<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "groupuser".
 *
 * @property integer $idGroupUser
 * @property integer $idGroup
 * @property integer $idUser
 * @property string $Role
 *
 * @property Group $idGroup0
 * @property User $idUser0
 */
class GroupUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'groupuser';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idGroupUser', 'idGroup', 'idUser'], 'required'],
            [['idGroupUser', 'idGroup', 'idUser'], 'integer'],
            [['Role'], 'string', 'max' => 1],
            [['idGroup'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['idGroup' => 'idGroup']],
            [['idUser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idUser' => 'idUser']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idGroupUser' => 'Id Group User',
            'idGroup' => 'Id Group',
            'idUser' => 'Id User',
            'Role' => 'Role',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdGroup0()
    {
        return $this->hasOne(Group::className(), ['idGroup' => 'idGroup']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser0()
    {
        return $this->hasOne(User::className(), ['idUser' => 'idUser']);
    }
}
