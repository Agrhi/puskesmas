<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TreeNode
{

    // public $parent;
    public $attribute;
    public $values;
    // public $classes_count;
    public $is_leaf;

    public function setParent(TreeNode $parent)
    {
        $this->parent = $parent;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function setAttribute($attribute)
    {
        $this->attribute = $attribute;
    }

    public function addClassesCount($valueName, $classesCount = array())
    {
        $this->classes_count[$valueName] = $classesCount;
    }

    public function setIsLeaf($is_leaf = false)
    {
        $this->is_leaf = $is_leaf;
        return $this;
    }

    public function getIsLeaf()
    {
        return $this->is_leaf;
    }

    public function addChild($value, $child)
    {
        if (!isset($this->values)) {
            $this->values = [];
        }

        $this->values[$value] = $child;
        return $this;
    }

    public function getChild($value)
    {
        if ($this->hasValue($value)) {
            return $this->values[$value];
        }
    }

    public function getValues()
    {
        return array_keys($this->values);
    }

    public function getAttributeName()
    {
        return $this->attribute;
    }

    public function removeValue($value)
    {
        if ($this->hasValue($value)) {
            unset($this->values[$value]);
        }

        return $this;
    }

    public function hasValue($value)
    {
        if (!isset($this->values)) {
            return false;
        }

        return array_key_exists($value, $this->values);
    }

    public function classify(array $data)
    {
        if (isset($data[$this->attribute])) {
            $attrValue = $data[$this->attribute];

            if (!$this->hasValue($attrValue)) {
                return 'unclassified';
            }

            $child = $this->values[$attrValue];

            if (!$child->getIsLeaf()) {
                return $child->classify($data);
            } else {
                return $child->getChild('result');
            }
        }
    }

    public function toArray()
    {
        $data = [];
        $data['attribute'] = $this->attribute;
        foreach ($this->values as $key => $value) {
            if (!is_null($value)) {
                if ($value instanceof self) {
                    $data['values'][$key] = $value->toArray();
                }
            }
        }

        return $data;
    }

    public function toJson()
    {
        $data = [];
        $data['attribute'] = $this->attribute;
        foreach ($this->values as $key => $value) {
            if (!is_null($value)) {
                if ($value instanceof self) {
                    $data['values'][$key] = $value->toJson();
                }
            }
        }

        return json_encode($data);
    }

    public function toString($tabs = '')
    {
        $result = '';

        foreach ($this->values as $key => $child) {
            $result .= $tabs . $this->attribute . ' = ' . $key;

            if ($child->getIsLeaf()) {
                $classCount = $this->getInstanceCountAsString($key);
                $result .= ' : ' . $child->getChild('result') . ' ' . $classCount . "\n";
            } else {
                $result .= "\n";
                $result .= $child->toString($tabs . "|\t");
            }
        }

        return $result;
    }

    private function getClassesCountAsString($attribute_value)
    {
        $result = '(';
        $total = array_sum($this->classes_count[$attribute_value]);

        foreach ($this->classes_count[$attribute_value] as $key => $value) {
            $result .= $value . '/';
        }

        $result .= $total . ')';

        return $result;
    }

    private function getInstanceCountAsString($attribute_value)
    {
        $result = '(';
        $total = array_sum($this->classes_count[$attribute_value]);
        $child = $this->getChild($attribute_value);
        $className = $child->getChild('result');
        $classCount = $this->classes_count[$attribute_value][$className];

        if ($total > $classCount) {
            $result .= $total . '.0';
            $result .= '/' . ($total - $classCount) . '.0';
        } else {
            $result .= $classCount . '.0';
        }

        $result .= ')';

        return $result;
    }
}
