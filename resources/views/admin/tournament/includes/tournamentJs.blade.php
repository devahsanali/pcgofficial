<script>
 /*product create*/
    $('#form-create').validate({
        rules: {
            title: {
                required: true,
                maxlength: 250
            },
            type_id: {
                required: true,
            },
            platform: {
                required: true
            },
            start_date: {
                required: true
            },
            end_date: {
                required: true
            },
            entry_charges: {
                required: true,
                digits: true
            },
            no_of_teams:{
                required:{
                  depends: function(element){
                   var status = false;
                   if($('#type_id').val() == 2){
                       var status = true;
                   }
                   return status;
                 }
                },
                digits: true
            },
            no_of_players:{
                required: true,
                digits: true
            },
            awarding_price:{
                required: true,
                digits: true
            },
            description:{
                required: true
            }
        },
        highlight: function(element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
        },
        submitHandler: function(form) {
            event.preventDefault();
            if($("#fileName").val() == ""){
                $('#fail').show();
                $('#fail-text').html('<strong>Required!</strong> Please upload images');
                $('.back-to-top').click();
                return false;
            }
            if($.trim($('#description').summernote('code')) == ""){
                $('#fail').show();
                $('#fail-text').html('<strong>Required!</strong> Please fill description field');
                $('.back-to-top').click();
                return false;
            }
            $(".create").html("Processing...");
            $(".create").prop('disabled', true);
            var values = $(form).serializeArray();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.tournament.post')}}",
                type: "post",
                data: values,
                success: function(data) {
                    if (data == 'success') {
                        var myDropzone = Dropzone.forElement("#dropzone");
                        myDropzone.element.classList.remove("dz-started");
                        $('#dropzone').trigger("reset");
                        $( ".dz-image-preview" ).remove();
                        $('#form-create').trigger("reset");
                        $('#success').show();
                        $('#success-text').html('<strong>Success!</strong> Form has been submitted.');
                        $('.back-to-top').click();
                        $(".create").html("CREATE");
                        $(".create").prop('disabled', false);
                        setTimeout(
                          function() 
                          { 
                           
                            location. reload(true);
                          }, 1000);                       
                    };
                },
                error: function() {
                    alert('There is error while submit');
                }
            });
        },
    });


    //Remove Uploaded File
    Dropzone.options.dropzone = {
      renameFile: function (file) {
        let newName = new Date().getTime() + '_' + file.name;
        return newName;
      },
      maxFiles: 3,
      addRemoveLinks: true,
      acceptedFiles: "image/jpeg,image/png,image/gif",
      accept: function(file, done) {
        done();
      },

      removedfile: function(file) {
        var _ref;
        var name = file.upload.filename;
        var fileList = $('#fileName').val();
        fileList = fileList.replace(name+"~~", "");
        $('#fileName').val(fileList);
      $.ajax({
            type: "get",
            url: "{{route('admin.tournament.remove.image')}}",
            data: { file: name },
            dataType: 'html'
        });
         return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
      },
      init: function() {
        this.on("success", function (file, responseText) {
            document.getElementById('fileName').value += responseText+"~~";
            file.name = responseText;
            console.log(file);
          });
        } 
    };

    //serach header by category
    function item_delete(id){
       if (window.confirm('Do you really want to delete it?')){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                    url: "{{route('admin.tournament.delete')}}",
                    type: "post",
                    data: {
                        id:id
                    },
                    success: function(data) {
                        if (data == 'success') {
                            $('#success').show();
                            $('#success-text').html('<strong>Success!</strong> Record has been deleted.');
                            $('.back-to-top').click();
                            setTimeout(
                              function() 
                              {
                                location. reload(true);
                              }, 1000);                       
                        };
                    },
                    error: function() {
                        alert('There is error while deleting record');
                    }
                }); 
        }
    }
    //toggle team field
    $('#type_id').on('change', function(){
      (this.value == 1) ? $('#team').hide() : $('#team').show();
       $('form.validate').validate().element($('.no_of_teams'));
    });
    //hide team field if not individual selected
    ($('#type_id').val() == 1) ? $('#team').hide() : '';
    //update_status
    function update_status(id) {
        if (window.confirm('Do you really want to change it?')){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                    url: "{{route('admin.tournament.status')}}",
                    type: "post",
                    data: {
                        id:id
                    },
                    success: function(data) {
                        if (data == 'success') {
                            $('#success').show();
                            $('#success-text').html('<strong>Success!</strong> Status has been changed.');
                            $('.back-to-top').click();
                            setTimeout(
                              function() 
                              {
                                location. reload(true);
                              }, 1000);                       
                        };
                    },
                    error: function() {
                        alert('There is error while changing status');
                    }
                }); 
        }
    }

  
</script>