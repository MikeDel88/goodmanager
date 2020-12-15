<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Lang extends CI_Migration {

        public function up()
        {     
            $sql = 
            "ALTER TABLE `client` CHANGE `last_name` `nom` VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
            ALTER TABLE `client` CHANGE `first_name` `prenom` VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
            ALTER TABLE `client` CHANGE `birthday` `date_naissance` DATE NOT NULL;
            ALTER TABLE `client` CHANGE `address` `adresse` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;
            ALTER TABLE `client` CHANGE `zipcode` `code_postal` VARCHAR(5) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
            ALTER TABLE `client` CHANGE `city` `ville` VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
            ALTER TABLE `client` CHANGE `phone` `telephone` VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
            ALTER TABLE `entreprise` CHANGE `address` `adresse` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;
            ALTER TABLE `entreprise` CHANGE `zipcode` `code_postal` VARCHAR(5) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
            ALTER TABLE `entreprise` CHANGE `city` `ville` VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
            ALTER TABLE `users` CHANGE `last_name` `nom` VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
            ALTER TABLE `users` CHANGE `first_name` `prenom` VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
            ALTER TABLE `users` CHANGE `activate` `active` TINYINT(1) NOT NULL DEFAULT '0';
            ALTER TABLE `users` CHANGE `password` `mdp` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL;
            ALTER TABLE `rdv` CHANGE `user_id` `utilisateur_id` INT(11) NOT NULL;
            ALTER TABLE `contact` CHANGE `user_id` `utilisateur_id` INT(11) NOT NULL;
            RENAME TABLE `goodmanager`.`users` TO `goodmanager`.`utilisateurs`;
            ";
            $this->db->query($sql);

        }

        public function down(){

            
        }

}