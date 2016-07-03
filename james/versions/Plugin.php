<?php namespace James\Versions;

use Backend;
use James\Versions\Controllers\Versions;
use RainLab\Blog\Models\Post;
use System\Classes\PluginBase;
use Event;
use RainLab\Blog\Controllers\Posts as PostsController;
use RainLab\Blog\Models\Post as PostModel;
use James\Versions\Models\Version;

/**
 * versions Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * @var array   Require the RainLab.Blog plugin
     */
    public $require = ['RainLab.Blog'];

    /**
     * Returns information about this plugin.
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Versions',
            'description' => 'Enable software version tagging for blog posts.',
            'author'      => 'James Thomas',
            'icon'        => 'icon-pencil'
        ];
    }

    public function boot(){
        // Extend the navigation to show versions on the left side when in the blog tab
        Event::listen('backend.menu.extendItems', function($manager) {
            $manager->addSideMenuItems('RainLab.Blog', 'blog', [
                'tags' => [
                    'label'       => 'Versions',
                    'icon'        => 'icon-clone',
                    'code'        => 'tags',
                    'owner'       => 'RainLab.Blog',
                    'url'         => Backend::url('james/versions/versions')
                ],
            ]);
        });

        // Extend the controller so we can use versions in posts
        PostsController::extendFormFields(function($form, $model, $context) {
            if (!$model instanceof PostModel) return;
            $form->addSecondaryTabFields([
                'versions' => [
                    'label'     => 'Version',
                    'tab'       => 'rainlab.blog::lang.post.tab_categories',
                    'type'      => 'dropdown',
                    'options'   => Version::listVersions($model->id),
                ]
            ]);
        });

        // Extend the model to accept versions in posts. Define the relationship here.
        PostModel::extend(function($model) {
            $model->belongsToMany['versions'] = [
                'James\Versions\Models\Version',
                'table' => 'james_versions_post_versions',
                'order' => 'version'
            ];
        });
    }

    public function registerReportWidgets(){
        return [
            'James\Versions\VersionsWidget' => [
                'label'     => 'Versions',
                'context'   => 'dashboard'
            ],
            'James\Versions\SoftwareWidget' => [
                'label'     => 'Software',
                'context'   => 'dashboard'
            ]
        ];
    }
}