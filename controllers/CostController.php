<?php

namespace halumein\consumption\controllers;

use halumein\consumption\models\search\CostSearch;
use Yii;
use halumein\consumption\models\Cost;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CostController implements the CRUD actions for Cost model.
 */
class CostController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Cost models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Cost::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionProblem()
    {
        $searchModel = new CostSearch();

        $searchParams = Yii::$app->request->queryParams;
        $searchParams['CostSearch']['income_id'] = null;

        $dataProvider = $searchModel->search($searchParams);

        return $this->render('problem', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionResolveProblem()
    {
        //var_dump(Yii::$app->request->post()); //позже будет забирать с activeFields
        //ищем все проблемные
        //var_dump("йохохо");

        $this->redirect('problem');
    }

    /**
     * Finds the Cost model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cost the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cost::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionNullupdate()
    {
        $get = Yii::$app->request->get();
        $id = $get['id'];


        $model = $this->findModel($id);
//        echo "<pre>";
//        var_dump($model);
//        die;
        $array =  Yii::$app->consumption->setNullCost($model);

        return true;


    }
}
