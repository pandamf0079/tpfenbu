<?php
namespace app\index\controller;
use think\Session;
use think\Request;
class Index  extends \think\Controller
{
    public function index()
    {
        return $this->fetch();
    }
	
	
	//个人中心
	public function my()
    {	
		if(!Session::get('sess_admin')){
	  		return $this->error('请先登陆',url('/index/index/login'));
		}else{
			$user_info = Session::get('sess_admin');
		}
		$this->assign('ip', $_SERVER['SERVER_NAME']);
		$this->assign('user_info', $user_info);
        return $this->fetch();
    }
	
	//登录
	public function login()
    {
        return $this->fetch();
    }
	
	//登出
	public function loginout()
    {
       Session::set('sess_admin',NULL);
	   $this->success('登出成功', '/'); 
    }
	
	//提交
	public function submit(Request $request)
    {	
	
		$username = $request->param('username');
		$pass = $request->param('pass');
		
		$userlist = ['username'=>'superman','pass'=>'123456','sex'=>'男','account'=>100,'login_time'=>time()];

		if($username==$userlist['username'] && $pass == $userlist['pass'] ){
			Session::set('sess_admin',$userlist);
			$this->success('登陆成功', '/');
		}else{
			$this->error('用户名或密码错误!');
			
		}
		

    }
}
