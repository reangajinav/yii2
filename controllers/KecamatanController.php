<?php

namespace app\controllers;

use Yii;
use app\models\Kecamatan;
use app\models\Provinsi;
use app\models\Kabupaten;
use app\models\KecamatanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\filters\AccessControl;

/**
 * KecamatanController implements the CRUD actions for Kecamatan model.
 */
class KecamatanController extends Controller
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
     * Lists all Kecamatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KecamatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Kecamatan model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Kecamatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Kecamatan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $provinsi = Provinsi::find()->all();
        $provinsi = ArrayHelper::map($provinsi,'id','nama');

        return $this->render('create', [
            'model' => $model,
            'provinsi' => $provinsi,
        ]);
    }

    /**
     * Updates an existing Kecamatan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $provinsi = Provinsi::find()->all();
        $provinsi = ArrayHelper::map($provinsi,'id_provinsi','nama_provinsi');

        return $this->render('update', [
            'model' => $model,
            'provinsi' => $provinsi,
        ]);
    }

    /**
     * Deletes an existing Kecamatan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionGetkabupaten() {
        Yii::$app->controller->enableCsrfValidation = false;
        $out = [];
        if (isset($_POST['depdrop_parents'][0])&& $_POST['depdrop_parents'][0]) {
            $parents = $_POST['depdrop_parents'];
            
            $id_provinsi = $parents[0];
            $output = Kabupaten::getDepDropOptions(['provinsi_id' => $id_provinsi]); 
            if(is_array($output))
            {
                $out = $output;
            }
            
        }

        echo Json::encode(['output' => $out, 'selected' => '']);

    }

    public function actionGetkecamatan() {
        Yii::$app->controller->enableCsrfValidation = false;
        $out = [];
        if (isset($_POST['depdrop_parents'][0])&& $_POST['depdrop_parents'][0]) {
            $parents = $_POST['depdrop_parents'];
            $provinsi_id = $parents[0];
            $kabupaten_id = $parents[1];
            $output = Kecamatan::getDepDropOptions(['kabupaten_id' =>$kabupaten_id]); 
            if(is_array($output))
            {
                $out = $output;
            }
            
        }

        echo Json::encode(['output' => $out, 'selected' => '']);

    }

    /**
     * Finds the Kecamatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Kecamatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kecamatan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
