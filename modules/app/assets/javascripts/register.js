$(document).ready(function(){

	$("#details1").click(function(){
	    $("#more_details1").slideToggle('slow');
   		
  	});
  	$("#details2").click(function(){
	    $("#more_details2").slideToggle('slow');
   		
  	});
  	$("#details3").click(function(){
	    $("#more_details3").slideToggle('slow');
	    $("#arrow3down").hide();
	    $("#arrow3up").show();
   		
  	});
  	$("#next").click(function(e){
  		
	    $("#step1").hide('slow');
	    $("#step2").show('slow');
   		
  	});
  	$("#next2").click(function(e){
  		
	    $("#step2").hide('slow');
	    $("#step3").show('slow');
   		
  	});
  	$(".card").click(function(){
  		$('#next').removeAttr('disabled');
  	});
  	$("#card2").click(function(){
  		$(".package").removeAttr('checked');
  		$("#package2").attr('checked', true);
  		
  	});
  	$("#card3").click(function(){
  		$(".package").removeAttr('checked');
  		$("#package3").attr('checked', true);
  		
  	});
  	$("#card1").click(function(){
  		$(".package").removeAttr('checked');
  		$("#package1").attr('checked', true);
  		
	  });
	  /*$('.card').click(function(event) {
        var result = $('#form_reg input[type=radio]:checked').val();
        $('#ispis').html(result);
    });*/
});