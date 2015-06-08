$( document ).ready(function() {
    console.log( "ready!" );

    // A little bit of trickery to keep the webpage looking nice and running well. I hid the inputs that do the actual work and have two buttons from Bootsrap in their place. When either of the Bootsrap buttons are clicked, an onClick function will "click" the hidden inputs.
    
    $("#fileUploadBtn").click(function(){
        $("#fileChoice").click();
    })

    $("#submitChoiceBtn").click(function(){
        $("#submitChoice").click();
    })

});



    