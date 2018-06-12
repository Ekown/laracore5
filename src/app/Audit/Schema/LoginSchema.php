<?php

namespace Ekown\Laracore5\App\Audit\Schema;

class LoginSchema
{
    const LOGIN_FORM_SUBMIT = [
        'name' => 'Login.FormSubmit',
        'message' => 'A login form was submitted'
    ];

    const LOGIN_FORM_DISPLAYED = [
        'name' => 'Login.Form.Displayed',
        'message' => 'A login form was displayed'
    ];

    const LOGIN_RETRIEVE_DETAILS_SUCCESS = [
        'name' => 'Login.RetrieveDetails.Success',
        'message' => 'User credentials retrieved'
    ];
}