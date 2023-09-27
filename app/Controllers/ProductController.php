<?php

namespace App\Controllers;

class ProductController extends BaseController
{
    public function getIndex()
    {
        // return 'i am product controller';
        return view('frontend/product');

    }

    public function find($prod_name)
    {
        // return 'Product: '.$prod_name;
        // $data['prod_list'] = ['nokia', 'samsung', 'apple'];
        // $data['name'] = $prod_name;

        $data = [
            'name' => $prod_name,
            'prod_list' => ['nokia', 'samsung', 'apple'],
        ];
        return view('frontend/product', $data);
    }
}