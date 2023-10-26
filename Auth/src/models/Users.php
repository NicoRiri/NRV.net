<?php

namespace NRV\auth\api\models;

class Users extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = true;

}