<?php namespace James\Versions\Controllers;

use BackendMenu;
use Illuminate\Support\Facades\Input;
use Backend\Classes\Controller;
use James\Versions\Models;
use Backend\Facades\Backend;

/**
 * Versions Back-end Controller
 */
class Versions extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('James.Versions', 'versions', 'versions');
    }
    public function store(){
        $version = new Models\Version;
        $version->software_id = Input::get('software_id');
        $version->version = Input::get('version');

        if( $version->save() ) {
            \Flash::success('Version added successfully.');
        }
        else{
            \Flash::error('Validation error' );
        }

        return \Redirect::to( Backend::url() );
    }

    public function index(){
        $this->makeLists();
        $this->makeView('index');
    }
}