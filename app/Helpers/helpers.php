<?php

function setAlert($type, $message)
{
    Session::flash('alert', ['type' => $type, 'message' => $message]);
}
