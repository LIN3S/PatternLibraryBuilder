<?php

namespace LIN3S\PatternLibraryBuilder\Renderer;

interface Renderer
{
    public function renderPreview($item);

    public function renderFull($item);
}
