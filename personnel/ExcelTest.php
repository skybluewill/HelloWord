<?php
		include 'include.php';
		include 'PHPExcel180/Classes/PHPExcel.php';
		
		list($encodeCondition) = array_keys($_GET);
		$condition = base64_decode($encodeCondition);
		
		$pdo = new PDO($dsn, $user, $password);

		$sql = "select
			EmployeeMsg.ChineseName,EmployeeMsg.EmployeeCode,
			DataDepartment.DepartmentName,ClassGroup.ClassGroupName,DataDetail.Item,
			EmployeeMsg.ContactAddr,ContactPhone,EmployeeMsg.IDcard,
			EmployeeMsg.MyField1,EmployeeMsg.OnDutyTime,
			EmployeeMsg.OutDutyTime
			from
			EmployeeMsg left join DataDepartment
			on EmployeeMsg.Department = DataDepartment.DepartmentID
			left join ClassGroup
			on EmployeeMsg.ClassGroupID = ClassGroup.ClassGroupID
			left join DataDetail
			on EmployeeMsg.Principalship = DataDetail.DetailID

			where $condition";

		$rs = $pdo -> query($sql);
		
		$data = $rs->fetchAll(PDO::FETCH_ASSOC);
		//$data = Sconv($data,'GBK');
		//print_r($data);
		//exit;
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getProperties()->setCreator("this creator")
		                              ->setLastModifiedBy("this is lastModify author")
		                              ->setSubject("this is Subject")
		                              ->setTitle("this is title")
		                              ->setDescription("this is description")
		                              ->setKeywords("this is keyword")
		                              ->setCategory("this is Category");

		/*$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Hello')
            ->setCellValue('B2', 'world!')
            ->setCellValue('C1', 'Hello')
            ->setCellValue('D2', 'world!');*/
		$sheet1 = $objPHPExcel->setActiveSheetIndex(0);
		$sheet1 ->setCellValue('A1', '序列号')
				->setCellValue('B1', '姓名')
				->setCellValue('C1', '工号')
				->setCellValue('D1', '部门')
				->setCellValue('E1', '班别')
				->setCellValue('F1', '职位')
				->setCellValue('G1', '籍贯')
				->setCellValue('H1', '身份证号码')
				->setCellValue('I1', '联系电话' )
				->setCellValue('J1', '介绍人')
				->setCellValue('K1', '入职日期')
				->setCellValue('L1', '是否在职');

		foreach($data as $i => $val){
			$i += 2;
			//echo $i;
				$sheet1 ->setCellValue('A'.$i, $i-1)
						->setCellValue('B'.$i, $val['ChineseName'])
						->setCellValue('C'.$i, $val['EmployeeCode'])
						->setCellValue('D'.$i, $val['DepartmentName'])
						->setCellValue('E'.$i, $val['ClassGroupName'])
						->setCellValue('F'.$i, $val['Item'])
						->setCellValue('G'.$i, $val['ContactAddr'])
						->setCellValueExplicit('H'.$i, $val['IDcard'],
										PHPExcel_Cell_DataType::TYPE_STRING)
						->setCellValueExplicit('I'.$i, $val['ContactPhone'],
										PHPExcel_Cell_DataType::TYPE_STRING)
						->setCellValue('J'.$i, $val['MyField1'])
						->setCellValue('K'.$i, substr($val['OnDutyTime'],0,strpos($val['OnDutyTime'],' ')) );

			if($val['OutDutyTime'])
				$sheet1	->setCellValue('L'.$i, substr($val['OutDutyTime'],0,strpos($val['OutDutyTime'],' ')) );
			else
				$sheet1	->setCellValue('L'.$i, '是');
		}
		

		//$sheet1 ->getColumnDimension('G')->setAutoSize(true);
		$sheet1 ->getStyle('G1:G'.$sheet1->getHighestRow())
				->getAlignment()->setWrapText(true);
		$sheet1->getStyle('A1:'."L$i")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		//$sheet1->getStyle('A2,'."D$i")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$sheet1 ->getStyle('G2:G'.$sheet1->getHighestRow())
				->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$sheet1 ->getStyle('B2:'."D$i")
				->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$sheet1->getStyle('G1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$sheet1->getColumnDimension('G')->setWidth(49);
		$sheet1->getColumnDimension('H')->setWidth(22);
		$sheet1->getColumnDimension('I')->setWidth(13);
		$sheet1->getColumnDimension('J')->setWidth(13);
		$sheet1->getColumnDimension('K')->setWidth(12);
		$sheet1->getColumnDimension('L')->setWidth(12);
		$sheet1->getColumnDimension('D')->setWidth(11);
		$sheet1->getColumnDimension('C')->setWidth(10);
		$sheet1->getStyle('A1:'."L$i")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  
		$sheet1->setTitle('报表');

		$objPHPExcel->setActiveSheetIndex(0);
		
		$filename = '文件名称';
		//echo $filename;
		// Redirect output to a client��s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header("Content-Disposition: attachment;filename=$filename.xlsx");
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		var_dump($objWriter->save('php://output'));
		exit;




?>