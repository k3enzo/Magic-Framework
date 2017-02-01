<?php 
	class article_controller extends controller
	{
		public function index()
		{
			Load::viewer("article");
		}
		public function view($id)
		{
			$article = Load::model("article");
				
            $row = $article->get_rows("*","id = $id");

                $this->view->set('data',$row);
                $this->view->render('article');
		}
	}
