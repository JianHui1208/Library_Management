<?php

// api 接口返回 信息
// status => message
return [
    // 0 -> 500 System Error Code
    '0'                 => "Success",
    '401'               => 'Unauhorized',
    '403'               => '403 Forbidden',

    // 600 -> 699 OTP Controller
    '600'               => 'Successfully get the resource list',
    '664'               => 'OTP Function Not Open',
    '665'               => 'OTP MSG Error',
    '666'               => 'OTP Send Successfully',
    '667'               => 'OTP Resend Successfully',
    '668'               => 'Verification code failed.',
    '669'               => 'Verification code has expired.',
    '670'               => 'User does not exist',
    '671'               => 'Forget Password OTP Send Successfully',
    '672'               => 'PIN mismatch. Please try again',
    '673'               => 'PIN Record Not Found',
    '674'               => 'PIN match',

    // 700 -> 799 Users Controller
    '700'               => 'User Create Successfully',
    '701'               => 'User Not Found',
    '702'               => 'User Information Get Successfully',
    '703'               => 'Email or password is wrong',
    '704'               => 'User Information Update Successfully',
    '705'               => 'User New Password Update Successfully',
    '706'               => 'Old Passowrd Not Match',

    // 800 -> 899 Country Controller
    '801'               => 'Get All Active Country',

    // 900 -> 999 SAASModuleApiController
    '901'               => 'Get All SAAS List',
    '902'               => 'SAAS Package Create Successfully',

    '-1'                => "Error",
    'success'           => 'Function Success',
    'something_error'   => "Something Error",
    'invalid_user'      => "Invalid User",
    'repeat_user'       => "Repeat User",
];

?>