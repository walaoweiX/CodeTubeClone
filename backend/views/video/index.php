<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Videos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Video', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'video_id',
                'content' => function ($model) {
                    return $this->render('_video_item', ['model' => $model]);
                }
            ],
            [
                'attribute' => 'status',
                'content' => function ($model) {
                    return $model->getStatusLabels()[$model->status];
                }
            ],
            //'has_thumbnail',
            //'video_name',
            'created_at:datetime',
            'updated_at:datetime',
            //'created_by',
            [
                'class' => ActionColumn::className(),
                'template' => '{delete}',
                'buttons' => [
                    'delete' => function($url) {
                        return Html::a('Delete', $url, [
                            'data-method' => 'post',
                            'data-confirm' => 'Are you sure?',
                        ]);
                    }
                ],
                'urlCreator' => function ($action, \common\models\Video $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'video_id' => $model->video_id]);
                }
            ],
        ],
    ]); ?>


</div>