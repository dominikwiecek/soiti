<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "author".
 *
 * @property integer $idAuthor
 * @property integer $idUser
 * @property integer $idPublication
 * @property integer $Order
 *
 * @property Publication $idPublication0
 * @property User $idUser0
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'author';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUser', 'idPublication'], 'required'],
            [['idAuthor', 'idUser', 'idPublication', 'Order'], 'integer'],
            [['idPublication'], 'exist', 'skipOnError' => true, 'targetClass' => Publication::className(), 'targetAttribute' => ['idPublication' => 'idPublication']],
            [['idUser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idUser' => 'idUser']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idAuthor' => 'Id Author',
            'idUser' => 'Id User',
            'idPublication' => 'Id Publication',
            'Order' => 'Order',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPublication0()
    {
        return $this->hasOne(Publication::className(), ['idPublication' => 'idPublication']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser0()
    {
        return $this->hasOne(User::className(), ['idUser' => 'idUser']);
    }
}
