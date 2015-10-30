/*-----------------------------------------------------*/
/*      _____           _               ___   ___      */
/*     |  __ \         | |             |__ \ / _ \     */
/*     | |__) |___  ___| |_ _   _ ___     ) | (_) |    */
/*     |  _  // _ \/ __| __| | | / __|   / / \__, |    */
/*     | | \ \  __/ (__| |_| |_| \__ \  / /_   / /     */
/*     |_|  \_\___|\___|\__|\__,_|___/ |____| /_/      */
/*                                                     */
/*                Date: 04/10/2015 17:41               */
/*                 All right reserved                  */
/*-----------------------------------------------------*/

function boxOpen() {
    $(body).append(
        '<div id="box" class="row">' +
        '<div id="boxHeader" class="row">' +
        '<a href="#" id="boxClose" class="pull-right"><i class="fa fa-close "></i></a>' +
        '</div>' +
        '<div id="boxContent"></div>' +
        '</div>');
}


function boxOpen(content) {
    $('body').append(
        '<div id="box" class="row" >' +
        '<div id="boxHeader" class="row" >' +
        '<a href="#" id="boxClose" class="pull-right"><i class="fa fa-close"></i></a>' +
        '</div>' +
        '<div id="boxContent">' + content + '</div>' +
        '</div>');


}


$(document).on('click', '#signupForm input[type="submit"]', function(e){
    e.preventDefault();
    var requiredFree = true;
    $('input.required').each(function(){
        if($(this).val() == null || $(this).val().length < 1){
            $(this).css('background', '#FFD5D5');
            requiredFree = false;
        }
    });
    if(requiredFree){
        $($(this).parents('form')[0]).submit();
    }
});