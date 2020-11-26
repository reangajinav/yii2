<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use app\models\Provinsi;
use app\models\Kabupaten;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$provinsi = Provinsi::find()->all();
$provinsi = ArrayHelper::map($provinsi, 'id','nama');

/* @var $this yii\web\View */
/* @var $model app\models\KabupatenSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kabupaten-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-3">
         <?php echo $form->field($model, 'provinsi_id')->widget(Select2::classname(), [
            'data' => $provinsi,
            'language' => 'de',
            'options' => ['class' => 'form-control search', 'prompt'=>'Pilih Provinsi', 'id'=>'provinsi_id'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

    </div>
    <div class="col-md-3">
        <?php echo $form->field($model, 'id')->widget(DepDrop::classname(), [
            'type' => DepDrop::TYPE_SELECT2,
            'options' => ['id' => 'id',
            'prompt' => '--pilih kabupaten--'],
            'pluginOptions' =>[
                'depends' => ['provinsi_id'],
                'placeholder' => '--pilih kabupaten--',
                'url' => Url::to(['kabupaten/getkabupaten'])
            ]
        ]); ?>
    </div>
</div>

<div class="form-group">
    <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>
