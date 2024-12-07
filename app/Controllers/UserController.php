<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    public function __construct()
    {
        helper('cookie');
    }
    public function formPage()
    {
        return view('register');
    }

    public function create()
    {
        $response = ['status' => false, 'message' => '', 'errors' => []];

        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required|alpha_space|min_length[3]',
            'lname' => 'required|alpha|min_length[3]',
            'email' => 'required|valid_email|is_unique[user.email]',
            'password' => 'required|min_length[6]',
            'gender' => 'required|in_list[Male,Female]',
            'mobile_number' => 'required|numeric|min_length[10]|max_length[15]',
            'city' => 'required|in_list[India,USA,UK,Landon]',
            'profile_image' => 'uploaded[profile_image]|mime_in[profile_image,image/jpg,image/jpeg,image/png,image/webp]',
            'images' => 'uploaded[images]|mime_in[images,image/jpg,image/jpeg,image/png,image/webp]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            log_message('error', json_encode($validation->getErrors()));
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $validation->getErrors(),
            ]);
        }

        $userModel = new UserModel();
        $data = $this->request->getPost();

        $profileImage = $this->request->getFile('profile_image');
        if ($profileImage->isValid() && !$profileImage->hasMoved()) {
            $profileImageName = $profileImage->getRandomName();
            $profileImage->move('public/uploads/', $profileImageName);
            $data['profile_image'] = $profileImageName;
        }

        $multipleImages = $this->request->getFiles()['images'];
        $uploadedImages = [];
        foreach ($multipleImages as $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                $imageName = $file->getRandomName();
                $file->move('public/uploads/', $imageName);
                $uploadedImages[] = $imageName;
            }
        }
        $data['multiple_images'] = json_encode($uploadedImages);

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        if ($userModel->insert($data)) {
            $response['status'] = true;
            $response['message'] = 'Registration successful!';
        } else {
            $response['message'] = 'Failed to register!';
        }

        return $this->response->setJSON($response);
    }

    public function logPage()
    {
        return view('login');
    }

    public function createLog()
    {
        $response = ['status' => false, 'message' => ''];

        if ($this->request->isAJAX()) {

            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');

            $validationRules = [
                'email' => 'required|valid_email',
                'password' => 'required|min_length[6]',
            ];

            if (!$this->validate($validationRules)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'errors' => $this->validator->getErrors()
                ]);
            }

            $userModel = new UserModel();
            $user = $userModel->where('email', $email)->first();

            if ($user && password_verify($password, $user['password'])) {
                $session = session();
                $session->set([
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'is_logged_in' => true,
                ]);

                set_cookie('user_email', $email, 3600);

                $response['status'] = true;
                $response['message'] = 'Login successful!';
            } else {
                $response['message'] = 'Invalid email or password!';
            }
        }

        return $this->response->setJSON($response);
    }

    public function logout()
    {
        $session = session();
        $session->destroy();

        delete_cookie('user_email');

        return redirect()->to('/login'); 
    }


    public function welcome()
    {
        return view('welcome');
    }
}
