<?php
/**
 * Created by PhpStorm.
 * User: Master
 * Date: 02.09.2018
 * Time: 20:00
 */

namespace app\controllers;
use app\models\Product;
use app\models\Cart;
use Yii;
use app\models\OrdeItems;
use app\models\Order;

class CartController extends AppController
{
    public function actionAdd()
    {
        $id=Yii::$app->request->get('id');
        $qty=(int)Yii::$app->request->get('qty');
        $qty = !$qty ? 1 : $qty;
        $product = Product::findOne($id);
        if(empty($product)) return false;
        $session=Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product, $qty);
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionClear()
    {
        $session=Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionShow()
    {
        $session=Yii::$app->session;
        $session->open();
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionDelItem(){
        $id = Yii::$app->request->get('id');
        $session =Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->recalc($id);
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionView()
    {
        $session=Yii::$app->session;
        $session->open();
        $this->setMeta('Оформление заказа');
        $order = new Order();
        if( $order->load(Yii::$app->request->post()) ){
            debag(Yii::$app->request->post());
        }
        return$this->render('view', compact('session','order'));
    }
}