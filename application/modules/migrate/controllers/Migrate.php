<?php
defined("BASEPATH") or exit("No direct script access allowed");

/**
 * @property CI_Migration $migration
 */
class Migrate extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!is_cli()) {
            show_404();
        }
    }

    public function index()
    {
        $this->load->library("migration");
        echo "Starting Migrationn!" . PHP_EOL;
        if ($this->migration->latest() === false) {
            show_error($this->migration->error_string());
        } else {
            echo "Migration successfully executed!" . PHP_EOL;
        }
    }

    public function rollback($version = 0)
    {
        $this->load->library("migration");

        if ($this->migration->version($version) === false) {
            show_error($this->migration->error_string());
        } else {
            echo "Rollback to version " . $version . " successfully!" . PHP_EOL;
        }
    }
}
