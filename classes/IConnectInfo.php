<?php
    interface IConnectInfo
    {
        const CONN_HOST = 'webnation.dk.mysql';
        const CONN_USER = 'webnation_dk';
        const CONN_PASS = 'm011yhund';
        const CONN_DB = 'webnation_dk';
        const CONN_PORT = 3306;
        const MYSQL_CHARSET = 'utf8';
        
        public static function doConnect();
    }