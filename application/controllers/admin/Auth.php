<?php

class Auth extends CI_Controller
{
    public function __construct()

    {
        parent::__construct();
        $this->load->model("admin_model");
        $this->load->helper('url');

    }
//验证管理员是否已经登陆过了，已经登录则直接跳转到后台详情页面，没有登录则进入登陆页面
    public function index()
    {
        if ($this->session->has_userdata('admin')) {
            // 已经登录 直接跳转到main去
            redirect("admin/main");
        } else {
            // 如果没有登录 就展示登录界面
            $data['errorMessage'] = $this->input->get("errorMessage");
            $this->load->view('login', $data);
        }
    }
//执行登录验证操作，首先看用户名是否存在接着再匹配密码，验证完成，登录成功，跳转到后台管理详情页
    public function loginCheck()
    {
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        $admin = $this->admin_model->getByUsername($username);
        if (empty($admin)) {
            // 用户名不存在 就不继续往下执行了哈  否则就会跟着去匹配密码 然后跳转 昨天我写都没考虑到这里哈
            // 或者在这里 就直接跳转了
            // 用get的方式传到登录界面去
            // redirect('admin/auth?errorMessage=用户名不存在');
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'status' => 'error',
                    'message' => '用户名不存在'
                )));
        }
        $adminPassword = $admin['password'];
        if ($adminPassword == $password) {
            $this->session->set_userdata("admin", $admin);
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'status' => 'success',
                    'message' => '登录成功'
                )));
        } else {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'status' => 'error',
                    'message' => '密码错误'
                )));
        }

    }
//删除session，退出登录，跳转到登陆页面
    public function logout()
    {
        $this->session->unset_userdata('admin');
        echo "退出登陆成功";
        redirect('admin/auth');
    }
//加载注册页面
    public function register()
    {
        $this->load->view('register');
    }
//验证注册信息，
    public function doRegister()
    {
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        $reqPassword = $this->input->post("reqPassword");
        $name = $this->input->post("name");
        $admin['username'] = $username;
        $admin['password'] = $password;
        // 把name存到数据库
        $admin['name'] = $name;
        // 检查要放在前面   检查通过以后才能存在数据库里去
        // 前面如果两个条件没通过,就直接return了
        // $admin 是不可能为空的 因为就算 username 和 password 没传 $admin 也不会为空
        if (empty($username)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'status' => 'error',
                    'message' => '请输入用户名'
                )));
        }
        if (empty($password)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'status' => 'error',
                    'message' => '请输入密码'
                )));
        }

        if ($password != $reqPassword) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'status' => 'error',
                    'message' => '两次密码输入不想等',
                )));
        }

        // 验证完成不能为空以后,验证用户名是否已经被注册过了
        // 如果通过用户名去查询用户对象  查询到了 说明这个用户名已经有人用了(在数据库里已经有记录了 )
        if ($this->admin_model->existByUsernameOrName($username,$name)) {
            // 返回的是true 表示已经存在用户名或者姓名
            // 不为空
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'status' => 'error',
                    'message' => '用户名或者姓名已经被注册',
                )));
        }



        // 注册成功了 跳转到登陆页面哈  不是直接就设置了
        $this->admin_model->input($admin);
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array(
                'status' => 'success',
                'message' => '注册成功'
            )));
    }
}