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

    /**
     * 在添加数据库之前上传图片
     */
    protected static function init()
    {
        parent::init();
        Article::event('before_insert',function ($article) {
            if($_FILES['thumb']['tmp_name']){
                // 获取表单上传文件 例如上传了001.jpg
                $file = request()->file('thumb');
                // 移动到框架应用根目录/public/uploads/ 目录下
                if($file){
                    $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                    if($info){
                        $article['thumb'] = '/public'. DS . 'uploads'. DS .$info->getSaveName();
                    }
                }
            }
        });

        Article::event('before_update',function ($article) {
            if($_FILES['thumb']['tmp_name']){
                // 获取表单上传文件 例如上传了001.jpg
                $file = request()->file('thumb');
                // 移动到框架应用根目录/public/uploads/ 目录下
                if($file){
                    $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                    if($info){
                        $article['thumb'] = '/public'. DS . 'uploads'. DS .$info->getSaveName();
                        //删除旧图片
                        $res = Article::where('id','=',$article['id'])->find();
                        $path = $_SERVER['DOCUMENT_ROOT'].$res['thumb'];
                        if(file_exists($path)){
                            unlink($path);
                        }
                    }
                }
            }
        });

        Article::event('before_delete',function ($article) {
            $res = Article::where('id','=',$article['id'])->find();
            $path = $_SERVER['DOCUMENT_ROOT'].$res['thumb'];
            if(file_exists($path)){
                unlink($path);
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



    /**
     *获取文章列表
     */
    public function getArticle(){
        return  $res=$this->field('a.*,b.catename')->alias('a')->join('bk_cate b','a.cateid=b.id')->paginate(5);
    }

    /**
     *  删除id为的文章
     */
    public  function del($id){
        if(empty($id)){
            return 0;
        }
        //$res = $this->where('id','=',$id)->delete();
        $res = Article::destroy($id);
        return $res;
    }

    public function editArticle($data){
        if(empty($data) || !is_array($data)){
            return false;
        }
       /* $old = $this->where('id','=',$data['id'])->find();
        if($old['catename'] == $data['catename'] && $old['type'] == $data['type'] && $old['id'] == $data['id'] && $old['pid'] == $data['pid']){
            return true;
        }*/
       /* $res = $this->save([
            'title'  => $data['title'],
            'author'  => $data['author'],
            'keywords' => $data['keywords'],
            'desc'  => $data['desc'],
            'cateid'  => $data['cateid'],
            'content'  => $data['content'],
            'thumb'  => $data['thumb']
        ],['id' => $data['id']]);*/

        $res = $this->save($data,['id' => $data['id']]);
        if($res){
            return true;
        }
        return false;
    }

}
