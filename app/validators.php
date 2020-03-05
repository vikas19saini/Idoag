<?php
Validator::extend('alpha_spaces', function($attribute, $value)
{
    return preg_match('/^[\pL\s]+$/u', $value);
});

Validator::extend('phone', function($attribute, $value)
{
    return preg_match('/^([0-9\s\-\+\(\)]*)$/', $value);
});
