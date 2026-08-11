<?php
defined("BASEPATH") or exit("No direct script access allowed");

/**
 * @property CI_DB_forge $dbforge
 */
class Migration_Create_users_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            "id" => [
                "type" => "VARCHAR",
                "constraint" => 36,
            ],
            "name" => [
                "type" => "VARCHAR",
                "constraint" => "255",
            ],
            "email" => [
                "type" => "VARCHAR",
                "constraint" => "255",
                "unique" => true,
            ],
            "email_verified_at" => [
                "type" => "TIMESTAMP",
                "null" => true,
            ],
            "password" => [
                "type" => "VARCHAR",
                "constraint" => "255",
            ],
            "remember_token" => [
                "type" => "VARCHAR",
                "constraint" => "100",
                "null" => true,
            ],
            "created_at" => [
                "type" => "TIMESTAMP",
                "null" => true,
            ],
            "updated_at" => [
                "type" => "TIMESTAMP",
                "null" => true,
            ],
        ]);

        $this->dbforge->add_key("id", true);
        $this->dbforge->create_table("users");
    }

    public function down()
    {
        $this->dbforge->drop_table("users");
    }
}
