<?php

namespace App\Classes;

use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * This class is incharge of all validation requests
 */
class ValidateRequest
{
    private static $error = [];
    private static $error_messages = [
        'string' => 'The :attribute field cannot contain numbers or special charectors',
        'required' => 'The :attribute field is required',
        'number' => 'The :attribute field must be numbers only',
        'unique' => 'The :attribute field is already taken, please try another one',
        'idNumberLength' => 'The :attribute field must be 13 numbers, please try again'
    ];

    /**
     * do validation
     *
     * @param array $dataAndValues, column and value to validate
     * @param array $policies, the rules that values must certisfy
     * @return void
     */
    public function abide(array $dataAndValues, array $policies)
    {
        foreach ($dataAndValues as $column => $value) {
            if (in_array($column, array_keys($policies))) {
                // do validation
                self::doValidation([

                    'column' => $column,
                    'value' => $value,
                    'policies' => $policies[$column],
                ]);
            }
        }
    }
    /**
     * Perform validation for the data provided and set error messages
     *
     * @param array $data
     * @return void
     */
    private static function doValidation(array $data)
    {
        $column = $data['column'];

        foreach ($data['policies'] as $rule => $policy) {
            $valid = call_user_func_array([self::class, $rule], [$column, $data['value'], $policy]);
            if (!$valid) {
                self::setError(
                    str_replace([':attribute', ':policy', '_'],
                        [$column, $policy, ' '],
                        self::$error_messages[$rule]), $column
                );
            }
        }
    }
    /**
     * check unique values
     *
     * @param [type] $column, filed name / column in the table
     * @param [type] $value, what is submitted
     * @param [type] $policy, the rule that we set i.e min = 5
     * @return bool
     */
    protected static function unique($column, $value, $policy)
    {
        if ($value != null && !empty(trim($value))) {
            return !Capsule::table($policy)->where($column, '=', $value)->exists();
        }
        return true;
    }

    /**
     * making values required
     *
     * @param [type] $column
     * @param [type] $value
     * @param [type] $policy
     * @return void
     */
    protected static function required($column, $value, $policy)
    {
        return $value !== null && !empty(trim($value));
    }
    
    /**
     * we only want strings here
     *
     * @param [type] $column
     * @param [type] $value
     * @param [type] $policy
     * @return bool
     */
    protected static function string($column, $value, $policy)
    {
        if ($value !== null && !empty(trim($value))) {
            if (!preg_match("/^[a-zA-Z\s]+$/", $value)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Only allow numbers
     *
     * @param [type] $column
     * @param [type] $value
     * @param [type] $policy
     * @return bool
     */
    protected static function number($column, $value, $policy)
    {
        if ($value !== null && !empty(trim($value))) {
            if (!preg_match('/^[0-9.]+$/', $value)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Check length of id number 
     *
     * @param [type] $column 
     * @param [type] $value 
     * @param [type] $policy 
     * @return bool
     */ 
    protected static function idNumberLength($column, $value, $policy)
    {
        if ($value !== null && !empty(trim($value))) {
            return strLen($value) == $policy;
        }

        return true;
    }

    private static function setError($error, $key = null)
    {
        if ($key) {
            self::$error[$key][] = $error;
        } else {
            self::$error[] = $error;
        }
    }
    /**
     * return true if there's an error
     *
     * @return bool
     */
    public function hasError()
    {
        return count(self::$error) > 0 ? true : false;
    }

    /**
     * return all validation error messages
     *
     * @return void
     */
    public function getErrorMessages()
    {
        return self::$error;
    }
}