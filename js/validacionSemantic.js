

$(document).ready(function () {

    $("#vigencia_licencia").datepicker({dateFormat: 'yy-mm-dd'});
    $("#fecha_infraccion").datepicker({dateFormat: 'yy-mm-dd'});
    $("#hora_infraccion").clockpicker({
    placement: 'bottom',
    align: 'center',
    donetext: 'Listo'
});
 
    $(".ui.checkbox").checkbox();
    $('.ui.accordion').accordion();

$('.ui.dropdown')
  .form(validationRules, {
    inline : true,
    on     : 'blur'
  })
;
