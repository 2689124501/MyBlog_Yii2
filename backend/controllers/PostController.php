<?php

namespace backend\controllers;

use Yii;
use common\models\Post;
use common\models\PostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],            
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        // $post =  Yii::$app->db->createCommand('select * from post where id=:id and status=:status')
        // ->bindValue(':id', $_GET['id'])     //绑定值
        // ->bindValue(':status', 2)
        // ->queryOne();
        // $post = Post::find()->where(['status'=>1])->all();
        //     //有可替代的函数
        //     //Post::findOne(1); 查询主键为1的记录
        //     //Post::findAll(['status'=>1,]);
        //复杂的查询 排序 like 
        // $post = Post::find()->where(['AND', ['status'=>2], ['author_id'=>1], ['like', 'title', 'yii2']])->orderBy('id')->all();

        // //访问列数据 AR对象的属性 对应为数据行的列        
        // echo $post->id;
        // echo '<br />';
        // echo $post->author_id;
        // echo '<br />';
        // echo $post->status;
        // echo '<br />';
        // echo $post->title;
        // 用all搜索到的结果是一个对象数组
        // foreach($post as $item){
        //     echo $item->id;
        //     echo '<br />';
        //     echo $item->author_id;
        //     echo '<br />';
        //     echo $item->status;
        //     echo '<br />';
        //     echo $item->title;
        //     echo '<br />';
        //     echo '<br />';
        // }
        // var_dump($post);
        // exit(0);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!Yii::$app->user->can('createPost')){
            throw new ForbiddenHttpException('对不起，你没有进行该操作的权限。');
        }

        $model = new Post();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(!Yii::$app->user->can('updatePost')){
            throw new ForbiddenHttpException('对不起，你没有进行该操作的权限。');
        }

        // 先读出需要修改的文章Post对象
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())/*←是否有数据提交 是否能成功保存到数据库→*/ && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if(!Yii::$app->user->can('deletePost')){
            throw new ForbiddenHttpException('对不起，你没有进行该操作的权限。');
        }

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        //调用Post类的findOne静态方法
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
