<?php

namespace Ekown\Laracore5\App\Audit\Schema;

class LoginSchema
{
    const LOGIN_FORM_SUBMIT = [
        'name' => 'Login.Form.Submit',
        'message' => 'A login form was submitted'
    ];

    const LOGIN_FORM_DISPLAYED = [
        'name' => 'Login.Form.Displayed',
        'message' => 'A login form was displayed'
    ];

    const LOGIN_FORM_CREATED = [
        'name' => 'Login.Form.Created',
        'message' => 'A login form was created'
    ];

    const LOGIN_RETRIEVE_DETAILS_SUCCESS = [
        'name' => 'Login.RetrieveDetails.Success',
        'message' => 'Login credentials retrieved'
    ];

    const LOGIN_RETRIEVE_DETAILS_FAILED = [
        'name' => 'Login.RetrieveDetails.Failed',
        'message' => 'Failed to retrieve login credentials'
    ];

    const LOGIN_SUCCESS = [
        'name' => 'Login.Success',
        'message' => 'Login was successful'
    ];

    const LOGIN_FAILED = [
        'name' => 'Login.Failed',
        'message' => 'Failed to login'
    ];
}