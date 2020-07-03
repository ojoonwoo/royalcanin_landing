<?php
include_once "../config.php";
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

$startDate =  $_REQUEST['sDate'];
$endDate =  $_REQUEST['eDate'];
$where = "";
if($startDate != "" && $endDate != "") {
    $where = "AND liking_regdate >= '".$startDate."' AND liking_regdate <= '".$endDate." 23:59:59'";
}
$list_query = "SELECT * FROM ".$_gl['liking_info_table']." WHERE 1 ".$where."";
$list_res		= mysqli_query($my_db, $list_query);

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("minivertising")
							 ->setLastModifiedBy("minivertising")
							 ->setTitle("Office 2007 XLSX Member Data")
							 ->setSubject("Office 2007 XLSX Member Data")
							 ->setDescription("Report for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("data result file");


// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '이름')
            ->setCellValue('B1', '전화번호')
            ->setCellValue('C1', '선택한 스타일')
            ->setCellValue('D1', '선택한 색상')
            ->setCellValue('E1', '선택한 재질')
            ->setCellValue('F1', '선택한 상품')
            ->setCellValue('G1', '유입매체')
            ->setCellValue('H1', '유입구분')
            ->setCellValue('I1', '참여일자');

while ($buyer_data = @mysqli_fetch_array($list_res)) {
    $buyer_info[] = $buyer_data;
}
$dataIdx = 2;
foreach($buyer_info as $key => $val)
{
    $upload_image = "https://www.hi-maumbot.co.kr/uploads/".$val["family_file_folder"]."/".$val["family_file_name"];
    
    
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$dataIdx, $val['liking_name'])
                ->setCellValue('B'.$dataIdx, $val['liking_phone'])
                ->setCellValue('C'.$dataIdx, $val['liking_cate'])
                ->setCellValue('D'.$dataIdx, $val['liking_tone'])
                ->setCellValue('E'.$dataIdx, $val['liking_texture'])
                ->setCellValue('F'.$dataIdx, $val['liking_select'])
                ->setCellValue('G'.$dataIdx, $val['liking_media'])
                ->setCellValue('H'.$dataIdx, $val['linking_gubun'])
                ->setCellValue('I'.$dataIdx, $val['linking_regdate']);

    $dataIdx++;
}
// $i = 0;
// $dataIdx = 2;
// ->getColumnDimension('A')->setWidth(15);


// $objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('이브자리_내마음대로부문_참여자목록_'.date("Ymd"));


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="이브자리_내마음대로부문_참여자목록_'.date("Ymd").'.xls"');
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
