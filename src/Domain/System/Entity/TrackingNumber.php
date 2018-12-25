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
     * @ORM\Column(type="integer", name="current_number")
     */
    private $currentNumber;

    public function __construct(
        string $code, 
        int $startingNumber = 0, 
        int $endingNumber = 99999999, 
        bool $isActive = true
    ) {
        $this->code             = $code;
        $this->isActive         = $isActive;
        $this->startingNumber   = $startingNumber;
        $this->endingNumber     = $endingNumber;
        $this->currentNumber    = $startingNumber;
    }

    public function getNextAvailableStringVal() : string
    {
        $endingNumberSize = strlen((string) $this->getEndingNumber());
        $nextNumericNumber = $this->getCurrentNumber() + 1;

        if ($nextNumericNumber > $this->getEndingNumber()) {
            throw TrackingNumberGenerationFailedException::fromExhaustedNumbers($this);
        }

        $paddedStringNumber = str_pad((string) $nextNumericNumber, $endingNumberSize, '0', STR_PAD_LEFT);
        return "{$this->getCode()}-$paddedStringNumber";
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