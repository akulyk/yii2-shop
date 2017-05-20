<?php
/**
 * Created by PhpStorm.
 * User: akulyk
 * Date: 16.05.2017
 * Time: 22:37
 */

namespace common\bootstrap;

use shop\services\ContactService;
use yii\base\BootstrapInterface;
use yii\di\Instance;
use yii\mail\MailerInterface;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $container = \Yii::$container;
        $container->setSingleton(MailerInterface::class, function () use ($app) {
            return $app->mailer;
        });
        $container->setSingleton(ContactService::class, [], [
            $app->params['adminEmail'],
        //    Instance::of(MailerInterface::class) можно не указывать - фреймворк сам спарсит через рефлексию
        ]);
    }/**/
}/* end of Class */