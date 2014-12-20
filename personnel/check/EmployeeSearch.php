<?php
	require 'config.php';
	if(empty($_POST['name'])){
		echo('你未输入姓名哦');
		exit;
	}
	$name = $_POST['name'];
	$mode = $_POST['mode'];
	//echo 1111;exit;

	$pdo = new PDO($dsn,$user,$password);
	$InitCondition = 'EmployeeMsg.ChineseName like ';
	//$sql = "select top 1 * from EmployeeMsg where ChineseName like '%$name'";
	//$sql = "select count(*) from EmployeeMsg where EmployeeMsg.ChineseName like ";
	$sql = "select
			EmployeeMsg.ChineseName,EmployeeMsg.EmployeeCode,
			DataDepartment.DepartmentName,ClassGroup.ClassGroupName,DataDetail.Item,
			EmployeeMsg.ContactAddr,ContactPhone,EmployeeMsg.IDcard,
			EmployeeMsg.MyField1,EmployeeMsg.OnDutyTime,DataDetail2.Item AS education,
			EmployeeMsg.OutDutyTime
			from
			EmployeeMsg left join DataDepartment
			on EmployeeMsg.Department = DataDepartment.DepartmentID
			left join ClassGroup
			on EmployeeMsg.ClassGroupID = ClassGroup.ClassGroupID
			left join DataDetail
			on EmployeeMsg.Principalship = DataDetail.DetailID
			left join DataDetail AS datadetail2
			on EmployeeMsg.EduLevel = DataDetail2.DetailID
			where ";
			//left join DataDetail
			//on EmployeeMsg.EduLevel = DataDetail.DetailID
			//echo $sql;
	/*$sql = "select
			*
			from
			EmployeeMsg left join DataDepartment
			on EmployeeMsg.Department = DataDepartment.DepartmentID
			left join ClassGroup
			on EmployeeMsg.ClassGroupID = ClassGroup.ClassGroupID
			left join DataDetail
			on EmployeeMsg.Principalship = DataDetail.DetailID
			left join DataDetail AS datadetail2
			on EmployeeMsg.EduLevel = DataDetail2.DetailID
			where ";*/
	switch ($mode){

		case 1 :						//精确查找
			$varName = $name;
		break;

		case 2 :						//姓氏查找
			$varName = $name.'%';
		break;

		case 3 :						//模糊查找
			$varName = '%'.$name.'%';
		break;

		default :
			ErrAlert('未能正确解析你搜索模式，难道你用了BUG模式？');

	}
	$condition = $InitCondition."'$varName'";
	$sql = $sql.$condition;
	//$sql = "select * from ($sql) "."left join DataDetail on EmployeeMsg.Principalship = DataDetail.DetailID";
	//echo $sql;
	if(!VarData($pdo, 'EmployeeMsg', $condition)){
	    ErrAlert('查询出错');
		exit;
	}

	$rs  = $pdo -> query($sql);
	if(!$rs){
		$err = $pdo -> errorInfo();
		print_r($err);
		exit;
	}

	//$colcount = $rs -> columnCount();
	//echo $colcount;
	while($data[] = $rs->fetch(PDO::FETCH_ASSOC)){
	}
	//echo '11111111111111';
	array_pop($data);			//弹出最后一个空元素，while循环会出现一个空元素
	//print_r($data);
	//exit;
	include './html/EmployeeSearchTable.html';


?>