<?php

namespace app\controllers;
use app\models\Category;
use app\models\Product;
use Yii;
use yii\data\Pagination;

class CategoryController extends AppController{

    public function actionIndex(){
        $hits = Product::find()->where(['hit' => '1'])->limit(6)->all();
        $this->setMeta('E-SHOPER - главная страница');
        return $this->render('index', compact('hits'));
    }

    public  function actionView($id)
    {
        //$id = Yii::$app->request->get($id);
        $category = Category::findOne($id);

       if (empty($category)) { // item does not exist
            throw new \yii\web\HttpException(404, 'Фиг Вам, а не товары, надодо было раньше приходить...');
        }
        //$products = Product::find()->where(['category_id' => $id])->all();
        $query = Product::find()->where(['category_id' => $id]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 3, 'pageSizeParam' => false, 'forcePageParam' => false]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        $this->setMeta('E-SHOPER | '.$category->name, $category->keywords, $category->description );
        return $this->render('view', compact('products','pages', 'category'));

    }

    public function actionSearch()
    {
        $q = Yii::$app->request->get('q');
        $this->setMeta('E-SHOPER | Посиск: '.$q);
        if(!$q) return $this->render('search');// от пустой строки в поиске
        $query = Product::find()->where(['like', 'name', $q]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 3, 'pageSizeParam' => false, 'forcePageParam' => false]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('search', compact('products','pages', 'q'));


    }

}
