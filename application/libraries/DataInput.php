<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once __DIR__ . '/../libraries/DataInputInterface.php';

class DataInput implements DataInputInterface
{
    public $file = array();
    public $data = array();
    public $classes = array();
    public $attributes = array();

    public function setFile($path_to_file)
    {
    }

    public function setAttributes($attributes = array())
    {
        $this->attributes = $attributes;
    }

    public function hasAttribute($attribute)
    {
        return array_search($attribute, $this->attributes) !== false;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function setData($data = array())
    {
        $this->data = $data;
        $this->populateClasses();
    }

    public function getData($start = 0, $length = null)
    {
        if ($length == null) {
            return $this->data;
        } else {
            return array_slice($this->data, $start, $length);
        }
    }

    public function getClasses($attributes = array())
    {
        if (!empty($attributes)) {
            $result = array();

            foreach ($attributes as $value) {
                if ($this->hasAttribute($value)) {
                    $result[$value] = $this->classes[$value];
                }
            }

            return $result;
        } else {
            return $this->classes;
        }
    }

    protected function populateClasses()
    {
        if (is_array($this->data)) {
            $this->classes = array();

            foreach ($this->data as $row) {
                foreach ($row as $key => $value) {
                    if (array_key_exists($key, $this->classes)) {
                        if (array_search($value, $this->classes[$key]) === false) {
                            $this->classes[$key][] = $value;
                        }
                    } else {
                        $this->classes[$key] = array($value);
                    }
                }
            }
        }
    }

    public function getByCriteria($criteria = array(), $length = null)
    {
        $result = array();

        foreach ($this->data as $row) {
            if ($length === 0) {
                break;
            }
            if ($this->isMatch($row, $criteria)) {
                $result[] = $row;
                --$length;
            }
        }

        return $result;
    }

    public function countByCriteria($criteria = array())
    {
        $result = 0;

        foreach ($this->data as $row) {
            if ($this->isMatch($row, $criteria)) {
                ++$result;
            }
        }

        return $result;
    }

    private function isMatch($data, $criteria)
    {
        $result = true;

        foreach ($criteria as $key => $value) {
            if ($this->hasAttribute($key)) {
                if (is_array($data)) {
                    if ($data[$key] != $value) {
                        $result = $result && false;
                    }
                } elseif (is_object($data)) {
                    if ($data->{$key} != $value) {
                        $result = $result && false;
                    }
                } else {
                    $result = false;
                }
            }
        }

        return $result;
    }
}
