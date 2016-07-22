<?php
namespace Leo;

/**
 * 地理位置相关类
 * User: leo
 * Date: 2016/7/2
 * Time: 14:52
 */
class File
{
    // 从excel读取数据
    public function readFromExcel($filename, $hasRowName = false)
    {

        if (!file_exists($filename)) {
            exit("文件不存在！" . EOL);
        }
        $objReader = \PHPExcel_IOFactory::createReaderForFile($filename);
        $objPHPExcel = $objReader->load($filename);
        foreach ($objPHPExcel->getSheetNames() as $v) {
            $data = [];
            /**读取excel文件中的第一个工作表*/
            $objPHPExcel->setActiveSheetIndexByName($v);
            $currentSheet = $objPHPExcel->getSheetByName($v);
            /**取得最大的列号*/
            $allColumn = $currentSheet->getHighestColumn();
            /**取得一共有多少行*/
            $allRow = $currentSheet->getHighestRow();
            /**从第二行开始输出，因为excel表中第一行为列名*/
            for ($currentRow = 2;$currentRow <= $allRow;$currentRow++){
                $temp = [];
                $row_nanme = $hasRowName? $currentSheet->getCellByColumnAndRow('A',$currentRow)->getValue() : $currentRow;
                /**从第A列开始输出*/
                for($currentColumn= 'A';$currentColumn<= $allColumn; $currentColumn++){
                    // 获取列名
                    $col_nanme = $currentSheet->getCellByColumnAndRow(ord($currentColumn) - 65,1)->getValue();
                    /**ord()将字符转为十进制数*/
                    $temp[$col_nanme] = $currentSheet->getCellByColumnAndRow(ord($currentColumn) - 65,$currentRow)->getValue();
                    /**如果输出汉字有乱码，则需将输出内容用iconv函数进行编码转换，如下将gb2312编码转为utf-8编码输出*/
                    // echo iconv('utf-8','gb2312', $val)."\t";
                }
                $data[$row_nanme] = $temp;
            }

            $sheets[$v] = array_filter($data);

        }
        return $sheets;
    }

    /*
     * 输出为excel文件
     *
     * @author leo<leo19920823@gmail.com>
     *
     * @param $data array 需要保存的数据 $data[表名][行号][列名]
     * @param $filename string 需要输出的文件名
     *
     * @return 直接输出到浏览器
     */
    function writeToExcel($data , $filename = 'sheets')
    {
        $objPHPExcel = new \PHPExcel();
        // Set document properties
        $objPHPExcel->getProperties();

        // Add some data
        $sheet_index = 0;
        foreach ($data as $sheet_name => $sheet) {
            if ($sheet_index != 0) {
                $objPHPExcel->createSheet($sheet_index);
            }
            $objPHPExcel->setActiveSheetIndex($sheet_index);
            $objPHPExcel->getActiveSheet()->setTitle($sheet_name);
            $col_names = array_keys($sheet[0]);
            foreach ($col_names as $k => $v) {
                $objPHPExcel->getActiveSheet()->setCellValue(chr(65+$k).'1', $v);
            }
            $curr_row = 2;
            foreach ($sheet as $row_name => $row){
                $curr_col = 65;
                foreach ($row as $col_nanme => $cell) {
                    $objPHPExcel->getActiveSheet()->setCellValue(chr($curr_col).$curr_row, $cell);
                    $curr_col++;
                }
                $curr_row++;
            }
            // 切换新的表
            $sheet_index ++;
        }
        // Rename worksheet
        $objPHPExcel->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Excel5)
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename={$filename}.xls");
        header('Cache-Control: max-age=0');

        $objWriter->save('php://output');
    }
}