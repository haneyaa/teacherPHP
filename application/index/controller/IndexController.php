<?php
namespace app\index\controller;

use think\Db;   // 引用数据库操作类
use think\Controller;
use app\common\model\Teacher;

// Index既是类名，也是文件名，说明这个文件的名字为Index.php。
class IndexController extends Controller
{
	public function __constructor(){
		//调用父类的构造方法（必须）
		parent::__constructor();

		//验证用户是否登录
		if(!Teacher::isLogin()){
			return $this->error('请先登录！',url('Login/index'));
		}
	}
    public function index()
    {
        var_dump(Db::name('teacher')->find()); //获取数据表中第一条数据
    }
}
