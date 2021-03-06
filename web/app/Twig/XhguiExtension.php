<?php

class Twig_XhguiExtension extends Twig_Extension
{
    public function getName()
    {
        return 'xhgui';
    }

    public function getFunctions()
    {
        return array(
            'url' => new Twig_Function_Method($this, 'url'),
        );
    }

    public function getFilters()
    {
        return array(
            'simple_url' => new Twig_Filter_Function('simpleUrl'),
            'as_bytes' => new Twig_Filter_Method($this, 'formatBytes', array('is_safe' => array('html'))),
            'as_time' => new Twig_Filter_Method($this, 'formatTime', array('is_safe' => array('html'))),
        );
    }

    protected function _getBase()
    {
        $base = dirname($_SERVER['PHP_SELF']);
        if ($base == '/') {
            return '';
        }
        return $base;
    }

    /**
     * Get a URL for xhgui.
     *
     * @param string $path The file/path you want a link to
     * @param array $queryarg Additional querystring arguments.
     * @return string url.
     */
    public function url($path, $queryargs = array())
    {
        $base = $this->_getBase();
        $query = '';
        if (!empty($queryargs)) {
            $query = '?' . http_build_query($queryargs);
        }
        $path = '/' . ltrim($path, '/');
        return $base . $path . $query;
    }

    public function formatBytes($value)
    {
        return number_format((float)$value) . ' <span class="units">bytes</span>';
    }

    public function formatTime($value)
    {
        return number_format((float)$value) . ' <span class="units">µs</span>';
    }

}
