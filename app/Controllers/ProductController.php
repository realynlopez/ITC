<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProductModel; // Assuming you have a ProductModel

class ProductController extends BaseController
{
    public function index()
    {
        // Load the ProductModel to retrieve product data
        $productModel = new ProductModel();
        $data['products'] = $productModel->findAll();

        // Pass the product data to a view for rendering
        return view('products/index', $data);
    }

    public function show($productId)
    {
        // Load the ProductModel to retrieve product data
        $productModel = new ProductModel();
        $data['product'] = $productModel->find($productId);

        // Pass the product data to a view for rendering
        return view('products/show', $data);
    }

    public function create()
    {
        // Display a form for adding a new product
        return view('products/create');
    }

    public function store()
    {
        // Handle the form submission to add a new product to the database
        // - Validate form input
        // - Create a new product record in the database
        // - Redirect to the product catalog or product details page

        // Example code for adding a product (replace with your validation and database logic)
        $productModel = new ProductModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            // Add other product fields here
        ];

        $productModel->insert($data);

        return redirect()->to('/products');
    }

    public function edit($productId)
    {
        // Load the ProductModel to retrieve product data
        $productModel = new ProductModel();
        $data['product'] = $productModel->find($productId);

        // Display a form for editing an existing product
        return view('products/edit', $data);
    }

    public function update($productId)
    {
        // Handle the form submission to update an existing product in the database
        // - Validate form input
        // - Update the product record in the database
        // - Redirect to the product catalog or updated product details page

        // Example code for updating a product (replace with your validation and database logic)
        $productModel = new ProductModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            // Update other product fields here
        ];

        $productModel->update($productId, $data);

        return redirect()->to('/products');
    }

    public function delete($productId)
    {
        // Delete a product based on $productId
        // - Find the product in the database by ID
        // - Delete the product record
        // - Redirect to the product catalog or another appropriate page

        $productModel = new ProductModel();
        $productModel->delete($productId);

        return redirect()->to('/products');
    }
}
