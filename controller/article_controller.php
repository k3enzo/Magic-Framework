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

			$s = $article->where('id',$id)->delete();

//			Load::viewer('article',['var'=>'data','data'=>$row]);

		}
	}
