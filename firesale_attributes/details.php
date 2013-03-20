<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Firesale_Attributes extends Module
{
    public $version = '1.0.0';
    public $language_file = 'firesale_attributes/firesale';

    public function __construct()
    {
        parent::__construct();
        $this->load->library('firesale/firesale');
        $this->lang->load($this->language_file);
    }

    public function info()
    {

        $info = array(
            'name' => array(
                'en' => 'FireSale Attributes'
            ),
            'description' => array(
                'en' => 'Product attribute management.'
            ),
            'frontend' 		=> false,
            'backend' 		=> false,
            'menu'	   		=> 'FireSale',
            'author' 		=> 'Jamie Holdroyd'
        );

        return $info;
    }

    public function install()
    {

        ################
        ## ATTRIBUTES ##
        ################

        $this->db->query("CREATE TABLE `".SITE_REF."_firesale_attributes` (
                          `id` INT( 6 ) NOT NULL AUTO_INCREMENT,
                          `title` VARCHAR( 255 ) NOT NULL,
                          PRIMARY KEY ( `id` ))
                          ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

        ###########################
        ## ATTRIBUTE ASSIGNMENTS ##
        ###########################

        $this->db->query("CREATE TABLE `".SITE_REF."_firesale_attributes_assignments` (
                          `ordering_count` INT( 3 ) NOT NULL DEFAULT 0,
                          `stream_id` INT( 6 ) NOT NULL,
                          `row_id` INT( 6 ) NOT NULL,
                          `attribute_id` INT( 6 ) NOT NULL,
                          `value` TEXT NOT NULL,
                          INDEX (`stream_id`, `row_id`, `attribute_id`),
                          FULLTEXT (`value`))
                          ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

        // Return
        return TRUE;
    }

    public function uninstall()
    {

        // Drop tables
        $this->db->query("DROP TABLE `".SITE_REF."_firesale_attributes`");
        $this->db->query("DROP TABLE `".SITE_REF."_firesale_attributes_assignments`");

        // Return
        return TRUE;
    }

    public function upgrade($old_version)
    {
        // Your Upgrade Logic
        return TRUE;
    }

    public function help()
    {
        return "Some Help Stuff";
    }

}
