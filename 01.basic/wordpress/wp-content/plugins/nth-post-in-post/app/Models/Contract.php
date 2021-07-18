<?php

namespace NthPostInPost\Models;

use WPMVC\MVC\Traits\FindTrait;
use WPMVC\MVC\Models\PostModel as Model;

/**
 * Contract model.
 * WordPress MVC model.
 *
 * @author Trong Hieu <https://github.com/dalatcoder>
 * @package nth-post-in-post
 * @version 1.0.0
 */
class Contract extends Model
{
    use FindTrait;
    /**
     * Property type.
     * @since 1.0.0
     *
     * @var string
     */
    protected $type = 'post';
    protected $id = 'contract';

    protected $aliases = [
        'title'    => 'post_title',
        'content'     => 'post_content',
    ];

    public function getTitle()
    {
        return $this->title ? $this->title : '';
    }

    public function getContent()
    {
        return $this->content ? $this->content : '';
    }
}
