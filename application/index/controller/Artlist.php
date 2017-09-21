<?php
namespace app\index\controller;

class Artlist extends Base
{
    public function index()
    {
        return $this->fetch();
    }
}
