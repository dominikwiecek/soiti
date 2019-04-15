<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publication".
 *
 * @property integer $idPublication
 * @property integer[] $Authors
 * @property string $Title
 * @property integer $idPublicationType
 * @property string $Year
 * @property string $Publisher
 * @property string $Print
 * @property string $Pages
 * @property string $DOI
 * @property string $ISBN
 *
 * @property Author[] $authors
 * @property Projectpublications[] $projectpublications
 * @property Publicationtype $idPublicationType0
 * @property Researchareas[] $researchareas
 */
class Publication extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'publication';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Title', 'idPublicationType', 'Year'], 'required'],
            [['idPublication', 'idPublicationType'], 'integer'],
            [['Year'], 'safe'],
            [['Print', 'DOI', 'ISBN'], 'string', 'max' => 45],
            [['Title', 'Publisher'], 'string', 'max' => 450],
            [['Pages'], 'string', 'max' => 10],
            [['idPublicationType'], 'exist', 'skipOnError' => true, 'targetClass' => Publicationtype::className(), 'targetAttribute' => ['idPublicationType' => 'idPublicationType']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPublication' => '',
            'Authors' => 'Authors',
            'Title' => 'Title',
            'idPublicationType' => 'Publication Type',
            'Year' => 'Year',
            'Publisher' => 'Publisher',
            'Print' => 'Print',
            'Pages' => 'Pages',
            'DOI' => 'DOI',
            'ISBN' => 'ISBN',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthors()
    {
        return $this->hasMany(Author::className(), ['idPublication' => 'idPublication']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectpublications()
    {
        return $this->hasMany(Projectpublications::className(), ['idPublication' => 'idPublication']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPublicationType0()
    {
        return $this->hasOne(Publicationtype::className(), ['idPublicationType' => 'idPublicationType']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResearchareas()
    {
        return $this->hasMany(Researchareas::className(), ['idPublication' => 'idPublication']);
    }
}
