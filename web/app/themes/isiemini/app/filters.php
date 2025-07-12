<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'sage'));
});

/**
 * Добавляет кастомную категорию блоков в редактор Gutenberg.
 */
add_filter('block_categories_all', function ($categories) {
    // Добавляем нашу категорию в начало массива для удобства
    array_unshift($categories, [
        'slug'  => 'iesemini-theme', // Уникальный идентификатор
        'title' => 'Блоки Темы Iesemini', // Название для пользователя
        'icon'  => 'star-filled',      // Иконка из набора WordPress Dashicons
    ]);

    return $categories;
});