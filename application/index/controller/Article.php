<?php
namespace app\index\controller;

class Article extends Base
{
    public function index()
    {
        return $this->fetch();
    }
}
