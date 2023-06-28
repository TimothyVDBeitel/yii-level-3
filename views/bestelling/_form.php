<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$menuList = ArrayHelper::map($menu,'ID','Naam');
$medewerkerList = ArrayHelper::map($medewerkers,'id','naam');
$medewerkerList=['1'=>'test1','2'=>'test2','3'=>'test3'];
// dd($medewerkerList);
// dd($medewerkers);

/** @var yii\web\View $this */
/** @var app\models\Bestelling $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="bestelling-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'id')->textInput() ?> -->

    <!-- <?= $form->field($model, 'medewerker_id')->textInput() ?> -->

    <?= $form->field($model, 'medewerker_id')->dropDownList([ '1'=> 'Ayoub', '2'=> 'Brahim','3'=> 'Carla','4'=> 'Diego','5'=> 'Eisa' ]) ?>


    <?= $form->field($model, 'naam')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'menu_id')->textInput() ?> -->

    <?= $form->field($model, 'menu_id')->dropDownList($menuList, ['prompt' => '']) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'besteld' => 'Besteld', 'klaar' => 'Klaar', 'geleverd' => 'Geleverd', ], ['prompt' => '']) ?>

    <!-- <?= $form->field($model, 'timestamp')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<!-- Timothy van den Beitel -->
