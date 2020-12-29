
function saveIp ()
{
    var ip = document.getElementById( "ipAdress" );
    var comment = updateText = $( `#comment` ).val();
    var ip = ipAdress.textContent;

    $.ajax( {
        url: "/save",
        type: "POST",
        data: {
            ip: ip,
            comment: comment
        }
    } ).done( function ( data, status, jqXHR )
    {

    } ).fail( function ( jqXHR, status, error )
    {
        // 失敗時の処理
    } );
}
function deleteIp ( id )
{

    $.ajax( {
        url: "/delete",
        type: "POST",
        dataType: "json",
        data: {
            id: id
        }
    } )
}
function editIp(id)
 {
    $( `#ip${ id }` ).show();
    $( `#text${ id }` ).show();
    $( `#updateIp${ id }` ).show();
    $( `#comment${ id }` ).show();
}
function updateIp ( id )
{
    updateIp = $( `#ip${ id }` ).val();
    updateName = $( `#text${ id }` ).val();
    updateText = $( `#comment${ id }` ).val();

    $.ajax( {
        url: "/update",
        type: "POST",
        dataType: "json",
        data: {
            id: id,
            updateIp: updateIp,
            updateName: updateName,
            updateText: updateText
        }
    } );
}