
/**
 * load output of PHP file into a HTML element
 * @param  {string} link - URL or path name of PHP script
 * @param  {string} element - HTML element to load content into
 * @param  {array}  data - data to pass to PHP script
 * @param  {string} testID - ID of test
 * @return {boolean} load PHP output into HTML element
 */
function load_php_file(link, element, data) {
    return $.ajax({
        url: link,
        method: "POST",
        data: data,
        success: function(data) {
              console.log(data)
              $(element).html(data);
              return true;        
        }, 
        error: function(data) {
           console.log(data);
           return false;
        }
    })

}

/* INDEX */

function create_new() {
    window.location.href = "createGame.php";
}

function join() {
    window.location.href = "join.php";
}

/* CREATE GAME */

function add_myself() {
    name = $('#name').val()
    code = $('#code').html()
    if (name != null && name != "") {
        load_php_file('src/joinGame.php',null,{code: code, name: name});
        load_php_file('src/getLobby.php','#lobby',{code: code});
    }
}

function start_game() {
    load_php_file('src/startGame.php',null,{code: code});
    //window.open('src/generateQuestions.php', '_blank').focus();

}
