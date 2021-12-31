<?php

namespace Src\Services;

class Validator
{
    public  $rules = [
    'regex'     => [ 'ip' => '/\d+\.\d+\.\d+\.\d+:\d+/', 'name' => '/[^(\w)|(\x7F-\xFF)|(\s)]/', 'password' => '/[^(\S)]/', 'email' => '#^([\w]+\.?)+(?<!\.)@(?!\.)[a-zа-я0-9ё\.-]+\.?[a-zа-яё]{2,}$#ui'],
    'lengthMin' => [ 'email' => 3, 'name' => 3, 'password' => 5],
    'lengthMax' => [ 'email' => 50, 'name' => 13, 'password' => 56]
    ];

    public function validate($form, $rulse = [])
    {
        $this->rules['required'] = $rulse;
        $errors = [];
        foreach ($this->rules['required'] as $input) {
            if(!array_key_exists($input, $form)){
                $errors['name'] = 'Ошибка отправки формы!';
            }
        }
        if (!empty($form['name'])){ $errors['name'] = $this->validateName($form['name']); }
        if (!empty($form['password'])){ $errors['password'] = $this->validatePassword($form['password']); }
        if (!empty($form['email'])){ $errors['email'] = $this->validateEmail($form['email']); }
        if (!empty($form['ip'])){ $errors['ip'] = $this->validateIP($form['ip']); }
        return array_filter($errors, function($element) {
            return !empty($element);
        });
    }

    public function validateName($value)
    {
        $result = null;
        if (in_array('name', $this->rules['required'])) {
            $result = isset($value) ? $result : 'Поле Имя не должно быть пустым!';
        }
        if (key_exists('name', $this->rules['regex'])) {
            $result = preg_match($this->rules['regex']['name'], $value) ? 'В написании имени допустимы только буквы латинского и русского алфавита,цифры, символ подчеркивания и пробел' : $result;
        }
        if (key_exists('name', $this->rules['lengthMin'])) {
            $result = strlen($value) < $this->rules['lengthMin']['name'] ? "Длина имени должна быть от {$this->rules['lengthMin']['name']}" : $result;
        }
        if (key_exists('name', $this->rules['lengthMax'])) {
            $result = strlen($value) > $this->rules['lengthMax']['name'] ? "Длина имени должна быть до {$this->rules['lengthMax']['name']}" : $result;
        }
        return $result;
    }

    public function validatePassword($value)
    {
        $result = null;
        if (in_array('password', $this->rules['required'])) {
            $result = isset($value) ? $result : 'Поле пароль не должно быть пустым!';
        }
        if (key_exists('password', $this->rules['regex'])) {
            $result = preg_match($this->rules['regex']['password'], $value) ? 'В написании пароля допустимы только буквы латинского алфавита,цифры, символ подчеркивания' : $result;
        }
        if (key_exists('password', $this->rules['lengthMin'])) {
            $result = strlen($value) < $this->rules['lengthMin']['password'] ? "Длина пароля должна быть от {$this->rules['lengthMin']['password']}" : $result;
        }
        if (key_exists('password', $this->rules['lengthMax'])) {
            $result = strlen($value) > $this->rules['lengthMax']['password'] ? "Длина пароля должна быть до {$this->rules['lengthMax']['password']}" : $result;
        }
        return $result;
    }
    public function validateEmail($value)
    {
        $result = null;
        if (in_array('email', $this->rules['required'])) {
            $result = isset($value) ? $result : 'Поле email-адрес не должно быть пустым!';
        }
        if (key_exists('email', $this->rules['regex'])) {
            $result = preg_match($this->rules['regex']['email'], $value) ? $result : 'Недопустимый формат email-адреса';
        }
        if (key_exists('email', $this->rules['lengthMin'])) {
            $result = strlen($value) < $this->rules['lengthMin']['email'] ? "Длина email-адреса должна быть от {$this->rules['lengthMin']['email']}" : $result;
        }
        if (key_exists('email', $this->rules['lengthMax'])) {
            $result = strlen($value) > $this->rules['lengthMax']['email'] ? "Длина email-адреса должна быть до {$this->rules['lengthMax']['email']}" : $result;
        }
        return $result;
    }
    public function validateIP($value)
    {
        $result = null;
        if (in_array('ip', $this->rules['required'])) {
            $result = isset($value) ? $result : 'Поле ip-адрес не должно быть пустым!';
        }
//        if (filter_var($value, FILTER_VALIDATE_IP) === false) {
//            $result[] =  "IP-адрес указан неверно.";
//        }
        if (key_exists('ip', $this->rules['regex'])) {
            $result = preg_match($this->rules['regex']['ip'], $value) ? $result : 'IP-адрес указан неверно.';

        }
        return $result;
    }
}

