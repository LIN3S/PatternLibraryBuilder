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

namespace spec\LIN3S\PatternLibraryBuilder\Twig;

use LIN3S\PatternLibraryBuilder\Twig\DindentExtension;
use PhpSpec\ObjectBehavior;

class DindentExtensionSpec extends ObjectBehavior
{
    public function it_gets_filters()
    {
        $this->shouldHaveType(DindentExtension::class);
        $this->shouldHaveType(\Twig_Extension::class);

        $this->getFilters()->shouldBeArray();
    }

    public function it_uses_dindent()
    {
        $this->dindent('<div><span>This is</span><span>a test!</span></div>')->shouldReturn(
            '&lt;div&gt;&lt;span&gt;This is&lt;/span&gt;&lt;span&gt;a test!&lt;/span&gt;&lt;/div&gt;'
        );
    }
}
