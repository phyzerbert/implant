<?php
    require '../db.php';
    session_start();

    // if (!$mysqli->query('CREATE DATABASE implant'))
    // {
    //     printf("Errormessage: %s\n", $mysqli->error);
    // }

    // $mysqli->query('
    // CREATE TABLE `implant`.`users` 
    // (
    //     `id` INT NOT NULL AUTO_INCREMENT,
    //     `first_name` VARCHAR(50) NOT NULL,
    //     `last_name` VARCHAR(50) NOT NULL,
    //     `email` VARCHAR(100) NOT NULL,
    //     `password` VARCHAR(100) NOT NULL,
    //     `hash` VARCHAR(32) NOT NULL,
    //     `active` INT NOT NULL DEFAULT 0,
    //     `created_at` TIMESTAMP NOT NULL DEFAULT NOW(),
    //     `updated_at` TIMESTAMP NOT NULL DEFAULT NOW(),
    //     PRIMARY KEY (`id`) 
    // );') or die($mysqli->error);

     $mysqli->query('
    CREATE TABLE `implant`.`suppliers` 
    (
        `id` INT NOT NULL AUTO_INCREMENT,
        `user_id` INT(11),
        `reference_no` VARCHAR(191),
        `company_name` VARCHAR(191),
        `company_number` VARCHAR(191),
        `company_tax` VARCHAR(191),
        `company_vat` VARCHAR(191),
        `company_address` VARCHAR(191),
        `postal_address` VARCHAR(191),
        `company_contact_person` VARCHAR(191),
        `company_telephone` VARCHAR(191),
        `company_email` VARCHAR(191),
        `company_fax` VARCHAR(191),
        `company_website` VARCHAR(191),
        `business_primary_category` VARCHAR(191),
        `business_direct` VARCHAR(191),
        `business_indirect` VARCHAR(191),
        `financial_capacity` VARCHAR(191),
        `financial_declare` VARCHAR(191),
        `bank_account` VARCHAR(191),
        `bank_name` VARCHAR(191),
        `bank_account_number` VARCHAR(191),
        `bank_branch_code` VARCHAR(191),
        `bank_swift_code` VARCHAR(191),
        `document_company_registration` VARCHAR(191),
        `document_tax` VARCHAR(191),
        `document_bee` VARCHAR(191),
        `document_id_document` VARCHAR(191),
        `document_terms` VARCHAR(191),
        `created_at` TIMESTAMP NOT NULL DEFAULT NOW(),
        `updated_at` TIMESTAMP NOT NULL DEFAULT NOW(),
        PRIMARY KEY (`id`),
        FOREIGN KEY (user_id) REFERENCES users(id)
    );') or die($mysqli->error);

    echo "Import Success";
?>