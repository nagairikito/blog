<?php

function sessionDelete($key) {
    if( isset($_SESSION[$key]) ) {
        unset($_SESSION[$key]);
    }
}
