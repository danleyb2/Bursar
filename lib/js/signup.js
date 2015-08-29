   function validate(form){
	   input=form.getElementsByTagName("input");
	   for(var i=0;i<input.length;i++){

		   if(input[i].value.trim()==''){
		   $toastContent='Please fill out all input fields';
           Materialize.toast($toastContent, 3000, '', function () {
               //calback

           });
		   return false;
		   }
	   }
       return true;


   }



$(document).ready(function(){
   $(".signup-sc-form").submit();



});