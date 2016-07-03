<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 7/2/2016
 * Time: 9:50 PM
 */

namespace James\Versions;

use Backend\Classes\ReportWidgetBase;
use \James\Versions\Models\Version;
use \James\Versions\Models\Software;

class SoftwareWidget extends ReportWidgetBase{

    public function render(){
        $software = Software::all();
        return $this->makePartial('software', [ 'software' => $software ]);
    }

    public function defineProperties()
    {
        return [
            'title'     => [
                'title'     => 'Widget title',
                'default'   => 'Software'
            ],
            'showList'  => [
                'title'     => 'Show software',
                'type'      => 'checkbox'
            ]
        ];
    }
}