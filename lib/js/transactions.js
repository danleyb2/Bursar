$("document").ready(function(){
$(".del_tr").on("click",function(){
		var trId=$(this).attr('id');
		console.log(trId);
		$.post("../ajax/delete_tr.php", {id:trId}, function(data){
			console.log('Response :'+data);
			if (data==1){
				 //success
                $( "#"+trId ).parent().remove();
			    var $toastContent = 'Transaction Info Delete';
			    Materialize.toast($toastContent, 2000,'',function(){
			        //calback

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