<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Test extends CI_Migration {

        public function up()
        {     
            $sql = "ALTER TABLE `client` ADD `latitude` DECIMAL(10,8) NOT NULL AFTER `updated_at`";
            $this->db->query($sql);

            $sql = "ALTER TABLE `client` ADD `longitude` DECIMAL(11,8) NOT NULL AFTER `latitude`";
            $this->db->query($sql);
        }

}






