<?php namespace James\Versions\Models;

use Model;
use Illuminate\Support\Facades\DB;
use RainLab\Blog\Models\Post;

/**
 * Version Model
 */
class Version extends Model
{
    //use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'james_versions_versions';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    protected $rules = [
        'version' => 'required|min:1'
    ];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['version','software_id'];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = ['software' => [
            'James\Versions\Models\Software',
            'table' => 'james_versions_softwares',
            'order' => 'id desc'
        ]
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    /**
     * Get software name corresponding to this version
     */
    public function getSoftwareName()
    {
        return Software::find($this->attributes['software_id'])->name;
    }

    /**
     * @return mixed key value pair of software (ID/Software Name)
     */
    public static function listSoftware(){
        foreach(Software::all() as $software){
            $returnArray[$software->id] = $software->name;
        }
        return $returnArray;
    }

    /**
     * @param null $post - A post ID, if found the version corresponding to that post (if any) will be at the head of the return array
     * @return array - An array of versions (ID/Version Name key value pairs)
     */
    public static function listVersions($post = null)
    {
        //Make sure the first value is none
        $returnArray[0] = "None";

        //Loop through and set all the software ids and names
        foreach(Version::all() as $version){
            $returnArray[$version->id] = $version->getSoftwareName() . " - " . $version->version;
        }

        //Move the current post's version to the head of the array, if passed in
        if($post){
            $post = Post::find($post);
            if($post && $post->versions->first()) {
                //Prep Array
                reset($returnArray);
                $first_key = key($returnArray);

                $returnArray = array_swap_assoc($post->versions->first()->id, $first_key, $returnArray);
            }
        }
        return $returnArray;
    }
}

/**
 * Swaps an array's head value with a specified key if found
 */
if(!function_exists('array_swap_assoc')) {
    function array_swap_assoc($key1, $key2, $array) {
        $newArray = array ();
        foreach ($array as $key => $value) {
            if ($key == $key1) {
                $newArray[$key2] = $array[$key2];
            } elseif ($key == $key2) {
                $newArray[$key1] = $array[$key1];
            } else {
                $newArray[$key] = $value;
            }
        }
        return $newArray;
    }
}