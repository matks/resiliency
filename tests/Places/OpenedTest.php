<?php

namespace Tests\Resiliency\Places;

use Resiliency\Exceptions\InvalidPlace;
use Resiliency\Places\Opened;
use Resiliency\States;

class OpenedTest extends PlaceTestCase
{
    /**
     * @dataProvider getFixtures
     *
     * @param mixed $failures
     * @param mixed $timeout
     * @param mixed $threshold
     */
    public function testCreationWith($failures, $timeout, $threshold): void
    {
        unset($failures, $timeout);
        $closedPlace = new Opened($threshold);

        $this->assertSame(0, $closedPlace->getFailures());
        $this->assertSame(0.0, $closedPlace->getTimeout());
        $this->assertSame($threshold, $closedPlace->getThreshold());
    }

    /**
     * @dataProvider getInvalidFixtures
     *
     * @param mixed $failures
     * @param mixed $timeout
     * @param mixed $threshold
     */
    public function testCreationWithInvalidValues($failures, $timeout, $threshold): void
    {
        unset($failures, $timeout);

        $this->expectException(InvalidPlace::class);

        new Opened($threshold);
    }

    public function testGetExpectedState()
    {
        $closedPlace = new Opened(1.0);

        $this->assertSame(States::OPEN_STATE, $closedPlace->getState());
    }
}