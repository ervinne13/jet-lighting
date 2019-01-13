<?php

namespace App\Imports;

use App\Imports\ItemSheetImport;
use Illuminate\Support\Collection;
use Jet\Domain\PLD\Service\ItemCategoryRepository;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ItemsImport implements WithMultipleSheets
{
    /** @var ItemCategoryRepository */
    private $itemCategoryRepository;

    public function __construct(ItemCategoryRepository $itemCategoryRepository)
    {
        $this->itemCategoryRepository = $itemCategoryRepository;
    }

    public function sheets(): array
    {
        $allSheets = [];

        $supportedCategories = [
            'LED Recessed Lights',
            'Downlight Fixtures',
            'Mall Lighting',
            'Surface Downlights',
            'LED Bulbs & Lamps',
            'Louver Lighting',            
            'Industrial Lighting',
            'Track Lights',
            'Wall Lighting',
            'LED Indoor Wall Lamps & Step Lights',
        ];
        
        for ($i = 0; $i < count($supportedCategories); $i ++) {
            $allSheets[$i] = app()->makeWith(ItemSheetImport::class, [
                'category' => $this->itemCategoryRepository->findByName($supportedCategories[$i])
            ]);
        }

        return $allSheets;
    }
}
