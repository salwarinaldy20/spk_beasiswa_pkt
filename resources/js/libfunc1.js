/*$(document).ajaxStart(function(){
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
}); */

const loadIndicator = $('<div>').dxLoadIndicator({ visible: false }); 
//preloader

$(function(){
	setTimeout(function(){
		$('body').addClass('loaded'); 
	}, 1000);
});


$(document).on('click', '.refresh', function(){
  var elm = $(this).data('refreshx');
  refreshTablex($('#'+elm));
})


function refreshTablex(tablex, deselect = true){
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
      // var color = '#3A87AD';
      var color = '#000000';
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
    text: text,
    //timer: timer,
    timerProgressBar: true,
    showConfirmButton: true,
  })

}else{

  Swal.fire({
    icon: type,
    title: title,
    text: text,
    timer: timer,
    timerProgressBar: true,
    showConfirmButton: confirm,
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
    html: msg,
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
  function CheckExtensionDOCIMGPDF(file) {
      /*global document: false */
      var validFilesTypes = ["xlxs", "xlx", "docx", "doc", "csv", "jpg", "jpeg", "png", "pdf"];
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
      target.find('.spinnerx').show();
      target.find('.btnttl').html(text);
      target.find('.btnload').prop('disabled', true);
      target.find('.form-control').prop('disabled', true);    
  } else {
    target.find('.spinnerx').hide();
    target.find('.btnttl').html(text);
    target.find('.btnload').prop('disabled', false);
    target.find('.form-control').prop('disabled', false);    
  }
}

function btnLoading(target, isload){
  if(isload){
    $(target).find('.indicator-label').parent().attr('data-kt-indicator', 'on').prop('disabled', true);
  } else {
    $(target).find('.indicator-label').parent().removeAttr('data-kt-indicator').prop('disabled', false);
  }
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

function loadPanel1(target, show){
  var loadPanel = $('#devxloadpanel').dxLoadPanel({
      shadingColor: 'rgba(0,0,0,0.2)',
      position: {
          of: target
      },
      visible: false,
      showIndicator: true,
      showPane: true,
      shading: true,
      closeOnOutsideClick: false,
      onShown() {
          // setTimeout(() => {
          //     loadPanel.hide();
          // }, 3000);
      },
      onHidden() {
          // showEmployeeInfo(employee);
      },
  }).dxLoadPanel('instance');

  if(show){
    loadPanel.show()
  } else {
    loadPanel.hide();
  }

}

function loadPanel(target, show, msg = 'Loading...'){
  
  try {
      if (show) {
          $(target).dxDataGrid('instance').beginCustomLoading(msg);
      } else {
          $(target).dxDataGrid('instance').endCustomLoading();
      }
  } catch (e) {}


}


function bs5showTab(element){
  var triggerFirstTabEl = document.querySelector(element)
  bootstrap.Tab.getOrCreateInstance(triggerFirstTabEl).show();
}

//fungsi agar scrolling multiple modal tetap ada
$("#modal-file").on('hidden.bs.modal', function (event) {
if ($('.modal:visible').length) //check if any modal is open
{
  $('body').addClass('modal-open');//add class to body
}
});

