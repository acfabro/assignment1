<?php


namespace Acfabro\MailerLiteAssignment\Database;


use Acfabro\MailerLiteAssignment\Helpers\Env;
use Doctrine\DBAL\DriverManager;

/**
 * Class Connection
 *
 * Database connection
 *
 * @package Acfabro\MailerLiteAssignment\Database
 */
class Connection
{
    protected static $instance;

    /**
     * Database connection singleton
     * @return mixed
     * @throws \Doctrine\DBAL\DBALException
     */
    public static function instance()
    {
        // return if already instantiated
        if (!empty(self::$instance)) return self::$instance;

        // otherwise make new
        $connectionParams = array(
            'dbname' => Env::get('DB_NAME', 'mailerlite'),
            'user' => Env::get('DB_USERNAME', 'homestead'),
            'password' => Env::get('DB_PASSWORD', 'secret'),
            'host' => Env::get('DB_HOST', 'localhost'),
            'port' => Env::get('DB_PORT', 3306),
            'driver' => 'pdo_mysql',
        );
        return self::$instance = DriverManager::getConnection($connectionParams);
    }
}