<?php

namespace Javanile\Moldable\Tests;

use Javanile\Moldable\Database;
use Javanile\Producer;
use PHPUnit\Framework\TestCase;

Producer::addPsr4(['Javanile\\Moldable\\Tests\\' => __DIR__]);

final class DatabaseSchemaApiTest extends TestCase
{
    use DatabaseTrait;

    public function testDatabaseSchemaDesc()
    {
        $db = new Database([
            'host'     => $GLOBALS['DB_HOST'],
            'port'     => $GLOBALS['DB_PORT'],
            'dbname'   => $GLOBALS['DB_NAME'],
            'username' => $GLOBALS['DB_USER'],
            'password' => $GLOBALS['DB_PASS'],
            'debug'    => true,
        ]);

        $db->apply([
            'test_table_1' => [
                'test_field_1' => 0,
            ],
            'test_table_2' => [
                'test_field_2' => 0,
            ],
        ]);

        $this->assertEquals($db->desc(), [
            'test_table_1' => [
                'test_field_1' => [
                    'Field'   => 'test_field_1',
                    'Type'    => 'int(11)',
                    'Null'    => 'NO',
                    'Key'     => '',
                    'Default' => '0',
                    'Extra'   => '',
                    'First'   => true,
                    'Before'  => false,
                ],
            ],
            'test_table_2' => [
                'test_field_2' => [
                    'Field'   => 'test_field_2',
                    'Type'    => 'int(11)',
                    'Null'    => 'NO',
                    'Key'     => '',
                    'Default' => '0',
                    'Extra'   => '',
                    'First'   => true,
                    'Before'  => false,
                ],
            ],
        ]);
    }

    public function testDatabaseSchemaAlter()
    {
        $db = new Database([
            'host'     => $GLOBALS['DB_HOST'],
            'port'     => $GLOBALS['DB_PORT'],
            'dbname'   => $GLOBALS['DB_NAME'],
            'username' => $GLOBALS['DB_USER'],
            'password' => $GLOBALS['DB_PASS'],
            'debug'    => true,
        ]);

        $db->alter([
            'test_table_1' => [
                'test_field_1' => 0,
            ],
            'test_table_2' => [
                'test_field_2' => 0,
            ],
        ]);

        $this->assertEquals($db->desc(), [
            'test_table_1' => [
                'test_field_1' => [
                    'Field'   => 'test_field_1',
                    'Type'    => 'int(11)',
                    'Null'    => 'NO',
                    'Key'     => '',
                    'Default' => '0',
                    'Extra'   => '',
                    'First'   => true,
                    'Before'  => false,
                ],
            ],
            'test_table_2' => [
                'test_field_2' => [
                    'Field'   => 'test_field_2',
                    'Type'    => 'int(11)',
                    'Null'    => 'NO',
                    'Key'     => '',
                    'Default' => '0',
                    'Extra'   => '',
                    'First'   => true,
                    'Before'  => false,
                ],
            ],
        ]);

        $db->alter('new_table', 'new_field', 'default_value');
        $models = $db->getModels();
        $this->assertEquals($models, ['new_table', 'test_table_1', 'test_table_2']);
    }

    public function testDatabasePrefix()
    {
        $db = new Database([
            'host'     => $GLOBALS['DB_HOST'],
            'port'     => $GLOBALS['DB_PORT'],
            'dbname'   => $GLOBALS['DB_NAME'],
            'username' => $GLOBALS['DB_USER'],
            'password' => $GLOBALS['DB_PASS'],
            'debug'    => true,
        ]);

        $db->apply([
            'test_table_1' => [
                'test_field_1' => 0,
            ],
        ]);

        $db->setPrefix('prefix_');

        $db->apply([
            'test_table_1' => [
                'test_field_1' => 0,
            ],
        ]);

        $tables = $db->getTables(false);

        $this->assertEquals($tables, ['prefix_test_table_1', 'test_table_1']);
    }

    public function testDiffTable()
    {
        $db = new Database([
            'host'     => $GLOBALS['DB_HOST'],
            'port'     => $GLOBALS['DB_PORT'],
            'dbname'   => $GLOBALS['DB_NAME'],
            'username' => $GLOBALS['DB_USER'],
            'password' => $GLOBALS['DB_PASS'],
            'debug'    => true,
        ]);

        $db->apply([
            'test_table_1' => [
                'test_field_1' => 0,
            ],
        ]);

        $sql = $db->diffTable('test_table_1', [
            'test_field_2' => 0,
        ]);

        $this->assertEquals(substr($sql[0], 0, 11), 'ALTER TABLE');
    }

    public function testInfo()
    {
        $this->expectOutputRegex('/^<pre.+pre>$/s');

        $db = new Database([
            'host'     => $GLOBALS['DB_HOST'],
            'port'     => $GLOBALS['DB_PORT'],
            'dbname'   => $GLOBALS['DB_NAME'],
            'username' => $GLOBALS['DB_USER'],
            'password' => $GLOBALS['DB_PASS'],
            'debug'    => true,
        ]);

        $db->apply([
            'test_table_1' => [
                'test_field_1' => 0,
            ],
        ]);

        $db->info(['test_table_1']);
    }
}
