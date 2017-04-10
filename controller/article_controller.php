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



			Auth::login('k3en','k3en');

//			var_dump(
//			$article->where('name',1)->OrWhere('type',455)->get()
//		);

//			Load::viewer('article',['var'=>'data','data'=>$row]);

		}

	}
