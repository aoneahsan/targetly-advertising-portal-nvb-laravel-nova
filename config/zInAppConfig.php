<?php

use Illuminate\Validation\Rules;

return [
    /*
    * Default length of a string
    */
    'stringLength' => 255,

        /*
    * Default length of a string
    */
    'emailLength' => 254,

    /*
    * Default length of a text/description
    */
    'textLength' => 1000,

    'fieldRules' => [
        'text' => ['required', 'max:255'],
        'textNullable' => ['nullable', 'max:'],
        'content' => ['required', 'max:1000'],
        'contentNullable' => ['nullable', 'max:1000'],
        'email' => ['required', 'email', 'max:254'],
        'emailNullable' => ['nullable', 'email', 'max:254'],
        'password' => ['required', Rules\Password::defaults()],
        'passwordNullable' => ['nullable', Rules\Password::defaults()],
        'image' => ['required', 'image'],
        'imageNullable' => ['nullable', 'image'],
        'numaric' => ['required', 'numeric', 'min:3', 'max:12'],
        'numaricNullable' => ['nullable', 'numeric', 'min:3', 'max:12'],
        'json' =>  ['required', 'json'],
        'jsonNullable' =>  ['nullable', 'json'],
    ]
];
