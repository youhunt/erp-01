<?php

namespace App\Controllers;

use App\Models\StatesModel;
use App\Models\CountriesModel;

use Config\Services;

class States extends BaseController
{

    public function index()
	{
        $data['menu'] = 'setup';
        $data['submenu'] = 'states';

        $data['title'] = 'States';
        return view('states/index', $data);
	}

    public function getStates()  
    {

        $request = Services::request();
        $datatable = new StatesModel($request);
        
        if ($request->getMethod(true) === 'POST') {
            $lists = $datatable->getDatatables();
            $data = [];
            $no = $request->getPost('start');

            $countriesModel = new CountriesModel($request);

            foreach ($lists as $list) {
                $no++;
                if ($list->id !== '1') {
                    $row = [];
                    $row['id'] = $list->id;
                    $row['name'] = $list->name;
                    $row['country'] = $countriesModel->getCountry($list->country_id)[0]->name;
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