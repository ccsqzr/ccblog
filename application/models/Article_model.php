<?php

/**
 * Created by PhpStorm.
 * User: sqzr
 * Date: 2017/2/13
 * Time: 15:21
 */
class Article_model extends CI_Model
{

    public function count()
    {
        return $this->db->count_all("article");
    }
    public function getAllByPage($page){
        $pageCount = 10;
        $start = ($page - 1) * 10;
        $this->db->select('a.id as articleId,a.title,a.content,a.author,a.create_date,c.id as categoryId,c.name,a.category,a.visit');
        $this->db->from('article a');
        $this->db->join('category c', 'c.id=a.category', 'left');
        $this->db->limit($pageCount,$start);
        $query = $this->db->get();
        return $query->result_array();
        // 第一页
        // select * from article limit 0,10;
        // 第二页
        // select * from article limit 10,10;
        // 第三页
        // select * from article limit 20,10;
        // 第四页
        // select * from article limit 30,10;
        // 第五页
        // select * from article limit 40,10;
    }

    public function getAll()
    {
        $this->db->select('a.id as articleId,a.title,a.content,a.author,a.create_date,c.id as categoryId,c.name,a.category');
        $this->db->from('article a');
        $this->db->join('category c', 'c.id=a.category', 'left');
        $query = $this->db->get();
        return $query->result_array();

    }

    public function getById($articleId)
    {
        $this->db->select('a.id as articleId,a.visit,a.title,a.content,a.author,a.create_date,c.id as categoryId,c.name');
        $this->db->from('article a');
        $this->db->join('category c', 'a.category = c.id', "left");
        $this->db->where('a.id', $articleId);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getByCategoryId($categoryId)
    {
        $this->db->select('a.id as articleId,a.title,a.content,a.author,a.create_date,c.id as categoryId,c.name');
        $this->db->from('article a');
        $this->db->join('category c', 'a.category = c.id', "left");
        $this->db->where('c.id', $categoryId);
        $query = $this->db->get();
        return $query->result_array();

    }

    public function input($data)
    {
        // 你这里insert到哪张表安
        $this->db->insert('article', $data);
    }

    public function delete($articleId)
    {
        // 这里哪里有a嘛 就是id
        $this->db->where('id', $articleId);
        $this->db->delete('article');
        return $this->db->affected_rows() > 0;
    }

    public function update($articleId, $data)
    {
        $this->db->where('id', $articleId);
        $this->db->update('article', $data);
        return $this->db->affected_rows() > 0;
    }
    public function search($keyWord){
        $this->db->select('a.id as articleId,a.title,a.content,a.author,a.create_date,c.id as categoryId,c.name,a.category,a.visit');
        $this->db->from('article a');
        $this->db->join('category c', 'c.id=a.category', 'left');
        $this->db->like('a.title', $keyWord);
        $this->db->or_like('a.content',$keyWord);
        return $this->db->get()->result_array();
    }
    public function visitCount($articleId){
        //首先查出分类
        $article = $this->db->get_where('article', array("id" => $articleId))->row_array();
        //拿到分类原本有多少文章数
        $OldVisitCount = $article['visit'];
        if ($OldVisitCount == null ) {
            // 如果原来数量已等于经0，就直接给他赋为1
            $NewVisitCount = 1;
        } else {
            $NewVisitCount = $OldVisitCount +1;
        }
        $this->db->where('id', $articleId);
        $this->db->update('article', array("visit" =>$NewVisitCount ));

    }

}
