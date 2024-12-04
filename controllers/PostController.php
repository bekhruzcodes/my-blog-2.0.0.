<?php

namespace app\controllers;

use app\models\Post;
use app\models\PostSearch;
use Throwable;
use Yii;
use yii\db\Exception;
use yii\db\StaleObjectException;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * PostsController implements the CRUD actions for Posts model.
 */
class PostController extends Controller
{
    /**
     * @inheritDoc
     */

    public $layout = 'blog';

    public function behaviors(): array
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::Class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Posts models.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Posts model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $id): string
    {
        $currentPost = Post::findOne($id);

        if (!$currentPost) {
            throw new NotFoundHttpException("The requested post does not exist.");
        }

        $previousPost = Post::find()
            ->where(['<', 'id', $id])
            ->orderBy(['id' => SORT_DESC])
            ->one();

        $nextPost = Post::find()
            ->where(['>', 'id', $id])
            ->orderBy(['id' => SORT_ASC])
            ->one();

        return $this->render('view', [
            'post' => $currentPost,
            'prevPost' => $previousPost,
            'nextPost' => $nextPost,
            'comments'=> []
        ]);
    }



    public function actionSendComment(): array
    {


        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Html::encode(Yii::$app->request->post('post_id'));
        $name = Html::encode(Yii::$app->request->post('cName'));
        $username = Html::encode(Yii::$app->request->post('cWebsite'));
        $message = Html::encode(Yii::$app->request->post('cMessage'));

        if ($name && $username && $message) {

            $text =
                "Name: $name\n" .
                "Telegram Username: $username\n" .
                "Message: $message";
            if($post!=0){
                $text = "New Comment:\n\n" ."Post: $post\n" .$text;
            }else{
                $this->sendEmail($username, 'subscribe');
            }

            $botToken = "7070665154:AAHB-IkRdas8vA8YNfVykZ-xU2OUj_XpDeM";
            $chatId = "5129089072";

            $telegramUrl = "https://api.telegram.org/bot$botToken/sendMessage";
            $data = [
                'chat_id' => $chatId,
                'text' => $text
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $telegramUrl);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);
            $error = curl_error($ch);
            curl_close($ch);


            return [
                'success' => true,
                'message' => 'Sent successfully!'
            ];
        }

        return [
            'success' => false,
            'message' => 'Please fill all fields.'
        ];
    }



    /**
     * Finds the Posts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): Post
    {
        if (($model = Post::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function sendEmail($email, $type=null)
    {
        if ($type == 'subscribe') {
            Yii::$app->mailer->compose('@app/views/mail/layouts/html')
                ->setFrom(['bekhruzbekmirzaliev744@gmail.com' => 'Bek and Dev'])
                ->setTo($email)
                ->setSubject('Hey, I have heard from you')
                ->send();


        }
    }
}