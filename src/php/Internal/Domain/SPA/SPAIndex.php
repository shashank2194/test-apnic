<?php

namespace APNIC\FoundationNews\Internal\Domain\SPA;

class SPAIndex
{
    /**
     * @var array|string[]
     */
    private array $styles;

    /**
     * @var array|string[]
     */
    private array $scripts;

    /**
     * @param array|string[] $styles
     * @param array|string[] $scripts
     */
    public function __construct(array $styles, array $scripts)
    {
        $this->styles = $styles;
        $this->scripts = $scripts;
    }

    /**
     * @return array|string[]
     */
    public function styles(): array
    {
        return $this->styles;
    }

    /**
     * @return array|string[]
     */
    public function scripts(): array
    {
        return $this->scripts;
    }
}
