<?php

namespace Aslammaududy\CustomGoogleClientApi;

use Google_Client;
use Google_Service_Directory;
use Google_Service_Directory_User;
use Google_Service_Directory_UserName;
use User;

class UserManager
{

    /*
 * Email address for admin user that should be used to perform API actions
 * Needs to be created via Google Apps Admin interface and be added to an admin role
 * that has permissions for Admin APIs for Users
 */
    private $delegatedAdmin;

    /*
 * Some name you want to use for your app to report to Google with calls, I assume
 * it is used in logging or something
 */
    private $appName;

    /*
 * Array of scopes you need for whatever actions you want to perform
 * See https://developers.google.com/admin-sdk/directory/v1/guides/authorizing
 */
    private $scopes;

    /* the hosted domain */
    private $domain;

    /*
 * Provide path to JSON credentials file that was downloaded from Google Developer Console
 * for Service Account
 */
    private $authJson;

    private $dir;

    public function __construct()
    {

        $this->delegatedAdmin = config('customgoogleclientapi.delegatedAdmin');
        $this->appName = config('customgoogleclientapi.appName');
        $this->scopes = config('customgoogleclientapi.scopes');
        $this->domain = config('customgoogleclientapi.domain');
        $this->authJson = config('customgoogleclientapi.authJson');

        $client = new Google_Client();
        $client->setAuthConfig($this->authJson);
        $client->setApplicationName($this->appName);
        $client->setSubject($this->delegatedAdmin);
        $client->setScopes($this->scopes);
        $client->setAccessType('offline');

        $this->dir = new Google_Service_Directory($client);
    }

    public function showUsers()
    {
        $users = $this->dir->users->listUsers(["domain" => $this->domain])->getUsers();

        return $users;
    }

    public function addUser(array $userData)
    {
        $user = new Google_Service_Directory_User();
        $name = new Google_Service_Directory_UserName();

        $name->setGivenName($userData["namaDepan"]);
        $name->setFamilyName($userData["namaBelakang"]);

        $user->setPrimaryEmail("{$userData["email"]}@politeknikaceh.ac.id");
        $user->setName($name);
        $user->setPassword($userData["password"]);
        $user->setOrganizations("politeknikaceh.ac.id");

        $this->dir->users->insert($user);
    }
}
