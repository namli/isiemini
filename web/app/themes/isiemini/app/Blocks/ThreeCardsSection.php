<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Log1x\AcfComposer\Builder;

class ThreeCardsSection extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Three Cards Section';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'A beautiful Three Cards Section block.';

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
        'title' => 'Pricing that grows with you',
        'description' => 'Choose an affordable plan that’s packed with the best features for engaging your audience, creating customer loyalty, and driving sales.',
        'cards' => [
            [
                'title' => 'Freelancer',
                'description' => 'The essentials to provide your best work for clients.',
                'button_text' => 'Buy plan',
                'button_url' => '#',
                'button_target' => '_self',
                'button_rel' => '',
                'button_class' => '',
            ],
            [
                'title' => 'Freelancer',
                'description' => 'The essentials to provide your best work for clients.',
                'button_text' => 'Buy plan',
                'button_url' => '#',
                'button_target' => '_self',
                'button_rel' => '',
                'button_class' => '',
            ],
            [
                'title' => 'Freelancer',
                'description' => 'The essentials to provide your best work for clients.',
                'button_text' => 'Buy plan',
                'button_url' => '#',
                'button_target' => '_self',
                'button_rel' => '',
                'button_class' => '',
            ],
        ]
    ];

    /**
     * The block template.
     *
     * @var array
     */
    // public $template = [
    //     'core/heading' => ['placeholder' => 'Hello World'],
    //     'core/paragraph' => ['placeholder' => 'Welcome to the Three Cards Section block.'],
    // ];

    /**
     * Data to be passed to the block before rendering.
     */
    public function with(): array
    {
        $data = [];

        foreach ($this->fields() as $field) {
            $value = get_field($field);
            if ($value) {
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
        $fields = Builder::make('three_cards_section');

        $fields
            ->addText('title')
            ->addText('description')
            ->addRepeater('cards')
            ->addText('title')
            ->addText('description')
            ->addText('button_text')
            ->addUrl('button_url')
            ->addText('button_target')
            ->addText('button_rel')
            ->addText('button_class')
            ->endRepeater();

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
