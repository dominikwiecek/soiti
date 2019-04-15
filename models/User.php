<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $idUser
 * @property string $Name
 * @property string $MiddleName
 * @property string $SurName
 * @property integer $idUserType
 * @property integer $idGroup
 * @property string $Login
 * @property string $Password
 * @property string $AuthKey
 *
 * @property Author[] $authors
 * @property Groupuser[] $groupusers
 * @property Laboratorymembers[] $laboratorymembers
 * @property Projectuser[] $projectusers
 * @property Researchareas[] $researchareas
 * @property Usertype $idUserType0
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name', 'SurName', 'idUserType', 'Password'], 'required'],
            [['idUser', 'idUserType', 'idGroup'], 'integer'],
            [['Name', 'MiddleName', 'SurName', 'Login', 'Password'], 'string', 'max' => 90],
            [['idUserType'], 'exist', 'skipOnError' => true, 'targetClass' => Usertype::className(), 'targetAttribute' => ['idUserType' => 'idUserType']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idUser' => '',
            'Name' => 'Name',
            'MiddleName' => 'Middle Name',
            'SurName' => 'Sur Name',
            'idUserType' => 'User Type',
            'idGroup' => 'Group',
            'Login' => 'Login',
            'Password' => 'Password',
            'AuthKey' => 'AuthKey',
        ];
    }

    /**
     * LOGIN
     */
    public static function findIdentity($id){
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null){
        throw new NotSupportedException();//I don't implement this method because I don't have any access token column in my database
    }

    public function getId(){
        return $this->idUser;
    }

    public function getAuthKey(){
        return $this->AuthKey;//Here I return a value of my authKey column
    }

    public function validateAuthKey($authKey){
        return $this->AuthKey === $authKey;
    }

    public static function findByUsername($username){
        return self::findOne(['Login'=>$username]);
    }

    public function validatePassword($password){
        return $this->Password === hash('sha256', $password);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthors()
    {
        return $this->hasMany(Author::className(), ['idUser' => 'idUser']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupusers()
    {
        return $this->hasMany(Groupuser::className(), ['idUser' => 'idUser']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLaboratorymembers()
    {
        return $this->hasMany(Laboratorymembers::className(), ['idUser' => 'idUser']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectusers()
    {
        return $this->hasMany(Projectuser::className(), ['idUser' => 'idUser']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResearchareas()
    {
        return $this->hasMany(Researchareas::className(), ['idUser' => 'idUser']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUserType()
    {
        return $this->hasOne(Usertype::className(), ['idUserType' => 'idUserType']);
    }


}
