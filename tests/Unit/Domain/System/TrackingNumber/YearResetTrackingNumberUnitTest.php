<?php

namespace Tests\Unit\Domain\System\NavigationTree;

use Jet\Domain\System\Service\Builder\TrackingNumberBuilder;
use PHPUnit\Framework\TestCase;

class YearResetTrackingNumberUnitTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_generate_the_current_year_if_set_to_reset_every_year()
    {
        $builder = new TrackingNumberBuilder();
        $tn = $builder
            ->withCode('SI')
            ->resetsEveryYear()
            ->build();

        $nextNumber = $tn->getNextAvailableStringVal();
        $this->assertEquals('18-SI-00000001', $nextNumber);
    }
}