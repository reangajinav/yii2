<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\Provinsi;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Kabupaten */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kabupaten-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'provinsi_id')->widget(Select2::classname(), [
		'data' => $provinsi,
		'options' => ['placeholder' => '--Pilih Provinsi--'],
		'pluginOptions' => [
			'allowClear' => true
		],
	]); ?>

	<?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

	<div class="form-group">
		<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
