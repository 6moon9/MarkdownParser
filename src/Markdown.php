<?php
class Markdown {
    public $md;
    public $html;
    public function __contruct (string $markdown) {
        var_dump($markdown);
        $this -> md = $markdown;
    }
    public function toHTML() {
        $md = $this -> md;
        var_dump($this -> md);
        //ul
        $md = preg_replace('/^\s*\n\*/m', '<ul>\n*', $md);
        $md = preg_replace('/^(\*.+)\s*\n([^\*])/m', '$1\n</ul>\n\n$2', $md);
        $md = preg_replace('/^\*(.+)/m', '<li>$1</li>', $md);
        //ol
        $md = preg_replace('/^\s*\n\d\./m', '<ol>\n1.', $md);
        $md = preg_replace('/^(\d\..+)\s*\n([^\d\.])/m', '$1\n</ol>\n\n$2', $md);
        $md = preg_replace('/^\d\.(.+)/m', '<li>$1</li>', $md);
        //blockquote
        $md = preg_replace('/^\>(.+)/m', '<blockquote>$1</blockquote>', $md);
        //h
        $md = preg_replace('/[\#]{6}(.+)/', '<h6>$1</h6>', $md);
        $md = preg_replace('/[\#]{5}(.+)/', '<h5>$1</h5>', $md);
        $md = preg_replace('/[\#]{4}(.+)/', '<h4>$1</h4>', $md);
        $md = preg_replace('/[\#]{3}(.+)/', '<h3>$1</h3>', $md);
        $md = preg_replace('/[\#]{2}(.+)/', '<h2>$1</h2>', $md);
        $md = preg_replace('/[\#]{1}(.+)/', '<h1>$1</h1>', $md);
        //alt h
        $md = preg_replace('/^(.+)\n\=+/m', '<h1>$1</h1>', $md);
        $md = preg_replace('/^(.+)\n\-+/m', '<h2>$1</h2>', $md);
        //images
        $md = preg_replace('/\!\[([^\]]+)\]\(([^\)]+)\)/', '<img src="$2" alt="$1" />', $md);
        //links
        $md = preg_replace('/[\[]{1}([^\]]+)[\]]{1}[\(]{1}([^\)\"]+)(\"(.+)\")?[\)]{1}/', '<a href="$2" title="$4">$1</a>', $md);
        //font styles
        $md = preg_replace('/[\*\_]{2}([^\*\_]+)[\*\_]{2}/', '<b>$1</b>', $md);
        $md = preg_replace('/[\*\_]{1}([^\*\_]+)[\*\_]{1}/', '<i>$1</i>', $md);
        $md = preg_replace('/[\~]{2}([^\~]+)[\~]{2}/', '<del>$1</del>', $md);
        //pre
        $md = preg_replace('/^\s*\n\`\`\`(([^\s]+))?/m', '<pre class="$2">', $md);
        $md = preg_replace('/^\`\`\`\s*\n/m', '</pre>\n\n', $md);
        //code
        $md = preg_replace('/[\`]{1}([^\`]+)[\`]{1}/', '<code>$1</code>', $md);
        //p
        // Adaptation bug. preg_replace doesnt accept function in argument
        // $md = preg_replace('/^\s*(\n)?(.+)/m', function (m) {
        //     return /\<(\/)?(h\d|ul|ol|li|blockquote|pre|img)/.test(m) ? m : '<p>' + m + '</p>';
        // });
        //strip p from pre
        $md = preg_replace('/(\<pre.+\>)\s*\n\<p\>(.+)\<\/p\>/m', '$1$2', $md);
        var_dump($md);
        $this -> html = $md;
        return $this -> html;
    }
}

$md = new Markdown("# Hello");
var_dump($md -> md);
// var_dump($md -> toHTML());
?>