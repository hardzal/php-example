<?php

class Mahasiswa extends Controller{

    public function index() {
        $data['title'] = "Data Mahasiwa";
        $data['mahasiswa'] = $this->model('Mahasiswa_model')->getAllMahasiswa();
        $this->view('layouts/header', $data);
        $this->view('mahasiswa/index', $data);
        $this->view('layouts/footer');
    }

    public function detail($id) {
        $data['title'] = "Detail Mahasiwa";
        $data['mahasiswa'] = $this->model('Mahasiswa_model')->getMahasiswaById($id);
        $this->view('layouts/header', $data);
        $this->view('mahasiswa/detail', $data);
        $this->view('layouts/footer');
    }

    public function create() {
        if($this->model('Mahasiswa_model')->createDataMahasiswa($_POST) > 0) {
            Flasher::setFlash("Berhasil", "ditambahkan", "success");
            header('Location: '. BASE_URL . '/mahasiswa');
            exit;
        } else {
            Flasher::setFlash("Gagal", "ditambahkan", "danger");
            header('Location: '. BASE_URL . '/mahasiswa');
            exit;
        }
    }

    public function delete($id) {
        if($this->model('Mahasiswa_model')->deleteDataMahasiswa($id) > 0) {
            Flasher::setFlash("Berhasil", "dihapus", "success");
            header('Location: '. BASE_URL . '/mahasiswa');
            exit;
        } else {
            Flasher::setFlash("Gagal", "dihapus", "danger");
            header('Location: '. BASE_URL . '/mahasiswa');
            exit;
        }
    }

    public function update() {
        if($this->model('Mahasiswa_model')->updateDataMahasiswa($_POST) > 0) {
            Flasher::setFlash("Berhasil", "diubah", "success");
            header('Location: '. BASE_URL . '/mahasiswa');
            exit;
        } else {
            Flasher::setFlash("Gagal", "diubah", "danger");
            header('Location: '. BASE_URL . '/mahasiswa');
            exit;
        }
    }

    public function edit() {
        echo json_encode($this->model('Mahasiswa_model')->getMahasiswaById($_POST['id']));
    }

    public function search() {
        $data['title'] = "Data Mahasiwa";
        $data['mahasiswa'] = $this->model('Mahasiswa_model')->searchDataMahasiswa($_POST['keyword']);
        $this->view('layouts/header', $data);
        $this->view('mahasiswa/index', $data);
        $this->view('layouts/footer');
    }
}