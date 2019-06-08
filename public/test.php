<?php
/**
 * 
 */
class Test{

	private $hi = 'hi 喊饿安逸';

	private $data = array(
		'name' => '张三', 
		'sex' => '0', 
		);

	public function __get($name){
		/*echo $name.'<br/>';
		return $this->hi;*/
		//校验在$this->data中是否存在这个键值
		//如果存在，即返回，如果不存在，则返回$this->data整个数组
		if (array_key_exists($name, $this->data)) {
			return $this->data[$name];
		} else {
			return $name.'字段不存在';
		}
		
	}

	public function __set($name, $value){
		echo '$name is '.$name.', $value is '.$value.'<br/>';
		$this->data[$name] = $value;
	}

}

$Test = new Test();
echo $Test->name;
echo $Test->sex;
//var_dump($Test->hello);
//
	
$Test->name = 'afafdaf';
$Test->sex = '1';
echo $Test->name;
echo $Test->sex;
echo $Test->he;
	

	