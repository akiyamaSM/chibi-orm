<?php

namespace Javanile\Moldable\Tests\Model;

use Javanile\Moldable\Tests\DefaultDatabaseTrait;
use Javanile\Moldable\Tests\Sample\AllNotations;
use Javanile\Moldable\Tests\Sample\UndefinedType;
use Javanile\Producer;
use PHPUnit\Framework\TestCase;

Producer::addPsr4(['Javanile\\Moldable\\Tests\\' => __DIR__.'/../']);

final class NotationApiTest extends TestCase
{
    use DefaultDatabaseTrait;

    public function testAllNotationsApi()
    {
        $object = new AllNotations();

        $this->assertEquals(true, $object->booleanTrue);
        $this->assertEquals(false, $object->booleanFalse);
        $this->assertEquals('Hello World!', $object->string);
        $this->assertEquals('', $object->varchar);
        $this->assertEquals('', $object->text);
        $this->assertEquals(3.14, $object->float);
        $this->assertEquals(0, $object->double);
        $this->assertEquals(null, $object->enumWithNull);
        $this->assertEquals('a', $object->enumNotation);
        $this->assertEquals('A', $object->enum);
        //$this->assertEquals('00:00:00', $object->time);
        //$this->assertEquals('0000-00-00', $object->date);
        //$this->assertEquals('0000-00-00 00:00:00', $object->datetime);

        //Producer::log($object->enumNotation);
    }

    public function testUndefinedType()
    {
        $this->expectException('Javanile\\Moldable\\Exception');
        $this->expectExceptionMessageRegExp('/class model error/i');

        $object = new UndefinedType();
    }
}
