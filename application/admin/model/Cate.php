<?php

namespace app\admin\model;
use think\Model;

class Cate extends Model
{
    //protected $table = 'bk_admin';

    public  function getCate(){
        return $this->select();
    }

    /**
     * 添加新栏目
     * @param $data
     */
    public function addCate($data){
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
     *对栏目进行排序
     */
    public function sort($data,$pid = 0, $level = 0){
         $arr =array();
        foreach ($data as $key => $value) {
            if($value['pid']==$pid){
                $value['level'] = $level;
                $arr[]  = $value;
                $this->sort($data,$pid =$value['id'],$level=$level+1);
            }
        }
       //dump($arr);
//        die();
        return $arr;
    }


}
