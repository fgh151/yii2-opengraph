<?php

namespace fgh151\opengraph;

use Yii;
use yii\web\View;

/**
 *
 * Class OpenGraph
 * Подключение:
 * 'components' => [
 *  'opengraph' => [
 *      'class' => 'fgh151\opengraph\OpenGraph',
 *  ],
 *  //....
 * ],
 * Использование:
 * Перед рендером вызвать:
 * Yii::$app->opengraph->title = 'My_Article';
 * Yii::$app->opengraph->description = 'My_Article_Description';
 * Yii::$app->opengraph->image = 'http://image.for.my/article';
 */

class OpenGraph{
    public $title;
    public $siteName;
    public $url;
    public $description;
    public $type;
    public $locale;
    public $image;

    public function __construct(){
        $this->title = Yii::$app->name;
        $this->siteName = Yii::$app->name;
        $this->url = Yii::$app->request->absoluteUrl;
        $this->description = null;
        $this->type = 'article';
        $this->locale = str_replace('-','_',Yii::$app->language);
        $this->image = null;

        Yii::$app->view->on(View::EVENT_BEGIN_PAGE, [$this, 'addTags']);
    }

    /**
     * Register og tags
     */
    public function addTags()
    {
        Yii::$app->controller->view->registerMetaTag([
            'property'=>'og:title',
            'content'=>$this->title
        ], 'og:title');
        Yii::$app->controller->view->registerMetaTag([
            'property'=>'og:site_name',
            'content'=>$this->siteName
        ], 'og:site_name');
        Yii::$app->controller->view->registerMetaTag([
            'property'=>'og:url',
            'content'=>$this->url
        ], 'og:url');
        Yii::$app->controller->view->registerMetaTag([
            'property'=>'og:type',
            'content'=>$this->type
        ], 'og:type');

        Yii::$app->controller->view->registerMetaTag([
            'property'=>'og:locale',
            'content'=>$this->locale
        ], 'og:locale');
        if($this->description!==null){
            Yii::$app->controller->view->registerMetaTag([
                'property'=>'og:description',
                'content'=>$this->description
            ], 'og:description');
        }
        if($this->image!==null){
            Yii::$app->controller->view->registerMetaTag([
                'property'=>'og:image',
                'content'=>$this->image
            ], 'og:image');
        }
    }

    /**
     * @param array $tags
     */
    public function set(array $tags){
        foreach($tags as $property=>$content){
             if(property_exists($this, $property)){
                $this->$property = $content;
            }
        }
    }

}