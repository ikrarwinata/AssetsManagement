<?php
namespace App\Controllers\superadministrator;
/**
* Auto Generated By TrigerIgniter v1
* Codeigniter Version 4.1.x
* Codeigniter Controller
**/
require_once(APPPATH.'ThirdParty'.DIRECTORY_SEPARATOR.'mPDF'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php');
use App\Models\Users_account_model;
use App\Controllers\BaseController;

class Users_account extends BaseController
{
    protected $model; //Default Models Of this Controler

    /**
     * Class constructor.
     */ 
    public function __construct()
    {
        $this->model = new Users_account_model(); //Set Default Models Of this Controller
        $this->PageData = $this->defaultPage(); //Attribute Of this Page
        $this->Template = $this->defaultTemplate(); //Template Of this Page
        $this->pager = \Config\Services::pager(); // Pagination
        $this->validation =  \Config\Services::validation();
    }

    protected function onLoad(){
        parent::onLoad();
        $this->getLocale();
        
        // check access level
        if (! $this->access_allowed()) {
            session()->setFlashdata("ci_login_flash_message", lang("Errors.AccessDenied", [], $this->PageData->locale));
            session()->setFlashdata("ci_login_flash_message_type", "text-danger");
            throw new \CodeIgniter\Router\Exceptions\RedirectException();
        };
    
    }
    
    //ATRIBUTE OF THIS PAGE
    private function defaultPage()
    {
        return (object) [
            'parent' => 'superadministrator/Users_account',
            'header' => (session("level") == NULL ? NULL : session("level") . " :: ") . 'Users_account', 
            'title' => 'Users_account',
            'subtitle' => [
                'Users_account' => 'superadministrator/Users_account/index'
            ],
            'url' => 'superadministrator/Users_account/index',
            'stylesheets' => [],
            'scripts' => [],
            'locale' => 'id',
            'access' => ['superadministrator']
        ];
    }

    //TEMPLATE OF THIS PAGE
    private function defaultTemplate()
    {
        return (object) [
            'container' => 'superadministrator/_templates/Container',
            'header' => 'superadministrator/_templates/header',
            'navbar' => 'superadministrator/_templates/navbar',
            'sidebar' => 'superadministrator/_templates/sidebar',
            'footer' => 'superadministrator/_templates/footer',
        ];
    }
    
    private function access_allowed(){
        $allowed = FALSE;
        if (count($this->PageData->access)==0) return TRUE;
        if (! session()->has("level"))  return FALSE;
        foreach ($this->PageData->access as $key => $value) {
            if(session("level")==$value){
                $allowed=TRUE;
                break;
            }
        };
        return $allowed;
    }

    //JSON_FUNCTION
    public function toJson($id = NULL)
    {
        $id = $id == NULL ? $this->request->getPostGet("indexer") : base64_decode(urldecode($id));

        if ($id != NULL) {
            $result = $this->model->getById($id);

            if ($result == FALSE) {
                $temp = [];
                foreach ($this->model->getFields() as $key => $value) {
                    $temp[$value] = NULL;
                };
                $result = (object) $temp;
            }
            $this->response->setHeader('Content-Type', 'application/json');
            return json_encode($result);
        }

        // Table sorting using GET var
        $sortcolumn = $this->request->getGetPost("sortcolumn");
        $sortorder = $this->request->getGetPost("sortorder");
        if ($sortcolumn != NULL) $sortcolumn = base64_decode($sortcolumn);
        if ($sortcolumn != NULL && $sortorder != NULL) {
            $sortorder = strtoupper($sortorder);
            if ($sortorder != "DESC" && $sortorder != "ASC") $sortorder = "ASC";
            if (in_array($sortcolumn, $this->model->getFields())) {
                $this->model->order = $sortorder;
                $this->model->columnIndex = $sortcolumn;
            } else {
                $sortcolumn = NULL;
                $sortorder = NULL;
            }
        }

        $keyword = $this->request->getGetPost("keyword");
        $totalrecord = $this->model->getData($keyword)->countAllResults();

        // How many data shows each page
        $perPage = $this->request->getPostGet("perPage");
        if ($perPage == NULL || $perPage <= 0) {
            $result = [
                'draw' => 0,
                'recordsTotal' => $totalrecord,
                'recordsFiltered' => $totalrecord,
                'keyword' => $keyword,
                'data' => $this->model->getData($keyword)->findAll()
            ];         
        }else {
            $page = $this->request->getGetPost("page");
            $page = $page <= 0 ? 1 : $page;

            $result = [
                'draw' => 0,
                'recordsTotal' => $totalrecord,
                'recordsFiltered' => $totalrecord,
                'perPage' => $perPage,
                'currentPage' => ($totalrecord / $perPage >= $page ? $page : max(floor($totalrecord / $perPage), 1)),
                'startIndex' => min(($page * $perPage) - ($perPage - 1), $totalrecord),
                'endIndex' => min(($perPage * $page), $totalrecord),
                'keyword' => $keyword,
                'data' => $this->model->getData($keyword)->paginate($perPage)
            ];
        }

        $this->response->setHeader('Content-Type', 'application/json');
        return json_encode($result);
    }

    //INDEX
    public function index()
    {
        //indexstart
        
        // Table sorting using GET var
        $sortcolumn = $this->request->getGetPost("sortcolumn");
        $sortorder = $this->request->getGetPost("sortorder");
        if ($sortcolumn == NULL || $sortorder == NULL){
            if (session()->has("sorting_table")) {
                if (session("sorting_table")==$this->model->table) {
                    $sortcolumn = session("sortcolumn");
                    $sortorder = session("sortorder");
                };
            };
        }else{
            $sortcolumn = base64_decode($sortcolumn);
        }
        if ($sortcolumn != NULL && $sortorder != NULL) {
            $sortorder = strtoupper($sortorder);
            if ($sortorder != "DESC" && $sortorder != "ASC") $sortorder = "ASC";
            if (in_array($sortcolumn, $this->model->getFields())){
                $this->model->order = $sortorder;
                $this->model->columnIndex = $sortcolumn;
                session()->set('sortcolumn', $sortcolumn);
                session()->set('sortorder', $sortorder);
                session()->set('sorting_table', $this->model->table);
            }else{
                $sortcolumn = NULL;
                $sortorder = NULL;
                session()->remove('sortcolumn');
                session()->remove('sortorder');
                session()->remove('sorting_table');
            }
        }

        // How many data shows each page
        $perPage = $this->request->getPostGet("perPage");
        if ($perPage == NULL) {
            if (session()->has("paging_table")) {
                if (session("paging_table")==$this->model->table) {
                    $perPage = session("perPage");
                };
            };
        };
        if ($perPage != NULL) {
            // Minimum data per-page = 2
            if ($perPage <= 0) $perPage = 2;
            session()->set('perPage', $perPage);
            session()->set('paging_table', $this->model->table);
        }else{
            // Default data per-page = 20
            $perPage = 20;
            session()->remove('paging_table');
            session()->remove('perPage');
        }

        $page = $this->request->getGet("page");
        $page = $page<=0?1:$page;
        $keyword = $this->request->getGetPost("keyword");
        $totalrecord = $this->model->getData($keyword)->countAllResults();

        $this->PageData->url = "superadministrator/Users_account/index";
        $this->PageData->subtitle = [
            $this->PageData->title => 'superadministrator/Users_account/index'
        ];

        $data = [
            'sortcolumn' => $sortcolumn,
            'sortorder' => $sortorder,
            'data' => $this->model->getData($keyword)->paginate($perPage),
            'perPage' => $perPage,
            'currentPage' => $page,
            'start' => min(($page*$perPage)-($perPage-1), $totalrecord),
            'end' => min(($perPage*$page), $totalrecord),
            'totalrecord' => $totalrecord,
            'pager' => $this->model->pager,
            'keyword' => $keyword,
            'Page' => $this->PageData,
            'Template' => $this->Template
        ];
        return view('superadministrator/users_account/users_account_list', $data);
        //endindex
    }

    //READfunction
    public function read($id=NULL)
    {
        $id = $id==NULL?$this->request->getPostGet("username"):base64_decode(urldecode($id));

        $this->PageData->title = "Users_account Detail";
        $this->PageData->header .= ' :: Detail';
        $this->PageData->subtitle = [
            'Users_account' => 'superadministrator/Users_account/index',
            'Detail' => 'superadministrator/Users_account/read/' . urlencode(base64_encode($id)),
        ];
        $this->PageData->url = "superadministrator/Users_account/read/" . urlencode(base64_encode($id));
        
        $dataFind = $this->model->getById($id);

        if($dataFind == FALSE || $id == NULL){
            session()->setFlashdata('ci_flash_message', lang("Errors.DataNotExist", [], $this->PageData->locale));
            session()->setFlashdata('ci_flash_message_type', ' alert-danger ');
            return redirect()->to(base_url($this->PageData->parent . '/index'));
        }
        $data = [
            'data' => $this->model->getById($id), //getById on data
            'Page' => $this->PageData,
            'Template' => $this->Template
        ];
        return view('superadministrator/users_account/users_account_read', $data);
    }

    //CREATEfunction
    public function create()
    {
        $this->PageData->header .= ' :: ' . lang("Default.CreateItem", [], $this->PageData->locale);
        $this->PageData->title = "Create Users_account";
        $this->PageData->subtitle = [
            'Users_account' => 'superadministrator/Users_account/index',
            lang("Default.CreateItem", [], $this->PageData->locale) => 'superadministrator/Users_account/create',
        ];
        $this->PageData->url = "superadministrator/Users_account/create";

        $data = [
            'data' => (object) [
                'username' => set_value('username'),
                'password' => set_value('password'),
                'full_name' => set_value('full_name'),
                'nick_name' => set_value('nick_name'),
                'email' => set_value('email'),
                'phone' => set_value('phone'),
                'level' => set_value('level'),
            ],
            'action' => site_url($this->PageData->parent.'/createAction'),
            'Page' => $this->PageData,
            'Template' => $this->Template
        ];
        return view('superadministrator/users_account/users_account_form', $data);
    }
    
    //ACTIONCREATEfunction
    public function createAction()
    {
        if($this->isRequestValid() == FALSE){
            return $this->create();
        };

        $data = [
            // 'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'full_name' => $this->request->getPost('full_name'),
            'nick_name' => $this->request->getPost('nick_name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'level' => $this->request->getPost('level'),
        ];
        
        $this->model->insert($data);
        session()->setFlashdata('ci_flash_message', lang("Default.CreateSuccess", [], $this->PageData->locale));
        session()->setFlashdata('ci_flash_message_type', ' alert-success ');
        return redirect()->to(base_url($this->PageData->parent . '/index'));
    }
    
    //UPDATEfunction
    public function update($id=NULL)
    {
        $id = $id == NULL ? $this->request->getPostGet("username") : base64_decode(urldecode($id));

        $this->PageData->header .= ' :: ' . lang("Default.UpdateItem", [], $this->PageData->locale);
        $this->PageData->title = "Update Users_account";
        $this->PageData->subtitle = [
            'Users_account' => 'superadministrator/Users_account/index',
            lang("Default.UpdateItem", [], $this->PageData->locale) => 'superadministrator/Users_account/update/' . urlencode(base64_encode($id)),
        ];
        $this->PageData->url = "superadministrator/Users_account/update/" . urlencode(base64_encode($id));

        $dataFind = $this->model->getById($id);

        if($dataFind == FALSE || $id == NULL){
            session()->setFlashdata('ci_flash_message', lang("Errors.DataNotExist", [], $this->PageData->locale));
            session()->setFlashdata('ci_flash_message_type', ' alert-danger ');
            return redirect()->to(base_url($this->PageData->parent . '/index'));
        }
        $data = [
            'data' => (object) [
                'username' => set_value('username', $dataFind->username),
                'password' => set_value('password', $dataFind->password),
                'full_name' => set_value('full_name', $dataFind->full_name),
                'nick_name' => set_value('nick_name', $dataFind->nick_name),
                'email' => set_value('email', $dataFind->email),
                'phone' => set_value('phone', $dataFind->phone),
                'level' => set_value('level', $dataFind->level),
            ],
            'action' => site_url($this->PageData->parent.'/updateAction'),
            'Page' => $this->PageData,
            'Template' => $this->Template
        ];
        return view('superadministrator/users_account/users_account_form', $data);
    }
    
    //ACTIONUPDATEfunction
    public function updateAction()
    {
        $id = $this->request->getPostGet('oldusername');
        $dataFind = $this->model->getById($id);

        if($dataFind == FALSE || $id == NULL){
            session()->setFlashdata('ci_flash_message', lang("Errors.DataNotExist", [], $this->PageData->locale));
            session()->setFlashdata('ci_flash_message_type', ' alert-danger ');
            return redirect()->to(base_url($this->PageData->parent . '/index'));
        };

        if($this->isRequestValid() == FALSE){
            return $this->update(urlencode(base64_encode($id)));
        };

        $data = [
            // 'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'full_name' => $this->request->getPost('full_name'),
            'nick_name' => $this->request->getPost('nick_name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'level' => $this->request->getPost('level'),
        ];
        
        $this->model->update($id, $data);
        session()->setFlashdata('ci_flash_message', lang("Default.UpdateSuccess", [], $this->PageData->locale));
        session()->setFlashdata('ci_flash_message_type', ' alert-success ');
        return redirect()->to(base_url($this->PageData->parent . '/index'));
    }

    //DELETE
    public function delete($id=NULL)
    {
        $id = $id == NULL ? $this->request->getPostGet("username") : base64_decode(urldecode($id));
        $row = $this->model->getById($id);

        if ($row && $id != NULL) {
            
            
            $this->model->delete($id);
            session()->setFlashdata('ci_flash_message', lang("Default.DeleteSuccess", [], $this->PageData->locale));
            session()->setFlashdata('ci_flash_message_type', ' alert-success ');
            return redirect()->to(base_url($this->PageData->parent . '/index'));
        } else {
            session()->setFlashdata('ci_flash_message', lang("Errors.DataNotExist", [], $this->PageData->locale));
            session()->setFlashdata('ci_flash_message_type', ' alert-danger ');
            return redirect()->to(base_url($this->PageData->parent . '/index'));
        }
    }

    //DELETEBATCH
    public function deleteBatch()
    {
        $arr = $this->request->getPost("removeme");
        $res = 0;
        if ($arr!=NULL) {
            if (count($arr)>=1) {
                foreach ($arr as $key => $id) {
                    $row = $this->model->getById($id);
                    if (! $row || $id == NULL) continue;
                    
                    $this->model->delete($id);
                    $res++;
                }
            }
        }

        session()->setFlashdata('ci_flash_message', lang("Default.BatchDeleteSuccess", ["total"=>$res], $this->PageData->locale));
        session()->setFlashdata('ci_flash_message_type', ' alert-success ');
        return redirect()->to(base_url($this->PageData->parent . '/index'));
    }

    //TRUNCATE
    public function truncate()
    {
        $this->model->truncate();
        session()->setFlashdata('ci_flash_message', lang("Default.TruncateSuccess", [], $this->PageData->locale));
        session()->setFlashdata('ci_flash_message_type', ' alert-success ');
        return redirect()->to(base_url($this->PageData->parent . '/index'));
    }

    // FORMVALIDATION
    private function isRequestValid(){
        $res = FALSE;

        $this->validation->setRules([
                'password' => 'trim|required|max_length[100]',
                'full_name' => 'trim|required|max_length[250]',
                'nick_name' => 'trim|required|max_length[100]',
                'email' => 'trim|max_length[100]',
                'phone' => 'trim|max_length[50]',
                'level' => 'trim|required|max_length[18]',
        ]);

        if ($this->validation->withRequest($this->request)->run() == TRUE) {
            $res = TRUE;
        }else{
            $errors = $this->validation->getErrors();
            foreach ($errors as $key => $value) {
                session()->setFlashdata('ci_flash_message_'.$key, $value);
                session()->setFlashdata('ci_flash_message_'.$key.'_type', ' alert-danger ');
            }
        }
        return $res;
    }

    //EXPORTEXCELfunction
    public function toExcel(){
        $excel = new Users_account_model();
        $sortcolumn = $this->request->getGetPost("sortcolumn");
        $sortorder = $this->request->getGetPost("sortorder");
        if ($sortcolumn == NULL && $sortorder == NULL){
            if (session()->has("sorting_table")) {
                if (session("sorting_table")==$this->model->table) {
                    $sortcolumn = session("sortcolumn");
                    $sortorder = session("sortorder");
                };
            };
        };
        if ($sortcolumn != NULL && $sortorder != NULL) {
            $excel->order = $sortorder;
            $excel->columnIndex = $sortcolumn;
        };
        $excel->export();
        exit();
    }

    //IMPORTEXCELfunction
    public function fromExcel(){
        $filename = NULL;
        if ($excelfile = $this->request->getFile('excel_file')) {
            if ($excelfile->isValid()) {
                if (!$excelfile->hasMoved()) {
                    $fotonewName = $excelfile->getRandomName();
                    $excelfile->move(WRITEPATH . 'uploads', $fotonewName);
                }
                $filename = WRITEPATH . 'uploads/' . $excelfile->getName();
            } else {
                session()->setFlashdata('ci_flash_message', $excelfile->getErrorString() . ' (' . $excelfile->getError() . ')');
                session()->setFlashdata('ci_flash_message_type', ' text-danger ');
                return $this->index();
            };
        };
        $excel = new Users_account_model();
        $result = $excel->import($filename);
        session()->setFlashdata('ci_flash_message', lang("Default.ImportedData", ["total"=>$result], $this->PageData->locale));
        session()->setFlashdata('ci_flash_message_type', ' alert-primary ');
        safeUnlink($filename);
        return redirect()->to(base_url($this->PageData->parent . '/index'));
    }

    //EXPORTWORDfunction
    public function toWord(){
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=Users_account.doc");

        // Table sorting using GET var
        $sortcolumn = $this->request->getGetPost("sortcolumn");
        $sortorder = $this->request->getGetPost("sortorder");
        if ($sortcolumn == NULL || $sortorder == NULL){
            if (session()->has("sorting_table")) {
                if (session("sorting_table")==$this->model->table) {
                    $sortcolumn = session("sortcolumn");
                    $sortorder = session("sortorder");
                };
            };
        }else{
            $sortcolumn = base64_decode($sortcolumn);
        }
        if ($sortcolumn != NULL && $sortorder != NULL) {
            if ($sortorder != "DESC" && $sortorder != "ASC") $sortorder = "ASC";
            if(in_array($sortcolumn, $this->model->getFields())){
                $this->model->order = $sortorder;
                $this->model->columnIndex = $sortcolumn;
            }
        }

        $this->PageData->title = "Word Document File";
        $this->PageData->subtitle = ["Users_account", "Word  Document File"];

        $data = array(
            'Page' => $this->PageData,
            'data' => $this->model->sort()->findAll(),
            'start' => 0
        );
        
        return view('superadministrator/users_account/users_account_doc', $data);
    }

    //mPDF_EXPORT_FUNCTION
    public function toPdf(){
        // Table sorting using GET var
        $sortcolumn = $this->request->getGetPost("sortcolumn");
        $sortorder = $this->request->getGetPost("sortorder");
        if ($sortcolumn == NULL || $sortorder == NULL) {
            if (session()->has("sorting_table")) {
                if (session("sorting_table") == $this->model->table) {
                    $sortcolumn = session("sortcolumn");
                    $sortorder = session("sortorder");
                };
            };
        } else {
            $sortcolumn = base64_decode($sortcolumn);
        }
        if ($sortcolumn != NULL && $sortorder != NULL) {
            if ($sortorder != "DESC" && $sortorder != "ASC") $sortorder = "ASC";
            if (in_array($sortcolumn, $this->model->getFields())) {
                $this->model->order = $sortorder;
                $this->model->columnIndex = $sortcolumn;
            }
        }

        $this->PageData->title = "PDF File";
        $this->PageData->subtitle = ["Users_account", "PDF File"];

        $data = array(
            'Page' => $this->PageData,
            'data' => $this->model->sort()->findAll(),
            'start' => 0
        );

        $view = \Config\Services::renderer();
        $temp = $view->setData($data)->render('superadministrator/users_account/users_account_pdf');

        $tempDir = "temp";
        if(!file_exists($tempDir)) mkdir($tempDir);

        $mpdf = new \Mpdf\Mpdf([
            'orientation' => 'P',
            'tempDir' => $tempDir
        ]);
        $mdpfFilename = "Users_account " . date("d_m_Y") . ".pdf";
        $mpdf->WriteHTML($temp);

        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output($mdpfFilename, "I"); // opens in browser
        exit();
    }

    //PRINTfunction
    public function printAll(){
        // Table sorting using GET var
        $sortcolumn = $this->request->getGetPost("sortcolumn");
        $sortorder = $this->request->getGetPost("sortorder");
        if ($sortcolumn == NULL || $sortorder == NULL){
            if (session()->has("sorting_table")) {
                if (session("sorting_table")==$this->model->table) {
                    $sortcolumn = session("sortcolumn");
                    $sortorder = session("sortorder");
                };
            };
        }else{
            $sortcolumn = base64_decode($sortcolumn);
        }
        if ($sortcolumn != NULL && $sortorder != NULL) {
            if ($sortorder != "DESC" && $sortorder != "ASC") $sortorder = "ASC";
            if(in_array($sortcolumn, $this->model->getFields())){
                $this->model->order = $sortorder;
                $this->model->columnIndex = $sortcolumn;
            }
        }

        $this->PageData->title = "Users_account Data";
        $this->PageData->subtitle = ["Users_account", "Print All"];
        $this->PageData->url = "superadministrator/Users_account/printAll/";

        $data = array(
            'Page' => $this->PageData,
            'data' => $this->model->sort()->findAll(),
            'start' => 0
        );
        
        return view('superadministrator/users_account/users_account_print', $data);
    }
    
    //ENDFUNCTION
}
