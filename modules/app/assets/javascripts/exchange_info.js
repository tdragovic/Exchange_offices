$(document).ready(function(){

	$("#edit_profile").click(function(){
	    $("#info").hide();
   		$("#form1").show();
  });


  $("#currency_save").click(function(){
  		$("#currency_form1").hide();
   		$("#currency_form2").show();
  });

	$("#currency_edit").click(function(){
	    $("#currency_form2").hide();
   		$("#currency_form1").show();
  });
  $("#currency_edit3").click(function(){
      $("#currency_form3").hide();
      $("#currency_form1").show();
  });
  var i=1;
  $('#btn-location').click(function(){
    	
    	
    	$('#add_location').append("<div class='input-group my-3' id='loc"+i+"'><input type='text' id='location"+i+"' name='location"+i+"' placeholder='Lokacija menjacnice' class='form-control mr-4'><input type='button' id='"+i+"' class=' btn remove btn-danger' value='X'></div>");
    	i++;

  });

  $(document).on('click','.remove', function(){
    	
		var button_id = $(this).attr("id");
		$("#loc"+button_id+"").remove();
    	$("#location"+button_id+"").remove();
    	$("#"+button_id+"").remove();
    	
  });
  var i=1;

	$('#btn-phone').click(function(){
    	
    	$('#add_phone').append("<input type='text' id='phonep"+i+"' name='phonep"+i+"' placeholder='Broj telefona' class='form-control m-1 w-75'><input type='button' id='p"+i+"' class='btn remove-phone' value='X'>");
    	i++;

  });

  $(document).on('click','.remove-phone', function(){
    	
    	var button = $(this).attr("id");
    	$("#phone"+button+"").remove();
    	$("#"+button+"").remove();
    	
  });
  $('#btn-email').click(function(){
    	
    	var i=1;
    	$('#add_email').append("<input type='email' id='emailm"+i+"' name='emailm"+i+"' placeholder='E-mail' class='form-control m-1 w-75'><input type='button' id='m"+i+"' class='btn remove-email' value='X'>");
    	i++;

  });

  $(document).on('click','.remove-email', function(){
    	
    	var button2 = $(this).attr("id");
    	$("#email"+button2+"").remove();
    	$("#"+button2+"").remove();
    	
  });

 $("#show_desc").click(function(){
    $("#description").slideToggle("slow");
      
  });
  $(document).change('#xml_input', function(){
      
    if($('#xml_input').val() != '') {
      $('.file_button').css('display', 'block');
      $('.file_choose').css('display', 'none');
    } 
      
  });

});