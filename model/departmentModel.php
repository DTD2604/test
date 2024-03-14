<?php 
require "database/database.php";
function insertDepartment($name, $leader, $status, $beginningDate){
    $db = connectionDb();
    $flagInsert = false;
    $sqlInsert = "INSERT INTO department (`name`,`slug`, `leader`, `status`, `beginning_Date`,`status`,`created_at`) values (:nameDepartment, :slug, :leader, :beginning_date, :statusDepartment, :created_at)";
    $stmt = $db->prepare($sqlInsert);
    return $flagInsert;
}