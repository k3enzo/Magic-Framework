<?php
/**
 * Created by PhpStorm.
 * User: k3en
 * Date: 12/08/2016
 * Time: 11:26 PM
 */

print_r($data);

?>


<html>
<head>
    <title>Test</title>
</head>
<body>
    <div align="center">
        <p>

            <?php foreach($data as $row){

            echo $row['name'];

            }?>
          Name : { $data['name'] }
		  <img src='..\public\img\1.jpg'>
        </p>
        <p>
          type : { $data['type'] }
        </p>
    </div>
</body>
</html>