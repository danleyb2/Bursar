$("document").ready(function(){
$(".del_stu").on("click",function(){
		var stId=$(this).attr('id');
		console.log(stId);
		$.post("../ajax/delete_st.php", {id:stId}, function(data){
			console.log('Response :'+data);
			if (data==1){
				 //success
			    var $toastContent = 'Student Delete';
			    Materialize.toast($toastContent, 2000,'',function(){
			        //calback
			    	$( "#"+stId ).parent().remove();


			    });
			}else{
				var $toastContent = 'Could not delete at this time';
			    Materialize.toast($toastContent, 3000,'',function(){
			        //calback

			    });
			}

		});
	});
	//End del student
$( "div.collection-item" ).on({
  click: function() {
    $( this ).toggleClass( "active" );
  }, mouseenter: function() {
    $( this ).addClass( "active" );
  }, mouseleave: function() {
    $( this ).removeClass( "active" );
  }
});

});