<?php

namespace NRV\auth\api\models;

class Users extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'users';
    protected $primaryKey = 'email';
    public $timestamps = false;
    public $keyType = 'string';
}