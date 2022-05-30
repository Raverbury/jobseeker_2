<?php

class RecruitController extends Controller
{
    public function process($params)
    {   //if ($_SESSION['role']!='employer')
        //$this->redirect('home');
        require('..\core\models\RecruitModel.php');
        $recruitModel = new RecruitModel();
        $action = array_shift($params);
        switch ($action) {
            case '':
                $this->redirect('recruit/all');
                break;
            case 'all':
                $this->view = 'recruitViewAll';
                $recruitModel->getAllQuery('1'); // param = SESSION[id]
                $this->result = $recruitModel->getResult();
                //print_r($this->result);
                // map result to view
                break;
            case 'create':
                $this->view = 'recruitCreate';
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $recruitModel->loadParams($_SESSION['id'], $_POST['companyname'], $_POST['title'], $_POST['expyear'], $_POST['salary'], $_POST['jobdes']);
                    $recruitModel->executeQuery();
                    $this->redirect('recruit/all');
                    //print_r($_POST);
                } else {
                    $this->view = 'recruitCreate';
                }
                break;
            case 'getId':
                if ($params[0]) { // queried id
                    //print_r($params[0]);
                    $recruitModel->getIdQuery($params[0]);
                    $this->result = $recruitModel->getResult();
                    $this->view = 'recruitView';
                } else {
                    $this->redirect('error');
                }

                break;
            default:
                //$this->redirect('recruit/all');
                break;
        }
    }
}
