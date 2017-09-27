<?php

namespace app\admin\controller;

class Cate extends Base
{
    protected function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
    }

    /* public function _initialize(){
         $admin = model('admin');
     }*/

    public function lst()
    {
        $cate = model('cate');
        $data = $cate->getCate();
        $res= $cate->sort($data);
//        dump($res) ;
//        die();
        $this->assign('cateres',$res);

        return $this->fetch();
    }

    public function add(){
        $cate = model('cate');
        if($_POST){
            //var_dump($_POST);
//            dump(input('post.'));
//            die();
            if($cate->addCate(input('post.'))){
                $this->success('栏目添加成功',url('lst'));
            }else{

                $this->error('栏目添加失败',url('add'));
            }
            return;
        }
        $data = $cate->getCate();
        $res= $cate->sort($data);
        $this->assign('cateres',$res);

        return $this->fetch();
    }

}
