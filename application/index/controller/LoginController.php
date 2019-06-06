<?php
namespace app\index\controller;

use think\Controller;
use think\Request;  //请求
use app\common\model\Teacher; //教师模型

class LoginController extends Controller{

	//用户登录表单
	public function index(){

		//return 'index';
		 // 显示登录表单    
		return $this->fetch();
	}

	//处理用户提交的登录数据
	public function login(){
		//return 'login';
		//var_dump(input('post.'));
		$postData = Request::instance()->post();
		//验证用户名是否存在
		$map = array('username' => $postData['username']);
		$Teacher = Teacher::get($map);
		//var_dump($Teacher);
		if (Teacher::login($postData['username'],$postData['password'])) {
			//验证密码是否正确
			//用户名密码正确，将TeacherId存session
			session('teacherId',$Teacher->getData('id'));
			return $this->success('登录成功！',url('Teacher/index'));
			
		} else {
			//用户不存在，跳转至登录页面
			//由于$this->error()本身就是在抛出异常，所以以后我们在C层中的代码，将所有需要抛出异常的代码都统一写为$this->error()。异常抛出后，交给ThinkPHP为我们进行处理。
			return $this->error('登录失败，跳转至登录页面',url('index'));
		}
		
		//验证密码是否正确
		//用户名密码正确，将teacherId存session
		//用户名密码错误，跳转到登录页面
	}

	public function test(){
		echo Teacher::encryptPassword('');
		echo "<br/>";
		echo Teacher::encryptPassword('123');
		echo "<br/>";
		$hello = ['hello'];
		echo Teacher::encryptPassword($hello);
	}

	//注销
	public function logOut(){
		if(Teacher::logOut()){
			return $this->success('退出登录',url('index'));
		}else{
			return $this->error('登出出错',url('index'));
		}
	}
}
