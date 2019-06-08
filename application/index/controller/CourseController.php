<?php
namespace app\index\controller;

use think\Request;
use app\common\model\Course;       // 课程
use app\common\model\Klass;
use app\common\model\KlassCourse;
/**
 * 课程管理
 */
class CourseController extends IndexController
{
    public function index()
    {
        // 这里自行添加代码，进行练习
        echo "string";
    }

    public function add()
    {
    	/*$klasses = Klass::all();
        $this->assign('klasses', $klasses);*/
        $this->assign('Course', new Course());
        return $this->fetch();
    }

    public function save()
    {
        // var_dump(Request::instance()->post());
    	//存储课程信息
    	$Course = new Course;
    	$Course->name = Request::instance()->post('name');

    	//新增数据，并验证
    	if(!$Course->validatePost()){
    		return $this->error('数据添加错误22：' . $Course->getError());
    	}
    	$Course->save();
    	//return $this->success('操作成功', url('index'));

    	//-------------------新增班级信息-----------------------
    	$klassIds = Request::instance()->post('klass_id/a'); // /a表示获取的类型为数组
    	//利用klass_id这个数组，拼接为包括klass-id和course_id的二维数组
    	if (!is_null($klassIds)) {
    		//使用thinkphp内置多对多关联之前的代码
    		/*
    		$datas = array();
    		foreach ($klassIds as $klassId) {
    			$data = array();
    			$data['klass_id'] = $klassId;
    			$data['course_id'] = $Course->id; //此时，由于前面已经执行过插入数据的操作，所以可以直接获取到Course对象的ID值
    			array_push($datas, $data);


    		}

    		//利用saveAll()方法，将二维数组存入数据库	
    		if(!empty($datas)){
    			$KlassCourse = new KlassCourse;
    			if(!$KlassCourse->validatePost()){
    				return $this->error('课程-班级信息保存错误'.$KlassCourse->getError());
    			}
    			$KlassCourse->saveAll($datas);
    			unset($KlassCourse); //unset出现的位置和new语句的缩进量相同，在返回前，最后被执行。
    		}*/
    		//使用thinkphp内置多对多关联代码
    		if(!$Course->Klasses()->saveAll($klassIds)){
    			return $this->error('课程-班级信息保存错误'.$couser->Klasses()-getError());
    		}
    	}

    	unset($Course); //unset出现的位置和new语句的缩进量相同，在返回前，最后被执行。
    	return $this->success('操作成功',url('index'));
    }

    public function edit()
    {
        $id = Request::instance()->param('id/d');
        $Course = Course::get($id);

        if (is_null($Course)) {
            return $this->error('不存在ID为' . $id . '的记录');
        }

        $this->assign('Course', $Course);
        return $this->fetch();
    }

}