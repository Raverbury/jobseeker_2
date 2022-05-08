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
