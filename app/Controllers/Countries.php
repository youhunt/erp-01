<?php

namespace App\Controllers;

use App\Models\CountriesModel;
use Config\Services;

class Countries extends BaseController
{

    public function index()
	{
        $data['menu'] = 'setup';
        $data['submenu'] = 'countries';

        $data['title'] = 'Countries';
        return view('countries/index', $data);
	}

    public function getCountries()  
    {

        $request = Services::request();
        $datatable = new CountriesModel($request);
        
        if ($request->getMethod(true) === 'POST') {
            $lists = $datatable->getDatatables();
            $data = [];
            $no = $request->getPost('start');

            foreach ($lists as $list) {
                $no++;
                if ($list->id !== '1') {
                    $row = [];
                    $row['id'] = $list->id;
                    $row['name'] = $list->name;
                    $row['region'] = $list->region;
                    $row['subregion'] = $list->subregion;
                    $data[] = $row;
                }
                
            }

            $output = [
                'draw' => $request->getPost('draw'),
                'recordsTotal' => $datatable->countAll(),
                'recordsFiltered' => $datatable->countFiltered(),
                'data' => $data
            ];

            echo json_encode($output);
        }
    }
}