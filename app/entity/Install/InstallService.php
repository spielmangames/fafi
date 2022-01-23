<?php

namespace FAFI\entity\Install;

use FAFI\config\Settings;
use FAFI\exception\FafiException;

class InstallService
{
    /**
     * @return void
     * @throws FafiException
     */
    public function installDB(): void
    {
        $filename = 'fafibase.sql';
        $filepath = bendSeparatorsRight(PATH_APP . 'db' . DS . $filename);


        $servername = Settings::getInstance()->get('db/host');
        $username = Settings::getInstance()->get('db/user');
        $password = Settings::getInstance()->get('db/pass');
        $dbname = Settings::getInstance()->get('db/name');


        $cmd = 'mysql -u%s -p%s %s < %s';
        $cmd = sprintf($cmd, $username, $password, $dbname, $filepath);

        throw new FafiException(sprintf('Please run "%s" manually in order to re-install the DB.', $cmd));
//        $result = system($cmd);
//        if (!$result) {
//            throw new FafiException('');
//        }
    }
}
