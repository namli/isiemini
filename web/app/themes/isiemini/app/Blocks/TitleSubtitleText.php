<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Log1x\AcfComposer\Builder;

class TitleSubtitleText extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Title Subtitle Text';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Text block with three fields and action button';

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
        'title' => 'Main Title',
        'subtitle' => 'Subtitle text here',
        'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'alignment' => 'center',
    ];

    /**
     * The block template.
     *
     * @var array
     */
    // public $template = [
    //     'core/heading' => ['placeholder' => 'Hello World'],
    //     'core/paragraph' => ['placeholder' => 'Welcome to the Title Subtitle Text block.'],
    // ];

    /**
     * Data to be passed to the block before rendering.
     */
    public function with(): array
    {
        $data = [];

        $fields = [
            'title',
            'subtitle',
            'text',
            'button_text',
            'button_url',
            'button_target',
            'button_rel',
            'alignment',
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
        $fields = Builder::make('title_subtitle_text');

        $fields
            ->addText('title')
            ->addText('subtitle')
            ->addWysiwyg('text', [
                'tabs' => ['text', 'visual'],
                'toolbar' => 'basic',
                'media_buttons' => false
            ])
            ->addText('button_text')
            ->addUrl('button_url')
            ->addSelect('button_target', ['choices' => ['', '_blank', '_self', '_parent', '_top']])
            ->addSelect('button_rel', ['choices' => ['', 'noopener noreferrer', 'nofollow', 'noreferrer']])
            ->addSelect('alignment', [
                'label' => 'Alignment / Выравнивание',
                'choices' => [
                    'left' => 'Left / Лево',
                    'center' => 'Center / Центр',
                    'right' => 'Right / Право',
                ],
                'default_value' => 'center',
            ]);

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
