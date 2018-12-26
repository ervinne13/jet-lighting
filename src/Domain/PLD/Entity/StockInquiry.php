<?php

namespace Jet\Domain\PLD\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping AS ORM;
use Jet\Domain\Common\Entity\Specification\HasCreatedBy;
use Jet\Domain\Common\Entity\Specification\HasDocumentNumber;
use Jet\Domain\PLD\Entity\StockInquiry;
use Jet\Domain\PLD\Entity\StockInquiryDetail;
use JsonSerializable;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;

/**
 * @ORM\Entity
 * @ORM\Table(name="stock_inquiry_headers")
 */
class StockInquiry implements JsonSerializable
{
    use Timestamps;
    use HasDocumentNumber;
    use HasCreatedBy;

    protected $moduleCode = 'ISI';

    /**
     * @ORM\Column(type="string")
     */
    private $purpose;

    /**
     * @ORM\OneToMany(targetEntity="StockInquiryDetail", mappedBy="header", cascade={"all"})     
     */
    private $details;

    public function __construct(string $purpose = null, array $details = [])
    {
        $this->reserveDocumentNumber();
        $this->purpose = $purpose;
        $this->details = $details;

        $this->generateCreatedBy();
    }

    public function getPurpose() : ?string
    {
        return $this->purpose;
    }

    public function getDetails() : Collection
    {
        //  PersistentCollection
        return $this->details;
    }

    public function addDetail(StockInquiryDetail $stockInquiryDetail)
    {
        $stockInquiryDetail->setHeader($this);
        $this->details[] = $stockInquiryDetail;
        return $this;
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
            'details' => $details,
        ];
    }
    
}