<?php

namespace App\Imports;

use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\Collection;
use Jet\Domain\PLD\Entity\Item;
use Jet\Domain\PLD\Entity\ItemCategory;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ItemSheetImport implements ToCollection, WithHeadingRow
{
    /** @var ItemCategory */
    private $category;

    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em, ItemCategory $category)
    {
        $this->em = $em;
        $this->category = $category;        
    }

    public function collection(Collection $rows)
    {
        \Illuminate\Support\Facades\Log::info($this->category);
        foreach ($rows as $row) 
        {
            $item = new Item(
                $this->category,
                $row['item_code'],
                $row['item_name']
            );
            $item->setImageUrl($this->generateImageUrl($row));
            $this->em->persist($item);
            \Illuminate\Support\Facades\Log::info(json_encode($row));
        }

        $this->em->flush();
    }

    public function headingRow(): int
    {
        return 2;
    }

    private function generateImageUrl($row) : string
    {
        $code = $row['item_code'];
        $sanitizedCode = $this->replaceSpecialCharacters($code);

        return "item-img/{$sanitizedCode}.png";
    }

    private function replaceSpecialCharacters(string $string)
    {
        $replaceableCharacters = [
            ' ', '"', '\'', '\\', '/'
        ];

        foreach($replaceableCharacters as $character) {
            $string = str_replace($character, '_', $string);
        }

        return $string;
    }
}
