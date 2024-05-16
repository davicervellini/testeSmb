<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ClientesModel;

class Clientes extends BaseController
{
    private $clientesModel;

    public function __construct()
    {
        $this->clientesModel = new ClientesModel();
    }

    public function index(): string
    {
        return view('home');
    }

    public function list(){
        $html = '';

        foreach ($this->clientesModel->findAll() as $cli) {
            $html .= '<tr>
                        <td>' . $cli['id'] . '</td>
                        <td>' . $cli['nome'] . '</td>
                        <td>' . $cli['telefone'] . '</td>
                        <td>' . $cli['email'] . '</td>
                        <td>' . $cli['dtNacimento'] . '</td>
                        <td><img style="width: 50px;" class="mb-3" id="ajaxImgUpload" alt="Preview Image" src="./img/' . $cli['img'] . '" /></td>
                        <td><span class="material-icons md-18 "onclick="editar(' . $cli['id'] . ')">edit</span></td>
                        <td><span class="material-icons md-18 "onclick="deletar(' . $cli['id'] . ')">delete</span></td>
                    </tr>';
        }
        return $html;
    }

    public function delete() {
        if($this->clientesModel->delete($_POST['id'])){
            return 'Cliente excluido com sucesso.';
        }else{
            return 'Erro ao excluir o cliente.';
        }
    }
    
    public function store() {
        if($this->clientesModel->save($this->request->getPost())){
            if($this->request->getPost()['id'] != ''){
                return 'Cliente editado com sucesso.';
            }else{
                return 'Cliente cadastrado com sucesso.';
            }
        }else{
            if ($this->request->getPost()['id'] != '') {
                return 'Erro ao editar o cliente.';
            } else {
                return 'Erro ao cadastrado o cliente.'; 
            }
        }
    }
    
    public function edit() {
        return json_encode($this->clientesModel->find($_POST['id']));
    }

    public function upload()
    {
        helper(['form', 'url']);

        $validationRule = [
            'file_name' => [
                'rules' => 'uploaded[file_name]'
                . '|is_image[file_name]'
                . '|mime_in[file_name,image/jpg,image/jpeg,image/gif,image/png]'
                . '|max_size[file_name,4096]',
            ],
        ];

        $response = [
            'success' => false,
            'data' => $validationRule,
            'msg' => "Image could not upload"
        ];

        if ($this->validate($validationRule)) {
            $imageFile = $this->request->getFile('file_name');
            // set image path
            $imageFile->move('./img/');

            $response = [
                'success' => true,
                'img' => $imageFile->getClientName(),
                'msg' => "Imagem enviada com sucesso"
            ];
        }

        return $this->response->setJSON($response);
    }
}
