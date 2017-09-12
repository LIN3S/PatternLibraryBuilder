<?php

namespace LIN3S\PatternLibraryBuilder\Config;

final class ThemeConfig
{
    private $title;
    private $description;
    private $stylesheets;
    private $javascripts;
    private $customStyles;
    private $logo;

    public function __construct(
        string $title,
        string $description,
        array $stylesheets = [],
        array $javascripts = [],
        array $customStyles = [],
        string $logo = null
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->stylesheets = $stylesheets;
        $this->javascripts = $javascripts;
        $this->customStyles = $customStyles;
        $this->logo = $logo;
    }

    public function title()
    {
        return $this->title;
    }

    public function description()
    {
        return $this->description;
    }

    public function stylesheets()
    {
        return $this->stylesheets;
    }

    public function javascripts()
    {
        return $this->javascripts;
    }

    public function customStyles()
    {
        return $this->customStyles;
    }

    public function logo()
    {
        return $this->logo;
    }
}
