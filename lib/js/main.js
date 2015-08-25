function updateAmountStudents() {
    $.ajax({
            type: "GET"/*,
             dataType: "json"*/,
            url: "../ajax/update_amount_students.php", //Relative or absolute path to response.php file
            //data: null,
            success: function (dat) {
                var data = JSON.parse(dat);
                $("#all_students")[0].innerHTML=data.allStudents;
                $("#total_amount")[0].innerHTML=data.totalAmount;


            }
        });

}
function loadStudent () {
        var idt = $(this).attr('student_id');
        var data = {
            id: idt
        };
        /***
         * TODO:load student script error after a search result
         */

        // data = $(this).serialize() + "&" + $.param(data);
        $.ajax({
            type: "POST"/*,
             dataType: "json"*/,
            url: "../ajax/load_student.php", //Relative or absolute path to response.php file
            data: data,
            success: function (dat) {
                var data = JSON.parse(dat);
                $(".the-return").html(
                        "<span class=\"white-text\"> First Name: " + data["first_name"] + "</span><br />" +
                        "<span class=\"white-text\">Last Name: " + data["last_name"] + "</span><br />" +
                        "<span class=\"white-text\">Form: " + data["school_form"] + "</span><br />" +
                        "<span class=\"white-text\">amount: " + data["amount"] + "</span>" +
                        "<span class=\"white-text hide\" id=\"st_id\" student_id=\"" + data["id"] + "\"></span>"+

                    "<span class=\"white-text right logout-st\"> Log Out</span><br />"

                );
                $(".current_student_name").html(data["first_name"]+' '+data["last_name"]);

            }
        });

    }
function logoutStudent(){
     var idt = $(this).attr('student_id');
        var data = {
            id: idt
        };

        // data = $(this).serialize() + "&" + $.param(data);
        $.ajax({
            type: "POST"/*,
             dataType: "json"*/,
            url: "../ajax/unload_student.php", //Relative or absolute path to response.php file
            data: data,
            success: function (dat) {
                var data = JSON.parse(dat);

                $(".the-return").html(
                        "<span class=\"white-text\"> First Name: " + data["first_name"] + "</span><br />" +
                        "<span class=\"white-text\">Last Name: " + data["last_name"] + "</span><br />" +
                        "<span class=\"white-text\">Form: " + data["school_form"] + "</span><br />" +
                        "<span class=\"white-text\">amount: " + data["amount"] + "</span>" +
                        "<span class=\"white-text hide\" id=\"st_id\" student_id=\"" + data["id"] + "\"></span>"+

                    "<span class=\"white-text right logout-st\"> Log Out</span><br />"

                );
                $(".current_student_name").html(data["first_name"]+' '+data["last_name"]);

            }
        });

}
function search () {
       /* $('li').on('click',function(){

       $('li').removeClass('active');
        $(".srh").addClass('active');

        $(".srh").siblings('.collapsible-body').stop(true,false).slideDown({
            duration: 350,
            easing: "easeOutQuart",
            queue: false,
            complete: function() {
                $(this).css('height', '');
            }
        });*/



        /**
         * Todo:clear the collection  div and append it to search result pane
         */
        //var col='<div class="collection search-result"></div>';
            $(".collection").empty();



        var idt = $("#search-field")[0].value;

        if(idt.trim()==''){
            var $toastContent = 'Enter a student full name or username';
            Materialize.toast($toastContent, 3000, '', function () {
                //calback

            });
            return;
        }
        var data;


        nameArray=idt.trim().split(' ');
        if(nameArray.length>1){
         data = {
            first_name: nameArray[0],
            last_name:nameArray[1]
        };
        }else{
          data = {
            username: nameArray[0]
        };

        }
        // data = $(this).serialize() + "&" + $.param(data);
        $.ajax({
            type: "POST"/*,
             dataType: "json"*/,
            url: "../ajax/search.php", //Relative or absolute path to response.php file
            data: data,
            success: function (dat) {
                 var data = JSON.parse(dat);




                data.forEach(function(dt){
                   console.log(dt);

                    $(".collection").append(

                '<div class="collection-item" student_id="'+dt[0]+'" style="cursor: pointer;">'+
                    '<span href="#!">'+dt[1]+' '+dt[2]+'</span>'+
                    '<span>'+dt[3]+'</span> Shillings Form <span>'+dt[4]+'</span>'+

                '</div>'

                    );
                    $(".collection-item").bind("click",loadStudent);

                    /**
                     * Todo:Append the search result items
                     * FIXME:
                     */
                });



            }
        });
        return false;

    }

function trPane(e) {
   // console.log('activating card revel');

     $('.card-reveal-an').css({display: 'block'}).velocity("stop", false).velocity(
         {translateY: '-100%'},
         {duration: 300, queue: false, easing: 'easeInOutQuad'}
     );
    return false;
    }

$("document").ready(function () {

    //card revel for transaction

    $(document).on('click.card', '.card', function (e) {
        if ($(this).find('.card-reveal-tr').length) {
            if ($(e.target).is($('.card-reveal-tr .card-title')) || $(e.target).is($('.card-reveal-tr .card-title i'))) {
                // Make Reveal animate down and display none
                $(this).find('.card-reveal-tr').velocity(
                    {translateY: 0}, {
                        duration: 225,
                        queue: false,
                        easing: 'easeInOutQuad',
                        complete: function () {
                            $(this).css({ display: 'none'});
                        }
                    }
                );
            }
            else if ($(e.target).is($('.card .activator-tr')) ||
                $(e.target).is($('.card .activator-tr i'))) {
                $(this).find('.card-reveal-tr').css({ display: 'block'}).velocity("stop", false).velocity({translateY: '-100%'}, {duration: 300, queue: false, easing: 'easeInOutQuad'});
            }
        }


    });

    //End card revel for transaction
    //card revel for add new
    $(document).on('click.card', '.card', function (e) {
        if ($(this).find('.card-reveal-an').length) {
            if ($(e.target).is($('.card-reveal-an .card-title')) || $(e.target).is($('.card-reveal-an .card-title i'))) {
                // Make Reveal animate down and display none
                $(this).find('.card-reveal-an').velocity(
                    {translateY: 0}, {
                        duration: 225,
                        queue: false,
                        easing: 'easeInOutQuad',
                        complete: function () {
                            $(this).css({ display: 'none'});
                        }
                    }
                );
            }
            else if ($(e.target).is($('.card .activator-an')) ||
                $(e.target).is($('.card .activator-an i'))) {
                $(this).find('.card-reveal-an').css({ display: 'block'}).velocity("stop", false).velocity({translateY: '-100%'}, {duration: 300, queue: false, easing: 'easeInOutQuad'});
            }
        }


    });
    //End card revel for add new
    $("#transact").on("click", function () {
        var tr_state = $("#tr_type")[0].value;
        var id = $("#st_id").attr('student_id');
        var tr_amount = $("#amount")[0].value;
        /*var tr_validate=$("")[0].value;
        var tr_reason=$("")[0].value;
        var tr_sendEmail=$("")[0].value;*/
        /**
         * TODO:display  textarea when checkbox clicked
         */



        $("#amount")[0].value = '';
        if (tr_amount == '') {
            tr_amount = 0;
        }
        console.log(tr_amount);
        /**
         * 1-Withdraw
         * 2-Recharge
         *TODO: add all tr input fields
         */

        switch (tr_state) {
            case "1":
                //$.get("ajax/transaction.php?");
                $.ajax({
                    type: "POST",
                    url: '../ajax/withdraw.php',
                    data: {withd_amount: tr_amount, id: id},
                    success: function (data) {
                        // $( ".result" ).html( data );
                        var $toastContent = data;
                        updateAmountStudents();
                        Materialize.toast($toastContent, 3000, '', function () {
                            //calback

                        });

                    }
                });
                break;
            case "2":
                //$.get();
                $.ajax({
                    type: "POST",
                    url: '../ajax/recharge.php',
                    data: {recharge_amount: tr_amount, id: id },
                    success: function (data) {
                        //$( ".result" ).html( data );
                        var $toastContent = data;
                        updateAmountStudents();
                        Materialize.toast($toastContent, 3000, '', function () {
                            //calback

                        });

                    }
                });


                break;
            default:
                var $toastContent = 'Please Select a transaction Type';
                Materialize.toast($toastContent, 3000, '', function () {
                    //calback

                });


        }

    });
    /**
     * TODO :add email field
     *
     */

    $("#add").on("click", function () {
        console.log('Click');
        var studentData = {
            first_name: $("#first_name")[0].value,
            last_name: $("#last_name")[0].value,
            username: $("#username")[0].value,
            password: $("#password")[0].value,
            email: $("#email")[0].value,
            school_level: $("#s_form")[0].value,
            amount: $("#amount_in")[0].value

        };
        /**
         * TODO:validate form data
         *
         */
        $.post("../ajax/new_student.php", studentData, function (data) {

            if (true) {
                //success
                updateAmountStudents();
                var $toastContent = data;
                Materialize.toast($toastContent, 2000, '', function () {
                    //calback

                });

            } else {
                //failure
                var $toastContent = 'Could not Add student at this time';
                Materialize.toast($toastContent, 2000, '', function () {
                    //calback

                });
            }
        });
    });

    $(".sign_in").submit(function () {
        var username = $("#c_name")[0].value;
        var password = $("#c_pass")[0].value;

        var data = {
            student_name: username,
            student_pass: password
        };

        // data = $(this).serialize() + "&" + $.param(data);
        $.ajax({
            type: "POST"/*,
             dataType: "json"*/,
            url: "../ajax/sign_in_student.php", //Relative or absolute path to response.php file
            data: data,
            success: function (dat) {
                var data = JSON.parse(dat);
                $(".the-return").html(
                        "<span class=\"white-text\"> First Name: " + data["first_name"] + "</span><br />" +
                        "<span class=\"white-text\">Last Name: " + data["last_name"] + "</span><br />" +
                        "<span class=\"white-text\">Form: " + data["school_form"] + "</span><br />" +
                        "<span class=\"white-text\">amount: " + data["amount"] + "</span>" +
                        "<span class=\"white-text hide\" id=\"st_id\" student_id=\"" + data["id"] + "\"></span>"
                );
                //data["first_name"]+' '+data["last_name"]
                $(".current_student_name").html(data["first_name"]+' '+data["last_name"]);




            }
        });
        return false;
    });
    $(".collection-item").on("click",loadStudent );
    $(".addst_link").on("click",trPane );

    $("#search").submit( search);


});
