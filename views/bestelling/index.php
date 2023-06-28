<?php

use app\models\Bestelling;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\BestellingSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */


$this->title = 'Bestellingen';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="bestelling-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Bestelling', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'medewerker_id',
                  'label'     => 'Medewerker',
                'filter'    => $medewerkers,
                'value'     => 'medewerkers.naam'
            ],
            [
                'attribute' => 'menu_id',
                  'label'     => 'Bestelling',
                'filter'    => $menuList,
                'value'     => 'menu.Naam'
            ],

            'id',
            // 'medewerker_id',
            'naam',
            // 'menu_id',
                        [
                'attribute'=>'status',
                'filter'=>$statusList,
            ],
            //'timestamp',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Bestelling $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
