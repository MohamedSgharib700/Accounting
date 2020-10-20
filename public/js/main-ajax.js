$( document ).ready(function(){
    /* ------------------- new-supervisor ----------------- */
    $(document).on('click', "#add-supervisor", function (e) {
        var path = "uploads/";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: 'supervisors',
            data: new FormData($("#add-supervisor-form")[0]),
            dataType: 'json',
            async: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $('.popup').hide(300);
                Swal.fire(
                    'تمت العمليه بنجاح',
                    '',
                    'success'
                );
                $('#add-supervisor-form').trigger("reset");
                $(".supervisors-table").append("<tr class='supervisor-" + data.id + "'>" +
                    "<th scope='row'>" + data.id + "</th>" +
                    "<td>" + data.name + "</td>" +
                    "<td>" + data.email + "</td>" +
                    "<td>" + data.phone + "</td>"+
                    "<td><img src='" + data.image + "' width='100px'></td>" +
                    "<td><button class='edit-supervisor edit-popup btn btn-block btn-primary'  data-toggle='modal' data-target='#edit-modal-product' data-id='" + data.id + "' data-name='" + data.name + "' data-email='" + data.email + "' data-phone='" + data.phone + "'   >تعديل</button></td>" +
                    "<td><button class='edit-supervisor-active edit-popup-active btn btn-block btn-warning'  data-active='"+data.active+"' data-id='" + data.id + "' >تعديل الحاله</button></td>" +
                    "</tr>")
            },
            error: function (data) {
                $.each(data.responseJSON.errors, function(key,value){
                    $('.popup').hide(300);
                    Swal.fire({
                        type: 'error',
                        title: 'عفوا',
                        text: value,
                    });
                })
                $('#add-supervisor-form').trigger("reset");

            }

        });
        e.preventDefault();


    });
    /* ------------------- edit-supervisor ----------------- */
    $(document).on('click', ".edit-supervisor", function (e) {
        $('#edit-supervisor-form').trigger("reset");
        $("#supervisor-name-edit").val($(this).data('name'));
        $("#supervisor-email-edit").val($(this).data('email'));
        $("#supervisor-phone-edit").val($(this).data('phone'));
        supervisorId = $(this).data('id');
    });
    $(document).on('click', "#edit-supervisor", function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: 'supervisors-edit/'+supervisorId,
            data: new FormData($("#edit-supervisor-form")[0]),
            dataType: 'json',
            async: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $('.popup-edit').hide(300);
                Swal.fire(
                    'تمت العمليه بنجاح',
                    '',
                    'success'
                );
                $('#edit-supervisor-form').trigger("reset");
                if(data.original.active==1){
                    $(".supervisor-"+supervisorId).replaceWith("<tr class='supervisor-" + data.original.id + "'>" +
                        "<th scope='row'>" + data.original.id + "</th>" +
                        "<td>" + data.original.name + "</td>" +
                        "<td>" + data.original.email + "</td>" +
                        "<td>" + data.original.phone + "</td>"+
                        "<td><img src='"+ data.original.image +"' width='100px'></td>" +
                        "<td class='active-"+supervisorId+"' > <button class='success btn btn-block'>مفعل </button> </td>" +
                        "<td><button class='edit-popup edit-supervisor  btn btn-block btn-primary' data-id='" + data.original.id + "' data-name='" + data.original.name + "' data-email='" + data.original.email + "' data-phone='" + data.original.phone + "'   >تعديل</button></td>" +
                        "</tr>")
                }
                else{
                    $(".supervisor-"+supervisorId).replaceWith("<tr class='supervisor-" + data.original.id + "'>" +
                        "<th scope='row'>" + data.original.id + "</th>" +
                        "<td>" + data.original.name + "</td>" +
                        "<td>" + data.original.email + "</td>" +
                        "<td>" + data.original.phone + "</td>"+
                        "<td><img src='"+ data.original.image +"' width='100px'></td>" +
                        "<td class='active-"+supervisorId+"' > <button class='failed btn btn-block'> غير مفعل </button> </td>" +
                        "<td><button class='edit-popup edit-supervisor  btn btn-block btn-primary' data-id='" + data.original.id + "' data-name='" + data.original.name + "' data-email='" + data.original.email + "' data-phone='" + data.original.phone + "'   >تعديل</button></td>" +
                        "<td><button class='edit-popup-active edit-supervisor-active  btn btn-block btn-warning'  data-active='"+data.original.active+"' data-id='" + data.original.id + "' >تعديل الحاله</button></td>" +
                        "</tr>")
                }
            },
            error: function (data) {
                $.each(data.responseJSON.errors, function(key,value){
                    $('.popup-edit').hide(300);
                    Swal.fire({
                        type: 'error',
                        title: 'عفوا',
                        text: value,
                    });
                })
                $('#edit-supervisor-form').trigger("reset");
            }

        });
        e.preventDefault();


    });
    /* ------------------- edit-supervisor-active ----------------- */
    $(document).on('click', '.change', function(e) {
        var supervisor_id = $(this).data('id');
        var active = $(this).data('active');
        if(active ==0) {
            active=1;
        } else{
            active=0;
        }
        $.ajax({
            type: "GET",
            dataType: "json",
            url: 'supervisors/'+supervisor_id+'/'+active,
            success: function(data){
                console.log(data.success)
            }
        });
        e.preventDefault();
    })
})
