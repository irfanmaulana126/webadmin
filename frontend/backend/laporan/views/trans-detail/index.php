<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;
use kartik\tabs\TabsX;
use kartik\date\DatePicker;
use kartik\builder\Form;
use yii\helpers\Url;
use yii\web\View;

$this->registerCss("
		#book-openclose .kv-grid-table :link {
			color: #fdfdfd;
		}
		#import-absen-log .kv-grid-table :link {
			color: #fdfdfd;
		}
		
		#import-absen-log .kv-grid-table .actual-delete :link {
			color: #fdfdfd;
		}		
		
		/* mouse over link */
		a:hover {
			color: #5a96e7;
		}
		/* selected link */
		a:active {
			color: blue;
		}
		.modal-content { 
			border-radius: 50;
		}
		.kv-panel {
			//min-height: 340px;
			height: 300px;
		}
		.kv-grid-container{
			height:600px
		}
		.tmp-button-delete a:hover {
			color:red;
		}
	");
$this->title = 'Trans Opencloses';
/* $this->params['breadcrumbs'][] = $this->title;
		' 'ID',
            'ACCESS_GROUP',
            'STORE_ID',
            'ACCESS_ID',
            'GOLONGAN',
            // 'TRANS_ID',
            // 'OFLINE_ID',
            // 'TRANS_DATE',
            // 'PRODUCT_ID',
            // 'PRODUCT_NM',
            // 'PRODUCT_PROVIDER',
            // 'PRODUCT_PROVIDER_NO',
            // 'PRODUCT_PROVIDER_NM',
            // 'PRODUCT_QTY',
            // 'UNIT_ID',
            // 'UNIT_NM',
            // 'HARGA_JUAL',
            // 'DISCOUNT',
            // 'PROMO',
            // 'CREATE_AT',
            // 'UPDATE_BY',
            // 'UPDATE_AT',
            // 'STATUS',
            // 'DCRP_DETIL:ntext',
            // 'YEAR_AT',
            // 'MONTH_AT', */
	$aryFieldDTrans= [		  
		['ID' =>0, 'ATTR' =>['FIELD'=>'StoreNm','SIZE' => '180px','label'=>'Toko','align'=>'left','mergeHeader'=>false,'FILTER'=>true]],		  
		['ID' =>1, 'ATTR' =>['FIELD'=>'TRANS_DATE','SIZE' => '6px','label'=>'TRANS_DATE','align'=>'center','mergeHeader'=>true,'FILTER'=>true]],	

	];	
	$valFieldsDTrans = ArrayHelper::map($aryFieldDTrans, 'ID', 'ATTR'); 
	$bColor='rgba(87,114,111, 1)';
	$attTransDetail[] =[			
		'class'=>'kartik\grid\SerialColumn',
		'contentOptions'=>['class'=>'kartik-sheet-style'],
		'width'=>'10px',
		'header'=>'No.',
		'headerOptions'=>[
			'style'=>[
				'text-align'=>'center',
				'width'=>'10px',
				'font-family'=>'verdana, arial, sans-serif',
				'font-size'=>'9pt',
				'background-color'=>$bColor,
				'color'=>'white',
			]
		],
		'contentOptions'=>[
			'style'=>[
				'text-align'=>'center',
				'width'=>'10px',
				'font-family'=>'tahoma, arial, sans-serif',
				'font-size'=>'9pt',
			]
		],					
	];
	/*OTHER ATTRIBUTE*/
	foreach($valFieldsTmp as $key =>$value[]){	
		if ($value[$key]['FIELD']=='DEP_NM' OR $value[$key]['FIELD']=='HARI'){				
			$gvfilterType=GridView::FILTER_SELECT2;
			//$gvfilterType=false;
			//$gvfilter =$aryDeptId;
			$filterWidgetOpt=[				
				'pluginOptions'=>['allowClear'=>true],		
			]; 
			if($value[$key]['FIELD']=='HARI'){
				$filterInputOpt=['placeholder'=>'-Pilih-'];
			}else{
				$filterInputOpt=['placeholder'=>'-- Pilih --'];
			}			
		}else{
			$gvfilterType=false;
			//$gvfilter=true;
			$filterWidgetOpt=[];		
			$filterInputOpt=['class'=>"form-control"];					
		}; 
		
		$attTransDetail[]=[		
			'attribute'=>$value[$key]['FIELD'],
			'label'=>$value[$key]['label'],
			'filter'=>$value[$key]['FILTER'],
			'filterType'=>$gvfilterType,
			'filterWidgetOptions'=>$filterWidgetOpt,	
			'filterInputOptions'=>$filterInputOpt,								
			'hAlign'=>'right',
			'vAlign'=>'middle',
			//'mergeHeader'=>true,
			'noWrap'=>true,	
			'value'=>function($data)use($key,$value){
				$x=$value[$key]['FIELD'];
				return $data->$x;
			},
			'noWrap'=>false,	
			'mergeHeader'=>$value[$key]['mergeHeader'],
			'headerOptions'=>[		
					'style'=>[									
					'text-align'=>'center',
					'width'=>$value[$key]['SIZE'],
					'font-family'=>'tahoma, arial, sans-serif',
					'font-size'=>'8pt',
					'background-color'=>$bColor,
				]
			],  
			'contentOptions'=>[
				'style'=>[
					'text-align'=>$value[$key]['align'],
					//'width'=>'12px',
					'font-family'=>'tahoma, arial, sans-serif',
					'font-size'=>'8pt',
					//'background-color'=>'rgba(13, 127, 3, 0.1)',
				]
			],
			//'pageSummaryFunc'=>GridView::F_SUM,
			//'pageSummary'=>true,
			'pageSummaryOptions' => [
				'style'=>[
						'text-align'=>'right',		
						//'width'=>'12px',
						'font-family'=>'tahoma',
						'font-size'=>'8pt',	
						'text-decoration'=>'underline',
						'font-weight'=>'bold',
						'border-left-color'=>'transparant',		
						'border-left'=>'0px',									
				]
			],	
		];	
	};
/* ==================================
 * GridViews Body
 *
 * ===================================
 */			
 $gvTransDetail= GridView::widget([
	'id'=>'detail-sales-trans',
	'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
	'filterRowOptions'=>['style'=>'background-color:'.$bColor.'; align:center'],
	'columns' =>$attTransDetail,	
	'toolbar' => [
		'{export}',
	],	
	'panel'=>[
		//'heading'=>$pageNm.'  '.tombolCreate().' '.tombolExportFormat($paramUrl).' '.tombolUpload().' '.tombolSync(),					
		//'heading'=>tombolRefresh().' '.tombolClear().' '.tombolCreateTmp().' '.tombolCreatePeriode().' '.tombolExportFormat($paramUrl).' -> '.tombolUpload().' -> '.tombolSync().' '.$perode,					
		'type'=>'info',
		'after'=>false,
		'before'=>false,
		'footer'=>false,
	],
	'pjax'=>true,
	'pjaxSettings'=>[
		'options'=>[
			'enablePushState'=>true,
			'id'=>'detail-sales-trans',
		],
	],
	'hover'=>true, //cursor select
	'responsive'=>true,
	'responsiveWrap'=>true,
	'bordered'=>true,
	'striped'=>'4px',
	'autoXlFormat'=>true,
	'export' => false,
	'export'=>[//export like view grid --ptr.nov-
	'fontAwesome'=>true,
	'showConfirmAlert'=>false,
	'target'=>GridView::TARGET_BLANK
	],
	//'floatHeader'=>false,
	// 'floatHeaderOptions'=>['scrollingTop'=>'200'] 
	// 'floatOverflowContainer'=>true,
	'floatHeader'=>true,
]);	
?>
<div class="container-fluid" style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 9pt;">
		<div class="row">		
		<?=$gvTransDetail?>
		</div>
	</div>
</div>