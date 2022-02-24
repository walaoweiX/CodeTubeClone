<?php

namespace frontend\controllers;

use Yii;
use \yii\data\ActiveDataProvider;
use \yii\web\Controller;
use \common\models\Video;
use common\models\VideoLike;
use common\models\VideoView;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class VideoController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['like', 'dislike', 'history'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ]
            ],
            'verb' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'like' => ['post'],
                    'dislike' => ['post'],
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Video::find()->published()->latest(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $this->layout = 'auth';
        $video = $this->findVideo($id);

        $videoView = new VideoView();
        $videoView->video_id = $id;
        $videoView->user_id = Yii::$app->user->id;
        $videoView->created_at = time();
        $videoView->save();

        $similarVideos = Video::find()
            ->published() 
            ->byKeyword($video->title)
            ->andWhere(['NOT', ['video_id' => $id]])
            ->limit(5)
            ->all();

            // echo '<pre>';
            // var_dump($similarVideos);
            // echo '</pre>';
            // exit;

        return $this->render('view', [
            'model' => $video,
            'similarVideos' => $similarVideos,
        ]);
    }

    public function actionSearch($keyword)
    {
        $query = Video::find()
                ->published()
                ->latest();
        
        if ($keyword) {
            $query->byKeyword($keyword);
        }
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('search', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionHistory() {
        $query = Video::find()
            ->alias('v')
            ->innerJoin("(SELECT video_id, MAX(created_at) as max_date FROM video_view WHERE user_id = :userId GROUP BY video_id) vv", 'vv.video_id = v.video_id', ['userId' => \Yii::$app->user->id])
            ->orderBy("vv.max_date DESC");

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('history', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionLike($id)
    {
        $video = $this->findVideo($id);
        $user_id = Yii::$app->user->id;

        $videoLikeDislike = VideoLike::find()->userIdVideoId($user_id, $id)->one();

        if (!$videoLikeDislike) {
            $this->saveLikeDislike($id, $user_id, VideoLike::TYPE_LIKE);
        } else if ($videoLikeDislike->type == VideoLike::TYPE_LIKE) {
            $videoLikeDislike->delete();
        } else {
            $videoLikeDislike->delete();
            $this->saveLikeDislike($id, $user_id, VideoLike::TYPE_LIKE);
        }

        return $this->renderAjax('_buttons', [
            'model' => $video,
        ]);
    }

    public function actionDislike($id)
    {
        $video = $this->findVideo($id);
        $user_id = Yii::$app->user->id;

        $videoLikeDislike = VideoLike::find()->userIdVideoId($user_id, $id)->one();

        if (!$videoLikeDislike) {
            $this->saveLikeDislike($id, $user_id, VideoLike::TYPE_DISLIKE);
        } else if ($videoLikeDislike->type == VideoLike::TYPE_DISLIKE) {
            $videoLikeDislike->delete();
        } else {
            $videoLikeDislike->delete();
            $this->saveLikeDislike($id, $user_id, VideoLike::TYPE_DISLIKE);
        }

        return $this->renderAjax('_buttons', [
            'model' => $video,
        ]);
    }

    protected function saveLikeDislike($videoId, $userId, $type)
    {
        $videoLikeDislike = new VideoLike();
        $videoLikeDislike->video_id = $videoId;
        $videoLikeDislike->user_id = $userId;
        $videoLikeDislike->type = $type;
        $videoLikeDislike->created_at = time();
        $videoLikeDislike->save();
    }

    protected function findVideo($id)
    {
        $video = Video::findOne($id);

        if (!$video) {
            throw new NotFoundHttpException("Video does not exist");
        }
        return $video;
    }
}
