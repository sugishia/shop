<?php
$instance = new Person("uesugi", 38, "mail");


?>

<?php
/**
 * Created by PhpStorm.
 * User: xta-u
 * Date: 2018/04/17
 * Time: 17:56
 */

class Person{

    public $name;
    public $age;
    public $sex;

    public function __construct($name, $age, $sex)
    {
        $this->name = $name;
        $this->age = $age;
        $this->sex = $sex;
    }

    public function method(){

    }
}
?>

