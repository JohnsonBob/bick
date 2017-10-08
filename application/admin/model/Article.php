<?php

namespace app\admin\model;
use think\Model;

class Article extends Model
{
    //自定义初始化
    protected function initialize()
    {
        //需要调用`Model`的`initialize`方法
        parent::initialize();
        //TODO:自定义的初始化
    }

    protected static function init()
    {
        parent::init();
        Article::event('before_insert', function ($article) {
            if($_FILES['thumb']['tmp_name']){
                // 获取表单上传文件 例如上传了001.jpg
                $file = request()->file('thumb');
                // 移动到框架应用根目录/public/uploads/ 目录下
                if($file){
                    $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                    if($info){
                        $article['thumb'] = '__PUBLIC__'. DS . 'uploads'. DS .$info->getSaveName();
                    }
                }
            }
        });
    }

    /**
     *添加文章
     */
    public function addArticle($data){
        if(empty($data) || !is_array($data)){
            return false;
        }
        // $data['id'] =999999999999999999999999   ;
        if($this->save($data)){
            return true;
        }
        return false;
    }

}
