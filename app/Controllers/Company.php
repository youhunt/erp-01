<?php

namespace App\Controllers;

use App\Models\CompanyModel;
use Config\Services;

class Company extends BaseController
{

    public function index()
	{
        $data['menu'] = 'setup';
        $data['submenu'] = 'company';

        $data['title'] = 'Company';
        return view('company/index', $data);
	}

    public function getCompany()  
    {

        $request = Services::request();
        $datatable = new CompanyModel($request);
        
        if ($request->getMethod(true) === 'POST') {
            $lists = $datatable->getDatatables();
            $data = [];
            $no = $request->getPost('start');

            foreach ($lists as $list) {
                $no++;
                if ($list->id !== '1') {
                    $row = [];
                    $row['id'] = $list->id;
                    $row['comp_code'] = $list->comp_code;
                    $row['comp_name'] = $list->comp_name;
                    $row['comp_pic'] = $list->comp_pic;
                    $row['comp_taxid'] = $list->comp_taxid;
                    $row['no'] = "";
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