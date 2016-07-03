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

class VersionsWidget extends ReportWidgetBase{

    public function render(){

        $versions = Version::all();
        $software = Software::all();
        return $this->makePartial('versions', [ 'software' => $software, 'versions' => $versions ]);
    }

    public function defineProperties()
    {
        return [
            'title'     => [
                'title'     => 'Widget title',
                'default'   => 'Versions'
            ],
            'showList'  => [
                'title'     => 'Show versions',
                'type'      => 'checkbox'
            ]
        ];
    }
}