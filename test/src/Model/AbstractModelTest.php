<?php

namespace XframeCMS\Model;

use PHPUnit\Framework\TestCase;

/**
 * Mock the abstract model.
 */
class AbstractModelMock extends AbstractModel
{
    protected $id;

    protected $value;

    /**
     * Set values.
     */
    public function __construct()
    {
        $this->id = 1;
        $this->value = 'test';
    }

    /**
     * Getter.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Setter.
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}

/**
 * Test abstract model.
 */
class AbstractModelTest extends TestCase
{
    /**
     * Test serialisation.
     */
    public function testSerialisation()
    {
        $this->assertJsonStringEqualsJsonString(
            '{"_id":1,"value":"test"}',
            \json_encode(new AbstractModelMock())
        );
    }

    /**
     * Test magic methods.
     */
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
