<?php
namespace App\Models;
/**
* Auto Generated By TrigerIgniter v1
* Codeigniter Version 4.1.x
* Codeigniter Model
**/
require_once(APPPATH.'ThirdParty'.DIRECTORY_SEPARATOR.'phpspreadsheet'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php');
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use CodeIgniter\Model;

class Category_model extends Model
{
    protected $table      = 'category';
    protected $primaryKey = 'id';

    //To help protect against Mass Assignment Attacks, the Model class requires 
    //that you list all of the field names that can be changed during inserts and updates
    // https://codeigniter4.github.io/userguide/models/model.html#protecting-fields
    protected $allowedFields = ['id', 'category_name', 'category_detail'];

    protected $useAutoIncrement = true;

    // protected $returnType     = 'array';
    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public $order = "DESC";
    public $columnIndex = "id";

    public function getFields(){
        return $this->allowedFields;
    }

    public function getById($id)
    {
        return $this->where($this->primaryKey, $id)->sort()->first();
    }

    public function getRowBy($key, $val)
    {
        return $this->where($key, $val)->sort()->first();
    }

    public function getBy($key, $val)
    {
        return $this->where($key, $val)->sort()->findAll();
    }

    public function totalRows($arr = NULL)
    {
        if ($arr == NULL) {
            return $this->countAllResults();
        }else{
            if(is_array($arr)) {
                foreach ($arr as $key => $value) {
                    $this->where($key, $value);
                };
            }else{
                $this->getData($arr);
            }
            return $this->countAllResults();
        }
    }

    public function getData($keyword = null)
    {
        if ($keyword == null) {
            return $this->sort();
        };
        $this
            ->groupStart()
            ->like($this->table . '.category_name', $keyword)
            ->orLike($this->table . '.category_detail', $keyword)
            ->groupEnd();
        return $this->sort();
    }

    public function sort($columnIndex = NULL, $sortDirection = NULL)
    {
        if($columnIndex == NULL){
            if (strpos($this->columnIndex, ".") !== FALSE) {
                $columnIndex = $this->columnIndex;
            }else{
                $columnIndex = $this->table . '.' . $this->columnIndex;
            }
        };
        if($sortDirection == NULL){
            $sortDirection = $this->order;
        };
        return $this->orderBy($columnIndex, $sortDirection);
    }

    public function truncate(){
        $this->query('TRUNCATE '.$this->table);
        return TRUE;
    }
    
    //COLUMNHEADER_STYLE_PHPSPREADSHEET
    public $headerStyle = array(
                'font' => array('bold' => true), // Set font nya jadi bold
                'alignment' => array(
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
                ),
                'borders' => array(
                    'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                    'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                    'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                    'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
                )
            );

    //EXPORT_PHPSPREADSHEET_FUNCTION
    public function export()
    {
        $spreadsheet = new Spreadsheet();
        // Set document properties
        $spreadsheet->getProperties()->setCreator('shouts')
        ->setLastModifiedBy('shouts')
        ->setTitle('Category Data')
        ->setSubject('Category Data')
        ->setDescription('Category Data '.date("Y"))
        ->setKeywords('Category')
        ->setCategory('Category');

        // subtitle on row 3
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A3', 'Category Data '.date("Y"));
        $spreadsheet->getActiveSheet()->mergeCells('A3:E3');
        // date on row 4
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A4', date("d M Y H:i"));
        $spreadsheet->getActiveSheet()->mergeCells('A4:E4');

        // columnHeader
        $startRowHeader = 6;
        $highestColumn = "C";
        $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A'.$startRowHeader, '#')
        ->setCellValue('B'.$startRowHeader, 'Category_name')
        ->setCellValue('C'.$startRowHeader, 'Category_detail')
        ;
        // set column header style
        $spreadsheet->getActiveSheet()->getStyle("A".$startRowHeader)->applyFromArray($this->headerStyle);
        $spreadsheet->getActiveSheet()->getStyle('B'.$startRowHeader)->applyFromArray($this->headerStyle);
        $spreadsheet->getActiveSheet()->getStyle('C'.$startRowHeader)->applyFromArray($this->headerStyle);
        // set column header autosize
        $spreadsheet->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);

        // merge top row as title
        $spreadsheet->getActiveSheet()->mergeCells('A1:'.$highestColumn.'1');
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', "Category Data");
        $spreadsheet->getActiveSheet()->getStyle('A1:'.$highestColumn.'1')->applyFromArray($this->headerStyle);

        $startRowBody = $startRowHeader+1;
        $index = 0;
        $data_category = $this->orderBy($this->columnIndex, $this->order)->findAll();
        foreach ($data_category as $key => $category) {
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('A'.$startRowBody, ++$index);
            if(isset($category->category_name))
                $spreadsheet->setActiveSheetIndex(0)->setCellValueExplicit('B'.$startRowBody, $category->category_name, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            if(isset($category->category_detail))
                $spreadsheet->setActiveSheetIndex(0)->setCellValue('C'.$startRowBody, $category->category_detail);
            $startRowBody++;
        };

        $spreadsheet->getActiveSheet()->setTitle('Category Data '.date('Y'));
        $spreadsheet->setActiveSheetIndex(0);

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    //IMPORT_PHPSPREADSHEET_FUNCTION
    public function import($filepath){        
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $reader->setReadDataOnly(true);

        $spreadsheet = $reader->load($filepath);
        $sheet = $spreadsheet->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        $startImport = FALSE;
        $doInsert = FALSE;
        $startColumnIndex = 0;
        $counter = 0;

        for ($row = 1; $row <= $highestRow; $row++) {                  //  Read a row of data into an array                 
            $cellData = $sheet->rangeToArray(
                'A' . $row . ':' . $highestColumn . $row,
                NULL,
                TRUE,
                FALSE
            );

            // Sesuaikan key array dengan nama kolom di database
            if ($cellData == NULL) continue;
            // Pastikan kolom pertama atau kedua tidak kosong
            if ((!isset($cellData[0][0])) && (!isset($cellData[0][1])) && ($cellData[0][0] == NULL) && ($cellData[0][1] == NULL)) continue;
            
            $doInsert = FALSE;
            if ($startImport == TRUE) {
                $insertData = [];
                if (isset($cellData[0][$startColumnIndex + 0])){
                    $insertData["category_name"] = $cellData[0][$startColumnIndex + 0];
                    $doInsert = TRUE;
                }else {
                    $doInsert = FALSE;
                }
                if (isset($cellData[0][$startColumnIndex + 1])){
                    $insertData["category_detail"] = $cellData[0][$startColumnIndex + 1];
                    $doInsert = TRUE;
                }

                if($doInsert){
                    $this->insert($insertData);
                    $counter++;
                }
            } else {
                if (
                    // jika kolom pertama tanpa nomor
                    strtolower($cellData[0][0]) == "category_name" &&
                    strtolower($cellData[0][1]) == "category_detail"
                ) {
                    $startImport = TRUE;
                    $startColumnIndex = 0;
                } elseif
                (
                    // jika kolom pertama adalah nomor
                    (strtolower($cellData[0][0]) == "no" || strtolower($cellData[0][0]) == "#") &&
                    strtolower($cellData[0][1]) == "category_name" &&
                    strtolower($cellData[0][2]) == "category_detail"
                ) {
                    $startImport = TRUE;
                    $startColumnIndex = 1;
                }
            };
        };

        return $counter;
    }
    //END_PHPSPREADSHEET_FUNCTION
}
