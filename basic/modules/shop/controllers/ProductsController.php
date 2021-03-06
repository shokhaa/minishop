<?php

namespace app\modules\shop\controllers;


use app\models\Images;
use app\models\PhotoUpload;
use app\modules\shop\models\Category;
use app\modules\shop\models\CatProduct;
use app\modules\shop\models\InfoProduct;
use app\modules\shop\models\Type;
use Yii;
use app\modules\shop\models\Products;
use app\modules\shop\models\ProductsSearch;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {

        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['index'],
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
     * Lists all Products models.
     * @return mixed
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

    /**
     * Displays a single Products model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        /** @var TYPE_NAME $productInfo */
        $productInfo = InfoProduct::find()->where(['product_id' => $id])->all();
        $produuctImages = \app\modules\shop\models\Images::find()->where(['product_id' => $id])->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'productInfo' => $productInfo,
            'productImages' => $produuctImages
        ]);
    }

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Products();
        $uploadPhotoProduct = new \app\modules\shop\models\PhotoUpload();

        $typeArray = Type::find()->asArray()->indexBy('id')->all();


        $type = ArrayHelper::map($typeArray, 'id', 'title');


        $category = Category::find()->all();
        $category = ArrayHelper::map($category, 'id', 'title');


        if ($model->load(Yii::$app->request->post())) {

            $uploadPhotoProduct->file = UploadedFile::getInstances($uploadPhotoProduct, 'file');

//            echo "<pre>";
//            print_r($_POST);
//            print_r($uploadPhotoProduct->file);
//            die('stop');
            $db = Yii::$app->db;
            $transaction = $db->beginTransaction();

            try {
                $model->save();
                foreach ($_POST['category'] as $category) {

                    $catProduct = new CatProduct();
                    $catProduct->product_id = $model->id;
                    $catProduct->category_id = $category;
                    $catProduct->save();
                }
                foreach ($_POST['info'] as $item) {
                    $infoProduct = new InfoProduct();
                    $infoProduct->product_id = $model->id;
                    $infoProduct->info_name = $item['name'];
                    $infoProduct->info_value = $item['value'];
                    $infoProduct->save();
                }
                foreach ($uploadPhotoProduct->file as $file) {
                    $gen = Yii::$app->security->generateRandomString(7);
                    $file->saveAs('uploads/product/' . $gen . '.' . $file->extension);

                    $image = new \app\modules\shop\models\Images();
                    $image->name = $gen . '.' . $file->extension;
                    $image->product_id = $model->id;
                    $image->save();
                }

                $transaction->commit();
                return $this->redirect(['view', 'id' => $model->id]);
            } catch (\Exception $e) {
                $transaction->rollBack();
                throw $e;
            } catch (\Throwable $e) {
                $transaction->rollBack();
            }


        }


        return $this->render('create', [
            'model' => $model,
            'type' => $type,
            'category' => $category,
            'uploadPhotoProduct' => $uploadPhotoProduct
        ]);
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $typeArray = Type::find()->asArray()->indexBy('id')->all();
        $category = Category::find()->all();
        $category = ArrayHelper::map($category, 'id', 'title');


        $selectedCategory = [];
        foreach ($model->category as $item) {
            $selectedCategory[] = $item->id;
        }

        $type = ArrayHelper::map($typeArray, 'id', 'title');

        if ($model->load(Yii::$app->request->post())) {

            $delIngredients = CatProduct::deleteAll(['product_id' => $model->id]);
            if ($delIngredients && $model->save()) {
                foreach ($_POST['category'] as $item) {

                    $catProduct = new CatProduct();
                    $catProduct->product_id = $model->id;
                    $catProduct->category_id = $item;
                    $catProduct->save();
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'type' => $type,
            'selectedCategory' => $selectedCategory,
            'category' => $category
        ]);
    }

    /**
     * Deletes an existing Products model.
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

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
