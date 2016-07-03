<?php namespace James\Versions\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use James\Versions\Models;
use Illuminate\Support\Facades\Input;
use Backend\Facades\Backend;

/**
 * Software Back-end Controller
 */
class Software extends Controller
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

        BackendMenu::setContext('James.Versions', 'versions', 'software');
    }

    public function store(){
        $software = new Models\Software;
        $software->name = Input::get('name');

        if( $software->save() ) {
            \Flash::success('Software added successfully.');
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