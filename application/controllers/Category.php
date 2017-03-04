<?php

/**
 * Created by PhpStorm.
 * User: sqzr
 * Date: 2017/2/13
 * Time: 14:46
 */
class Category extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("article_model");
        $this->load->model("category_model");
        $this->load->model('admin_model');
        $this->load->library('pagination');
    }
    public function index($page=1){
        $config['base_url'] = 'http://127.0.0.1/index.php/category/';
        $config['total_rows'] = $this->category_model->count();
        $config['per_page'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['first_link'] = '首页';
        $config['last_link'] = '最后一页';
        $config['next_link'] = '下一页';
        $config['prev_link'] = '上一页';
        $this->pagination->initialize($config);
        $data['paginationHtml'] =$this->pagination->create_links();
        $data['categoryAll']=$this->category_model->getByPageAll($page);
        $this->load->view('Category',$data);
    }
    public function add(){
        $this->load->view('addCategory');
    }
    public function doAdd(){
       $name= $this->input->post("category");
        if ($this->category_model->existByName($name)) {
            // 返回的是true 表示已经存在用户名或者姓名
            // 不为空
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'status' => 'error',
                    'message' => '该分类已存在',
                )));
        }else{
            $this->category_model->input($name);
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'status' => 'success',
                    'message' => '新增分类成功'
                )));
        }

    }
    public function delete(){
        $categoryId = $this->input->post("categoryId");
        $deleteResult = $this->category_model->delete($categoryId);
        if ($deleteResult) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'status' => 'success',
                    'message' => '删除成功'
                )));
        }else {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'status' => 'error',
                    'message' => '删除失败'
                )));
        }
    }
    public function update($modifyId){
        $data['ByIdCategory']=$this->category_model->getById($modifyId);
        $this->load->view('updateCategory',$data);
    }
    public function doUpdate(){
        $categoryId=$this->input->post("id");
        $name = $this->input->post("name");
        $data = array(
            "id" => $categoryId,
           "name"=>$name
        );
        $updateResult=$this->category_model->update($categoryId,$data);
        if ($updateResult) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'status' => 'success',
                    'message' => '更新成功'
                )));
        }else {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'status' => 'error',
                    'message' => '更新失败'
                )));
        }
    }

}