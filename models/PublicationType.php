<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publicationtype".
 *
 * @property integer $idPublicationType
 * @property string $Name
 *
 * @property Publication[] $publications
 */
class PublicationType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'publicationtype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idPublicationType'], 'required'],
            [['idPublicationType'], 'integer'],
            [['Name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPublicationType' => 'Id Publication Type',
            'Name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublications()
    {
        return $this->hasMany(Publication::className(), ['idPublicationType' => 'idPublicationType']);
    }
}
