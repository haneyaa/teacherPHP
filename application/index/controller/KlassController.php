<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Loader;

use app\common\model\Klass;
use app\common\model\Teacher;

class KlassController extends IndexController{
	
	public function index(){
		//分页
		$klasses = Klass::paginate(2);
		//向V层传数据
		$this-> assign('klasses',$klasses);
		//取回打包后的数据
		return $this->fetch();
	}

	public function add(){
		//return $this->fetch();
		$teachers = Teacher::all();
		$this->assign('teachers',$teachers);
		return $this->fetch();
	}

	public function save(){
		// var_dump(Request::instance()->post());

		$Request = Request::instance();
		$Klass = new Klass();
		$Klass->name = $Request->post('name');
		$Klass->teacher_id = $Request->post('teacher_id/d');
		//$Klass->save();
		//
		//添加数据
		/*if (!$Klass->validate(true)->save()) {
			return $this->error('数据添加错误'.$Klass->getError());
		}

		var_dump($Klass->validate(true));
		//return $this->success('操纵成功！',url('index'));*/
		//加入验证
		/*$data = [
			'name' => $Klass->name,
			'teacher_id' => $Klass->teacher_id,
		];

		$validate = validate('Klass');
		if(!$validate->check($data)){
			 return $this->error('数据添加错误：' . $validate->getError());
		}
		$Klass->save();*/
		// 添加数据
        if (!$Klass->validatePost()) {
            return $this->error('数据添加错误22：' . $Klass->getError());
        }
        $Klass->save();
		return $this->success('操作成功', url('index'));
	}

	public function edit(){
		$id = Request::instance()->param('id/d');

		//获取所有教师信息
		$teachers = Teacher::all();
		$this->assign('teachers', $teachers);

		//获取用户操作的班级信息
		if(false === $Klass=Klass::get($id)){
			return $this->error('系统未找到ID为：'.$id.'的记录');
		}

		$this->assign('Klass',$Klass);
		return $this->fetch();

	}

	public function update(){
		$id = Request::instance()->post('id/d');

		//获取传入的班级信息
		$Klass = Klass::get($id);
		if (is_null($Klass)) {
			return $this->error('系统未找到ID为：'.$id.'的记录');
		}

		//数据更新
		$Klass->name = Request::instance()->post('name');
		$Klass->teacher_id = Request::instance()->post('teacher_id/d');
		if (!$Klass->validatePost()) {
			return $this->error('更新错误：'.$Klass->getError());
		}

		$Klass->save();
		return $this->success('操作成功。',url('index'));

	}

	public function delete(){
		try{
			//获取GET数据
			$Request = Request::instance();
			$id = Request::instance()->param('id/d');

			//判断是否接受成功
			if(0 === $id){
				throw new \Exception("为获取到ID信息",1);
			}

			//获取要删除的对象
			$Klass = Klass::get($id);

			//要删除的对象不存在
			if(is_null($Klass)){
				throw new \Exception('不存在id为：'.$id.'的课程，删除失败',1);
			}

			//删除对象
			if(!$Klass->delete()){
				$message = '删除失败'.$Klass->getError();
			}

			

			
		}catch(\think\Exception\HttpResponseException $e){
			echo $e;
			throw $e;
		}
		catch(\Exception $e){
			//var_dump($e);
			return '自定义错误：'.$e->getMessage();
		}
		return $this->success('删除成功',$Request->header('referer'));
	}
}

