<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db
 */
class MY_Model extends CI_Model
{
    protected $table = '';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * @param array $data
     * @return object|bool
     */
    public function create(array $data): object|bool
    {
        $this->db->trans_begin();

        $this->db->insert($this->table, $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();

            if (isset($data[$this->primary_key])) {
                return $this->find($data[$this->primary_key]);
            }

            if (!empty($search_params)) {
                $this->db->order_by($this->primary_key, 'DESC');
                $row = $this->db->where($search_params)->get($this->table)->row();

                if ($row) {
                    return $row;
                }
            }
            return (object) $data;
        }
    }

    /**
     * @param array|int|string $params 
     * @param array $data
     * @return bool
     */
    public function update(array|int|string $params, array $data): bool
    {
        $this->db->trans_begin();

        if (!is_array($params)) {
            $params = [$this->primary_key => $params];
        }

        $this->db->where($params)->update($this->table, $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    /**
     * @param array|int|string $params
     * @return bool
     */
    public function delete(array|int|string $params): bool
    {
        $this->db->trans_begin();

        if (!is_array($params)) {
            $params = [$this->primary_key => $params];
        }

        $this->db->where($params)->delete($this->table);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->db->get($this->table)->result();
    }

    /**
     * @param array|int|string $params
     * @return object|null
     */
    public function find(array|int|string $params)
    {
        if (!is_array($params)) {
            $params = [$this->primary_key => $params];
        }

        return $this->db->where($params)->get($this->table)->row();
    }

    /**
     * @param array $params
     * @return array
     */
    public function filter(array $params): array
    {
        return $this->db->where($params)->get($this->table)->result();
    }
}
