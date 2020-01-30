<?php
    class UniversalConnect implements IConnectInfo
    {

        //put your code here
        private static $server = IConnectInfo::CONN_HOST;
        private static $currentDB = IConnectInfo::CONN_DB;
        private static $user = IConnectInfo::CONN_USER;
        private static $pass = IConnectInfo::CONN_PASS;
        private static $port = IConnectInfo::CONN_PORT;
        private static $charset = IConnectInfo::MYSQL_CHARSET;
        private static $connection; // tilslutning

        public static function doConnect()
        {
            // One connection through whole application
            if (null == self::$connection) {
                self::$connection = new mysqli(self::$server, self::$user, self::$pass, self::$currentDB, self::$port);
                if (self::$connection->set_charset(self::$charset)) {
                    self::$connection->character_set_name();
                } elseif (self::$connection->connect_errno > 0) {
                    return 'Failed to connect';
                }
            }
            return self::$connection;
        }
    }