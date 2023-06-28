<?php

namespace Supermarket\models;

use Supermarket\helpers\functionsHelper;
use Supermarket\app\database\Database;
use ReflectionClass;
use Supermarket\app\database\Config;


abstract class BaseModel {

    public function __construct() {
    }
    /**
     * @var integer
     */
    protected $n_id;

    /**
     * @var datetime
     */
    protected $updated_at;
    /**
     * @var datetime
     */
    protected $created_at;

    protected $errors = [];

    public abstract static function tableName(): string;
    //public abstract static function getById(string $tableName,int $id): array;

    public function validate(): bool {
        return true;
    }
    /**
     * Check if database engine is postgres or mysql for add the character ` for the table
     */
    protected static function getEngine() {
        $config = Config::getConfig();
        $engine = $config['db']['engine'];
        return $engine;
    }

    public function load(array $attributes) {

        $safe_attributes = array_keys($this->getAttributes());

        foreach ($attributes as $attribute => $value) {
            if (!in_array($attribute, $safe_attributes)) {
                continue;
            }

            $this->{'set_' . camelcase2UnderScore($attribute)}($value);
        }
    }

    public function save(): bool {

        if (!$this->validate()) {
            //Controller::setFlash('danger', $this->getErrors());
            return false;
        }
        $isNew = ($this->isNewRecord()) ? true : false;
        // todo takes the variable create and pass null if is update , solution when is update remote the param create_at
        if ( $isNew ) {
            $this->created_at = date('Y/m/d H:i:s');
        }

        $this->updated_at = date('Y/m/d H:i:s');

        $db = Database::getInstance();

        $variables = $this->getAttributes();

        if ( $isNew ) {
            $table = self::getEngine() === 'pgsql' ? '%s' : '`%s` ';

            $variables = array_filter($variables, static function ($element) {
                return $element !== "n_id";
            },ARRAY_FILTER_USE_KEY);

            $columns = implode(', ', array_keys($variables));

            $params = array_map(static function ($param) {
                return ':' . $param;
            }, array_keys($variables));

            $result = $db->query(
                sprintf("INSERT into {$table} (%s) VALUES (%s)", static::tableName(), $columns, implode(',', $params)),
                array_combine($params, $variables)
            );
            $this->n_id = $db->getDb()->lastInsertId();
        } else {
            // todo codigos repetindo ajustar posteriormente
            // $variables = array_filter($variables, static function ($element) {
            //     return $element !== "n_id";
            // },ARRAY_FILTER_USE_KEY);

            $columns = implode(', ', array_keys($variables));

            $params = array_map(static function ($param) {
                return ':' . $param;
            }, array_keys($variables));
            $this->update($db, $variables, $columns);
        }

        return true;
    }

    public function delete() {
        $table = self::getEngine() === 'pgsql' ? '%s' : '`%s` ';
        $db = Database::getInstance();
        try {
            $result = $db->query(
                sprintf("DELETE FROM {$table} WHERE n_id = :n_id", static::tableName()),
                [
                    ':n_id' => $this->n_id
                ]
            );
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function update($db, $variables, $columns) {
        $table = self::getEngine() === 'pgsql' ? '%s' : '`%s` ';

        $columns = array_map(static function ($column) {
            return "$column = :$column";
        }, array_keys($variables));

        $params = array_map(static function ($param) {
            return ':' . $param;
        }, array_keys($variables));

        $params = array_merge(
            array_combine($params, array_values($variables)),
            [
                ':n_id' => $this->n_id
            ]
        );

        $result = $db->query(
            sprintf("UPDATE {$table} SET %s WHERE n_id = :n_id", static::tableName(), implode(', ', $columns)),
            $params
        );
        return $result;
    }

    public static function  get($conditions = [], $all = false) {
        $db = Database::getInstance();

        $columns = array_map(static function ($column) {
            return "$column = :$column";
        }, array_keys($conditions));
        $columns = implode(' AND ', $columns);

        $params = array_map(static function ($param) {
            return ':' . $param;
        }, array_keys($conditions));

        $params = array_combine($params, array_values($conditions));
        $table = self::getEngine() === 'pgsql' ? '%s' : '`%s` ';

        $r = $db->select(
            sprintf(
                "SELECT * FROM {$table}  %s %s",
                static::tableName(),
                !empty($conditions) ? 'WHERE' : null,
                $columns
            ),
            $params
        );


        if (!empty($r)) {
            if ($all) {
                return array_map(static function ($row) {
                    $model = new static();
                    $model->load($row);
                    return $model;
                }, $r);
            } else {
                $model = new static();
                $model->load(array_shift($r));
                return $model;
            }
        }

        return $all ? [] : null;
    }

    public static function query($rawQuery, $params = []) {
        $db = Database::getInstance();

        $resultData = $db->select($rawQuery, $params);
        return $resultData;
    }

    public static function list(): array {
        return self::get([], true);
    }

    /**
     * Returns attributes and values
     *
     * @return array
     */
    public function getAttributes(): array {
        $variables = [];

        $r = new ReflectionClass($this);

        foreach ($r->getProperties() as $propertie) {
            $name = $propertie->getName();

            $variables[$name] = $this->$name;
        }

        unset($variables['errors']);

        return $variables;
    }

    /**
     * Returns true if Model is a new insert
     *
     * @return boolean
     */
    public function isNewRecord(): bool {
        return empty($this->n_id);
    }

    public function set_updated_at($updated_at): void {
        $this->updated_at = $updated_at;
    }

    /**
     * @return integer|null
     */
    public function get_updated_at() {
        return $this->updated_at;
    }

    public function set_created_at($created_at): void {
        $this->created_at = $created_at;
    }

    /**
     * @return integer|null
     */
    public function get_created_at() {
        return $this->created_at;
    }

    public function getErrors(): array {
        return $this->errors;
    }

    public function setErrors(string $key, string $value): void {
        $this->errors[$key] = $value;
    }

}
