<?php

declare(strict_types = 1);

/*
 * This file is part of the Pattern Library Builder project.
 *
 * Copyright (c) 2017-present LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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

//        $config = $container->getParameter('lin3s_pattern_library_builder.config');
//        $themeData = $config['theme'];
//
//        $theme = sprintf(
//            self::THEME,
//            $themeData['accordion']['default'],
//            $themeData['accordion']['hover'],
//            $themeData['accordion']['open'],
//            $themeData['accordion']['header'],
//            $themeData['accordion']['link']['default'],
//            $themeData['accordion']['link']['hover'],
//            '',
//            '',
//            '',
//            '',
//            '',
//            '',
//            '',
//            '',
//            '',
//            '',
//            $themeData['tab'],
//            $themeData['main']['aside'],
//            $themeData['main']['article'],
//            $themeData['accordion']['icon']
//        );

        $colorPrimary = '#0099ff';
        $fontFamilyPrimary = 'ITC Avant Garde Gothic Pro';
        $fontFamilySecondary = 'Roboto';
        $articleBackgroundColor = '#fefefe';
        $asideBackgroundColor = '#e1e1e1';
        $asideHeaderBackgroundColor = $colorPrimary;
        $asideHeaderTextColor = '#fff';
        $accordionItemLevel1TextColor = '#333';
        $accordionItemLevel1TextColorHover = '#545454';
        $accordionItemLevel1BackgroundColorOpened = '#ececec';
        $accordionItemLevel1HeaderBorderColor = '#d1d1d1';
        $accordionItemLevel2TextColor = '#666';
        $accordionItemLevel2TextColorHover = '#999';
        $accordionItemLevel2BackgroundColorOpened = '#f8fbfb';
        $accordionItemLevel2HeaderBorderColor = '#e5e5e5';
        $accordionItemLevel3TextColor = '#999';
        $accordionItemLevel3TextColorHover = '#a3a3a3';
        $accordionItemLevel3BackgroundColor = '#fff';
        $statusTextColorTodo = '#f14133';
        $statusTextColorDoing = '#fba30a';
        $statusTextColorPendingReview = '#16a5ba';
        $statusTextColorDone = '#598d09';
        $tabbedBackgroundColor = '';
        $tabbedBorderColor = '';
        $tabbedContentBackgroundColor = '';
        $tabbedContentBorderColor = '';
        $breadcrumbsTextColor = '#b6b6b6';
        $titleTextColor = $colorPrimary;
        $descriptionTextColor = '#444';
        $formInputBorderColor = '#b0b0b0';
        $formInputBorderColorHover = $colorPrimary;
        $formLabelTextColor = '#444';
        $iconFillColor = $colorPrimary;

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
