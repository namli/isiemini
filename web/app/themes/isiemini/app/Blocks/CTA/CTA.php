<?php

namespace App\Blocks\CTA;

use Log1x\AcfComposer\Block;
use Log1x\AcfComposer\Builder;

class CTA extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'CTA';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Click to action block';

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
        'title' => 'Boost your productivity. Start using our app today.',
        'description' => 'Incididunt sint fugiat pariatur cupidatat consectetur sit cillum anim id veniam aliqua proident excepteur commodo do ea.',
        'button_text' => 'Get started',
        'button_url' => '#',
        'button_target' => '_self',
        'button_rel' => 'nofollow',
        'button_class' => 'bg-indigo-600 text-white',
    ];

    /**
     * The block template.
     *
     * @var array
     */
    // public $template = [
    //     'core/heading' => ['placeholder' => 'Hello World'],
    //     'core/paragraph' => ['placeholder' => 'Welcome to the C T A block.'],
    // ];

    /**
     * Data to be passed to the block before rendering.
     */
    public function with(): array
    {
        return [
            'title' => get_field('title') ?: $this->example['title'],
            'description' => get_field('description') ?: $this->example['description'],
            'button_text' => get_field('button_text') ?: $this->example['button_text'],
            'button_url' => get_field('button_url') ?: $this->example['button_url'],
            'button_target' => get_field('button_target') ?: $this->example['button_target'],
            'button_rel' => get_field('button_rel') ?: $this->example['button_rel'],
            'button_class' => get_field('button_class') ?: $this->example['button_class'],
        ];
    }

    /**
     * The block field group.
     */
    public function fields(): array
    {
        $fields = Builder::make('c_t_a');

        $fields
            ->addText('title')
            ->addText('description')
            ->addText('button_text')
            ->addUrl('button_url')
            ->addText('button_target')
            ->addText('button_rel')
            ->addText('button_class');

        return $fields->build();
    }

    /**
     * Retrieve the items.
     *
     * @return array
     */
    public function items()
    {
        return get_field('items') ?: $this->example['items'];
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
