<?php
namespace app\index\controller;

class Page extends Base
{
    public function page()
    {
        return $this->fetch();
    }
}
