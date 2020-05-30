











// *************************
//
//   Tooltips
//
//**************************

$(document).ready(function(){

    $('[data-toggle="tooltip"]').tooltip();

});





// *************************
//
//    Styling The Menu Bar
//        For Mobile
//
//
//**************************
$(document).ready(function (){
    let currentwindowwidth = $( window ).width();


// window starts at mobile possition
    if(currentwindowwidth < 780 ){



        $( "#logodiv,#serchdiv,#menudiv,#serchform" ).addClass('d-flex justify-content-center');
        $( "#serchform" ).attr('style','width:100%;');
        $( "#serchform" ).append( '<button type="submit" class="btn btn-danger" style="margin-left: 5px;" >Search!</button>' );

    }



    $( window ).resize(function() {

        let windowsize = $( window ).width();


        if(windowsize < 863 ){
            $( "#logodiv,#serchdiv,#menudiv,#serchform" ).addClass('d-flex justify-content-center');
            $( "#serchform" ).attr('style','width:100%;');

        }


    });





})








