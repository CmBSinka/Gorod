<?php

namespace app\controllers;

use app\models\Request;
use app\models\RequestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * RequestController implements the CRUD actions for Request model.
 */
class RequestController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST', 'GET'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Request models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RequestSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Request model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Request model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Request();
        if ($this->request->isPost) {
            $model->load($this->request->post());
            $model->photo=UploadedFile::getInstance($model,'photo');
            $file_name = '/web/photo/' . \Yii::$app->getSecurity()->generateRandomString(50) . '.' . $model->photo->extension;
            $model->photo->saveAs(\Yii::$app->basePath . $file_name);
            $model->photo=$file_name;
            $model->user_id = \Yii::$app->user->identity->id;
            if ($model->save(false)) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    /**
     * Updates an existing Request model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ((\Yii::$app->user->isGuest) || (\Yii::$app->user->identity->is_admin==0))
        {
            $this->goBack();
            return false;
        }
        if ($this->request->isPost) {
            $model->load($this->request->post());
            $model->photo_after = UploadedFile::getInstance($model, 'photo_after');
            $file_name = '/web/photo/' . \Yii::$app->getSecurity()->generateRandomString(50) . '.' . $model->photo_after->extension;
            $model->photo_after->saveAs(\Yii::$app->basePath . $file_name);
            $model->photo_after = $file_name;
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Request model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['/user/view?id='.\Yii::$app->user->identity->id]);
    }

    /**
     * Finds the Request model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Request the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Request::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionAdminp()
    {
        if ((\Yii::$app->user->isGuest) || (\Yii::$app->user->identity->is_admin==0)){
            $this->redirect(['site/login']);
            return false;
            }
        $searchModel = new RequestSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('adminp', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
     }
}
