<?php
require_once 'EmployeesDao.php';



$aDao = new EmployeesDao();


$a = $aDao->getAll();
print_r($a);




?>
