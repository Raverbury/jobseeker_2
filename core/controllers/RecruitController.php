<?php

class RecruitController extends Controller
{
  public function process($params)
  {
    $action = array_shift($params);
    switch ($action) {
      case '':
        $this->redirect('recruit/all');
        break;
      case 'all':
        $response = JDModel::all();
        if ($response->message == "OK") {
          $this->data['allJDs'] = $response->query_result;
          $this->view = 'recruitViewAll';
          header("HTTP/1.0 200");
          $this->head['title'] = 'View all JDs';
          $this->head['description'] = 'View all JDs';
        } else {
          $_SESSION['message'] = $response->message;
          $_SESSION['showMessage'] = true;
          $_SESSION['messageType'] = 'danger';
          $this->redirect('home');
        }
        break;
      case 'create':
        if ($_SESSION['role'] != 'employer') {
          $_SESSION['message'] = 'Must be logged in as an employer.';
          $_SESSION['showMessage'] = true;
          $_SESSION['messageType'] = 'danger';
          $this->redirect('recruit/all');
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $response = JDModel::insert($_POST);
          if ($response->message == 'OK') {
            $_SESSION['message'] = 'Your JD has been created successfully.';
            $_SESSION['showMessage'] = true;
            $_SESSION['messageType'] = 'success';
            $this->redirect('recruit/all');
          } else {
            $_SESSION['message'] = $response->message;
            $_SESSION['showMessage'] = true;
            $_SESSION['messageType'] = 'danger';
            $this->redirect('recruit/create');
          }
          $this->redirect('recruit/all');
        } else {
          $this->view = 'recruitCreate';
        }
        break;
      case 'view':
        if (count($params) > 0) { // queried id
          //print_r($params[0]);
          $response = JDModel::byId($params[0]);
          $this->result['jdID'] = $params[0];
          $this->data['jd'] = $response->query_result;
          if ($response->message == 'OK') {
            $this->view = 'recruitView';
            header("HTTP/1.0 200");
            $this->head['title'] = 'View a JD';
            $this->head['description'] = 'View a single JDs';
          } else {
            $_SESSION['message'] = $response->message;
            $_SESSION['showMessage'] = true;
            $_SESSION['messageType'] = 'danger';
            $this->redirect('recruit/all');
          }
        } else {
          $this->redirect('recruit/all');
        }
        break;
      case 'apply':
        if ($_SESSION['role'] != 'candidate') {
          $_SESSION['message'] = 'Must be logged in as a candidate.';
          $_SESSION['showMessage'] = true;
          $_SESSION['messageType'] = 'danger';
          $this->redirect('recruit/all');
        }
        if (count($params) > 0) {
          $jdID = $params[0];
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $response = ApplicationModel::apply($_POST['uid'], $_POST['cvId'], $_POST['jdId']);
            if ($response->message == 'OK') {
              $this->redirect('recruit/apply/' . $jdID);
            } else {
              $_SESSION['message'] = $response->message;
              $_SESSION['showMessage'] = true;
              $_SESSION['messageType'] = 'danger';
              $this->redirect('recruit/all');
            }
          } else {
            $cv_response = CVModel::byOwnerId($_SESSION['id']);
            $cvs = $cv_response->query_result;
            $application_response = ApplicationModel::cvIdWhere($jdID, $_SESSION['id']);
            $applied = $application_response->query_result[0];
            if ($cv_response->message == 'OK' && $application_response->message == 'OK') {
              $this->data['cvs'] = $cvs;
              $this->data['applied'] = $applied;
              $this->data['jdId'] = $jdID;
              header("HTTP/1.0 200");
              $this->head['title'] = 'Apply to a job';
              $this->head['description'] = 'Apply a CV to a JD';
              $this->view = 'recruitApply';
            } else {
              $_SESSION['showMessage'] = true;
              $_SESSION['message'] = 'CVs: ' . $cv_response->message . '; applied: ' . $application_response->message;
              $_SESSION['messageType'] = 'danger';
              $this->redirect('home');
            }
          }
        } else {
          $this->redirect('recruit/all');
        }
        break;
      default:
        $this->redirect('error');
        break;
    }
  }
}
