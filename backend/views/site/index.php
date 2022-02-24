<?php

/** @var yii\web\View $this */
/**
 *
 * @var $latestVideo \common\models\Video
 * @var $numberOfViews integer
 * @var $numberOfSubscriber integer
 * @var $subscribers \common\models\Subscriber[]
 */
$this->title = 'My Yii Application';
?>
<div class="site-index d-flex">
  <div class="card m-2" style="width: 14rem;">
    <div class="ratio ratio-16x9">
      <video width="100%"
        poster="<?php echo $latestVideo->getThumbnailLink() ?>"
        src="<?php echo $latestVideo->getVideoLink() ?>"
      ></video>
    </div>
    <div class="card-body">
      <h6 class="card-title"><?php echo $latestVideo->title ?></h6>
      <p class="card-text">
                Likes: <?php echo $latestVideo->getLikes()->count() ?>
                <br>
                Views: <?php echo $latestVideo->getViews()->count() ?>
            </p>
      <a
        href="<?php echo \yii\helpers\Url::to(['/video/update', 'id' => $latestVideo->video_id]) ?>"
        class="btn btn-primary"
      >Edit</a>
    </div>
  </div>
  <div class="card m-2" style="width: 14rem;">
    <div class="card-body">
      <h6 class="card-title">Total Views</h6>
      <p class="card-text" style="font-size: 48px;">
                <?php echo $numberOfViews ?>
            </p>
    </div>
  </div>
  <div class="card m-2" style="width: 14rem;">
    <div class="card-body">
      <h6 class="card-title">Total Subscribers</h6>
      <p class="card-text" style="font-size: 48px;">
                <?php echo $numberOfSubscriber ?>
            </p>
    </div>
  </div>
  <div class="card m-2" style="width: 14rem;">
    <div class="card-body">
      <h6 class="card-title">Latest Subscribers</h6>
            <?php foreach ($subscribers as $subscriber): ?>
            	<div>
            		<?php echo $subscriber->user->username ?>
            	</div>
            <?php endforeach; ?>
        </div>
  </div>
</div>