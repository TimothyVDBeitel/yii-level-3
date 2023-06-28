<?php

namespace app\controllers;

use yii\helpers\ArrayHelper;
use Yii;
use app\models\Medewerker;
use app\models\Bestelling;
use app\models\Menu;
use app\models\BestellingSearch;
use app\models\MedewerkerSearch;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BestellingController implements the CRUD actions for Bestelling model.
 */
class BestellingController extends Controller
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
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Bestelling models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BestellingSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $statusList = ['besteld'=>'is besteld', 'klaar'=>'is klaar', 'betaald'=>'is betaald'];
        $medewerkers = Medewerker::find()->all();
        $menu = Menu::find()->all();
        $menuList = ArrayHelper::map($menu, 'id', 'naam');


        $medewerkerList = ArrayHelper::map($medewerkers, 'id', 'naam');

        // print_r($medewerkerList);
        // exit;


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'statusList' => $statusList,
            'medewerkers'=>$medewerkerList,
            'menu'=>$menuList

        ]);
    }

    /**
     * Displays a single Bestelling model.
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
     * Creates a new Bestelling model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Bestelling();
        $medewerkers = Medewerker::find()->all();
        $menu = Menu::find()->all();// Timothy van den Beitel
        // $sql="select * from medewerker";
        // $medewerkers = Yii::$app->db->createCommand($sql)->queryAll();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
    
        return $this->render('create', [
            'model' => $model,
            'medewerkers' => $medewerkers,
            'menu' => $menu,// Timothy van den Beitel
    
       ]);
    }

    /**
     * Updates an existing Bestelling model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $medewerkers = Medewerker::find()->all();
        $menu = Menu::find()->all();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'medewerkers' => $medewerkers,
            'menu' => $menu,// Timothy van den Beitel
    
       ]);
    }

    /**
     * Deletes an existing Bestelling model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Bestelling model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Bestelling the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Bestelling::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
