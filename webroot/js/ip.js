
function saveIp ()
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
};
function deleteIp ( id )
{
    console.log( id );

    $.ajax( {
        url: "/delete",
        type: "POST",
        dataType: "json",
        data: {
            id: id
        }
    } )
}