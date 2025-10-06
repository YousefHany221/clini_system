<?php

class Validator
{
    private $data;
    private $errors = [];

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function validate($value, $field, $rules)
    {
        $rules = explode('|', $rules);

        foreach ($rules as $rule) {
            if (strpos($rule, ':') !== false) {
                list($ruleName, $ruleValue) = explode(':', $rule);
            } else {
                $ruleName = $rule;
                $ruleValue = null;
            }

            switch ($ruleName) {
                case 'required':
                    if (empty($value)) {
                        $this->errors[$field][] = "$field is required";
                    }
                    break;

                case 'email':
                    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $this->errors[$field][] = "$field must be a valid email";
                    }
                    break;

                case 'min':
                    if (strlen($value) < $ruleValue) {
                        $this->errors[$field][] = "$field must be at least $ruleValue characters";
                    }
                    break;

                case 'max':
                    if (strlen($value) > $ruleValue) {
                        $this->errors[$field][] = "$field must not exceed $ruleValue characters";
                    }
                    break;

                case 'number':
                    if (!is_numeric($value)) {
                        $this->errors[$field][] = "$field must be a number";
                    }
                    break;

                case 'confirmed':
                    $confirmField = $field . '_confirmation';
                    if (isset($this->data[$confirmField]) && $value !== $this->data[$confirmField]) {
                        $this->errors[$field][] = "$field confirmation does not match";
                    }
                    break;
            }
        }
    }

    public function has_errors()
    {
        return !empty($this->errors);
    }

    public function get_errors()
    {
        return $this->errors;
    }

    public function get_error($field)
    {
        return isset($this->errors[$field]) ? $this->errors[$field] : [];
    }
}