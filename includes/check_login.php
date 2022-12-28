<?php

if (!$session->is_logged_in()) {
    redirect_to("login.php?redirect_to=" . basename(filter_input(INPUT_SERVER, "SCRIPT_FILENAME")));
}

if(WHITELIST){
    if (!in_array(filter_input(INPUT_SERVER, 'REMOTE_ADDR'), WHITELIST)) {
        redirect_to("access_denied.php");
    }
}