<?php

namespace app\models;


use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $username
 * @property string $password
 */
class User extends \yii\db\ActiveRecord
implements IdentityInterface
{


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
            [['username', 'password'], 'required'],
            [['username'], 'string', 'max' => 15],
            [['password'], 'string', 'max' => 10],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
        ];
    }
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['author_id' => 'id']);
    }
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public function getId()
    {
        return $this->id;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {

    }

    public function getAuthKey()
    {

    }

    public function validateAuthKey($authKey)
    {

    }
    public static function findByUsername($username)
    {
        return User::find()->where(['username' => $username])->one();
    }
    public function validatePassword($password) {
        //echo $this->password;
        return ($this->password == $password) ? true : false;
    }
    public static function UserId() {
        $userid=User::findOne(['username'=>'admin']);
        return $userid->id;
    }
}
