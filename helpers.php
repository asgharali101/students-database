<?php
$errors = [];

function error($key)
{
    global $errors;
    if (isset($errors[$key])) {
        echo  "<p style='color:red'>" . $errors[$key] . "</p>";
    }
}
function old($key)
{
    echo $_REQUEST[$key] ?? '';
}
