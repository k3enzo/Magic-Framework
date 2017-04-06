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

			$s = $article->where('id',$id)->update(['name'=>'mohi','type'=>'kitchen']);

			if($s)
				echo 'yesss';
			else
				echo 'nooo';

//			Load::viewer('article',['var'=>'data','data'=>$row]);

		}
	}
