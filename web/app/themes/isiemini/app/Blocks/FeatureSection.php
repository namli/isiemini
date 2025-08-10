<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Log1x\AcfComposer\Builder;

class FeatureSection extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Feature Section';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'A beautiful Feature Section block.';

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
        'title' => 'Feature Section',
        'description' => 'A beautiful Feature Section block.',
        'features' => [
            ['title' => 'Feature one', 'description' => 'Feature one description', 'icon' => 'IMAGE', 'link_text' => 'Feature one link', 'link_url' => 'Feature one link url', 'link_target' => '_blank', 'link_rel' => 'noopener noreferrer'],
            ['title' => 'Feature two', 'description' => 'Feature two description', 'icon' => 'IMAGE', 'link_text' => 'Feature two link', 'link_url' => 'Feature two link url', 'link_target' => '_blank', 'link_rel' => 'noopener noreferrer'],
            ['title' => 'Feature three', 'description' => 'Feature three description', 'icon' => 'IMAGE', 'link_text' => 'Feature three link', 'link_url' => 'Feature three link url', 'link_target' => '_blank', 'link_rel' => 'noopener noreferrer'],
        ],
    ];

    /**
     * The block template.
     *
     * @var array
     */
    // public $template = [
    //     'core/heading' => ['placeholder' => 'Hello World'],
    //     'core/paragraph' => ['placeholder' => 'Welcome to the Feature Section block.'],
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
            'features',
        ];

        foreach ($fields as $field) {
            if ($field === 'features') {
                $data[$field] = $this->features();
                if ($this->preview && empty($data[$field]) && isset($this->example[$field])) {
                    $data[$field] = $this->example[$field];
                }
            } else {
                $value = get_field($field);
                if ($this->preview && empty($value) && isset($this->example[$field])) {
                    $data[$field] = $this->example[$field];
                } else {
                    $data[$field] = $value;
                }
            }
        }

        return $data;
    }

    /**
     * The block field group.
     */
    public function fields(): array
    {

        $fields = Builder::make('feature_section');

        $fields
            ->addText('title')
            ->addText('description')
            ->addRepeater('features', [
                'layout' => 'block',
            ])
            ->addText('title')
            ->addText('description')
            ->addText('link_text')
            ->addUrl('link_url')
            ->addSelect('link_target', ['choices' => ['', '_blank', '_self', '_parent', '_top']])
            ->addSelect('link_rel', ['choices' => ['', 'noopener noreferrer', 'nofollow', 'noreferrer']])
            ->addField('icon', 'svg_icon_picker', [
                'label'         => 'Icon',
                'return_format' => 'icon', // or 'icon'
            ])
            ->endRepeater();

        return $fields->build();
    }

    /**
     * Retrieve the features.
     *
     * @return array
     */
    public function features()
    {
        return get_field('features') ?: $this->example['features'];
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
