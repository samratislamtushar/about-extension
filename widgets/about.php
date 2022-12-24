<?php

/**
 * Elementor About Us Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Dayerdrops_Widget extends \Elementor\Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve About Us widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'About Us';
    }

    /**
     * Get widget title.
     *
     * Retrieve About Us widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('About Us', 'layerdrops');
    }

    /**
     * Get widget icon.
     *
     * Retrieve About Us widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'fas fa-bullhorn';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the About Us widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['Layerdrops'];
    }

    /**
     * Register About Us widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {



        // section title
        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__('Title & Content', 'layerdrops'),
            ]
        );
        // subtitle
        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__('Sub Title', 'layerdrops'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('About subtitle here', 'layerdrops'),
                'placeholder' => esc_html__('Type your subtitle here', 'layerdrops'),
                'label_block' => true,
            ]
        );


        // title
        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'layerdrops'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Here is your about title', 'layerdrops'),
                'placeholder' => esc_html__('Type your title here', 'layerdrops'),
                'label_block' => true,
            ]
        );
        // description 
        $this->add_control(
            'desctiption',
            [
                'label' => esc_html__('Description', 'layerdrops'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been', 'layerdrops'),
                'placeholder' => esc_html__('Type your description here', 'layerdrops'),
            ]
        );

        $this->add_control(
            'tp_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'layerdrops'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'layerdrops'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'layerdrops'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'layerdrops'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'layerdrops'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'layerdrops'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'layerdrops'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );
        $this->add_responsive_control(
            'lds_align',
            [
                'label' => esc_html__('Alignment', 'layerdrops'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'layerdrops'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'layerdrops'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'layerdrops'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};'
                ]
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'about_feature',
            [
                'label' => esc_html__('Features List', 'layerdrops'),
            ]
        );
        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
            'features_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'layerdrops'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'layerdrops'),
                    'icon' => esc_html__('Icon', 'layerdrops'),
                ],
            ]
        );

        $repeater->add_control(
            'features_selected_icon_img',
            [
                'label' => esc_html__('Upload Icon Image', 'layerdrops'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'condition' => [
                    'features_icon_type' => 'image'
                ]

            ]
        );
        if (is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'features_icon',
                [
                    'show_label' => false,
                    'type' => \Elementor\Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa-solid fa-check',
                    'condition' => [
                        'features_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'features_selected_icon',
                [
                    'show_label' => false,
                    'type' => \Elementor\Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'features_icon_type' => 'icon'
                    ]
                ]
            );
        }


        $repeater->add_control(
            'features_title',
            [
                'label' => esc_html__('Title', 'layerdrops'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Feature Title', 'layerdrops'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'features_description',
            [
                'label' => esc_html__('Description', 'layerdrops'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Feature Description', 'layerdrops'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'features_list',
            [
                'label' => esc_html__('Feature - List', 'layerdrops'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'prevent_empty' => false,
                'default' => [
                    [
                        'features_title' => esc_html__('Discover', 'layerdrops'),
                        'features_description' => esc_html__('Discover', 'layerdrops')
                    ],
                    [
                        'features_title' => esc_html__('Define', 'layerdrops')
                    ],
                ],
                'title_field' => '{{{ features_title }}}',
            ]
        );
        $this->end_controls_section();


        // btn button group
        $this->start_controls_section(
            'tp_btn_button_group',
            [
                'label' => esc_html__('Button', 'layerdrops'),
            ]
        );

        $this->add_control(
            'tp_btn_button_show',
            [
                'label' => esc_html__('Show Button', 'layerdrops'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'layerdrops'),
                'label_off' => esc_html__('Hide', 'layerdrops'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'btn_text',
            [
                'label' => esc_html__('Button Text', 'layerdrops'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'layerdrops'),
                'title' => esc_html__('Enter button text', 'layerdrops'),
                'label_block' => true,
                'condition' => [
                    'tp_btn_button_show' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'btn_link_type',
            [
                'label' => esc_html__('Button Link Type', 'layerdrops'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'label_block' => true,
                'condition' => [
                    'tp_btn_button_show' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'tp_btn_link',
            [
                'label' => esc_html__('Button link', 'layerdrops'),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'layerdrops'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'condition' => [
                    'btn_link_type' => '1',
                    'tp_btn_button_show' => 'yes'
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'btn_page_link',
            [
                'label' => esc_html__('Select Button Page', 'layerdrops'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'btn_link_type' => '2',
                    'tp_btn_button_show' => 'yes'
                ]
            ]
        );
        $this->end_controls_section();


        // image
        $this->start_controls_section(
            'image',
            [
                'label' => esc_html__('Image', 'layerdrops'),
            ]
        );
        $this->add_control(
            'ab-image',
            [
                'label' => esc_html__('Choose Image', 'layerdrops'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'ab-image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->end_controls_section();

        // clint Info
        $this->start_controls_section(
            'cxtra-info',
            [
                'label' => esc_html__('Extra info', 'layerdrops'),
            ]
        );

        // info 
        $this->add_control(
            'client-info',
            [
                'label' => esc_html__('Client Info', 'layerdrops'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => custom_kses('Trusted by more <br> than <span class="odometer" data-count="3500">00</span>
                <br>
                clients', 'layerdrops'),
                'placeholder' => esc_html__('Type your description here', 'layerdrops'),
            ]
        );


        $this->end_controls_section();

        // subtitle style
        $this->start_controls_section(
            'subtitle_style',
            [
                'label' => __('Subtitle', 'layerdrops'),
                'tab' =>  \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'subtitle-color',
            [
                'label' => __('Color', 'layerdrops'),
                'type' =>  \Elementor\Controls_Manager::COLOR,
                'default' => '#fe7f4c',
                'selectors' => [
                    '{{WRAPPER}} .el-subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'subtitle-spacing',
            [
                'label' => __('Bottom Spacing', 'layerdrops'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'max' => 150,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .el-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typography',
                'selector' => '{{WRAPPER}} .el-subtitle',
            ]
        );
        $this->end_controls_section();

        // title style
        $this->start_controls_section(
            'title_style',
            [
                'label' => __('Title', 'layerdrops'),
                'tab' =>  \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title-color',
            [
                'label' => __('Color', 'layerdrops'),
                'type' =>  \Elementor\Controls_Manager::COLOR,
                'default' => '#1e3737',
                'selectors' => [
                    '{{WRAPPER}} .el-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'title-spacing',
            [
                'label' => __('Bottom Spacing', 'layerdrops'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'max' => 150,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .el-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .el-title',
            ]
        );
        $this->end_controls_section();

        // desctiption style
        $this->start_controls_section(
            'desctiption_style',
            [
                'label' => __('Desctiption', 'layerdrops'),
                'tab' =>  \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'desctiption-color',
            [
                'label' => __('Color', 'layerdrops'),
                'type' =>  \Elementor\Controls_Manager::COLOR,
                'default' => '#6e7a7a',
                'selectors' => [
                    '{{WRAPPER}} .el-desctiption' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'desctiption-spacing',
            [
                'label' => __('Bottom Spacing', 'layerdrops'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'max' => 150,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .el-desctiption' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'desctiption_typography',
                'selector' => '{{WRAPPER}} .el-desctiption',
            ]
        );
        $this->end_controls_section();

        // Icon style
        $this->start_controls_section(
            'icon_style',
            [
                'label' => __('Icon', 'layerdrops'),
                'tab' =>  \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'icon-size',
            [
                'label' => __('Size', 'layerdrops'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'max' => 150,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .el-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs('_tab_icon');

        $this->start_controls_tab(
            '_tab_icon_normal',
            [
                'label' => __('Normal', 'layerdrops'),
            ]
        );
        $this->add_control(
            'icon-color',
            [
                'label' => __('Color', 'layerdrops'),
                'type' =>  \Elementor\Controls_Manager::COLOR,
                'default' => '#07847f',
                'selectors' => [
                    '{{WRAPPER}} .el-icon i' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon-bg-color',
            [
                'label' => __('Color Background', 'layerdrops'),
                'type' =>  \Elementor\Controls_Manager::COLOR,
                'default' => '#f2f7f7',
                'selectors' => [
                    '{{WRAPPER}} .el-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_title_hover',
            [
                'label' => __('Hover', 'layerdrops'),
            ]
        );
        $this->add_control(
            'icon-color-hover',
            [
                'label' => __('Color', 'layerdrops'),
                'type' =>  \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} li:hover .el-icon i' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon-bg-color-hover',
            [
                'label' => __('Color Background', 'layerdrops'),
                'type' =>  \Elementor\Controls_Manager::COLOR,
                'default' => '#fe7f4c',
                'selectors' => [
                    '{{WRAPPER}} li:hover .el-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();


        // desctiption style
        $this->start_controls_section(
            'btn_style',
            [
                'label' => __('Button', 'layerdrops'),
                'tab' =>  \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs('_tab_btn');

        $this->start_controls_tab(
            '_tab_btn_normal',
            [
                'label' => __('Normal', 'layerdrops'),
            ]
        );
        $this->add_control(
            'btn-color',
            [
                'label' => __('Color', 'layerdrops'),
                'type' =>  \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .thm-btn' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'btn-bg-color',
            [
                'label' => __('Color Background', 'layerdrops'),
                'type' =>  \Elementor\Controls_Manager::COLOR,
                'default' => '#fe7f4c',
                'selectors' => [
                    '{{WRAPPER}} .thm-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'btn-radius',
            [
                'label' => __('Border radius', 'layerdrops'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .thm-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_btn_hover',
            [
                'label' => __('Hover', 'layerdrops'),
            ]
        );
        $this->add_control(
            'btn-color-hover',
            [
                'label' => __('Color', 'layerdrops'),
                'type' =>  \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .thm-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'btn-bg-color-hover',
            [
                'label' => __('Color Background', 'layerdrops'),
                'type' =>  \Elementor\Controls_Manager::COLOR,
                'default' => '#1e3737',
                'selectors' => [
                    '{{WRAPPER}} .thm-btn::before' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'btn-hover-radius',
            [
                'label' => __('Border radius', 'layerdrops'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .thm-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /**
     * Render About Us widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {

        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('title_args', 'class', 'section-title__title el-title');

        // Link
        if ('2' == $settings['btn_link_type']) {
            $this->add_render_attribute('button-arg', 'href', get_permalink($settings['btn_page_link']));
            $this->add_render_attribute('button-arg', 'target', '_self');
            $this->add_render_attribute('button-arg', 'rel', 'nofollow');
            $this->add_render_attribute('button-arg', 'class', 'thm-btn');
        } else {
            if (!empty($settings['tp_btn_link']['url'])) {
                $this->add_link_attributes('button-arg', $settings['tp_btn_link']);
                $this->add_render_attribute('button-arg', 'class', 'thm-btn');
            }
        }

        // img 

        if (!empty($settings['ab-image']['url'])) {
            $ab_image = !empty($settings['ab-image']['id']) ? wp_get_attachment_image_url($settings['ab-image']['id'], $settings['ab-image_size_size']) : $settings['ab-image']['url'];
            $ab_image_alt = get_post_meta($settings["ab-image"]["id"], "_wp_attachment_image_alt", true);
        }

?>
        <div class="page-wrapper">

            <!--Why Choose One Start-->
            <section class="why-choose-one">
                <div class="container">
                    <div class="why-choose-one__inner">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="why-choose-one__left">
                                    <div class="section-title text-left">
                                        <?php if (!empty($settings['sub_title'])) : ?>
                                            <span class="section-title__tagline el-subtitle">
                                                <?php echo custom_kses($settings['sub_title']); ?>
                                            </span>
                                        <?php endif ?>

                                        <?php
                                        if (!empty($settings['title'])) :
                                            printf(
                                                '<%1$s %2$s>%3$s</%1$s>',
                                                tag_escape($settings['tp_title_tag']),
                                                $this->get_render_attribute_string('title_args'),
                                                custom_kses($settings['title'])
                                            );
                                        endif;
                                        ?>
                                    </div>
                                    <?php if (!empty($settings['desctiption'])) : ?>
                                        <div class="why-choose-one__left-text">
                                            <p class="el-desctiption"><?php echo custom_kses($settings['desctiption']); ?></p>
                                        </div>
                                    <?php endif; ?>


                                    <ul class="why-choose-one__points list-unstyled">
                                        <?php foreach ($settings['features_list'] as $item) : ?>
                                            <li>

                                                <?php if ($item['features_icon_type'] !== 'image') : ?>
                                                    <?php if (!empty($item['features_icon']) || !empty($item['features_selected_icon']['value'])) : ?>
                                                        <div class="icon el-icon">
                                                            <?php el_render_icon($item, 'features_icon', 'features_selected_icon'); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php else : ?>
                                                    <?php if (!empty($item['features_selected_icon_img']['url'])) : ?>
                                                        <div class="icon-img">
                                                            <img src="<?php echo $item['features_selected_icon_img']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['features_selected_icon_img']['url']), '_wp_attachment_image_alt', true); ?>">
                                                        <?php endif; ?>
                                                        </div>

                                                    <?php endif; ?>

                                                    <div class="content">
                                                        <h3 class="title"><?php echo custom_kses($item['features_title']); ?> </h3>
                                                        <p class="text"><?php echo custom_kses($item['features_description']); ?></p>
                                                    </div>
                                            </li>
                                        <?php endforeach ?>

                                    </ul>

                                    <?php if (!empty($settings['btn_text'])) : ?>
                                        <a <?php echo $this->get_render_attribute_string('button-arg'); ?>>
                                            <?php echo $settings['btn_text']; ?>
                                        </a>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="why-choose-one__right">
                                    <div class="why-choose-one__img-box">
                                        <div class="why-choose-one__img">
                                            <img src="<?php echo esc_url($ab_image); ?>" alt="<?php echo esc_attr($ab_image_alt); ?>">
                                        </div>
                                        <?php if (!empty($settings['client-info'])) : ?>
                                            <div class="why-choose-one__trusted">
                                                <p class="el-extra"><?php echo custom_kses($settings['client-info']); ?></p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.why-choose-one__inner -->
                </div>
            </section>
            <!--Why Choose One End-->



        </div>
<?php


    }
}
