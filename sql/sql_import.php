<?php
    require 'db.php';
    session_start();

    // if (!$mysqli->query('CREATE DATABASE implant'))
    // {
    //     printf("Errormessage: %s\n", $mysqli->error);
    // }

    $mysqli->query('
    CREATE TABLE `implant`.`users` 
    (
        `id` INT NOT NULL AUTO_INCREMENT,
        `first_name` VARCHAR(50) NOT NULL,
        `last_name` VARCHAR(50) NOT NULL,
        `email` VARCHAR(100) NOT NULL,
        `password` VARCHAR(100) NOT NULL,
        `hash` VARCHAR(32) NOT NULL,
        `active` INT NOT NULL DEFAULT 0,
        `created_at` TIMESTAMP NOT NULL DEFAULT NOW(),
        `updated_at` TIMESTAMP NOT NULL DEFAULT NOW(),
    PRIMARY KEY (`id`) 
    );') or die($mysqli->error);

     $mysqli->query('
    CREATE TABLE `implant`.`suppliers` 
    (
        `id` INT NOT NULL AUTO_INCREMENT,
        `company_name` VARCHAR(191) NOT NULL,
        `company_number` VARCHAR(191) NOT NULL,
        `company_tax` VARCHAR(191) NOT NULL,
        `company_vat` VARCHAR(191) NOT NULL,
        `company_address` VARCHAR(191) NOT NULL,
        `postal_address` VARCHAR(191) NOT NULL,
        `first_name` VARCHAR(191) NOT NULL,
        `last_name` VARCHAR(191) NOT NULL,
        `gender` VARCHAR(191) NOT NULL,
        `contact_address` VARCHAR(191) NOT NULL,
        `contact_mobile_no` VARCHAR(191) NOT NULL,
        `created_at` TIMESTAMP NOT NULL DEFAULT NOW(),
        `updated_at` TIMESTAMP NOT NULL DEFAULT NOW(),
    PRIMARY KEY (`id`) 
    );') or die($mysqli->error);

    echo "Import Success";
?>