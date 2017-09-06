<?php

namespace spec\LIN3S\PatternLibraryBuilder\Config;

use LIN3S\PatternLibraryBuilder\Config\ThemeConfig;
use PhpSpec\ObjectBehavior;

class ThemeConfigSpec extends ObjectBehavior
{
    function it_holds_template_config()
    {
        $this->beConstructedWith('Title', 'Description', ['app.css'], ['app.js'], ['primary_color' => 'black']);

        $this->shouldHaveType(ThemeConfig::class);

        $this->title()->shouldReturn('Title');
        $this->description()->shouldReturn('Description');
        $this->stylesheets()->shouldReturn(['app.css']);
        $this->javascripts()->shouldReturn(['app.js']);
        $this->customStyles()->shouldReturn(['primary_color' => 'black']);
    }
}
