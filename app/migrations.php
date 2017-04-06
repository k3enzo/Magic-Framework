<?php

class article_migrate
{

    function Fields()
    {
        $mig = new migration();

        $mig->int('id')->autoinc;
        $mig->varchar('name');
        $mig->varchar('name_en');
    }

}

?>