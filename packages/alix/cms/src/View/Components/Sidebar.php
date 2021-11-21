<?php

namespace Alix\Cms\View\Components;

use Illuminate\View\Component;

class Sidebar extends Component
{
    public $categories;
    public $current_route;
    public $menus;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->current_route = preg_replace('/\.(create|index|edit)$/', '', \Route::currentRouteName());
        $this->menus = [
            [
                'title' => '微信用户',
                'route_name' => 'cms.users',
                'id' => 'cms_users',
                'icon' => 'account',
                'has_children' => false
            ],
            [
                'title' => '中奖用户',
                'route_name' => 'cms.winners',
                'id' => 'cms_winners',
                'icon' => 'format-list-bulleted',
                'has_children' => true
            ],
            // [
            //     'title' => '设置',
            //     'route_name' => 'cms.settings',
            //     'id' => 'cms_settings',
            //     'icon' => 'format-list-bulleted',
            //     'has_children' => false
            // ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('cms::components.sidebar');
    }
}
