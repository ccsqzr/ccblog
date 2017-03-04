<?php
class Main extends CI_Controller
{
    public function __construct()

    {
        parent::__construct();
        $this->load->model("admin_model");
        $this->load->model("article_model");
        $this->load->model("category_model");
        $this->load->helper('url');
        $this->load->library('pagination');

    }
    //展示后台管理详情页面
    public function index($page=1){
        $config['base_url'] = 'http://127.0.0.1/index.php/admin/main';
        $config['total_rows'] = $this->article_model->count();
        $config['per_page'] = 10;
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);
        $data['paginationHtml'] = $this->pagination->create_links();
        $data['articleAll'] = $this->article_model->getAllByPage($page);
        $data['categoryAll'] = $this->category_model->getAll();
        $data['admin']=$this->session->userdata('admin');
       $this->load->view('houTai',$data);

    }
}