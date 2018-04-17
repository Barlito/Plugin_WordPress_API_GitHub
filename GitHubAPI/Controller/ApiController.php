<?php

require_once __DIR__ . '/../composer/vendor/autoload.php';

class ApiController {

    private static $client = NULL;

    private static function getClient() {
        if (self::$client == NULL) {
            self::$client = new \Github\Client();
        }
        return self::$client;
    }

    public static function auth($login, $password) {

        try {
            $client = self::getClient();
            $client->authenticate($login, $password, \Github\Client::AUTH_HTTP_PASSWORD);
            $repos = $client->currentUser()->repositories();
        } catch (Exception $ex) {
            
        }
        return $repos;
    }

    public static function getCommit($login, $repository) {
        return $commits = self::getClient()->api('repo')->commits()->all($login, $repository, array('sha' => 'master'));
    }

}
