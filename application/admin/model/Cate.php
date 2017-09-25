<?php

namespace app\admin\model;
use think\Model;

class Cate extends Model
{
    protected $table = 'bk_admin';

    public  function getAdmin(){
        return $this->select();
        return $this->paginate(5);
    }

    /**
     * 添加新栏目
     * @param $data
     */
    public function addCate($data){
        if(empty($data) || !is_array($data)){
            return false;
        }
        if($data['password']){
            $data['password'] = md5($data['password']);
            if($this->save($data)){
                return true;
            }
        }
        return false;
    }
}
