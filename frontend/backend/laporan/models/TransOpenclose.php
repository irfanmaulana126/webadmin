<?php

namespace frontend\backend\laporan\models;

use common\models\Store;
use Yii;

/**
 * This is the model class for table "trans_openclose".
 *
 * @property string $ID
 * @property string $ACCESS_GROUP
 * @property string $STORE_ID
 * @property string $ACCESS_ID
 * @property string $OPENCLOSE_ID
 * @property string $TGL_OPEN
 * @property string $TGL_CLOSE
 * @property string $CASHINDRAWER
 * @property string $ADDCASH
 * @property string $SELLCASH
 * @property string $TOTALCASH
 * @property string $TOTALCASH_ACTUAL
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 * @property integer $STATUS
 * @property string $DCRP_DETIL
 * @property integer $YEAR_AT
 * @property integer $MONTH_AT
 */
class TransOpenclose extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trans_openclose';
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
            [['STORE_ID', 'ACCESS_ID', 'OPENCLOSE_ID', 'TGL_OPEN', 'YEAR_AT', 'MONTH_AT'], 'required'],
            [['TGL_OPEN', 'TGL_CLOSE', 'CREATE_AT', 'UPDATE_AT','storeNm'], 'safe'],
            [['CASHINDRAWER', 'ADDCASH', 'SELLCASH', 'TOTALCASH', 'TOTALCASH_ACTUAL'], 'number'],
            [['STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['DCRP_DETIL'], 'string'],
            [['ACCESS_GROUP', 'ACCESS_ID'], 'string', 'max' => 15],
            [['STORE_ID'], 'string', 'max' => 20],
            [['OPENCLOSE_ID', 'CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
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
            'OPENCLOSE_ID' => 'Openclose  ID',
            'TGL_OPEN' => 'Tgl  Open',
            'TGL_CLOSE' => 'Tgl  Close',
            'CASHINDRAWER' => 'Cashindrawer',
            'ADDCASH' => 'Addcash',
            'SELLCASH' => 'Sellcash',
            'TOTALCASH' => 'Totalcash',
            'TOTALCASH_ACTUAL' => 'Totalcash  Actual',
            'CREATE_BY' => 'Create  By',
            'CREATE_AT' => 'Create  At',
            'UPDATE_BY' => 'Update  By',
            'UPDATE_AT' => 'Update  At',
            'STATUS' => 'Status',
            'DCRP_DETIL' => 'Dcrp  Detil',
            'YEAR_AT' => 'Year  At',
            'MONTH_AT' => 'Month  At',
        ];
    }
	
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
}
