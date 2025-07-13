<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Log1x\AcfComposer\Builder;

class ImageAndTextContentSection extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Image And Text Content Section';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'A beautiful Image And Text Content Section block.';

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
            'background' => false,
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
        'title' => 'Image And Text Content Section',
        'description' => 'A beautiful Image And Text Content Section block.',
        'content' => 'A beautiful Image And Text Content Section block.',
        'image' => 'https://images.unsplash.com/photo-1487017159836-4e23ece2e4cf?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2102&q=80',
        'image_alt' => 'Image Alt',
    ];

    /**
     * The block template.
     *
     * @var array
     */
    // public $template = [
    //     'core/heading' => ['placeholder' => 'Hello World'],
    //     'core/paragraph' => ['placeholder' => 'Welcome to the Image And Text Content Section block.'],
    // ];

    /**
     * Data to be passed to the block before rendering.
     */
    public function with(): array
    {
        $data = [];

        $fields = [
            'title',
            'description',
            'content',
            'image',
            'image_alt',
        ];

        foreach ($fields as $field) {
            $value = get_field($field);

            if ($this->preview && empty($value) && isset($this->example[$field])) {
                $data[$field] = $this->example[$field];
            } else {
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
        $fields = Builder::make('image_and_text_content_section');

        $fields
            ->addText('title')
            ->addText('description')
            ->addWysiwyg('content', [
                'tabs' => ['text', 'visual'],
                'toolbar' => 'basic',
                'media_buttons' => false
            ])
            ->addImage('image', [
                'return_format' => 'url',
            ])
            ->addText('image_alt');

        return $fields->build();
    }

    /**
     * Retrieve the items.
     *
     * @return array
     */
    // public function items()
    // {
    //     return get_field('items') ?: $this->example['items'];
    // }

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
