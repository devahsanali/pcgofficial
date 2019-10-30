<script>
  //<-------Dropzone------------->//
Dropzone.options.dropzone = {
    addRemoveLinks: true,
    acceptedFiles: "image/jpeg,image/png,image/gif",        
    renameFile: function (file) {
      let newName = new Date().getTime() + '_' + file.name;
      return newName;
    },
     init: function() {
         
         thisDropzone = this;
        
        if(findImage != ''){
            $.each(images, function(key,value){
                var mockFile = { name: 'Uploaded', size: 15, 'upload':{'filename' : value} };
                thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                thisDropzone.options.thumbnail.call(thisDropzone, mockFile, image_path+value);
                thisDropzone.emit("complete", mockFile);
            });
        }
        this.on("success", function (file, responseText) {
              document.getElementById('fileName').value += responseText+"~~";
              file.name = responseText;
               
        });
        this.on("reset", function() {
         if(document.getElementById('fileName').value != ''){
            $('#dropzone').addClass("dz-started");
            }
        });


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
 
};

 //edit product
    $('#form-update').validate({
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
            if($.trim($('#description').summernote('code')) == ""){
                $('#fail').show();
                $('#fail-text').html('<strong>Required!</strong> Please fill description field');
                $('.back-to-top').click();
                return false;
            }
            if($("#fileName").val() == ""){
                $('#fail').show();
                $('#fail-text').html('<strong>Required!</strong> Please upload images');
                $('.back-to-top').click();
                return false;
            }
            $(".update").html("Processing...");
            $(".update").prop('disabled', true);
            var values = $(form).serializeArray();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.tournament.update')}}",
                type: "post",
                data: values,
                success: function(data) {
                    if (data == 'success') {
                        var myDropzone = Dropzone.forElement("#dropzone");
                        myDropzone.element.classList.remove("dz-started");
                        $('#dropzone').trigger("reset");
                        $( ".dz-image-preview" ).remove();
                        $('#product-update').trigger("reset");
                        $('#success').show();
                        $('#success-text').html('<strong>Success!</strong> Record has been updated.');
                        $('.back-to-top').click();
                        $(".update").html("update");
                        $(".update").prop('disabled', false);
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

</script>