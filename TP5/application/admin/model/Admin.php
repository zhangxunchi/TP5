<?php
namespace app\admin\model;
use think\Model;
use think\ config;
class Admin extends Model{

    public  function AddAdmin($data){
        if(empty($data)||!is_array($data)){
            return false;
        }
        if($this->save($data)){
            return true;
        }else{
            return false;
        }

    }


    public  function  select(){
        $row=\think\config::get('paginate')['list_rows'];//获取配置文件里面的信息。
        return $this->order("id desc")->paginate($row);
    }


}
