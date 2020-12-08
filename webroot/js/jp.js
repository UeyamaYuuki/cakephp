
function save ()
{
    var ip = document.getElementById( "ipAdress" );
    var ip = ipAdress.textContent;

    $.ajax( {
        url: "/save",
        type: "POST",
        dataType: "json",
        data: {
            ip: ip  
        }
    } )
} 