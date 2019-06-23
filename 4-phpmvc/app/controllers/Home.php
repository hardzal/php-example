<?php

class Home extends Controller {

    public function index() {
        $data['title'] = "Homepage";
        $data['name'] = $this->model('User_model')->getUser();
        $this->view('layouts/header', $data);
        $this->view('home/index', $data);
        $this->view('layouts/footer');
    }

}