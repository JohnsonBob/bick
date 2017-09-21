<?php
namespace app\index\controller;

class Artlist extends Base
{
    public function artlist()
    {
        return $this->fetch();
    }
}
