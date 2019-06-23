<?php

class Mahasiswa_model {
    private $mahasiswa = [
        [
            "nama" => "Muhammad Rizal",
            "nim" => "123170036",
            "email" => "hadrizal7@gmail.com",
            "jurusan" => "Teknik Informatika"
        ],
        [
            "nama" => "Riski Midi W",
            "nim" => "123170035",
            "email" => "riskimidiw@yahoo.com",
            "jurusan" => "Teknik Informatika"
        ],
        [
            "nama" => "Sakti W",
            "nim" => "123170031",
            "email" => "lulusejati@gmail.com",
            "jurusan" => "Teknik Informatika"
        ]
    ];

    private $table = 'mahasiswa';
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getAllMahasiswa() {
        // return $this->mahasiswa;
        $this->database->query("SELECT * FROM ".$this->table);
        return $this->database->resultSet();
    }

    public function getMahasiswaById($id) {
        $this->database->query('SELECT * FROM '. $this->table .' WHERE id = :id');
        $this->database->bind('id', $id);
        return $this->database->resultSingle();
    }

    public function createDataMahasiswa($data) {
        $query = "INSERT INTO mahasiswa 
                    VALUES 
                    ('',  :nama, :nim, :email, :jurusan)";
        $this->database->query($query);
        $this->database->bind('nama', $data['nama']);
        $this->database->bind('nim', $data['nim']);
        $this->database->bind('email', $data['email']);
        $this->database->bind('jurusan', $data['jurusan']);

        $this->database->execute();

        return $this->database->rowCount();
    }

    public function deleteDataMahasiswa($id) {
        $query = "DELETE FROM mahasiswa WHERE id = :id";

        $this->database->query($query);
        $this->database->bind('id', $id);

        $this->database->execute();

        return $this->database->rowCount();
    }

    public function updateDataMahasiswa($data) {
        $query = "UPDATE mahasiswa SET
            nama = :nama,
            nim = :nim, 
            email = :email,
            jurusan = :jurusan
            WHERE id = :id";

        $this->database->query($query);
        $this->database->bind('nama', $data['nama']);
        $this->database->bind('nim', $data['nim']);
        $this->database->bind('email', $data['email']);
        $this->database->bind('jurusan', $data['jurusan']);
        $this->database->bind('id', $data['id']);
        $this->database->execute();

        return $this->database->rowCount();
    }

    public function searchDataMahasiswa($keyword) {
        $query = "SELECT nama FROM mahasiswa WHERE nama LIKE :keyword";
        $this->database->query($query);
        $this->database->bind('keyword', "%$keyword%");
        $this->database->execute();

        return $this->database->resultSet();
    }
}