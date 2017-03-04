<?php

/**
 * Created by PhpStorm.
 * User: sqzr
 * Date: 2017/2/13
 * Time: 15:21
 */
class Category_model extends CI_Model
{
    /**
     * 通过id获取到分类
     */
    public function getById($categoryId)
    {
        return $this->db->get_where("category", array("id" => $categoryId))->row_array();

    }

    /**
     * 获取所有的分类
     */
    public function getAll()
    {
        return $this->db->get('category')->result_array();
    }

    public function existByName($name)
    {
        $this->db->where('name =', $name);
        $query = $this->db->get("category");
        // 拿到查询出来的结果数
        $resultCount = $query->num_rows();

        // 如果查询出来的结果数 大于0 则表示已存在用户了
        return $resultCount > 0;
    }

    public function input($name)
    {
        // 假如新增的姓名是 "安卓"
        // 那这里传进来的就是  程序咋个晓得 插在哪个字段安
        $data['name'] = $name;
        // 创建好了 默认就给他一个0
        $data['count'] = 0;
        $this->db->insert("category", $data);
    }

    public function delete($categoryId)
    {
        $this->db->where('id', $categoryId);
        $this->db->delete('category');
        return $this->db->affected_rows() > 0;
    }

    public function update($categoryId, $data)
    {
        $this->db->where('id', $categoryId);
        $this->db->update('category', $data);
        return $this->db->affected_rows() > 0;
    }

    public function count()
    {
        return $this->db->count_all("category");
    }

    public function getByPageAll($page)
    {
        $pageCount = 5;
        $start = ($page - 1) * 5;
        $this->db->select('c.id,c.name');
        $this->db->from('category c');
        $this->db->limit($pageCount, $start);
        $query = $this->db->get();
        return $query->result_array();

    }

    public function articleCount($categoryId)
    {
        // 是不是这样写 en
        $this->db->where('category', $categoryId);
        // 是不是 要生成这个sql  去查询某个分类下文章的数量en 是不是这样写
        // 不应该调用 count_all  count_all这个函数是不会带上条件 就直接返回所有条数 所以叫 count_all
        // 去看文档
        $this->db->from('article');
        // 我们要生成的sql是不是 select count(*) from article where category = $categoryId
        return $this->db->count_all_results();

    }


    // 把分类加1
    public function plusOneCount($categoryId)
    {
        // 首先我们查出分类
        $category = $this->db->get_where('category', array("id" => $categoryId))->row_array();
        //拿到分类原本有多少文章数
        $categoryOldCount = $category['count'];
        // 比如 第二条  count 取出来是 null

        // 然后我们把原来的数量+1 然后修改
        // 那我们就不能直接这样加起来了  我们就要有个判断
        if ($categoryOldCount == null) {
            // 如果原来的是空
            // 但是我们要保证原来的不能为空 就是说创建的时候 就必须有一个值 就是0嘛  然后去修改创建分类 测试一哈
            // 是不是就是1了
            $categoryNewCount = 1;
        } else {
            $categoryNewCount = $categoryOldCount + 1;
        }
        $this->db->where('id', $categoryId);
        $this->db->update('category', array("count" => $categoryNewCount));
        // 这样是不是就把分类的文章条数 +1 了   YUN
    }

    public function cutOneCount($categoryId)
    {
        // 首先我们查出分类
        $category = $this->db->get_where('category', array("id" => $categoryId))->row_array();
        //拿到分类原本有多少文章数
        $categoryOldCount = $category['count'];
        if ($categoryOldCount < 1) {
            // 如果原来数量已经小于0了  肯定就是存在数据异常的情况  就不要再去减了  就直接给他赋为0
            $categoryNewCount = 0;
        } else {
            $categoryNewCount = $categoryOldCount - 1;
        }
        $this->db->where('id', $categoryId);
        $this->db->update('category', array("count" => $categoryNewCount));
    }


}