<?php

namespace app\modules\sergey144010\docReader;


class Module extends \yii\base\Module
{
    public $docPath;

    public function init()
    {
        parent::init();
        $this->params['module.sergey144010.docReader.docPath'] = $this->docPath;
    }
}