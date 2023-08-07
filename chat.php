<?php
session_start();
if (isset($_GET['logout'])) { //Exit session
    session_destroy();
    header("Location: view-roomie.php"); //Redirect the user 
}
if (isset($_POST['enter'])) { //Joins chat
    if ($_POST['name'] != "") {
        $_SESSION['name'] = stripslashes(htmlspecialchars($_POST['name'])); //Textbox to enter a display name
    } else {
        echo '<span class="error">Please type in a name</span>';
    }
}
/**
 * Prompts the enter name box
 */
function loginForm()
{
    echo '<div id="loginform">  
            <p>Please enter your name to continue!</p> 
            <form action="chat.php" method="post"> 
                <label for="name">Name &mdash;</label> 
                <input type="text" name="name" id="name" /> 
                <input type="submit" name="enter" id="enter" value="Enter" /> 
            </form> 
        </div>';
}
?>
<?php require "includes/chat-header.php"; ?>

<body class="bg-primary-subtle">
    <?php
    if (!isset($_SESSION['name'])) { //if no name enter stay in the same page, otherwise redirect to the chat box
        loginForm();
    } else {
        ?>
        <div class=" bg-primary-subtle " id=" wrapper">
            <div id="menu">
                <p class="welcome fw-bold">Welcome, <b>
                        <?php echo $_SESSION['name']; ?>
                    </b></p>
                <p class="btn btn-danger btn-sm"><a id="exit" href="#">Exit Chat</a></p>
            </div>
            <div id="chatbox">
                <?php
                if (file_exists("log.html") && filesize("log.html") > 0) {
                    $contents = file_get_contents("log.html");
                    echo $contents;
                }
                ?>
            </div>
            <form name="message" action="">
                <input name="usermsg" type="text" id="usermsg" />
                <input name="submitmsg" type="submit" id="submitmsg" value="Send" />
            </form>
        </div>

        <?php require "includes/footer.php"; ?>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#submitmsg").click(function () {
                    var clientmsg = $("#usermsg").val();
                    $.post("post_chat.php", { text: clientmsg });
                    $("#usermsg").val("");
                    return false;
                });
                function loadLog() {
                    var oldscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height before the request 
                    $.ajax({
                        url: "log.html",
                        cache: false,
                        success: function (html) {
                            $("#chatbox").html(html);
                            //Auto-scroll 
                            var newscrollHeight = $("#chatbox")[0].scrollHeight - 20;
                            if (newscrollHeight > oldscrollHeight) {
                                $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div 
                            }
                        }
                    });
                }
                setInterval(loadLog, 2500);
                $("#exit").click(function () {
                    var exit = confirm("Are you sure you want to end the session?"); //exit session
                    if (exit == true) {
                        window.location = "view-roomie.php?logout=true";
                    }
                });
            });
        </script>
        <?php
    }
    ?>