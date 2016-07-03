<?php namespace James\Versions\Models;

use Model;

/**
 * Software Model
 */
class Software extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'james_versions_softwares';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    protected $rules = [
        'name'         => 'required|min:1'
    ];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['name'];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [ 'version' => [ 'James\Versions\Models\Version' ]];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

}