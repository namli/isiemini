<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Log1x\AcfComposer\Builder;

class HeroSection extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Hero Section';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Hero section with image on right';

    /**
     * The block category.
     *
     * @var string
     */
    public $category = 'iesemini-theme';

    /**
     * The block icon.
     *
     * @var string|array
     */
    public $icon = 'editor-ul';

    /**
     * The block keywords.
     *
     * @var array
     */
    public $keywords = [];

    /**
     * The block post type allow list.
     *
     * @var array
     */
    public $post_types = [];

    /**
     * The parent block type allow list.
     *
     * @var array
     */
    public $parent = [];

    /**
     * The ancestor block type allow list.
     *
     * @var array
     */
    public $ancestor = [];

    /**
     * The default block mode.
     *
     * @var string
     */
    public $mode = 'preview';

    /**
     * The default block alignment.
     *
     * @var string
     */
    public $align = '';

    /**
     * The default block text alignment.
     *
     * @var string
     */
    public $align_text = '';

    /**
     * The default block content alignment.
     *
     * @var string
     */
    public $align_content = '';

    /**
     * The default block spacing.
     *
     * @var array
     */
    public $spacing = [
        'padding' => null,
        'margin' => null,
    ];

    /**
     * The supported block features.
     *
     * @var array
     */
    public $supports = [
        'align' => false,
        'align_text' => false,
        'align_content' => false,
        'full_height' => false,
        'anchor' => false,
        'mode' => true,
        'multiple' => true,
        'jsx' => true,
        'color' => [
            'background' => true,
            'text' => false,
            'gradients' => false,
        ],
        'spacing' => [
            'padding' => false,
            'margin' => false,
        ],
    ];

    /**
     * The block styles.
     *
     * @var array
     */
    public $styles = ['light', 'dark'];

    /**
     * The block preview example data.
     *
     * @var array
     */
    public $example = [
        'title' => 'Data to enrich your business',
        'description' => 'Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo. Elit sunt amet fugiat veniam occaecat.',
        'button_text' => 'Get started',
        'button_url' => '#',
        'button_target' => '_self',
        'button_rel' => 'nofollow',
        'button_class' => 'bg-indigo-600 text-white',
        'link_text' => 'Learn more',
        'link_url' => '#',
        'link_target' => '_self',
        'link_rel' => 'nofollow',
        'link_class' => 'text-gray-900',
        'image' => 'https://images.unsplash.com/photo-1487017159836-4e23ece2e4cf?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2102&q=80',
        'image_alt' => 'Hero image',
    ];

    /**
     * The block template.
     *
     * @var array
     */
    // public $template = [
    //     'core/heading' => ['placeholder' => 'Hello World'],
    //     'core/paragraph' => ['placeholder' => 'Welcome to the Hero Section block.'],
    // ];

    /**
     * Data to be passed to the block before rendering.
     */
    public function with(): array
    {
        $data = [];

        // Собираем все наши поля в один массив для удобства
        $fields = [
            'title',
            'description',
            'button_text',
            'button_url',
            'button_target',
            'button_rel',
            'button_class',
            'link_text',
            'link_url',
            'link_target',
            'link_rel',
            'link_class',
            'image',
            'image_alt'
        ];

        foreach ($fields as $field) {
            // Получаем значение поля из базы данных
            $value = get_field($field);

            // Главная логика:
            // Если мы в превью редактора И значение поля пустое...
            if ($this->preview && empty($value) && isset($this->example[$field])) {
                // ...тогда берем значение из массива $this->example
                $data[$field] = $this->example[$field];
            } else {
                // ...в противном случае (на живом сайте или если поле заполнено)
                // берем реальное значение (даже если оно пустое)
                $data[$field] = $value;
            }
        }

        return $data;
    }

    /**
     * The block field group.
     */
    public function fields(): array
    {
        $fields = Builder::make('hero_section');

        $fields
            ->addText('title')
            ->addText('description')
            ->addText('button_text')
            ->addUrl('button_url')
            ->addText('button_target')
            ->addText('button_rel')
            ->addText('button_class')
            ->addText('link_text')
            ->addUrl('link_url')
            ->addText('link_target')
            ->addText('link_rel')
            ->addText('link_class')
            ->addImage('image')
            ->addText('image_alt');

        return $fields->build();
    }


    /**
     * Assets enqueued with 'enqueue_block_assets' when rendering the block.
     *
     * @link https://developer.wordpress.org/block-editor/how-to-guides/enqueueing-assets-in-the-editor/#editor-content-scripts-and-styles
     */
    public function assets(array $block): void
    {
        //
    }
}
