<?php
namespace App\Controllers;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected $helpers = ['form'];

    public function index()
    {
        $model = new UserModel();
        $data = [
            'users' => $model->paginate(5),
            'pager' => $model->pager
        ];
        return view('user_list', $data);
    }

    public function upload()
    {
        $file  = $this->request->getFile('avatar');
        $rules = [
            'avatar' => 'uploaded[avatar]|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]|max_size[avatar,2048]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/', $newName);

            $model = new UserModel();
            $model->save(['avatar' => $newName]);

            return redirect()->to('/users');
        }
    }
}