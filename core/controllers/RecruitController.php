<<<<<<< HEAD
<?php

class RecruitController extends Controller
{
    public function process($params)
    {
        $action = array_shift($params);
        switch ($action) {
            case '':
                header("HTTP/1.0 200");
                $this->head['title'] = 'Recruit';
                $this->head['description'] = 'Page for employers to recruit people';
                $this->view = 'recruit';
                break;
            default:
                $this->redirect('error');
                break;
        }
    }
}
=======
<?php

class RecruitController extends Controller
{
	public function process($params)
	{   //if ($_SESSION['role']!='employer')
            //$this->redirect('home');
        require ('..\core\models\RecruitModel.php');
        $recruitModel = new RecruitModel();
		$action = array_shift($params);
		switch ($action) {
			case '':
                $this->redirect('recruit/all');		
				break;
            case 'all':
                $this->view = 'recruitViewAll';
                $recruitModel->getAllQuery($_SESSION['id']);
                $this->result = $recruitModel->getResult();
                // map result to view
                break;
            case 'create':
                $this->view = 'recruitFormCreate';
                if ($_SERVER["REQUEST_METHOD"]=="POST"){
                    $recruitModel->loadParams($_SESSION['id'],$_POST['companyname'],$_POST['title'],$_POST['expyear'],$_POST['salary'],$_POST['benefits'],$_POST['jobdes']);
                    $recruitModel->executeQuery();
                    $this->redirect('recruit/all');
                }
                else{
                    $this->view = 'recruitFormCreate';
                }
                break;
            case 'getId':
                if ($params[0]){ // queried id
                    $recruitModel->getIdQuery($params[0]);
                    $this->result = $recruitModel->getResult();
                    $this->view = 'jobpostsingle';
                }
                else{
                    $this->redirect('error');
                }
                $this->view = 'recruitFormShow';

                break;
			default:
				$this->redirect('error');
				break;
		}
	}
}
>>>>>>> 750ef25e93a4bb84386b6fba9224773c3b89e80d
