<?php 
class users_controller extends controller {
	
		public function view()
		{
            Load::viewer("users");
		}
		public function shows($s)
        {
            echo $s;
        }
}

?>