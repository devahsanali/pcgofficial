<script>
	function option_template(id, val, count){
        if(count == 0){
           return "<option selected='selected' value='"+id+"'>"+val+"</option>"; 
        }else if(id == 0){
           return "<option value=''>"+val+"</option>"; 
        }
      return "<option value='"+id+"'>"+val+"</option>"; 
    }
    function iterate_option_template(data,id){
      var list = "";
      if(data.length < 1){
         list += option_template(0, "Type not found", 1);
      }else{
        for(var i=0; i<data.length; i++){
           list += option_template(data[i]['id'], data[i]['title'], i);
        }
      }
      $(id).html(list);
    }
</script>