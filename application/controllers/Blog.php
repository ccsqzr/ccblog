<?php
/**
 * Created by PhpStorm.
 * User: sqzr
 * Date: 2017/2/13
 * Time: 15:16
 */

/**
 * 首先展示出博客的首页
 */
class Blog extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("article_model");
        $this->load->model("category_model");
        $this->load->library('pagination');
    }


    public function index($page = 1)
    {
        $config['base_url'] = 'http://127.0.0.1/index.php/blog/';
        $config['total_rows'] = $this->article_model->count();
        $config['per_page'] = 10;
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);
        $data['paginationHtml'] = $this->pagination->create_links();
        $data['articleAll'] = $this->article_model->getAllByPage($page);

     // 这里就不去自己写count了   直接把数据库里查询出来的的拿出来用
        $data['categoryAll'] = $this->category_model->getAll();
        $this->load->view('blog', $data);

    }
    public function search(){
        $keyWord = $this->input->get("q");
       $data['allContent']= $this->article_model->search($keyWord);
       $data['keyword']=$keyWord;
       $this->load->view('searchShow',$data);
    }
}