// jQuery Document

$(document).ready(function () {
    //If user wants to end session

    $("#exit").click(function () {
        var exit = confirm("Are you sure you want to end the session?");
        if (exit == true) {
            window.location = 'index.php?logout=true';
        }
        usleep(1000);
        header("Refresh:0");

    });

    //If user submits the form
    $("#submitmsg").click(function () {
        var clientmsg = $("#usermsg").val();
        console.log(clientmsg);
        $.post("index.php", { newmsg: clientmsg });
        $("#usermsg").attr("value", "");
        return false;
    });

    //Load the file containing the chat log
    function loadLog() {
        var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
        $.ajax({
            url: "log.html",
            cache: false,
            success: function (html) {
                $("#chatbox").html(html); //Insert chat log into the #chatbox div	
                //Auto-scroll			
                var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
                if (newscrollHeight > oldscrollHeight) {
                    $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                }
            },
        });
    }
    setInterval(loadLog, 1000);	//Reload file every 2500 ms
});
