<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class App extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        '*',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'siteName' => $this->siteName(),
            'primaryMenu' => $this->getNavMenuItems('primary_navigation'),
        ];
    }

    /**
     * Retrieve the site name.
     */
    public function siteName(): string
    {
        return get_bloginfo('name', 'display');
    }

    /**
     * Возвращает пункты меню в виде массива.
     *
     * @param string $location
     * @return array|false
     */
    public function getNavMenuItems($location)
    {
        if (!has_nav_menu($location)) {
            return false;
        }

        $locations = get_nav_menu_locations();
        $menu = wp_get_nav_menu_object($locations[$location]);
        $menu_items = wp_get_nav_menu_items($menu->term_id, ['order' => 'DESC']);

        // Добавляем проверку на текущий активный пункт
        // foreach ($menu_items as $key => $item) {
        //     dd($item);
        //     if (in_array('current-menu-item', $item->classes) || in_array('current-page-ancestor', $item->classes)) {
        //         $menu_items[$key]->is_current = true;
        //     } else {
        //         $menu_items[$key]->is_current = false;
        //     }
        // }

        return $menu_items;
    }
}
