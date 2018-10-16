$(document).ready(function(){
    $('#brand_section').hide();
    var result;
    $('#brand').on('change',function(){
        var res = '';
        var brand = $.trim($(this).val());
        if(brand.length > 0){
            $.get('ajax.php',{'brandID': brand},function(data){
                result = $.parseJSON(data);
                res = '<option value="">Select Model</option>';
                for(var i=0; i<result.length;i++){
                    res +='<option value="'+result[i]['ID']+'" attr="'+result[i]['modelName']+'">'+result[i]['modelName']+'</option>';
                }
                $('#model').html(res);
                $('#brand_section').show();
            });
        }else{
            alert("Please Select Brand");
        }
        $('#selected_model').html('');
        $('#res_image').html('');
    });


    $('#model').on('change',function(){
        var model = $.trim($(this).val());
        for(var i=0; i<result.length;i++){
            if(result[i]['ID'] == model){
                $('#selected_model').html(result[i]['modelDesc']);
                $('#res_image').html('<img src="app/images/'+result[i]['modelImage']+'" class="img-responsive">');
            }
        }
    });
});