<?php

namespace Jet\Domain\System\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Jet\Domain\System\Entity\Module;
use Jet\Domain\System\Exception\TrackingNumberGenerationFailedException;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;

/**
 * @ORM\Entity
 * @ORM\Table(name="tracking_numbers")
 */
class TrackingNumber 
{
    use Timestamps;

    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    private $code;

    /**     
     * @ORM\ManyToOne(targetEntity="Module")
     * @ORM\JoinColumn(name="module_code", referencedColumnName="code")     
     */
    private $module;

    /**
     * @ORM\Column(type="boolean", name="is_active")
     */
    private $isActive;

    /**
     * @ORM\Column(type="integer", name="starting_number")
     */
    private $startingNumber;

    /**
     * @ORM\Column(type="integer", name="ending_number")
     */
    private $endingNumber;

    /**
     * @ORM\Column(type="boolean", name="is_reseting_every_year")
     */
    private $resetsEachYear;

    /**
     * @ORM\Column(type="integer", name="current_number")
     */
    private $currentNumber;

    public function __construct(
        string $code, 
        int $startingNumber = 0, 
        int $endingNumber = 99999999, 
        bool $resetsEachYear = false,
        bool $isActive = true
    ) {
        $this->code             = $code;
        $this->resetsEachYear   = $resetsEachYear;
        $this->isActive         = $isActive;
        $this->startingNumber   = $startingNumber;
        $this->endingNumber     = $endingNumber;
        $this->currentNumber    = $startingNumber;
    }

    public function getNextAvailableStringVal() : string
    {
        $nextNumericNumber = $this->getCurrentNumber() + 1;
        $this->validateNumberDoesNotExceedEndingNumber($nextNumericNumber);
        $generatedNumber = $this->generateCodeFromNumber($nextNumericNumber);
        return $this->prependYearIfThisResetsEachYear($generatedNumber);
    }        

    private function validateNumberDoesNotExceedEndingNumber(int $number)
    {
        if ($number > $this->getEndingNumber()) {
            throw TrackingNumberGenerationFailedException::fromExhaustedNumbers($this);
        }
    }

    private function generateCodeFromNumber(int $number)
    {
        $paddingSize = strlen((string) $this->getEndingNumber());

        //  ex. number = 102, padding size = 5, generates 00102
        $paddedStringNumber = str_pad((string) $number, $paddingSize, '0', STR_PAD_LEFT);
        $generatedNumber = "{$this->getCode()}-$paddedStringNumber";

        return $generatedNumber;
    }

    private function prependYearIfThisResetsEachYear(string $generatedNumber)
    {
        if ($this->resetsEachYear) {
            $generatedNumber = date('y') . "-{$generatedNumber}";
        }

        return $generatedNumber;
    }

    public function commit() : string
    {
        $commmitedNumber = $this->getNextAvailableStringVal();
        $this->currentNumber++;
        return $commmitedNumber;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getModule() : Module
    {
        return $this->module;
    }

    public function setModule(Module $module) : TrackingNumber
    {
        $this->module = $module;
        return $this;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }

    public function getStartingNumber()
    {
        return $this->startingNumber;
    }

    public function getEndingNumber()
    {
        return $this->endingNumber;
    }

    public function getCurrentNumber()
    {
        return $this->currentNumber;
    }

    public function setCurrentNumber($currentNumber)
    {
        $this->currentNumber = $currentNumber;

        return $this;
    }
}