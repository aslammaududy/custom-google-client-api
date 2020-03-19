<?php
return [
    /*
 * Email address for admin user that should be used to perform API actions
 * Needs to be created via Google Apps Admin interface and be added to an admin role
 * that has permissions for Admin APIs for Users
 */
    "delegatedAdmin" => 'delegated-admin@domain.org',

    /*
 * Some name you want to use for your app to report to Google with calls, I assume
 * it is used in logging or something
 */
    "appName" => 'Example App',


    /* the hosted domain */
    'domain' => 'domain.org',

    /*
 * Array of scopes you need for whatever actions you want to perform
 * See https://developers.google.com/admin-sdk/directory/v1/guides/authorizing
 */
    "scopes" => [
        'https://www.googleapis.com/auth/admin.directory.user'
    ],

    /*
 * Provide path to JSON credentials file that was downloaded from Google Developer Console
 * for Service Account
 */
    "authJson" => __DIR__ . '/credentials.json',
];
