<?php
/**
 * Configuração do Sistema
 * Sebo Alfarrábio Dashboard
 * @version 2.1
 */

namespace Ovos\Ebenezer\Database;
use PDO;
use PDOException;

// ================================
// CONFIGURAÇÃO PRINCIPAL (OBRIGATÓRIA)
// ================================
class Config
{
    public static function get()
    {
        return [
            'database' => array(
                'driver' => 'mysql',
                'mysql' => array(
                 'host' => '127.0.0.1',
                'db_name' => 'ovos_ebenezer',
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
                'port' =>  '3306',
                ),
            ),
            'app' => [
                'name'  => 'Ovos Ebenezer',
                'url'   => 'http://localhost/ovos-ebenezer',
                'email' => 'admin@ovosebenezer.com'
            ]
        ];
    }
}

