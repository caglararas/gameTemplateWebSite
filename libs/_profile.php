<?php

function isLoggedin() {
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        return true;
    } else {
        return false;
    }
}

function isAdmin() {
    if (isLoggedin() && isset($_SESSION["rol"]) && $_SESSION["rol"] === "admin") {
        return true;
    } else {
        return false;
    }
}

?>