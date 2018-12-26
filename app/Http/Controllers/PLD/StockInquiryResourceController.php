<?php

namespace App\Http\Controllers\PLD;

use App\Http\Controllers\Controller;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Http\Request;
use Jet\Domain\Common\ValueObject\Amount;
use Jet\Domain\PLD\Entity\StockInquiry;
use Jet\Domain\PLD\Entity\StockInquiryDetail;
use Jet\Domain\PLD\Service\ItemRepository;
use Jet\Domain\PLD\Service\SupplierRepository;
use Jet\Domain\PLD\ValueObject\SupplierStockCommitment;

class StockInquiryResourceController extends Controller
{

    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $isi = $this->createDummyInquiry();        
        $isi->commitAndPersist($this->em);
        $this->em->flush();

        return view('modules.pld.stock-inquiries.form', [
            'documentCloseRoute' => 'stock-inquiries.index',
            'inquiry'            => $isi
        ]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function createDummyInquiry() : StockInquiry
    {
        $itemRepo = app(ItemRepository::class);
        $supplierRepo = app(SupplierRepository::class);
        $item1 = $itemRepo->findByCode('JT24FT-LED-W-4K');
        $item2 = $itemRepo->findByCode('JT-2-Security-BR');
        $item3 = $itemRepo->findByCode('JT-2-Security-WH');
        $item4 = $itemRepo->findByCode('JML-303-12V');        
        $item5 = $itemRepo->findByCode('JET5050WW/60/OUT');

        $supplier = $supplierRepo->find('S-00000002');

        $isi = new StockInquiry('test purpose');    

        $isi->addDetail(new StockInquiryDetail($item1, 240, 300));
        $isi->addDetail(new StockInquiryDetail($item2, 120, 50));
        $isi->addDetail(new StockInquiryDetail($item3, 20, 10, new SupplierStockCommitment(
            $supplier,
            10,
            new Amount(1200)
        )));
        $isi->addDetail(new StockInquiryDetail($item4, 30, 0, new SupplierStockCommitment(
            $supplier,
            30,
            new Amount(1200)
        )));
        $isi->addDetail(new StockInquiryDetail($item5, 30, 0));

        return $isi;
    }
}
