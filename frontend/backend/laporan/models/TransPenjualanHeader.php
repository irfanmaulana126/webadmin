<?php

namespace frontend\backend\laporan\models;

use Yii;
use common\models\Store;
use common\models\Userlogin;

/**
 * This is the model class for table "trans_penjualan_header".
 *
 * @property string $ID
 * @property string $ACCESS_GROUP
 * @property string $STORE_ID
 * @property string $ACCESS_ID
 * @property string $TRANS_ID
 * @property string $OFLINE_ID
 * @property string $TRANS_DATE
 * @property string $OPENCLOSE_ID
 * @property double $TOTAL_PRODUCT
 * @property string $SUB_TOTAL_HARGA
 * @property string $PPN
 * @property string $TOTAL_HARGA
 * @property string $MERCHANT_ID
 * @property string $TYPE_PAY_ID
 * @property string $TYPE_PAY_NM
 * @property string $BANK_ID
 * @property string $BANK_NM
 * @property string $MERCHANT_NM
 * @property string $MERCHANT_NO
 * @property string $CONSUMER_ID
 * @property string $CONSUMER_NM
 * @property string $CONSUMER_EMAIL
 * @property string $CONSUMER_PHONE
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 * @property integer $STATUS
 * @property string $DCRP_DETIL
 * @property integer $YEAR_AT
 * @property integer $MONTH_AT
 */
class TransPenjualanHeader extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trans_penjualan_header';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('production_api');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STORE_ID', 'ACCESS_ID', 'TRANS_ID', 'TRANS_DATE', 'YEAR_AT', 'MONTH_AT'], 'required'],
            [['TRANS_DATE', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['TOTAL_PRODUCT', 'SUB_TOTAL_HARGA', 'PPN', 'TOTAL_HARGA'], 'number'],
            [['TYPE_PAY_ID', 'BANK_ID', 'STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['DCRP_DETIL'], 'string'],
            [['ACCESS_GROUP', 'ACCESS_ID'], 'string', 'max' => 15],
            [['STORE_ID'], 'string', 'max' => 20],
            [['TRANS_ID', 'OPENCLOSE_ID', 'UPDATE_BY'], 'string', 'max' => 50],
            [['OFLINE_ID', 'MERCHANT_NM', 'MERCHANT_NO'], 'string', 'max' => 255],
            [['MERCHANT_ID'], 'string', 'max' => 30],
            [['TYPE_PAY_NM', 'BANK_NM', 'CONSUMER_PHONE'], 'string', 'max' => 150],
            [['CONSUMER_ID', 'CONSUMER_NM'], 'string', 'max' => 100],
            [['CONSUMER_EMAIL'], 'string', 'max' => 200],
            [['storeNm','tgl','waktu','username'], 'safe'],
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
            'STORE_ID' => 'Store  ID',
            'ACCESS_ID' => 'Access  ID',
            'TRANS_ID' => 'Trans  ID',
            'OFLINE_ID' => 'Ofline  ID',
            'TRANS_DATE' => 'Trans  Date',
            'OPENCLOSE_ID' => 'Openclose  ID',
            'TOTAL_PRODUCT' => 'Total  Product',
            'SUB_TOTAL_HARGA' => 'Sub  Total  Harga',
            'PPN' => 'Ppn',
            'TOTAL_HARGA' => 'Total  Harga',
            'MERCHANT_ID' => 'Merchant  ID',
            'TYPE_PAY_ID' => 'Type  Pay  ID',
            'TYPE_PAY_NM' => 'Type  Pay  Nm',
            'BANK_ID' => 'Bank  ID',
            'BANK_NM' => 'Bank  Nm',
            'MERCHANT_NM' => 'Merchant  Nm',
            'MERCHANT_NO' => 'Merchant  No',
            'CONSUMER_ID' => 'Consumer  ID',
            'CONSUMER_NM' => 'Consumer  Nm',
            'CONSUMER_EMAIL' => 'Consumer  Email',
            'CONSUMER_PHONE' => 'Consumer  Phone',
            'CREATE_AT' => 'Create  At',
            'UPDATE_BY' => 'Update  By',
            'UPDATE_AT' => 'Update  At',
            'STATUS' => 'Status',
            'DCRP_DETIL' => 'Dcrp  Detil',
            'YEAR_AT' => 'Year  At',
            'MONTH_AT' => 'Month  At',
			'tgl'=>'Tanggal',
        ];
    }
	//=== STORE ==
	public function getStoreTbl(){
		return $this->hasOne(Store::className(), ['STORE_ID' => 'STORE_ID']);
	}	
	public function getStoreNm(){
		$rslt = $this->storeTbl['STORE_NM'];
		if ($rslt){
			return $rslt;
		}else{
			return "none";
		}; 
	}
	//=== STORE ==
	public function getUserTbl(){
		return $this->hasOne(Userlogin::className(), ['ACCESS_ID' => 'ACCESS_ID']);
	}	
	public function getUsername(){
		return $this->userTbl['username'];		
	}
	//=== SPLIT SELF ==
	public function getTgl(){
		return date("Y-m-d",strtotime($this->TRANS_DATE));
	}
	public function getWaktu(){
		return date("H:i:s",strtotime($this->TRANS_DATE));
	}
}
