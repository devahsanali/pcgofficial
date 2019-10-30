//datepicker
$('.autoclose-datepicker').datepicker({
	autoclose: true,
	todayHighlight: true,
	format: 'yyyy-mm-dd',

});

//switch button
 var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
  $('.js-switch').each(function() {
        new Switchery($(this)[0], $(this).data());
   });
//note editor
$('.summernoteEditor').summernote({
    height: 100,
    tabsize: 2
});