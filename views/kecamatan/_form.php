<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Kecamatan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kecamatan-form">

	<?php $form = ActiveForm::begin(); ?>

	<?php echo $form->field($model, 'provinsi_id')->widget(Select2::classname(), [
		'data' => $provinsi,
		'language' => 'de',
		'options' => ['class' => 'form-control search', 'prompt'=>'Pilih Provinsi', 'id'=>'provinsi_id'],
		'pluginOptions' => [
			'allowClear' => true
		],
	]); ?>

	<?php echo $form->field($model, 'kabupaten_id')->widget(DepDrop::classname(), [
		'type' => DepDrop::TYPE_SELECT2,
		'options' => ['id' => 'kabupaten_id',
		'prompt' => '--pilih kabupaten--'],
		'pluginOptions' =>[
			'depends' => ['provinsi_id'],
			'placeholder' => '--pilih kabupaten--',
			'url' => Url::to(['kecamatan/getkabupaten'])
		]
	]); ?>

	<?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'jumlah_penduduk')->textInput() ?>

	<div class="form-group">
		<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
