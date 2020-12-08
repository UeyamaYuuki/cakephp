
function save ()
{
    var ipAdress = document.getElementById( "ipAdress" );
    var ipAdress = ipAdress.textContent;

    $.ajax( {
        url: "/save",
        type: "POST",
        dataType: "json",
        data: {
            ipAdress: ipAdress
        }
    } )
} 