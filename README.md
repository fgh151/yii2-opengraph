Open graph tags
===============
Add open graph tags

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist fgh151/yii2-opengraph "*"
```

or add

```
"fgh151/yii2-opengraph": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, add it to component config  :

```php
'components' => [
   'opengraph' => [
       'class' => 'fgh151\opengraph\OpenGraph',
   ],
   //....
],
```

Then in controller or view set og tags

```php
Yii::$app->opengraph->title = 'My post';
Yii::$app->opengraph->description = 'My post description';
Yii::$app->opengraph->image = 'http://site.ru/image.jpg';
```