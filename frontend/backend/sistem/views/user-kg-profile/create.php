<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\sistem\models\UserKgProfile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-kg-profile-create">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ACCESS_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NM_DEPAN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NM_TENGAH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NM_BELAKANG')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KTP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ALMAT')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'LAHIR_TEMPAT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LAHIR_TGL')->textInput() ?>

    <?= $form->field($model, 'LAHIR_GENDER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EMAIL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CREATE_BY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CREATE_AT')->textInput() ?>

    <?= $form->field($model, 'UPDATE_BY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UPDATE_AT')->textInput() ?>

    <?= $form->field($model, 'STATUS')->textInput() ?>

    <?= $form->field($model, 'DCRP_DETIL')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'YEAR_AT')->textInput() ?>

    <?= $form->field($model, 'MONTH_AT')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
