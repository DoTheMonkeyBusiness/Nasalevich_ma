<?php
/**
 * Created by PhpStorm.
 * User: ХХХ
 * Date: 16.04.2018
 * Time: 12:19
 */

class hat_foot
{
    public $title = "travel shop";
    function hat()
    {
        echo "<html>\n<head>\n";
        echo "<title> $this->title </title>";
        ?>
        </head>
        <body>
        <?php
        $size = getimagesize('active-state4.png');
        echo '<div align=right><img src="active-state4.png" '.$size[3].'></div>';
    }
    function footer()
    {
        $size = getimagesize('active-state4.png');
        echo '<p><img src="active-state4.png"'. $size[3].'></p>';
        ?>
        </body>
        </html>
        <?php
    }
}
?>

