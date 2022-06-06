<?php

/*
 * please add your database environment variables here
 */

$host = "localhost"; // Host name
$database = ""; // Your database name
$user = "root"; // Your database user
$password = ""; // Your database password


// This file create database and table in your local machine


//connection to the database
$pdo = new PDO("mysql:host=$host", "$user", "$password");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// create the database if it doesn't exist
$pdo->query("CREATE DATABASE IF NOT EXISTS $database");
$pdo->query("USE $database");

//create the table if it doesn't exist
$pdo->query("CREATE TABLE IF NOT EXISTS champions (
  `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `title` varchar(255) NOT NULL,
    `avatar_image` varchar(255) NOT NULL,
    `loading_image` varchar(255) NOT NULL,
    `role` varchar(255) NOT NULL,
    `description` text NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)");

return $pdo;