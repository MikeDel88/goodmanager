<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Test extends CI_Migration {

        public function up()
        {     
            $sql = "ALTER TABLE `client` ADD `lat` DECIMAL(10,8) NOT NULL AFTER `city`";
            $this->db->query($sql);

            $sql = "ALTER TABLE `client` ADD `lng` DECIMAL(11,8) NOT NULL AFTER `lat`";
            $this->db->query($sql);
        }

}






