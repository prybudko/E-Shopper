<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use Yii;
use yii\base\Exception;
use yii\data\Pagination;
use yii\web\HttpException;

class CategoryController extends AppController
{

    public function actionIndex()
    {
        $hits = Product::find()->where(['hit' => '1'])->asArray()->limit(6)->all();
        $this->setMeta("E-Shooper");
        return $this->render("index", compact('hits'));
    }

    public function actionView($id)
    {
        //$id = Yii::$app->request->get('id');

        $category = Category::findOne($id);
        if(empty($category)){
            throw new HttpException(404, 'Такой категории нет!');
        }

        //products with pagination
        $query = Product::find()->where(['category_id'=>$id])->asArray();
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        $this->setMeta('E-Shopper | '. $category->name, $category->keywords, $category->description);

        return $this->render('view', compact('products', 'pages', 'category'));
    }

    public function actionSearch()
    {
       $queryNameProduct = Yii::$app->request->get('search');
        if(empty($category)){
            throw new HttpException(404, 'По Вашему запросу ничего не найдено!');
        }
        //products with pagination
        $query = Product::find()->where(['like', 'name', $queryNameProduct])->asArray();
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        $this->setMeta('E-Shopper | '. $category->name, $category->keywords, $category->description);

        return $this->render('view', compact('products', 'pages', $queryNameProduct));
    }
}