<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $password
 * @property string $email
 * @property string $login
 * @property string $first_name
 * @property string $last_name
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends ActiveRecord implements IdentityInterface
{

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function setPassword($password)
    {
        $this->password = addslashes($password);
//        $this->password = sha1($password);
    }

    public function validatePassword($password)
    {
//        return $this->password === sha1($password);
        return $this->password === ($password);
    }

    //=============================================

    public static function findIdentity($id)
    {
        return self::findOne($id);
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
}
