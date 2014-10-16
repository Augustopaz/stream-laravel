<?php

use GetStream\StreamLaravel\StreamLaravelManager;
use GetStream\StreamLaravel\Eloquent\Activity;
use Mockery as m;

class _Activity extends Activity
{
    public $author = null;
    public $created_at = null;
    public $id = 42;
    public function activityActorMethodName()
    {
        return 'author';
    }
}

class ActivityTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->instance = new _Activity;
        $this->instance->author = new _Activity;
        $this->instance->author->id = 43;
        $this->instance->created_at = new \Datetime("now");
    }

    public function testCreateActivity()
    {
        $activity = $this->instance->createActivity();
        $this->assertSame($activity['verb'], '_activity');
        $this->assertSame($activity['actor'], '_Activity:43');
        $this->assertSame($activity['object'], '_Activity:42');
        $this->assertSame($activity['foreign_id'], '_Activity:42');
    }
}