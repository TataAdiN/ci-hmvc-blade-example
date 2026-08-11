<?php
defined("BASEPATH") or exit("No direct script access allowed");

use Ramsey\Uuid\Uuid;

class M_User extends MY_Model
{
    protected $table = "users";
    protected $primary_key = "id";

    /**
     * @param array $data
     * @return object|bool
     */
    public function create(array $data): object|bool
    {
        if (!isset($data[$this->primary_key])) {
            $data[$this->primary_key] = Uuid::uuid4()->toString();
        }
        return parent::create($data);
    }
}
