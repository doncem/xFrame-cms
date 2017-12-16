<?php

namespace XframeCMS\Model;

use PHPUnit\Framework\TestCase;

class AbstractModelMock extends AbstractModel
{
    protected $id;

    protected $value;

    public function __construct()
    {
        $this->id = 1;
        $this->value = 'test';
    }

    public function getId()
    {
        return $this->id;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }
}

class AbstractModelTest extends TestCase
{
    public function testSerialisation()
    {
        $this->assertJsonStringEqualsJsonString(
            '{"_id":1,"value":"test"}',
            \json_encode(new AbstractModelMock())
        );
    }

    public function testMagicMethods()
    {
        $model = new AbstractModelMock();

        $this->assertEquals(1, $model->id);
        $this->assertEquals('test', $model->value);

        $model->id = 2;
        $model->value = 'testtest';

        $this->assertEquals(2, $model->id);
        $this->assertEquals('testtest', $model->value);
    }
}
