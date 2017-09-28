<?php

namespace app\admin\model;
use think\Model;

class Cate extends Model
{
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
        static $arr =array();
        foreach ($data as $key => $value) {
            if($value['pid']==$pid){
                $value['level'] = $level;
                $arr[]  = $value;
                $this->sort($data,$value['id'],$level+1);
            }
        }
        return $arr;
    }

    /**
     *  删除id为的条目
     */
    public  function del($id){
        if(empty($id)){
            return 0;
        }
       $res = $this->where('id','=',$id)->delete();
        return $res;
    }


    /**
     *删除需要删除条目的子栏目
     */
    public function delList($data,$id = 0){
        //static $arr =array();
        if(is_array($data) || !empty($data) || !empty($id)){
            foreach ($data as $key => $value) {
                if($value['pid']==$id){
                    $this->delList($data,$value['id']);
                    $this->where('id','=',$value['id'])->delete();
                }
            }
        }
    }


}
