<?php

use ahmetbarut\Csrf\Csrf;

/**
 * Yeni Tokeni Döndürür
 *
 * @return void
 */
function create_token()
{
    return (new Csrf)->getToken(); 
}

/**
 * Token için input oluşturur
 *
 * @return void
 */
function csrf_field()
{
    $token = create_token();
    echo <<<csrf
            <input type="hidden" name="_token" value="{$token}">
            csrf;
}