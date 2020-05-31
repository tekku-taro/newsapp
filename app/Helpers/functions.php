<?php
use Illuminate\Support\Facades\Session;

function setOld($key, $value)
{
    Session::flash('_old_input', [$key => $value]);
}
