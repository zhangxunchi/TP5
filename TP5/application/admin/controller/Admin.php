<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;//引用
use think\paginator;
use think\config;
use app\admin\model\Admin as AdminModel;
class Admin  extends  Controller
{





    /*显示信息*/
    public function lst()
    {

        /*$list=db('admin')->order("id desc")->paginate(5);*/
        $res= new AdminModel();
        $select=$res->select();
        $page=$select->render();
        $this->assign('list',$select);
        $this->assign('page',$page);
        return view();
    }

    /*添加管理员*/
    public  function  add()
    {
        if (request()->isPost()) {
            $pwd = md5(input("post.")['pwd']);
            $name=input("post.")['name'];
            $post=['name'=>$name,'pwd'=>$pwd];
            $admin= new AdminModel();
            if($admin->AddAdmin($post)){
                $this->success("添加管理员成功",url('lst'));
            }else{
                $this->error("添加管理员失败");
            }
        }
        return view();
    }

    /*删除管理员*/
    public  function  del(){
        $id=input('aid');
        db('admin')->where('id',$id)->delete();
        $this->redirect("admin/lst");
        return;
    }

    /*修改管理员*/
    public  function  edit(){
        $id=input("id");
        $select=db("admin")->where("id=".$id)->find();
        $this->assign("select",$select);
        $pwd=md5(input("post.pwd"));
        $name=input("post.name");
        if(!is_null($pwd)&&!is_null($name)){
            $row=db("admin")->where("id",$id)->update(['name'=>$name,'pwd'=>$pwd]);
            if($row){
                $this->success("修改成功",url("lst"));
            }
        }
        return  view();
    }
}
