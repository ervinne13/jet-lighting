<?php

namespace Jet\Domain\PLD\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Jet\Domain\Common\Entity\Specification\HasDocumentNumber;
use JsonSerializable;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;

/**
 * @ORM\Entity
 * @ORM\Table(name="stock_inquiry_header")
 */
class StockInquiry implements JsonSerializable
{
    use Timestamps;
    use HasDocumentNumber;

    /**
     * @ORM\Column(type="string")
     */
    private $purpose;

    /**
     * @ORM\OneToMany(targetEntity="StockInquiryDetails", mappedBy="header", cascade={"all"})     
     */
    private $details;

    public function __construct(string $purpose = null, array $details = [])
    {
        $this->purpose = $purpose;
        $this->details = $details;
    }

    public function getPurpose() : ?string
    {
        return $this->purpose;
    }

    public function getDetails() : array
    {
        return $this->details;
    }

    public function jsonSerialize()
    {
        $details = [];
        foreach($this->details as $detail) {
            $details[] = $detail->jsonSerialize();
        }
        
        return [
            'document_number' => $this->documentNumber,
            'document_date' => $this->createdAt,
            'purpose' => $this->purpose,
            'details' => $this->details,
        ];
    }
}