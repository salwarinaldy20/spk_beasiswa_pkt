let idmulti = [];

$(".datepicker").bootstrapMaterialDatePicker({
    weekStart: 0,
    time: true,
    clearButton: true,
    nowButton: true,
    // minDate: new Date()
    maxDate :  new Date()
})

$(".select2").select2({
    allowClear: true,
});

function toggleLayout(el){
    idmulti = [];
    if(el.text().toLowerCase() == 'add'){
        bs5showTab('#formx-tab');
        el.html("Back");
        $('.hidex').not(el).hide();
    } else {
        bs5showTab('#dataxtbl-tab');
        el.html("Add");
        $('.hidex').show();
    }
    resetForm();
}



// --- delay typing --
function delay(callback, ms) {
    var timer = 0;
    return function() {
      var context = this, args = arguments;
      clearTimeout(timer);
      timer = setTimeout(function () {
        callback.apply(context, args);
      }, ms || 0);
    };
}


//------------- table rules -------------------
var columns1 = [
    {data: 'id', name: 'id', render: function (data, type, row, meta) { return ''; }, orderable: false, searchable: false},
    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
    {data: 'nama_penyakit',    name: 'nama_penyakit'},
    {data: 'gejala',    name: 'gejala'},
    {data: 'bobot',  name: 'bobot' , visible:false,},
    {data: 'aksi',      name: 'aksi', orderable: false,},
];

var collapsedGroups = {};
var top = '';

// ---- initialize table ----
var tblrules = $('#tblrules').DataTable({
    pageLength : 10,
    searchDelay: 1200,
    scrollX: false,
    scrollCollapse: true,
    processing: true,
    serverSide: true,
    ajax: {
        type: "POST",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url : base+'/app/getdatarules',
        data: function (d) {
            d.filters = {
                // ini disesuaikan dengan from yang ada di controller
                nama_penyakit: $("#flid_penyakit").val().trim() ? [$("#flid_penyakit").parent().find('.statefil').text(), $("#flid_penyakit").val()] : '',
                gejala: $("#flid_gejala").val().trim() ? [$("#flid_gejala").parent().find('.statefil').text(), $("#flid_gejala").val()] : '',
                bobot: $("#flbobot").val().trim() ? [$("#flbobot").parent().find('.statefil').text(), $("#flbobot").val()] : '',
            };
        }
    },
    columns: columns1,
    /* scrollCollapse: true,
    fixedColumns:   {
        //leftColumns: 1,
        rightColumns: 1
    }, */
    colReorder: true,
    columnDefs: [ {
        orderable: false,
        className: 'select-checkbox',
        targets:   0
    }, {
        className: 'text-center',
        targets:   4
    }, {
        orderable: false,
        className: 'text-center',
        targets:   5
    }],
    select: {
        style: 'os',
        //selector: 'td:first-child'
    },
    createdRow: function ( row, data, index ) { // Buat baris menjadi berwarna
	},
	order: [[2, 'asc']],
    rowGroup: {
        enable: false,
        dataSrc: ['id_penyakit'],
        startRender: function(rows, group, level) {
            var all;

            if (level === 0) {
                top = group;
                all = group;
            } else {
                // if parent collapsed, nothing to do
                if (!!collapsedGroups[top]) {
                    return;
                }
                all = top + group;
            }

            var collapsed = !!collapsedGroups[all];

            rows.nodes().each(function(r) {
                r.style.display = collapsed ? 'none' : '';
            });

            // Add category name to the <tr>. NOTE: Hardcoded colspan
            return $('<tr/>').css({'cursor': 'pointer'})
                //.append('<td colspan="2"></td><td colspan="4">' + group + ' (' + rows.count() + ')</td>')
                .append('<td colspan="3"></td><td colspan="7">' + group + '</td>')
            .attr('data-name', all)
            .toggleClass('collapsed', collapsed);
        }
    },
    fnServerParams: function(data) {
        data['order'].forEach(function(items, index) {
            data['order'][index]['column_name'] = data['columns'][items.column]['data'];
        });
    }
});

// ---- handle group click ----
$('#tblrules tbody').on('click', 'tr.dtrg-start', function() {
    var name = $(this).data('name');
    collapsedGroups[name] = !collapsedGroups[name];
    tblrules.draw(false);
});

// ---- handle event on select row -----
tblrules.on('select deselect', function (e, dt, type, indexes) {
    var data = dt.rows({selected: true}).data();

    idmulti = [];
    if(data.length > 0){

        for(var i = 0; i < data.length; i++){
            idmulti.push(data[i].id);
        }


        $('.dsblsel').prop('disabled', false);
        $('.nsel').html(' ('+data.length+')');

    }
})

// ---- handle delay typing search box ---
$("#tblrules .dataTables_filter input").unbind().on('keyup', delay(function (e) {
    tblrules.search( $(this).val() ).draw();
}, 1200));

// ---- handle delay typing header filter ----
$('.fltable').on('keyup change', delay(function (e) {
    tblrules.column( $(this).data('column'))
    .search( $(this).val() )
    .draw();
}, 1200));

// ---- handle select all --------
$(document).on('click', '#satblrules', function() {
    if ($('#satblrules:checked').val() === 'on') {
      tblrules.rows().select();
    } else {
      tblrules.rows().deselect();
      $('.dsblsel').prop('disabled', true);
      $('.nsel').html('');
    }

});
// ------------- end table Rules ----------------


$('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
    tblrules.columns.adjust().draw();
});




//============================ start simpan =============================
$('form#reg').on('submit', function(e){
    e.preventDefault();

    // menyesuaikan dengan tabel database
        var data = new FormData();
        data.append('id', (idmulti[0] ? idmulti[0] : ''));
        data.append('id_penyakit', $('#id_penyakit').val().trim());
        data.append('id_gejala', $('#id_gejala').val().trim());
        data.append('bobot', $('#bobot').val().trim());

        if (validatex('#reg')){

            btnLoading($('#reg'), true);

            $.ajax({
                url: base+'/app/ucrules',
                type: 'POST',
                data: data,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                processData: false,
                contentType: false,
                global: false,
                dataType: "json",
                beforeSend: function(e) {
                    if(e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                    }
                },
                success: function(response){ // Ketika proses pengiriman berhasil

                    refreshTablex($('#tblrules'));
                    if (response.status) {
                        notif(response.data, response.message, 'success');
                        resetForm();
                    }else{
                        notif(response.errors, response.message, 'error');
                    }
                    btnLoading($('#reg'), false, 'Save Changes');
                },
                error: function (xhr, ajaxOptions, thrownError) { // Ketika terjadi error
                    btnLoading($('#reg'), false, 'Save Changes');

                    showAlert(1, 'ERROR!', 'Error : '+xhr.responseText, 'error', '', true);
                }
            });
        } else {

            notif('Ups', 'Please fill form correctly', 'error');
            return false;
        }

});

function edit(el){


    toggleLoadingDTB();

    var data = new FormData();
    // data.append('id', el.idu); old
    data.append('id', el);

    $.ajax({
        url: base+'/app/fdatarules',
        type: 'POST',
        data: data,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        processData: false,
        contentType: false,
        dataType: "json",
        beforeSend: function(e) {
            if(e && e.overrideMimeType) {
                e.overrideMimeType("application/json;charset=UTF-8");
            }
        },
        success: function(response){

            toggleLayout($('#add'));
            toggleLoadingDTB();

            idmulti = [];
            // idmulti.push(el.idu);
            idmulti.push(el);


            $('#id_penyakit').val(response.id_penyakit).trigger('change');
            $('#id_gejala').val(response.id_gejala).trigger('change');
            $('#bobot').val(response.bobot);

        }

    });

}

function hapus(el){

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        showLoaderOnConfirm: true,
        preConfirm: (act) => {

            var data = new FormData();
            // data.append('id', el.idu); old
            data.append('id', el);

            return $.ajax({
                url: base+'/app/delrules',
                type: 'POST',
                data: data,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                processData: false,
                contentType: false,
                dataType: "json",
                beforeSend: function(e) {
                    if(e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                    }
                },
                success: function(response){

                    return response;
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    return {status: false, message: 'Error : ' +ajaxOptions+' - '+thrownError, errors: null};
                }

            });

        },
        allowOutsideClick: false,

    }).then((result) => {

        if (result.isConfirmed){
            if (result.value.status) {
                refreshTablex($('#tblrules'));
                idmulti = [];
                showAlert(2, 'Success!', 'rules succsessfully deleted', 'success', 2000, true);
            } else {
                showAlert(1, 'ERROR!', 'Error : ' +result.value.message, 'error', 1800, true);
            }
        }

        resetSelect(1);

    });


}


function deleteAll() {

    if (idmulti.length < 1) {
        notif('Ups!', 'Please select data.', 'warning');
    }else{


        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: 'Yes',
            preConfirm: (act) => {

                var data = new FormData();
                data.append('id', JSON.stringify(idmulti));

                return $.ajax({
                    url: base+'/app/delrules',
                    type: 'POST',
                    data: data,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    beforeSend: function(e) {
                        if(e && e.overrideMimeType) {
                            e.overrideMimeType("application/json;charset=UTF-8");
                        }
                    },
                    success: function(response){
                        return response;
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        return {status: false, message: 'Error : ' +ajaxOptions+' - '+thrownError, errors: null};
                    }

                });

            },
            allowOutsideClick: false,

        }).then((result) => {
            if (result.isConfirmed){
                if (result.value.status) {
                    refreshTablex($('#tblrules'));
                    idmulti = [];

                    showAlert(2, 'Success!', 'rules succsessfully deleted', 'success', 2000, true);
                } else {
                    showAlert(1, 'ERROR!', 'Error : ' +ajaxOptions+' <br> '+thrownError, 'error', 1800, true);
                }
            }
            resetSelect(1);
        });


    }

}




function resetForm(){
    idmulti = [];
    $('form').trigger("reset");
    $("select[data-control=select2].s2x").val(null).trigger('change');
    $('.form-control').removeClass("is-valid").removeClass("is-invalid");
}

function resetSelect(table){
    idmulti = [];
    $('.dsblsel').prop('disabled', true);
    $('.nsel').html('');
}
