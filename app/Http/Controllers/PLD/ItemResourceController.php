<?php

namespace App\Http\Controllers\PLD;

use App\DataTables\PLD\ItemsDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Jet\Domain\PLD\Service\ItemRepository;

class ItemResourceController extends Controller
{

    /** @var ItemRepository */
    private $itemRepository;

    public function __construct(ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ItemsDataTable $dataTable)
    {
        return $dataTable->render('modules.pld.items.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  string $code
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $code
     * @return \Illuminate\Http\Response
     */
    public function edit($code)
    {
        $item = $this->itemRepository->findByCode($code);
        return view('modules.pld.items.form', [
            'item' => $item,            
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $code
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $code)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $code
     * @return \Illuminate\Http\Response
     */
    public function destroy($code)
    {
        //
    }
}
