<?php
    //db接続
    function db_connect(){
        //dbn(DataSourceName)
        $dsn = 'mysql:dbname='. DB_NAME. ';host='. DB_HOST. ';charset='. DB_CHARSET;
            $dbh = new PDO($dsn, DB_USER, DB_PASS,
            [
                // PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION,
                // PDO::ATTR_EMULATE_PREPARES, false,
                // PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC
            ]);

        return $dbh;
    }


?>