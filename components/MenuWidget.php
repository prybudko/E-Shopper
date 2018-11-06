<?php

namespace app\components;


use yii\base\Widget;

class MenuWidget extends Widget
{
    public $tpl;

    public function init()
    {
        parent::init();
        if ($this->tpl === null){
            $this->tpl = 'menu';
        }else{
            $this->tpl = 'select';
        }
        $this->tpl .= '.php';
    }

    public function run()
    {
        return $this->tpl;
    }

}