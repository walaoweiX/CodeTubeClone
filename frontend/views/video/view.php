<?php

/**
 * @var $model \common\models\Video
 * @var $similarVideos \common\models\Video[]
 */


?>

<div class="row">
    <div class="col-sm-8">
        <div class="ratio ratio-16x9">
            <video width="100%" poster="<?php echo $model->getThumbnailLink() ?>" src="<?php echo $model->getVideoLink() ?>" controls></video>
        </div>
        <h6><?php echo \yii\helpers\Html::encode($model->title) ?></h6>
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <?php echo $model->getViews()->count() ?> views .
                <?php echo \Yii::$app->formatter->asDate($model->created_at) ?>
            </div>
            <div>
                <?php \yii\widgets\Pjax::begin() ?>
                <?php echo $this->render('_buttons', [
                    'model' => $model
                ]); ?>
                <?php \yii\widgets\Pjax::end() ?>
            </div>
        </div>
        <div>
            <p>
                <?php echo yii\helpers\Html::a($model->createdBy->username, [
                    'channel/view', 'username' => $model->createdBy->username,
                ], ['class' => 'text-dark']) ?>
            </p>
            <?php echo \yii\helpers\Html::encode($model->description) ?>
        </div>
    </div>
    <div class="col-sm-4">
        <?php foreach ($similarVideos as $similarVideo) : ?>
            <div class="media mb-2">
                <a class=" align-self-center" href="<?php echo \yii\helpers\Url::to(['video/view', 'id' => $similarVideo->video_id]) ?>">
                    <div class="ratio ratio-16x9 mr-2" style="width: 120px;">
                        <video width="100%" poster="<?php echo $similarVideo->getThumbnailLink() ?>" src="<?php echo $similarVideo->getVideoLink() ?>"></video>
                    </div>
                </a>
                <div class="media-body">
                    <h6 class="m-0"><?php echo $similarVideo->title ?></h6>
                    <div class="text-muted">
                        <p class="m-0">
                            <?php echo yii\helpers\Html::a($similarVideo->createdBy->username, [
                                'channel/view', 'username' => $similarVideo->createdBy->username,
                            ], ['class' => 'text-dark']) ?>
                        </p>
                        <p>
                            <?php echo $similarVideo->getViews()->count() ?> views .
                            <?php echo \Yii::$app->formatter->asDate($similarVideo->created_at) ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>