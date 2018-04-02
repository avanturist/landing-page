<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //
    protected $table = 'pages';
    protected $primaryKey = 'id';

    public $incrementing = true;
    public $timestamps = true;
    /*доступ до колонок таблиці для запису в них інфо*/
    public $fillable = ['name','alias','text','images'];
}
