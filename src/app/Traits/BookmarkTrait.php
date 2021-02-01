<?php

namespace App\Traits;

use App\Models\Bookmark;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait BookmarkTrait
{
    /**
     * @return HasMany
     */
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function bookmarksByType($type)
    {
        return $this->bookmarks()->where('model_type', $type);
    }

    public function bookmark($object)
    {
        if ($this->isBookmarked($object)) {
            return $this->bookmarks()->where(
                [
                    ['model_type', get_class($object)],
                    ['model_id', $object->id]
                ]
            )->delete();
        }

        return $this->bookmarks()->create(['model_type' => get_class($object), 'model_id' => $object->id]);
    }

    public function isBookmarked($object)
    {
        return $this->bookmarks()->where(
            [
                ['model_type', get_class($object)],
                ['model_id', $object->id]
            ]
        )->exists();
    }
}
