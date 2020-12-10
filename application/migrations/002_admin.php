<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Admin extends CI_Migration {

        public function up()
        {     
            $sql = "ALTER TABLE `users` ADD `admin` BOOLEAN NOT NULL DEFAULT FALSE AFTER `activate`";
            $this->db->query($sql);

            $sql = "UPDATE `users` SET admin = 1";
            $this->db->query($sql);
        }

        public function down(){

            $sql = "ALTER TABLE `users` DROP `admin`";
            $this->db->query($sql);
            
        }

}
