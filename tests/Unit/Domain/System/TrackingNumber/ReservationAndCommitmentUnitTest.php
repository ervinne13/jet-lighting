<?php

namespace Tests\Unit\Domain\System\NavigationTree;

use Jet\Domain\System\Entity\TrackingNumber;
use Jet\Domain\System\Exception\TrackingNumberGenerationFailedException;
use Jet\Domain\System\Service\Builder\TrackingNumberBuilder;
use PHPUnit\Framework\TestCase;

class ReservationAndCommitmentUnitTest extends TestCase
{
    
    /**
     * @test
     */
    public function it_can_generate_next_available_number()
    {
        $builder = new TrackingNumberBuilder();
        $tn = $builder
            ->withCode('SI')
            ->build();

        $nextNumber = $tn->getNextAvailableStringVal();
        $this->assertEquals('SI-00001', $nextNumber);
    }

    /**
     * @test
     */
    public function it_can_generate_next_available_number_based_on_ending_number_size()
    {
        $builder = new TrackingNumberBuilder();
        $tn = $builder
            ->withCode('SI')
            ->withEndingNumber(99)
            ->build();

        $nextNumber = $tn->getNextAvailableStringVal();
        $this->assertEquals('SI-01', $nextNumber);
    }

    /**
     * @test
     */
    public function it_fails_to_generate_next_number_if_numbers_are_exhausted()
    {
        $builder = new TrackingNumberBuilder();
        $tn = $builder
            ->withCode('SI')
            ->withStartingNumber(99)
            ->withEndingNumber(99)
            ->build();

        $this->expectException(TrackingNumberGenerationFailedException::class);
        $this->expectExceptionCode(TrackingNumberGenerationFailedException::EXHAUSTED);
        $nextNumber = $tn->getNextAvailableStringVal();
    }

    /**
     * @test
     */
    public function it_can_commit_a_generated_tracking_number()
    {
        $builder = new TrackingNumberBuilder();
        $tn = $builder
            ->withCode('SI')
            ->withEndingNumber(99)
            ->build();

        $this->assertEquals(0, $tn->getCurrentNumber());
        $nextNumber = $tn->getNextAvailableStringVal();
        $commitedNumber = $tn->commit();

        //  the number is now commited
        $this->assertEquals(1, $tn->getCurrentNumber());
        $this->assertEquals('SI-01', $commitedNumber);
    }

    /**
     * This can happen if two people opens a new document at the same time.
     * If one user commits the tracking number, the next user must get the 
     * number next to that instead of the commited number     
     * @test
     */
    public function it_generates_the_next_tracking_number_if_number_is_already_commited()
    {
        $builder = new TrackingNumberBuilder();
        $tn = $builder
            ->withCode('SI')
            ->withEndingNumber(99)
            ->build();

        $this->assertEquals(0, $tn->getCurrentNumber());
        $numberToCommit = $tn->getNextAvailableStringVal();
        $firstActualCommitedNumber = $tn->commit();
        $secondActualCommitedNumber = $tn->commit();   //  simulate already commited number
        
        $this->assertEquals(2, $tn->getCurrentNumber());

        $this->assertEquals('SI-01', $firstActualCommitedNumber);
        //  even if the number to commit is SI-01
        $this->assertEquals('SI-02', $secondActualCommitedNumber); 
    }

}