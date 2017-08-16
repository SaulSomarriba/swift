<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class BranchSetting extends Model
{

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'branch_settings';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'branch_code', 'opening_time', 'closing_time', 'vehicle_group_code',
       'worker_group_code'
  ];

  /**
   * Disable Timestamps.
   */
  public $timestamps = false;
}