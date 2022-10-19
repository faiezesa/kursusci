<?php
namespace App\Controllers;

use Mpdf\Mpdf;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Employee extends BaseController{
    public function __construct(){
        $this->mod = model('App\Models\EmployeeModel');
    }
    
    public function index(){
        $data['title'] = 'Employee';
        return $this->render('employee',$data);
    }
    
    public function download_pdf(){
        $data['view'] = 'pdf';
        $data['employee'] = $this->mod->findAll();
        $html = $this->render('emp_pdf', $data);
    
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    
        header("Content-type:application/pdf");
        header("Content-Disposition:attachment;filename=downloaded.pdf");
    }
    
    public function download_xls(){
        /*$spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');
    
        $writer = new Xlsx($spreadsheet);
//        $writer->save(FCPATH.'public/uploads/hello world.xlsx');
    
        $writer->save("php://output");
    
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="hello_world.xlsx"');
        exit();*/
    
        header('Content-type: application/excel');
        $filename = 'filename.xls';
        header('Content-Disposition: attachment; filename='.$filename);
    
        $datax = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">
                <head>
                    <!--[if gte mso 9]>
                    <xml>
                        <x:ExcelWorkbook>
                            <x:ExcelWorksheets>
                                <x:ExcelWorksheet>
                                    <x:Name>Sheet 1</x:Name>
                                    <x:WorksheetOptions>
                                        <x:Print>
                                            <x:ValidPrinterInfo/>
                                        </x:Print>
                                    </x:WorksheetOptions>
                                </x:ExcelWorksheet>
                            </x:ExcelWorksheets>
                        </x:ExcelWorkbook>
                    </xml>
                    <![endif]-->
                </head>';
    
        $data['view'] = 'pdf';
        $data['employee'] = $this->mod->findAll();

        $datax .= $this->render('emp_pdf', $data);
    
//        $datax .= '<h1>TEST</h1>';
    
        echo $datax;
    }
}