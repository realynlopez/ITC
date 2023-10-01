<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    public function register()
{
    helper(['form']);

    if ($this->request->getVar() === 'post') {
        // Apply the validation rules to your form data here.
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required|min_length[4]|max_length[100]|valid_email|is_unique[users.username]',
            'password' => 'required|min_length[4]|max_length[50]',
            'confirmpassword' => 'matches[password]'
        ]);

        if ($validation->withRequest($this->request)->run()) {
            // Validation passed, insert the user into the database
            $userModel = new UserModel();
            $data = [
                'username' => $this->request->getPost('username'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT, []),

            ];
            $userModel->insert($data);

            // Redirect to a success page or login page
            return redirect()->to('/login');
        } else {
            // Validation failed, show the registration form with validation errors
            $data['validation'] = $validation;
        }
    }

    echo view('signup', $data);
}


    public function login(){
        helper(['form']);
        echo view('signin');

        $session = session();
        $userModel = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $data = $userModel->where('username', $username)->first();

        if ($data) {
            $hashedPassword = $data['password'];

            if (password_verify($password, $hashedPassword)) {
                $ses_data = [
                    'id' => $data['id'],
                    'username' => $data['username'],
                    'isLoggedin' => TRUE
                ];

                $session->set($ses_data);
                return redirect()->to('/profile');
            } else {
                $session->setFlashdata("msg", "Password is incorrect.");
                return redirect()->to("/signin");
            }
        } else {
            $session->setFlashdata("msg", "Username does not exist.");
            return redirect()->to("/signin");
        }
    }

}
