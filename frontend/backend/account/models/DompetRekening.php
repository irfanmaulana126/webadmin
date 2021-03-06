<?php

namespace frontend\backend\account\models;

use Yii;

use frontend\backend\account\models\DompetRekeningImage;
use frontend\backend\account\models\DompetRekeningImageSearch;
use frontend\backend\account\models\UserProfile;
use frontend\backend\account\models\UserProfileSearch;
/**
 * This is the model class for table "dompet_rekening".
 *
 * @property string $ID
 * @property string $ACCESS_GROUP
 * @property string $NAMA_LENGKAP
 * @property int $ID_BANK
 * @property string $BANK
 * @property int $NO_REK
 * @property string $ALAMAT
 * @property string $TLP
 * @property string $STATUS 0=proses;1=pending;2=success;3=gagal;
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 * @property string $DCRP_DETIL
 * @property int $YEAR_AT
 * @property int $MONTH_AT
 */
class DompetRekening extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dompet_rekening';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ACCESS_GROUP', 'ID_BANK', 'NO_REK', 'STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['ALAMAT', 'DCRP_DETIL'], 'string'],
            [['CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['NAMA_LENGKAP', 'BANK', 'CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 255],
            [['TLP'], 'string', 'max' => 11],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'ACCESS_GROUP' => 'Access  Group',
            'NAMA_LENGKAP' => 'Nama  Lengkap',
            'ID_BANK' => 'Id  Bank',
            'BANK' => 'Bank',
            'NO_REK' => 'No  Rek',
            'ALAMAT' => 'Alamat',
            'TLP' => 'Tlp',
            'STATUS' => 'Status',
            'CREATE_BY' => 'Create  By',
            'CREATE_AT' => 'Create  At',
            'UPDATE_BY' => 'Update  By',
            'UPDATE_AT' => 'Update  At',
            'DCRP_DETIL' => 'Dcrp  Detil',
            'YEAR_AT' => 'Year  At',
            'MONTH_AT' => 'Month  At',
        ];
    }
    public function getImages()
    {
        return $this->hasOne(DompetRekeningImage::className(),['ACCESS_GROUP'=>'ACCESS_GROUP']);
    }
    public function getProfile()
    {
        return $this->hasOne(UserProfile::className(),['ACCESS_ID'=>'ACCESS_GROUP']);
    }
    public function getGambar(){
        $result=$this->images;
        return $result!=''?$result->IMAGE:'';
    }

    public function getNama(){
        $result=$this->profile;
        return $result!=''?$result->NM_DEPAN.' '.$result->NM_TENGAH.' '.$result->NM_BELAKANG:'';
    }
    public function getAlamat(){
        $result=$this->profile;
        return $result!=''?$result->NM_DEPAN.' '.$result->NM_TENGAH.' '.$result->NM_BELAKANG:'';
    }
    public function getTtl(){
        $result=$this->profile;
        return $result!=''?$result->LAHIR_TEMPAT.'/'.$result->LAHIR_TGL:'';
    }
    public function getKontak(){
        $result=$this->profile;
        return $result!=''?$result->HP.'/'.$result->EMAIL:'';
    }
}
