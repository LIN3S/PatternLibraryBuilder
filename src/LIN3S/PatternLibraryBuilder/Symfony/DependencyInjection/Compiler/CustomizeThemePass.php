<?php

/*
 * This file is part of the Pattern Library Builder library.
 *
 * Copyright (c) 2017-present LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace LIN3S\PatternLibraryBuilder\Symfony\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class CustomizeThemePass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('twig')) {
            return;
        }

        $config = $container->getParameter('lin3s_pattern_library_builder.config');

        $themeData = $config['theme'];

        $colorPrimary = $themeData['color_primary'];
        $fontFamilyPrimary = $themeData['font_family_primary'];
        $fontFamilySecondary = $themeData['font_family_secondary'];
        $articleBackgroundColor = $themeData['article_background_color'];
        $asideBackgroundColor = $themeData['aside_background_color'];
        $asideHeaderBackgroundColor = $themeData['aside_header_background_color'];
        $asideHeaderTextColor = $themeData['aside_header_text_color'];
        $accordionItemLevel1TextColor = $themeData['accordion_item_level1_text_color'];
        $accordionItemLevel1TextColorHover = $themeData['accordion_item_level1_text_color_hover'];
        $accordionItemLevel1BackgroundColorOpened = $themeData['accordion_item_level1_background_color_opened'];
        $accordionItemLevel1HeaderBorderColor = $themeData['accordion_item_level1_header_border_color'];
        $accordionItemLevel2TextColor = $themeData['accordion_item_level2_text_color'];
        $accordionItemLevel2TextColorHover = $themeData['accordion_item_level2_text_color_hover'];
        $accordionItemLevel2BackgroundColorOpened = $themeData['accordion_item_level2_background_color_opened'];
        $accordionItemLevel2HeaderBorderColor = $themeData['accordion_item_level2_header_border_color'];
        $accordionItemLevel3TextColor = $themeData['accordion_item_level3_text_color'];
        $accordionItemLevel3TextColorHover = $themeData['accordion_item_level3_text_color_hover'];
        $accordionItemLevel3BackgroundColor = $themeData['accordion_item_level3_background_color'];
        $statusTextColorTodo = $themeData['status_text_color_todo'];
        $statusTextColorDoing = $themeData['status_text_color_doing'];
        $statusTextColorPendingReview = $themeData['status_text_color_pending_review'];
        $statusTextColorDone = $themeData['status_text_color_done'];
        $tabbedBackgroundColor = $themeData['tabbed_background_color'];
        $tabbedBorderColor = $themeData['tabbed_border_color'];
        $tabbedContentBackgroundColor = $themeData['tabbed_content_background_color'];
        $tabbedContentBorderColor = $themeData['tabbed_content_border_color'];
        $breadcrumbsTextColor = $themeData['breadcrumbs_text_color'];
        $titleTextColor = $themeData['title_text_color'];
        $descriptionTextColor = $themeData['description_text_color'];
        $formInputBorderColor = $themeData['form_input_border_color'];
        $formInputBorderColorHover = $themeData['form_input_border_color_hover'];
        $formLabelTextColor = $themeData['form_label_text_color'];
        $iconFillColor = $themeData['icon_fill_color'];

        $theme = sprintf(
            self::THEME,
            $asideBackgroundColor,
            $articleBackgroundColor,
            $asideHeaderBackgroundColor,
            $asideHeaderTextColor,
            $fontFamilyPrimary,
            $accordionItemLevel1TextColor,
            $fontFamilyPrimary,
            $accordionItemLevel1TextColorHover,
            $accordionItemLevel1BackgroundColorOpened,
            $accordionItemLevel1HeaderBorderColor,
            $accordionItemLevel1HeaderBorderColor,
            $accordionItemLevel1TextColor,
            $accordionItemLevel1TextColorHover,
            $accordionItemLevel2TextColor,
            $accordionItemLevel2TextColorHover,
            $accordionItemLevel2BackgroundColorOpened,
            $accordionItemLevel2HeaderBorderColor,
            $accordionItemLevel2HeaderBorderColor,
            $accordionItemLevel2TextColor,
            $accordionItemLevel2TextColorHover,
            $accordionItemLevel3TextColor,
            $accordionItemLevel3TextColorHover,
            $accordionItemLevel3BackgroundColor,
            $accordionItemLevel3TextColor,
            $fontFamilySecondary,
            $accordionItemLevel3TextColorHover,
            $colorPrimary,
            $fontFamilySecondary,
            $statusTextColorTodo,
            $statusTextColorDoing,
            $statusTextColorPendingReview,
            $statusTextColorDone,
            $tabbedBackgroundColor,
            $tabbedBorderColor,
            $tabbedBorderColor,
            $tabbedBorderColor,
            $tabbedBorderColor,
            $colorPrimary,
            $tabbedContentBackgroundColor,
            $tabbedContentBackgroundColor,
            $tabbedContentBackgroundColor,
            $tabbedContentBorderColor,
            $breadcrumbsTextColor,
            $fontFamilyPrimary,
            $titleTextColor,
            $fontFamilyPrimary,
            $descriptionTextColor,
            $fontFamilySecondary,
            $fontFamilySecondary,
            $formInputBorderColor,
            $fontFamilySecondary,
            $formInputBorderColorHover,
            $formLabelTextColor,
            $fontFamilyPrimary,
            $colorPrimary,
            $fontFamilySecondary,
            $iconFillColor
        );

        $container->getDefinition('twig')->addMethodCall('addGlobal', ['theme_styles', $theme]);
    }

    const THEME = '.main__aside{background-color:%s}
        .main__article{background-color:%s}
        .aside__header{background-color:%s;color:%s;font-family:%s}
        .accordion-item{color:%s;font-family:%s}.accordion-item:hover{color:%s}.accordion-item.accordion-item--opened{background-color:%s}.accordion-item .accordion-item__header{border-bottom-color:%s;border-top-color:%s}.accordion-item .link {color:%s}.accordion-item .link:hover{color:%s}
        .accordion-item .accordion-item{color:%s}.accordion-item .accordion-item:hover{color:%s}.accordion-item .accordion-item.accordion-item--opened{background-color:%s}.accordion-item .accordion-item .accordion-item__header{border-bottom-color:%s;border-top-color:%s}.accordion-item .accordion-item .link{color:%s}.accordion-item .accordion-item .link:hover{color:%s}
        .accordion-item .accordion-item--leaf{color:%s}.accordion-item .accordion-item--leaf:hover{color:%s}.accordion-item .accordion-item--leaf.accordion-item--opened{background-color:%s}.accordion-item .accordion-item--leaf .link{color:%s;font-family:%s}.accordion-item .accordion-item--leaf .link:hover{color:%s}
        .accordion-item__header:after{background-color:%s}
        .status{font-family:%s}.status--todo{color:%s}.status--doing{color:%s}.status--pending-review{color:%s}.status--done{color:%s}
        .tabbed__nav-item{background-color:%s;border-bottom-color:%s;border-top-color:%s;border-left-color:%s}.tabbed__nav-item:last-child{border-right-color:%s}.tabbed__nav-item:after{background-color:%s}.tabbed__nav-item--active{background-color:%s;border-bottom-color:%s}.tabbed__content{background-color:%s;border-color:%s}
        .article__breadcrumbs{color:%s;font-family:%s}
        .article__title{color:%s;font-family:%s}
        .article__description{color:%s;font-family:%s}
        .finder__tip{font-family:%s}
        .form-input{border-color:%s;font-family:%s}.form-input:focus{border-color:%s}
        .form-label{color:%s;font-family:%s}.form-label__required{color:%s}
        .link {font-family:%s}
        .icon-plus{fill:%s}';
}
