$('body').on('click', '.modal-show', function(event){
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title');
    
    $('.modal-title').text(title);
    $('#modal-btn-save').show();
    $('#modal-btn-save').text(me.hasClass('btn_edit') ? 'Update' : 'Simpan');

    $.ajax({
        url : url,
        dataType: 'html',
        success: function(response){
            $('.modal-body').html(response);
        }
    });

    $('#modal').modal('show');
})

$('body').on('click', '.kajian_show', function(event){
    event.preventDefault(); 
    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title');
    
    $('.modal-title').text(title);
    $('#modal-btn-save').hide();
    $.ajax({
        url : url,
        dataType: 'html',
        success: function(response){
            $('.modal-body').html(response);
        }
    });
    $('#modal').modal('show');
})

$('body').on('change', 'select[name="kajian_tahun"]', function(event){
    $.ajax({
        url : '/kajian/filter/' + $('select[name="kajian_tahun"]').val(),
        dataType: 'html',
        success: function(response){
            $('#table_count').fadeIn();
            $('#table_count').html(response);
        }
    });
})

// $('body').on('click', '.btn-edit-page', function(event){
//     var me = $(this);
//         url = me.attr('href');
//     $.ajax({
//         type: "get",
//         url: "http://127.0.0.1:8000/monev_batu/1/edit",
//         dataType: 'json',
//         success : function(data) {
//             $('#jumlah').val(data.info.jumlah);
//             $('#tanggal').val(data.info.tanggal);
//             $("#kategori").select2("trigger", "select", {
//                 data: { id: data.info.jenis_observasi }
//             });
//         },
//         error: function(response) {
//             alert(response.responseJSON.message);
//         }
//     });
// })

    
$('#modal-btn-save').click(function(event){
    event.preventDefault();

    var form = $('.modal-body form'),
        url = form.attr('action'),
        method = $('input[name=_method]').val() == undefined ? 'POST' : 'PUT';
        table = $('input[name=mow]').val() == 'mow' ? '#datatable-mow' : '#datatable';
    
    
    
    
    form.find('.help-block').remove();
    form.find('.form-group').removeClass('.text-danger');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    var formData = new FormData(form[0]);
    $.ajax({
        url : url,
        method : method,
        data : formData,
        contentType : false,
        processData : false,
        success : function (response) {
            form.trigger('reset'),
            $('#modal').modal('hide'),
            $(table).DataTable().ajax.reload();
            swal({
                type : 'success',
                title : 'Berhasil !',
                text : 'Data berhasil disimpan',
                buttonsStyling: false, 
                confirmButtonClass: "btn btn-success"
            })
        },
        error: function(xhr){
            var res = xhr.responseJSON;

            if($.isEmptyObject(res) == false){
                $.each(res.errors, function(key, value){
                    $('#' + key)
                        .closest('.form-group')
                        .addClass('.text-danger')
                        .append('<span class="help-block"><strong>' + value + '</strong></span>')
                })
            }
            console.log(xhr.responseJSON);
        }
    });
})

$('body').on('click', '.btn_show', function(event){
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title');
    
    $('.modal-title').text(title);
    $('#modal-btn-save').hide();

    $.ajax({
        url: url,
        dataType: 'html',
        success: function(response){
            $('.modal-body').html(response);
        }
    });

    $('#modal').modal('show');
});

$('body').on('click', '.btn_delete', function(event){
    event.preventDefault();

    var me = $(this);
        url = me.attr('href'),
        title = me.attr('title'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');
    
    swal({
        title: 'Hapus Data',
        text: 'Apakah anda yakin ingin menghapus data ini ?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        showCancelButton: '#d33',
        confirmButtonText: 'Hapus'
    }).then((result)=>{
        if(result.value){
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    '_method' : "DELETE",
                    '_token' : csrf_token
                },
                success: function(response){
                    $('#datatable').DataTable().ajax.reload();
                    $('#datatable-mow').DataTable().ajax.reload();
                    swal({
                        type : 'success',
                        title : 'Berhasil !',
                        text : 'Data berhasil dihapus',
                    })
                },
                error: function(xhr){
                    swal({
                        type : 'error',
                        title : 'Oops...',
                        text: 'Something went wrong!'
                    });
                }
            });
        }
    });
});


$('body').on('click', '#arsitektur, #mow, #video, #photo', function(event){
    event.preventDefault();
    var me = $(this),
        url = me.attr('href');
    // alert(url);

    $.ajax({
        url : url,
        dataType: 'html',
        success: function(response){
            $('#kategori').fadeOut();
            $('#kategori').html(response);
            $('#kategori').fadeIn(1000);
        }
    });
})

$('body').on('click', '#layanan_kunjungan', function(event){
    event.preventDefault();
    var me = $(this),
        url = me.attr('href');

    $.ajax({
        url : url,
        dataType: 'html',
        success: function(response){
            $('#kategori_layanan').fadeIn(3000);
            $('#kategori_layanan').html(response);
        }
    });
})

$('body').on('click', '#layanan_pemanfaatan', function(event){
    event.preventDefault();
    var me = $(this),
        url = me.attr('href');

    $.ajax({
        url : url,
        dataType: 'html',
        success: function(response){
            $('#kategori_layanan').fadeIn(3000);
            $('#kategori_layanan').html(response);
        }
    });
})

$('body').on('click', '#layanan_kemitraan', function(event){
    event.preventDefault();
    var me = $(this),
        url = me.attr('href');

    $.ajax({
        url : url,
        dataType: 'html',
        success: function(response){
            $('#kategori_layanan').fadeIn(3000);
            $('#kategori_layanan').html(response);
        }
    });
})

$('body').on('click', '#layanan_lab', function(event){
    event.preventDefault();
    var me = $(this),
        url = me.attr('href');

    $.ajax({
        url : url,
        dataType: 'html',
        success: function(response){
            $('#kategori_layanan').fadeIn(3000);
            $('#kategori_layanan').html(response);
        }
    });
})

$('body').on('click', '#layanan_dok', function(event){
    event.preventDefault();
    var me = $(this),
        url = me.attr('href');

    $.ajax({
        url : url,
        dataType: 'html',
        success: function(response){
            $('#kategori_layanan').fadeIn(3000);
            $('#kategori_layanan').html(response);
        }
    });
})

$('body').on('click', '#layanan_temuan', function(event){
    event.preventDefault();
    var me = $(this),
        url = me.attr('href');

    $.ajax({
        url : url,
        dataType: 'html',
        success: function(response){
            $('#kategori_layanan').fadeIn(3000);
            $('#kategori_layanan').html(response);
        }
    });
})

$('body').on('click', '#layanan_aduan', function(event){
    event.preventDefault();
    var me = $(this),
        url = me.attr('href');

    $.ajax({
        url : url,
        dataType: 'html',
        success: function(response){
            $('#kategori_layanan').fadeIn(3000);
            $('#kategori_layanan').html(response);
        }
    });
})