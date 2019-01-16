$(function() {

    $('.tombolTambahData').on('click', function() {
        $('#judulModalLabel').html("Tambah Data Mahasiswa");
        $('.modal-footer button[type=submit]').html("Tambah Data");    
    });

    $('.tampilModalUbah').on('click', function() {
        $('#judulModalLabel').html("Update Data Mahasiswa");
        $('.modal-footer button[type=submit]').html("Ubah Data");
        $('.modal-dialog form').attr('action', 'http://localhost:8080/phpmvc/public/mahasiswa/update');

        const id = $(this).data('id');
        
        $.ajax({
            url: 'http://localhost:8080/phpmvc/public/mahasiswa/edit',
            data: {
                id: id
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#nama').val(data.nama);
                $('#nim').val(data.nim);
                $('#email').val(data.email);
                $('#jurusan').val(data.jurusan);
                $('#id').val(data.id);
            }
        }); 

    });
});