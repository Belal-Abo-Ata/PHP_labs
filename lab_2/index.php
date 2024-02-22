
<?php
  include_once('./vendor/autoload.php');

$view = isset($_GET["view"]) ? $_GET["view"] : DEFAULT_VIEW;

if ($view == "add") {

    $valid_email = true;
    $valid_name = true;
    $valid_message = true;
    $name_pattern = '/^[a-zA-Z ]+$/';


    // if the submit button pressed and the method is POST
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        foreach ($_POST as $key => $value) {
            switch ($key) {
                case "name":
                    if (!preg_match($name_pattern, $value) || strlen($value) > MAX_NAME_LENGTH) {
                        echo "<center><h2> The name is not valid </h2></center>";
                        $valid_name = false;
                    }
                    break;

                case "email":
                    $valid_email = filter_input(INPUT_POST, $key, FILTER_VALIDATE_EMAIL);
                    if (!$valid_email) {
                        echo "<center><h2> The email is not valid </h2></center>";
                        $valid_email = false;
                    }
                    break;

                case "message":
                    if (empty($value) || strlen($value) > MAX_MESSAGE_LENGTH) {
                        echo "<center><h2> The message is not valid </h2></center>";
                        $valid_message = false;
                    }
                    break;
            }
        }

        // if the name and email are valid
        if ($valid_name && $valid_email && $valid_message) {
            echo "<center> <h1> Thanks for submitting </h1> </center>";
            // echo "<h2> Your name is: " . $_POST["name"] . "</h2>";
            // echo "<h2> Your email is: " . $_POST["email"] . "</h2>";
            // echo "<h2> Your message is: " . $_POST["message"] . "</h2>";
            if(store_in_file(SUBMIT_FILE, $_POST["name"], $_POST["email"])) {
                echo_in_tag("Data store successfully.", "center", "h3");
            } else {
                echo_in_tag("There is an error while storing the data", "center", "h3");
            }
            die("if you want to go to the display page <a href='index.php?view=display'>Click here</a> to go back <a href='index.php?view=add'>Click here</a>");
        }
    }

} else {
    if (file_exists(SUBMIT_FILE)) {
        echo_in_tag("Users Details", "center", "h1");
        display_from_file(SUBMIT_FILE);
        die("if you want to go to the form page <a href='index.php?view=add'>Click here</a>");
    } else {
        die("Can't reach the file");
    }
}

?>


<html>
    <head>
        <title> contact form </title>
    </head>

    <body>
        <h3> Contact Form </h3>
        <div id="after_submit">
        </div>
        <form id="contact_form" action="index.php?view=add" method="POST" enctype="multipart/form-data">

            <div class="row">
                <label class="required" for="name">Your name:</label><br />
                <input id="name" class="input" name="name" type="text" value="<?php echo $_POST["name"]; ?>" size="30" /><br />
            </div>
            <div class="row">
                <label class="required" for="email">Your email:</label><br />
                <input id="email" class="input" name="email" type="text" value="<?php echo $_POST["email"]; ?>" size="30" /><br />

            </div>
            <div class="row">
                <label class="required" for="message">Your message:</label><br />
                <textarea id="message" class="input" name="message" rows="7" cols="30"></textarea><br />

            </div>

            <input id="submit" name="submit" type="submit" value="Send email" />
            <input id="clear" name="clear" type="reset" value="clear form" />

        </form>
    </body>

</html>
