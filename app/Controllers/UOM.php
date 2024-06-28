<?php

namespace App\Controllers;

use App\Models\UOMModel;
use Config\Services;

class UOM extends BaseController
{

    public function index()
	{
        $data['menu'] = 'item';
        $data['submenu'] = 'uom';

        $data['title'] = 'UOM';
        return view('uom/index', $data);
	}

    public function getUOM()  
    {

        $request = Services::request();
        $datatable = new UOMModel($request);
        
        if ($request->getMethod(true) === 'POST') {
            $lists = $datatable->getDatatables();
            $data = [];
            $no = $request->getPost('start');

            foreach ($lists as $list) {
                $no++;
                if ($list->id !== '1') {
                    $row = [];
                    $row['id'] = $list->id;
                    $row['uom_code'] = $list->uom_code;
                    $row['uom_desc'] = $list->uom_desc;
                    $row['no'] = '';
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