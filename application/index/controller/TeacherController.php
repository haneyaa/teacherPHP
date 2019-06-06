<?php

namespace app\index\controller;

//use think\Db; //数据库操作类
use think\Controller;
use think\Request;
use app\common\model\Teacher;       // 教师模型
//use app\common\validate\Teacher;

/**
 * 教师管理
 */
class TeacherController extends IndexController{

	public function __construct(){
		//调用父类的构造函数（必须）
		parent::__construct();

		//验证用户是否登录
		if (!Teacher::isLogin()) {
			return $this->error('请先登录！',url('Login/index'));
		}
		
	}
	
	public function index(){
		//return 'hello teacher';
		
		/*//获取教师表中所有数据
		$teachers =Db::name('teacher')->select();
		
		//查看获取的数据
		var_dump($teachers[0]['name']);
		
		 // 用下面的语句，也可以直接返回给用户
        echo $teachers[0]['name'];
        
        // 查看获取的数据
        return $teachers[0]['name'];*/

		/*$Teacher = new Teacher;
		$teachers = $Teacher->select();
		$teacher = $teachers[0];
		
		var_dump($teacher->getData('name'));
		echo $teacher->getData('name');
		return $teacher->getData('name');*/
		
		//dump($teacher);
		
		//echo 'hello teacher';
		
		/*$JiaoShiBiao = new Teacher;
		$Suoyoujiaoshi = $JiaoShiBiao->select();
		$JiaoshiZhangsan = $Suoyoujiaoshi[0];
		//var_dump($JiaoShiBiao);
		echo '教师姓名：'.$JiaoshiZhangsan->getData('name').'<br/>';
		return '重复一遍，教师姓名：'.$JiaoshiZhangsan->getData('name');*/
		
		/*// $Teacher 首写字母大写，说明它是一个对象，更确切一些说明这是基于Teacher这个模型被我们手工实例化得到的，如果存在teacher数据表，它将对应teacher数据表。
		$Teacher = new Teacher;
		
		// $teachers 以s结尾，表示它是一个数组，数据中的每一项都是一个对象，这个对象基于Teahcer这个模型。
		$teachers = $Teacher->select();
		
		// 获取第0个数据
		$teacher = $teachers[0];
		// 调用上述对象的getData()方法
		var_dump($teacher->getData('name'));
		echo $teacher->getData('name');
		return $teacher->getData('name');*/
		
		/*try{

			//获取查询信息
			$name = Request::instance()->get('name');	
			echo $name;

			$pageSize = 5; //每页显示5条数据

			//实例化Teacher
			$Teacher = new Teacher;

			if(!empty($name)){
				$Teacher->where('name','like','%'.$name.'%');
				echo $Teacher;
			}
			//按条件查询并调用分页
			$teachers = $Teacher->paginate($pageSize,false,[
				'query'=>[
					'name' => $name,
				],
			]);	
			//$teachers = $Teacher->select();

			//像V层传数据
			$this->assign('teachers',$teachers);

			//取回打包后的数据
			$htmls = $this->fetch();

			//将数据返回给用户
			return $htmls;
		//获取TinkPHP内置异常时，直接向上抛出，交给ThinkPHP处理
		}catch(\think\Exception\HttpResponseException $e){
			throw $e;
		//获取正常的异常时，输出异常
		}catch(\Exception $e){
			// 由于对异常进行了处理，如果发生了错误，我们仍然需要查看具体的异常位置及信息，那么需要将以下代码的注释去掉。
            // throw $e;
			return $e->getMessage();
		}*/

		//由于thinkphp为我们提供了非常友好的异常处理方法，所以在这里，我们将原有的try catch 语句去除。
		//验证用户是否登录
		/*$teacherId = session('teacherId');
		if ($teacherId === null) {
			# code...
			return $this->error('请先登录！',url('Login/index'));
		}
		//获取查询信息
		//$name = Request::instance()->get('name');
		if (!Teacner::isLogin()) {
			return $this->error('请先登录！',url('Login/index'));
		}*/
		$name = input('get.name');
		/*var_dump($teacherId);
		var_dump('<br/>');
		var_dump($name);
*/
		$pageSize = 5; //每页显示5条

		//实例化Teacher
		$Teacher = new Teacher();

		//按条件查询并调用分页
		$teachers = $Teacher->where('name','like','%'.$name.'%')->paginate($pageSize,false,[
			'query'=>[
				'name' => $name, 
			],
		]);

		//向V层传数据
		$this->assign('teachers',$teachers);

		//取回打包后的数据
		$htmls = $this->fetch();

		//将数据返回给用户
		return $htmls;
		
	}
	
	//插入新数据
	public function insert(){
		//var_dump($_POST);
		//Request::instance()返回了一个对象，调用这个对象的post()方法，得到post数据、
		// $postData = Request::instance()->post();
		// var_dump($postData);
		//return; //return表示：本函数执行到此结束。
		//新建测试数据
		/*$teacher = array(); //这种写法也可以写出 $teacher = [];
		$teacher['name'] = '王五';
		$teacher['username'] = 'wangwu';
		$teacher['sex'] = '1';
		$teacher['email'] = 'wangwu@xdg.com';
		//var_dump($teacher);*/
		//引用teacher数据表对应的模型
		//$Teacher = new Teacher();
		//var_dump($Teacher);
		//向teacher数据表中插入数据，并判断插入是否成功
		/*$state = $Teacher->data($teacher)->save();
		var_dump($state);*/
		// $Teacher->data($teacher)->save();
		// return $teacher['name'].'成功增加至数据表中';
		// $Teacher->name = '王五';
		// $Teacher->username = 'wangwu';
		// $Teacher->sex = '1';
		// $Teacher->email = 'wangwu@qw.com';
		
		// var_dump($Teacher->save());
		// return $Teacher->name.'已成功增加至数据表中。新增 ID为：'.$Teacher->id;
		

		try{

			//接收传入数据
			$postData = Request::instance()->post(); //也可以实用$this->request->post(),但推荐使用静态方法
			//实例化Teacher对象
			$Teacher = new Teacher();
			//为对象赋值
			$Teacher->name= $postData['name'];
			$Teacher->username = $postData['username'];
			$Teacher->sex = $postData['sex'];
			$Teacher->email = $postData['email'];
			//$Teacher->create_time = time();
			
			//新增对象至数据表
			$result = $Teacher->validate(true)->save($Teacher->getData());
			if(false === $result){
				return '新增失败'.$Teacher->getError();
			}else{
				return $this->success('用户'.$Teacher->name.'新增成功。',url('index'));
			}
			//获取到ThinkPHP的内置异常时，直接向上抛出，交给ThinkPHP处理
		}catch(\think\Exception\HttpResponseException $e){
			throw $e;
		
		// 获取到正常的异常时，输出异常
		}catch(\Exception $e){
			// 发生异常
            return $e->getMessage();
		}
		
		return $this->error($message);

		// $Teacher->save();
		//反馈结果
		// return '新增成功。新增ID:'.$Teacher->id;
	}
	
	//添加用户提交的数据
	public function add(){
		//return 'hello add';
		try{
			$html= $this->fetch();
			return $html;
		}catch(\Exception $e){
			return '系统错误' . $e->getMessage();
		}
		
	}

	//删除数据
	public function delete(){
		// return 'delete hello';
		// //获取要删除的数据
		// $Teacher = 	Teacher::get(12);
		// //删除对象
		// $Teacher->delete();
		// return '删除成功！';
		
		//要删除的数据
		//$Teacher = Teacher::get(11);
		//要删除的对象存在
		//第一种方法，使用delete删除特定记录
		// if(!is_null($Teacher)){
		// 	if($Teacher->delete()){
		// 		return '删除成功！';
		// 	}
		// }
		// //要删除的对象不存在
		// else{
		// 	return '删除失败!';
		// }

		//第二种方法，使用destroy删除多条记录
		/*$state = Teacher::destroy(10);
		var_dump($state);
		return '删除成功！';*/
		//直接删除相关关键字记录
		/*if($count = Teacher::destroy(9)){
			return '删除成功！'.$count.'条记录';
		}

		return '删除失败';*/
		//获取get数据
		//var_dump(Request::instance()->get());
		//return;

		//获取要删除的对象
		//$Teacher = Teacher::get(8);

		//要删除的对象存在
		//
		//获取pathinfo传入的ID值
		/*$id = Request::instance()->param('id/d'); // “/d”表示将数值转化为“整形”

		if(is_null($id) || 0 === $id){
			return $this->error('未获取到ID信息');
		}

		//获取要删除的对象
		$Teacher = Teacher::get($id);
		if(is_null($Teacher)){
			return '不存在id为：'.$id.'的教师，删除失败！';
		}

		//删除对象
		if(!$Teacher->delete()){
			return $this->error('删除失败：'.$Teacher->getError());
		}

		//进行跳转
		return $this->success('删除成功！',url('index'));*/
		try{
			//获取GET数据
			$Request = Request::instance();
			$id = Request::instance()->param('id/d');

			//判断是否接受成功
			if(0 === $id){
				throw new \Exception("为获取到ID信息",1);
			}

			//获取要删除的对象
			$Teacher = Teacher::get($id);

			//要删除的对象不存在
			if(is_null($Teacher)){
				throw new \Exception('不存在id为：'.$id.'的教师，删除失败',1);
			}

			//删除对象
			if(!$Teacher->delete()){
				$message = '删除失败'.$Teacher->getError();
			}

			

			
		}catch(\think\Exception\HttpResponseException $e){
			throw $e;
		}
		catch(\Exception $e){
			//var_dump($e);
			return $e->getMessage();
		}

		// return $this->error($message);
		//进行跳转
			//删除成功后，竟然不显示任何信息。这是由于$this->success();本身返回了一个Exception，然后被下面的catch接收了。但接收的$e中的的message信息为空，所以并没有显示任何信息。
		return $this->success('删除成功',$Request->header('referer'));
	}

	public function edit(){
		//return 'edit';
		// var_dump(Request::instance()->param());
		try {
					//获取传入ID
				$id = Request::instance()->param('id/d');
				//在Teacher表模型中获取当前记录
				if(is_null($Teacher = Teacher::get($id))){
					return '系统未找到ID为：'.$id.'的记录';
				}
				
				//将数据传给V层
				$this->assign('Teacher',$Teacher);
				//获取封装好的V层内容
				$html = $this->fetch();
				//将封装好的V层内容返回给用户
				return $html;
			
		} catch (\think\Exception\HttpResponseException $e) {
			throw $e;
		}catch (Exception $e) {
			return $e->getMessage();
		}
		
	}

	//使用数组更新数据
	/*public function update(){
		//var_dump(Request::instance()->post());
		//接收数据
		$teacher = Request::instance()->post();
		//将数据存入Teacher表
		$Teacher =  new Teacher();
		$state = $Teacher->validate(true)->isUpdate(true)->save($teacher);
		$message = '更新成功';

		//依据状态定制提示信息
		var_dump($state);
		try{if(false === $Teacher->validate(true)->isUpdate(true)->save($teacher)){
			$message = '更新失败'.$Teacher->getError();
		}}
		catch(\Exception $e){
			$message = '更新失败'.$e.getError();
		}
		
		return $message;
	}*/

	//使用对象更新数据
	public function update(){
		try{
		//接收数据，获取更新的关键字信息
		$id = Request::instance()->post('id/d');
		$message = '更新成功';
		//获取当前对象
		$Teacher = Teacher::get($id);
		if(!is_null($Teacher)){

			
			//写入要更新的数据
			$Teacher->name = Request::instance()->post('name');
			$Teacher->username = Request::instance()->post('username');
			$Teacher->sex = Request::instance()->post('sex/d');
			$Teacher->email = Request::instance()->post('email');
			
			// var_dump($Teacher->validate(true)->save());
			//更新
			if(false === $Teacher->validate(true)->save()){
				$message = '更新失败'.$Teacher.getError();
			}
		}else{
			thrOW new \Exception("所更新记录不存在",1); //调用PHP的内置类时，需要前面加上 \
		}
		

		// 获取到ThinkPHP的内置异常时，直接向上抛出，交给ThinkPHP处理
        } catch (\think\Exception\HttpResponseException $e) {
            throw $e;

        // 获取到正常的异常时，输出异常
        } catch (\Exception $e) {
            return $e->getMessage();
        } 
		
		 // 成功跳转至index触发器
        return $this->success('操作成功', url('index'));
	}

	public function test()
    {
        try {
        	throw new \Exception('haneya自定义的错误',1);
        	//$this->error()这个提示错误的语句，实际是抛出了一个异常对象。由此，我们可以得出一条结论：ThinkPHP中错误是异常一种，它的名字是：RuntimeException。
            return $this->error("系统发生错误");
        }catch (\think\Exception\HttpResponseException $e) {
            throw $e;

        // 获取到正常的异常时，输出异常
        }  catch (\Exception $e) {
            var_dump($e);
            return $e->getMessage();
        }
    }

}
