let base = window.location.origin;

$(document).ajaxStart(function(){
  wait('facebook', 'default', '#app', 'Loading...');
  wait('facebook', 'default', '.card-body', 'Loading...');
});

$(document).ajaxComplete(function(){
  stopWait('#app');
  stopWait('.card-body');
});
$(document).ajaxSuccess(function(){
  stopWait('#app');
  stopWait('.card-body');
});
$(document).ajaxError(function(){
  stopWait('#app');
  stopWait('.card-body');
});

$(document).on('click', '.refreshtbl', function(){
  var elm = $(this).data('refreshx');
  $('#'+elm).DataTable().draw();
  $('.ckbsa').prop('checked', false);
})

$(document).on('click', '.itemfil', function(){
  var val = $(this).data('value');
  if(val == '&#128270;'){
    $(this).parent().parent().parent().next().val('').change();
  }
  $(this).parent().parent().find('.statefil').html(val);
})

function refreshTablex(tablex){
  try {  
    tablex.DataTable().draw();
  } catch (e) {  
      console.log('fail refresh datagrid');
  } 
}

function bs5showTab(element){
  var triggerFirstTabEl = document.querySelector(element)
  bootstrap.Tab.getOrCreateInstance(triggerFirstTabEl).show();
}

function validatex(target){
  var valid = true;
  let validator = $(target).jbvalidator({
      errorMessage: true,
      successClass: true,
  });
  valid = validator.checkAll() > 0 ? false : true;
  return valid;
}


//----------------------------------------------------

$(document).on('click', '.refresh', function(){
  var elm = $(this).data('refreshx');
  refreshTablex($('#'+elm));
})


function refreshTablex_old(tablex, deselect = true){
  try {  
    if (deselect){
      tablex.dxDataGrid("instance").deselectAll();
    }
    tablex.dxDataGrid("instance").refresh(); 
  } catch (e) {  
      console.log('fail refresh datagrid');
      //DevExpress.ui.notify(e.message, "error", 1000);  
  } 
}

function numberFormat(x) {
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
function numberFormat1(x) {
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
          c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
          return c.substring(name.length, c.length);
      }
  }
  return "";
}

function wait(effect, typecolor, target, text){

/* effect : win8, win8_linear, ios, progressBar, pulse, timer, rotation, facebook, bounce */			

    if (typecolor == 'danger') {
      var color = '#B94A48';
    }else if (typecolor == 'info') {
      var color = '#4BB1CF';
    }else if (typecolor == 'warning') {
      var color = '#FAA732';
    }else if (typecolor == 'success') {
      var color = '#5EB95E';
    }else if (typecolor == 'lavender') {
      var color = '#8854d0';
    }else if (typecolor == 'primary') {
      var color = '#3A87AD';
    }else{
      var color = '#000000';
    }
    

    var $loading = $(target).waitMe({
      effect: effect,
      text: text,
      bg: 'rgba(255,255,255,0.6)',
      color: color
    });
}

function stopWait(target){
$(target).waitMe('hide');
}

function showAlert(typeAlert, title, text, type, timer, confirm){
if (typeAlert == 1) {

  Swal.fire({
    icon: type,
    title: title,
    html: text,
    timer: timer,
    timerProgressBar: true,
    showConfirmButton: true,
  })

}else{

  Swal.fire({
    icon: type,
    title: title,
    html: text,
    timer: timer,
    timerProgressBar: true,
    showConfirmButton: typeAlert,
  })

}	

}

function showData(target, url, block){
wait('win8', 'primary', block, 'Sedang Memuat...');
$(target).load(url, function() {
  stopWait(block);
});
}
 

function notif(title1, msg, typex){
  Swal.fire({
    toast: true,
    icon: typex,
    title: msg,
    position: 'top',
    showConfirmButton: false,
    timer: 4000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  });
  
}

function notif2(title1, msg, typex){
  iziToast.show({ 
    theme: 'dark',
    title: title1,
    icon: 'fa fa-bell',
    class: 'custom1',
    // displayMode: 2,
    message: msg,
    pauseOnHover: true,
    position: 'bottomRight',
    transitionIn: 'bounceInLeft',
    // balloon: true,
    // transitionIn: 'flipInX',
    // transitionOut: 'flipOutX',
    maxWidth:500,
    displayMode: 0,
    layout: 2,
    iconColor: 'rgb(0, 255, 184)',
    progressBarColor: 'rgb(0, 255, 184)',
});
  
}

  function CheckExtensionPDF(file) {
      /*global document: false */
      var validFilesTypes = ["pdf"];
      var filePath = file;
      var ext = filePath.substring(filePath.lastIndexOf('.') + 1).toLowerCase();
      var isValidFile = false;

      for (var i = 0; i < validFilesTypes.length; i++) {
          if (ext == validFilesTypes[i]) {
              isValidFile = true;
              break;
          }
      }
      return isValidFile;
  }
  function CheckExtensionDOC(file) {
      /*global document: false */
      var validFilesTypes = ["xlxs", "xlx", "docx", "doc", "pdf"];
      var filePath = file;
      var ext = filePath.substring(filePath.lastIndexOf('.') + 1).toLowerCase();
      var isValidFile = false;

      for (var i = 0; i < validFilesTypes.length; i++) {
          if (ext == validFilesTypes[i]) {
              isValidFile = true;
              break;
          }
      }
      return isValidFile;
  }
  function CheckExtensionIMG(file) {
      /*global document: false */
      var validFilesTypes = ["jpg", "jpeg", "png", "gif"];
      var filePath = file;
      var ext = filePath.substring(filePath.lastIndexOf('.') + 1).toLowerCase();
      var isValidFile = false;

      for (var i = 0; i < validFilesTypes.length; i++) {
          if (ext == validFilesTypes[i]) {
              isValidFile = true;
              break;
          }
      }
      return isValidFile;
  }
  function CheckExtensionIMGPDF(file) {
      /*global document: false */
      var validFilesTypes = ["jpg", "jpeg", "png", "gif", "pdf"];
      var filePath = file;
      var ext = filePath.substring(filePath.lastIndexOf('.') + 1).toLowerCase();
      var isValidFile = false;

      for (var i = 0; i < validFilesTypes.length; i++) {
          if (ext == validFilesTypes[i]) {
              isValidFile = true;
              break;
          }
      }
      return isValidFile;
  }
  function CheckExtensionAUD(file) {
      /*global document: false */
      var validFilesTypes = ["mp3", "wav"];
      var filePath = file;
      var ext = filePath.substring(filePath.lastIndexOf('.') + 1).toLowerCase();
      var isValidFile = false;

      for (var i = 0; i < validFilesTypes.length; i++) {
          if (ext == validFilesTypes[i]) {
              isValidFile = true;
              break;
          }
      }
      return isValidFile;
  }
  function CheckExtensionVID(file) {
      /*global document: false */
      var validFilesTypes = ["mp4", "mkv", "3gp"];
      var filePath = file;
      var ext = filePath.substring(filePath.lastIndexOf('.') + 1).toLowerCase();
      var isValidFile = false;

      for (var i = 0; i < validFilesTypes.length; i++) {
          if (ext == validFilesTypes[i]) {
              isValidFile = true;
              break;
          }
      }
      return isValidFile;
  }
  function CheckExtensionExcel(file) {
      /*global document: false */
      var validFilesTypes = ["xlsx", "xls", "csv"];
      var filePath = file;
      var ext = filePath.substring(filePath.lastIndexOf('.') + 1).toLowerCase();
      var isValidFile = false;

      for (var i = 0; i < validFilesTypes.length; i++) {
          if (ext == validFilesTypes[i]) {
              isValidFile = true;
              break;
          }
      }
      return isValidFile;
  }
  function validateFileSize(e) {
              /*global document: false */
              var file = e;
              var isValidFile = false;
              if (e !== 0 && e <= 11010048) { //10 mb
                  isValidFile = true;
              }
              return isValidFile;
  }



function getCompany(comp = []){
    let lscompany = [{
        value: 'A000',
        text: 'A000 - PT Pupuk Indonesia',
        img: 'pi.png',
        comp_id: 'PI'
    }, {
        value: 'B000',
        text: 'B000 - PT Petrokimia Gresik',
        img: 'pkg.png',
        comp_id: 'PKG'
    }, {
        value: 'C000',
        text: 'C000 - PT Pupuk Kujang',
        img: 'pkc.png',
        comp_id: 'PKC'
    }, {
        value: 'D000',
        text: 'D000 - PT Pupuk Kalimantan Timur',
        img: 'pkt1.png',
        comp_id: 'PKT'
    }, {
        value: 'E000',
        text: 'E000 - PT Pupuk Iskandar Muda',
        img: 'pim.png',
        comp_id: 'PIM'
    }, {
        value: 'F000',
        text: 'F000 - PT Pupuk Sriwijaya',
        img: 'psp.png',
        comp_id: 'PSP'
    }];

    let res = [];

    if (comp.length < 1){
        res = lscompany;
    } else {
      if (comp[0] == "anper"){
        res = []; 
        lscompany.forEach(el => {
            if(el.value != 'A000'){
                res.push(el);
            }
        });
      } else {
        res = [];
        var i = 0;
        comp.forEach(el => {
            if(el == lscompany[i].value){
                res.push(lscompany[i]);
            }

            i++;
        });
      }
    }

    return res;
}


function btnLoading1(target, isload, text){
  if(isload){
      $(target).find('.spinnerx').show();
      $(target).find('.btnttl').html(text);
      $(target).find('.btnload').prop('disabled', true);
      $(target).find('.form-control').prop('disabled', true);    
  } else {
    $(target).find('.spinnerx').hide();
    $(target).find('.btnttl').html(text);
    $(target).find('.btnload').prop('disabled', false);
    $(target).find('.form-control').prop('disabled', false);    
  }
}

function btnLoading(target, isload){
  if(isload){
    $(target).find('.indicator-label').parent().attr('data-kt-indicator', 'on').prop('disabled', true);
  } else {
    $(target).find('.indicator-label').parent().removeAttr('data-kt-indicator').prop('disabled', false);
  }
}

function getBulan(bln){
  var bulan = '';
  switch(bln) {
    case 1:
        bulan = 'Januari'
    break;
    case 2:
        bulan = 'Februari'
    break;
    case 3:
        bulan = 'Maret'
    break;
    case 4:
        bulan = 'April'
    break;
    case 5:
        bulan = 'Mei'
    break;
    case 6:
        bulan = 'Juni'
    break;
    case 7:
        bulan = 'Juli'
    break;
    case 8:
        bulan = 'Agustus'
    break;
    case 9:
        bulan = 'September'
    break;
    case 10:
        bulan = 'Oktober'
    break;
    case 11:
        bulan = 'November'
    break;
    case 12:
        bulan = 'Desember'
    break;
    default:
    bulan = 'Januari'
  }
  return bulan;
}

//fungsi agar scrolling multiple modal tetap ada
$("#modal-file").on('hidden.bs.modal', function (event) {
if ($('.modal:visible').length) //check if any modal is open
{
  $('body').addClass('modal-open');//add class to body
}
});


function toggleLoadingDTB(){
  if($('.dataTables_processing').is(':visible')){
    $('.dataTables_processing').css( 'display', 'none');
  } else {
    $('.dataTables_processing').css( 'display', 'block');
  }
}

/* $(function(){
  tinymce.init({
    selector: ".tinymce",
    //theme: "silver",
    suffix: '.min',
    relative_urls: false,
    paste_data_images: true,
    setup: function (editor) {
        // For the keycode (eg. 13 = enter) use: cf http://keycode.info 
        editor.shortcuts.add('ctrl+m', 'mceTableMergeCells', function(){      
            tinymce.activeEditor.execCommand('mceTableMergeCells');
        });

    },                        
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    style_formats: [
        {title: 'aaaa', advlist: 'lower_alpha'}
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic underline subscript superscript | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | preview charmap | image",
    image_advtab: true,
    relative_urls: false,
    path_absolute: "/tinymceimage",
    file_picker_callback : function(callback, value, meta) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = '/laravel-filemanager?editor=' + meta.fieldname;
      if (meta.filetype == 'image') {
      cmsURL = cmsURL + "&type=Images";
      } else {
      cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.openUrl({
      url : cmsURL,
      title : 'Filemanager',
      width : x * 0.8,
      height : y * 0.8,
      resizable : "yes",
      close_previous : "no",
      onMessage: (api, message) => {
          callback(message.content);
      }
      });
    },

    templates: [{
      title: 'Test template 1',
      content: 'Test 1'
    }, {
      title: 'Test template 2',
      content: 'Test 2'
    }]
    });
    tinymce.suffix = ".min";
    tinyMCE.baseURL = base+'/js';

}) */