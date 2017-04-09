<?php

class article_model extends model
{
    protected $table = 'article';
    protected $pk = 'id';
    protected $fields = ['name','type'];


    public function getTest()
    {
         return $this->Joiner('test','articleId');
    }

}