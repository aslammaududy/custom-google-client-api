<?php
class User extends Google_Service_Directory_User
{
    //because the setName and getName function
    //required to be a Google_Service_Directory_UserName datatype
    //which has a family name and given name
    //so this function help to create the object
    public function name($familyName, $givenName)
    {
        $name = new Google_Service_Directory_UserName();
        $name->setFamilyName($familyName);
        $name->setGivenName($givenName);

        return $name;
    }
}
