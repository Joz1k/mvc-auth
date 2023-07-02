<?php

session_start();

function flash($label = '', $message = '', $class = 'alert alert-success')
{
    if (!empty($label)) {
        if (!empty($message) && empty($_SESSION[$label])) {
            if (!empty($_SESSION[$label])) {
                unset($_SESSION[$label]);
            }

            if (!empty($_SESSION[$label . '_class'])) {
                unset($_SESSION[$label . '_class']);
            }

            $_SESSION[$label] = $message;
            $_SESSION[$label . '_class'] = $class;
        } elseif (empty($message) && !empty($_SESSION[$label])) {
            $class = !empty($_SESSION[$label . '_class']) ? $_SESSION[$label . '_class'] : '';
            echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$label] . '</div>';
            unset($_SESSION[$label]);
            unset($_SESSION[$label . '_class']);
        }
    }
}

function isLoggedIn()
{
    if (isset($_COOKIE['jwt'])) {
        return true;
    } else {
        return false;
    }
}
