<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 07.11.2018
 * Time: 16:34
 */

namespace app\controllers;


use yii\web\Controller;

class AppController extends Controller
{

    protected function setMeta($title = null, $keywords = null, $description = null){

        $this->view->title = $title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => "$keywords"]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => "$description"]);

    }

}