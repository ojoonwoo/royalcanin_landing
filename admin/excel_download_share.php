<?php
// 설정파일
include_once "../include/autoload.php";

$mnv_f = new mnv_function();
$my_db         = $mnv_f->Connect_MySQL();
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */

/** Error reporting */
// error_reporting(E_ALL);
// ini_set('display_errors', TRUE);
// ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
// require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';
require_once '../lib/PHPExcel-1.8/Classes/PHPExcel.php';

$todayDate =  $_REQUEST['date'];
$media_query	= "SELECT sns_media, COUNT( sns_media ) media_cnt FROM share_info_9 WHERE sns_regdate LIKE  '%".$daily_date."%' GROUP BY sns_media";
$media_res		= mysqli_query($my_db, $media_query);
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("minivertising")
	->setLastModifiedBy("minivertising")
	->setTitle("Office 2007 XLSX Click Data")
	->setSubject("Office 2007 XLSX Click Data")
	->setDescription("Report for Office 2007 XLSX, generated using PHP classes.")
	->setKeywords("office 2007 openxml php")
	->setCategory("data result file");


// Add some data
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A1', '날짜')
	->setCellValue('B1', '공유매체')
	->setCellValue('C1', 'PC')
	->setCellValue('D1', 'Mobile')
	->setCellValue('E1', 'Total');

while ($media_daily_data = mysqli_fetch_array($media_res))
{
	$media_name[]	= $media_daily_data['sns_media'];
	$media_cnt[]	= $media_daily_data['media_cnt'];
	$pc_query		= "SELECT * FROM share_info_9 WHERE sns_regdate LIKE  '%".$daily_date."%' AND sns_media='".$media_daily_data['sns_media']."' AND sns_gubun='PC'";
	$pc_count		= mysqli_num_rows(mysqli_query($my_db, $pc_query));
	$mobile_query	= "SELECT * FROM share_info_9 WHERE sns_regdate LIKE  '%".$daily_date."%' AND sns_media='".$media_daily_data['sns_media']."' AND sns_gubun='MOBILE'";
	$mobile_count	= mysqli_num_rows(mysqli_query($my_db, $mobile_query));
	$pc_cnt[]		= $pc_count;
	$mobile_cnt[]	= $mobile_count;
	$total_cnt[]	= $pc_count + $mobile_count;
}
$rowspan_cnt =  count($media_name)+1;
$i = 0;
$dataIdx = 2;

foreach($media_name as $key => $val)
{
	if($dataIdx == 2) {
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A2', $todayDate)
			->mergeCells('A2:A'.$rowspan_cnt)
			->getColumnDimension('A')->setWidth(15);
	}

	$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('B'.$dataIdx, $val)
		->setCellValue('C'.$dataIdx, number_format($pc_cnt[$i]))
		->setCellValue('D'.$dataIdx, number_format($mobile_cnt[$i]))
		->setCellValue('E'.$dataIdx, number_format($click_cnt[$i]));

	$total_media_cnt += $media_cnt[$i];
	$total_mobile_cnt += $mobile_cnt[$i];
	$total_pc_cnt += $pc_cnt[$i];
	$i++;
	$dataIdx++;
}

$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A'.$dataIdx, '합계')
	->setCellValue('C'.$dataIdx, number_format($total_pc_cnt))
	->setCellValue('D'.$dataIdx, number_format($total_mobile_cnt))
	->setCellValue('E'.$dataIdx, number_format($total_media_cnt));


$objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('현대해상어서와마음봇_공유데이터_'.$todayDate);


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel;');
header('Content-Disposition: attachment;filename="현대해상어서와마음봇_공유데이터_'.$todayDate.'.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
ob_clean();

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
