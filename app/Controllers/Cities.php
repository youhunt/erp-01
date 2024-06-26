<?php

namespace App\Controllers;

use App\Models\CitiesModel;
use App\Models\CountriesModel;
use App\Models\StatesModel;

use Config\Services;

class Cities extends BaseController
{

    public function index()
	{
        $data['menu'] = 'setup';
        $data['submenu'] = 'cities';

        $data['title'] = 'Cities';
        return view('cities/index', $data);
	}

    public function getCities()  
    {

        $request = Services::request();
        $datatable = new CitiesModel($request);
        
        if ($request->getMethod(true) === 'POST') {
            $lists = $datatable->getDatatables();
            $data = [];
            $no = $request->getPost('start');

            $countriesModel = new CountriesModel($request);
            $statesModel = new StatesModel($request);

            foreach ($lists as $list) {
                $no++;
                if ($list->id !== '1') {
                    $row = [];
                    $row['id'] = $list->id;
                    $row['name'] = $list->name;
                    $row['country'] = $countriesModel->getCountry($list->country_id)[0]->name;
                    $row['states'] = $statesModel->getStates($list->state_id)[0]->name;
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