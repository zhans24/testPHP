<?php

namespace backend\Controller\interface;

interface ControllerInterface
{
    public function show();
    public function save($data);
    public function find($email);
    public function update($data, $email);
}