<?php

namespace App\Http\Controllers\CRM;

use App\DataTables\CRM\ClientCompaniesDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientCompanyResourceController extends Controller
{
    const MODULE_CODE = 'CC';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ClientCompaniesDataTable $dataTable)
    {
        return $dataTable->render('modules.crm.client-companies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.crm.client-companies.form', [
            'documentCloseRoute'    => 'client-companies.index',
            'mode'                  => 'create',
            'trackingNumber'        => reserve_tracking_number(static::MODULE_CODE) . ' (Tentative)'
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
}
