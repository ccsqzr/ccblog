<?php

/**
 * Created by PhpStorm.
 * User: sqzr
 * Date: 2017/2/13
 * Time: 14:46
 */
class Article extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("article_model");
        $this->load->model("category_model");
        $this->load->model('admin_model');
        // redirect依赖这个helper
        $this->load->helper('url');

    }

//通过文章ID获取文章详情页面
    public function index($articleID)
    {   $this->article_model->visitCount($articleID);
        $data['article'] = $this->article_model->getById($articleID);
        $this->load->view('article', $data);

    }

    //通过分类ID，获得该分类下的全部文章
    public function category($categoryId)
    {
        $data['byCategoryId'] = $this->article_model->getByCategoryId($categoryId);
        $data['category'] = $this->category_model->getById($categoryId);
        $this->load->view('byCategoryId', $data);


    }

    //后台管理员获取所有分类，并加载添加文章页面
    public function add()
    {
        if ($this->session->has_userdata('admin')) {
            // 已经登录 直接跳转到main去
            $data['allCategory'] = $this->category_model->getAll();
            $this->load->view('addArticle', $data);
        } else {
            redirect("admin/auth");
        }


    }

    //后台管理员执行新增文章操作，新增成功跳转回文章列表
    public function doAdd()
    {
        $title = $this->input->post("title");
        $content = $this->input->post("content");
        $category = $this->input->post("category");
        // session 是咋个取得安 看文档
        $loginAdmin = $this->session->userdata('admin');
        $author = $loginAdmin['name'];
        $data = array(
            "title" => $title,
            "content" => $content,
            "category" => $category,
            "author" => $author,
            "create_date" => date('Y-m-d H:i:s')
        );
        if (empty($title)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'status' => 'error',
                    'message' => '请输入标题'
                )));
        }
        if (empty($content)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'status' => 'error',
                    'message' => '请输入正文'
                )));
        }
        // $category 这里接收到的是不是就是分类的id嘛
        if (empty($category)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'status' => 'error',
                    'message' => '请选择文章分类'
                )));
        }
        if (!empty($data)) {
            $this->article_model->input($data);
            // 这里是不是就是添加成功了 然后把它添加到的分类 数量  +1 我们去写个方法哈
            $this->category_model->plusOneCount($category);
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'status' => 'success',
                    'message' => '新增文章成功'
                )));
        }

    }

//通过文章Id获取该条数据，执行删除操作，删除成功跳转到文章列表
    public function delete()
    {
        $articleId = $this->input->post("articleId");
        $article = $this->article_model->getById($articleId);
        $this->category_model->cutOneCount($article['categoryId']);
        $deleteResult = $this->article_model->delete($articleId);
        if ($deleteResult) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'status' => 'success',
                    'message' => '删除成功'
                )));
        } else {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'status' => 'error',
                    'message' => '删除失败'
                )));
        }
    }

    //通过ID获取该条数据，并获取所有分类，加载更新文章页面
    public function update($modifyId)
    {
        $data['articles'] = $this->article_model->getById($modifyId);
        $data['allCategory'] = $this->category_model->getAll();
        $this->load->view('updateArticle', $data);
    }

    //执行更新操作，修改后的内容update到该条数据里，在数据库中进行更新。更新成功跳转回文章列表页
    public function doUpdate()
    {
        $articleId = $this->input->post("articleId");
        $title = $this->input->post("title");
        $content = $this->input->post("content");
        $category = $this->input->post("category");
        $loginAdmin = $this->session->userdata('admin');
        $author = $loginAdmin['name'];
        $data = array(
            "title" => $title,
            "content" => $content,
            "category" => $category,
            "author" => $author
        );
        $updateResult = $this->article_model->update($articleId, $data);
        if ($updateResult) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'status' => 'success',
                    'message' => '更新成功'
                )));
        } else {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'status' => 'error',
                    'message' => '更新失败'
                )));
        }
    }
}











