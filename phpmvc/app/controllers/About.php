<?php

class About extends Controller {
    public function index($params = 'friends') {
        $data['hello'] = $params;
        $data['title'] = "About page";
        $this->view('layouts/header', $data);
        $this->view('about/index', $data);
        $this->view('layouts /footer');
    }
}