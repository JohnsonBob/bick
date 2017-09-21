<?php
namespace app\index\controller;

class Page extends Base
{
    public function index()
    {
        return $this->fetch();
    }
}
