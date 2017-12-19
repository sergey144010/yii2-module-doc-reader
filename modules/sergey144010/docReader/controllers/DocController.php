<?php

namespace app\modules\sergey144010\docReader\controllers;

use yii\base\Module;
use yii\web\Controller;
use app\modules\sergey144010\docReader\services\Reader;

class DocController extends Controller
{
    private $reader;

    public function __construct($id, Module $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->reader = new Reader($module->params['module.sergey144010.docReader.docPath']);
    }

    public function actionIndex()
    {
        if(\Yii::$app->request->get('file')){
            $this->reader->parse(\Yii::$app->request->get('file'));
            $this->reader->normalize();
            return $this->render('index', [
                'file' => $this->reader->getString(),
            ]);
        };
        $this->reader->parse('README.md');
        $this->reader->normalize();
        return $this->render('index', [
            'file' => $this->reader->getString(),
        ]);

    }
}