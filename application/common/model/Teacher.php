<?php
// 简单的原理重复记： namespace说明了该文件位于application\common\model 文件夹中
namespace app\common\model;

use think\Model; //导入think\Model类
	
	/**
	 * @Author    厚德载心，公众号：新帝国科技
	 * @qq        37864801
	 * @DateTime  2019-06-06
	 * @copyright 北京新帝国科技有限公司
	 * @version   [1.0]
	 */
	// 我的类名叫做Teacher，对应的文件名为Teacher.php，该类继承了Model类，Model我们在文件头中，提前使用use进行了导入
class Teacher extends Model{

	/**用户登录
	 * @param  string $username 用户名
	 * @param  string $password 密码
	 * @return bool    登录成功，返回true,失败返回false
	 */
	static public function login($username,$password){
		// return true;
		//验证用户是否存在
		$map = array('username' => $username);
		$Teacher = self::get($map);

		if(!is_null($Teacher))
		{
			//验证密码是否正确
			if($Teacher->checkPassword($password)){
				//登录
				session('teacherId',$Teacher->getData('id'));
				return true;

			}
		}
		return false;
	}
	
	/**
	 * 密码加密算法
	 * @param  string $password
	 * @return bool
	 */
	static public function encryptPassword($password){

		
        try{
        	if (!is_string($password)) {
            throw new \RuntimeException("传入变量类型非字符串，错误码2", 2);
       	   }

        	//实际过程中，还可以借助其他字符串算法，来实现不同加密
        	return sha1(md5($password).'haneya');

        }catch(\RuntimeException $e){
        	echo "请输入正确的密码格式";
        }
		

	}
	/**
	 * 验证密码是否正确
	 * @param  string $password 密码
	 * @return bool
	 */
	public function checkPassword($password){
		if ($this->getData('password') === $this::encryptPassword($password)) {

			return true;

		} else {

			return false;

		}

	}

	static public function logOut(){
		//销毁session中的数据
		session('teacherId', null);
		return true;
	}

	/**
	 * 判断用户是否已登录
	 * @return boolean
	 */
	static public function isLogin(){
		// echo 'isLogin';
		$teacherId = session('teacherId');
		//isset和is_null是一对反义词
		if (isset($teacherId)) {
			return true;
		}else{
			return false;
		}
	}
}
