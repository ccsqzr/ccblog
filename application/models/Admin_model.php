<?php
class Admin_model extends CI_Model
{
    public function getByUsername($username)
    {
        $query = $this->db->get_where("admin", array("username" => $username));
        return $query->row_array();
    }
    public function input($admin){
        $this->db->insert("admin",$admin);
    }
    public function getByName($name)
    {
        $query = $this->db->get_where("admin", array("name" => $name));
        return $query->row_array();
    }

    /**
     * 判断用户名或者姓名是否已经存在
     * @param $username 用户名
     * @param $name     姓名
     * 返回一个boolean类型 true表示已存在
     */
    public function existByUsernameOrName($username, $name)
    {
        $this->db->or_where('username =', $username);
        $this->db->or_where('name =', $name);
        $query = $this->db->get("admin");
        // 拿到查询出来的结果数
        $resultCount = $query->num_rows();

        // 如果查询出来的结果数 大于0 则表示已存在用户了
        return $resultCount > 0;
    }
}