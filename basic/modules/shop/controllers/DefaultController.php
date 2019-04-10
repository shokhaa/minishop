<?php

namespace app\modules\shop\controllers;

use app\modules\shop\models\Cart;
use app\modules\shop\models\ProductsSearch;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Default controller for the `shop` module
 */
class DefaultController extends Controller
{
    public function behaviors()
    {

        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],

        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionAddtocart($id)
    {
        $userID = Yii::$app->user->identity->id;

        $cart = Cart::find()->where(['product_id' => $id])->one();

        if ($cart) {
            $cart->qty++;
            if ($cart->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Такой товар было у вас козинке но мы еще раз добавили его'));
                return $this->redirect('/shop');
            }
        } else
        $model = new Cart();
        $model->product_id = $id;
        $model->qty = 1;
        $model->user_id = $userID;
        $model->created_date = date('Y-m-d');
        if ($model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Успешно завершено'));
            return $this->redirect('/shop');

        }


    }

    public function actionMycart(){
        $userID = Yii::$app->user->identity->id;



        $model = Cart::find()->with('user')->with('product')->where(['user_id' => $userID])->asArray()->all();


        return $this->render('cart', [
            'model' => $model,
        ]);


    }





}
