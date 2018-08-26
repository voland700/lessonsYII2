<?php
/**
 * Created by PhpStorm.
 * User: Master
 * Date: 25.08.2018
 * Time: 12:08
 */

namespace app\controllers;


use yii\web\Controller;

class AppController extends Controller
{
    protected function setMeta($title = null, $keywords = null, $description = null)
    {
        $this->view->title = $title;
        $this->view->registerMetaTag(['name'=>'keywords', 'content' => "$eywords"]);
        $this->view->registerMetaTag(['name'=>'description', 'content' => "$description"]);
    }

}