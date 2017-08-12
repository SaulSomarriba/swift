<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'menu';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'code', 'type', 'data', 'parent_code', 'branch_code'
  ];

  /**
   * Disable Timestamps.
   */
  public $timestamps = false;
}
