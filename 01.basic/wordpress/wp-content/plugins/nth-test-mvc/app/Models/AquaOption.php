<?php

namespace MyApp\Models;

use WPMVC\MVC\Traits\FindTrait;
use WPMVC\MVC\Models\OptionModel as Model;

/**
 * AquaOption model.
 * WordPress MVC model.
 *
 * @author Trong Hieu <hieuntctk42@gmail.com>
 * @package nth-app
 * @version 1.0.0
 */
class AquaOption extends Model
{
    use FindTrait;
    /**
     * Property id.
     * @since 1.0.0
     *
     * @var string
     */
    protected $id = 'aqua_option';

    protected $aliases = [
        // Alias "config" for custom field "config"
        'name'    => 'field_aquafina_name',

        // Alias "timer" for custom field "timer"
        'description'     => 'field_aquafina_description',
    ];

    public function getName()
    {
        return $this->name ? $this->name : '';
    }

    public function getDescription()
    {
        return $this->description ? $this->description : '';
    }
}
