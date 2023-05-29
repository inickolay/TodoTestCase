<?php namespace App\Models;

use PDO;
use Todo\DB;

class Task extends DB
{
    const WHITE_LIST_SORTING_FIELDS = ['name', 'email', 'text'];

    const WHITE_LIST_ORDER_FIELDS = ['ASC', 'DESC'];

    private string $tableName = 'tasks';

    public function create(string $name, string $email, string $text)
    {
        $this->query('INSERT INTO '. $this->tableName .' (name, email, text) VALUES (?, ?, ?)', [$name, $email, $text]);

        return $this->find($this->lastInsertId());
    }

    public function update(int $id, string $name, string $email, string $text, bool $status)
    {
        $this->query('UPDATE '. $this->tableName .' SET name=?, email=?, text=?, is_done=? WHERE id=?', [$name, $email, $text, $status, $id]);

        return true;
    }

    public function find(int $id)
    {
        return $this->query('SELECT * FROM '. $this->tableName .' WHERE id = ?', [$id])->fetch();
    }

    public function all()
    {
        return $this->query('SELECT * FROM '. $this->tableName)->fetchAll();
    }

    public function paginate(int $page = 1, int $perPage = 3, string $sort = 'id', string $order = 'DESC')
    {

        $start = ($page - 1) * $perPage;
        $this->getConnection()->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );

        $sort = in_array($sort, self::WHITE_LIST_SORTING_FIELDS) ? $sort : 'id';
        $order = in_array($order, self::WHITE_LIST_ORDER_FIELDS) ? $order : 'DESC';

        return $this->query('SELECT * FROM '. $this->tableName .' ORDER BY '. $sort .' '. $order .' LIMIT ?, ?', [$start, $perPage])->fetchAll();
    }

    public function count()
    {
        return $this->query('SELECT COUNT(*) FROM '. $this->tableName)->fetchColumn();
    }
}