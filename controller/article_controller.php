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
			var_dump(
				$article->getTest()->get()
			);

//			Load::viewer('article',['var'=>'data','data'=>$row]);

		}

	}
