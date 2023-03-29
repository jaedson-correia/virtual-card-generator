<?php

namespace App\Traits;

use Exception;

trait HasSlug
{

    public function scopeFindBySlug($query, $slug)
    {
        $this->validateSlug($slug);

        return $query->where('slug', $slug)->firstOrFail();
    }

    private function validateSlug($slug)
    {
        if (!preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $slug)) {
            throw new Exception('Invalid Slug');
        }
    }

}
