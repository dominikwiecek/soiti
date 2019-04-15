<?php

namespace app\controllers;

use Yii;
use app\models\Publication;
use app\models\Author;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PublicationController implements the CRUD actions for Publication model.
 */
class PublicationController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update', 'delete'],
                'rules' => [
                    [
//                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Publication models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Publication::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Publication model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Publication model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Publication();
        $authors = array();
        if(!empty(Yii::$app->request->post()) && !empty(Yii::$app->request->post()['Publication']['Authors'])){
            $authors = Yii::$app->request->post()['Publication']['Authors'];
            Yii::$app->request->post()['Publication']['Authors'] = NULL;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Author::deleteAll(['idPublication' => $model->idPublication]);
            foreach($authors as $order => $idAuthor){
                $author = new Author();
                $author->idPublication = $model->idPublication;
                $author->idUser = $idAuthor;
                $author->Order = $order;
                $author->save();
                unset($author);
            }
            return $this->redirect(['view', 'id' => $model->idPublication]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Publication model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        $authors = array();
        if(!empty(Yii::$app->request->post()) && !empty(Yii::$app->request->post()['Publication']['Authors'])){
            $authors = Yii::$app->request->post()['Publication']['Authors'];
            Yii::$app->request->post()['Publication']['Authors'] = NULL;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Author::deleteAll(['idPublication' => $model->idPublication]);
            foreach($authors as $order => $idAuthor){
                $author = new Author();
                $author->idPublication = $model->idPublication;
                $author->idUser = $idAuthor;
                $author->Order = $order;
                $author->save();
                unset($author);
            }
            return $this->redirect(['view', 'id' => $model->idPublication]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Publication model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Publication model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Publication the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Publication::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
