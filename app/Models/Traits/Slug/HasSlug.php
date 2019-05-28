<?php

namespace App\Models\Traits\Slug;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

trait HasSlug
{
    /** @var \App\Models\Traits\Slug\SlugOptions */
    protected $slugOptions;

    /**
     * Get the slug options.
     *
     * @return \App\Models\Traits\Slug\SlugOptions
     */
    abstract public function getSlugOptions(): SlugOptions;

    /**
     * Boot the trait.
     */
    protected static function bootHasSlug()
    {
        static::creating(function (Model $model) {
            $model->generateSlugOnCreate();
        });

        static::updating(function (Model $model) {
            $model->generateSlugOnUpdate();
        });
    }

    /**
     * Generate the slug when creating the model.
     */
    protected function generateSlugOnCreate()
    {
        $this->slugOptions = $this->getSlugOptions();

        if (! $this->slugOptions->generateSlugsOnCreate) {
            return;
        }

        $this->addSlug();
    }

    /**
     * Generate the slug when updating the model.
     */
    protected function generateSlugOnUpdate()
    {
        $this->slugOptions = $this->getSlugOptions();

        if (! $this->slugOptions->generateSlugsOnUpdate) {
            return;
        }

        $this->addSlug();
    }

    /**
     * Generate the slug.
     */
    public function generateSlug()
    {
        $this->slugOptions = $this->getSlugOptions();
        $this->addSlug();
    }

    /**
     * Add the slug to the model.
     */
    protected function addSlug()
    {
        $this->ensureValidSlugOptions();
        $slug = $this->generateNonUniqueSlug();

        if ($this->slugOptions->generateUniqueSlugs) {
            $slug = $this->makeSlugUnique($slug);
        }

        $slugField = $this->slugOptions->slugField;
        $this->$slugField = $slug;
    }

    /**
     * Generate a non-unique slug.
     */
    protected function generateNonUniqueSlug(): string
    {
        $slugField = $this->slugOptions->slugField;
        if ($this->hasCustomSlugBeenUsed() && ! empty($this->$slugField)) {
            return $this->$slugField;
        }

        return Str::slug($this->getSlugSourceString(), $this->slugOptions->slugSeparator, $this->slugOptions->slugLanguage);
    }

    /**
     * Has a custom slug been used for the model.
     */
    protected function hasCustomSlugBeenUsed(): bool
    {
        $slugField = $this->slugOptions->slugField;

        return $this->$slugField != $this->getOriginal($slugField);
    }

    /**
     * Get the source string for the slug.
     */
    protected function getSlugSourceString(): string
    {
        if (is_callable($this->slugOptions->generateSlugFrom)) {
            $slugSourceString = call_user_func($this->slugOptions->generateSlugFrom, $this);

            return substr($slugSourceString, 0, $this->slugOptions->maximumLength);
        }

        $slugSourceString = collect($this->slugOptions->generateSlugFrom)
            ->map(function (string $fieldName): string {
                return data_get($this, $fieldName, '');
            })
            ->implode($this->slugOptions->slugSeparator);

        return substr($slugSourceString, 0, $this->slugOptions->maximumLength);
    }

    /**
     * Make the slug unique.
     *
     * @param  string  $slug
     */
    protected function makeSlugUnique(string $slug): string
    {
        $originalSlug = $slug;
        $i = 1;

        while ($this->otherRecordExistsWithSlug($slug) || '' === $slug) {
            $slug = $originalSlug.$this->slugOptions->slugSeparator.$i++;
        }

        return $slug;
    }

    /**
     * Check if other records exist with the slug.
     *
     * @param  string  $slug
     */
    protected function otherRecordExistsWithSlug(string $slug): bool
    {
        $key = $this->getKey();

        if ($this->incrementing) {
            $key = $key ?? '0';
        }

        return static::where($this->slugOptions->slugField, $slug)
            ->where($this->getKeyName(), '!=', $key)
            ->withoutGlobalScopes()
            ->exists();
    }

    /**
     * Ensure the slug options are valid.
     *
     * @throws \App\Models\Traits\Slug\InvalidOption
     */
    protected function ensureValidSlugOptions()
    {
        if (is_array($this->slugOptions->generateSlugFrom) && ! count($this->slugOptions->generateSlugFrom)) {
            throw InvalidOption::missingFromField();
        }

        if (! strlen($this->slugOptions->slugField)) {
            throw InvalidOption::missingSlugField();
        }

        if ($this->slugOptions->maximumLength <= 0) {
            throw InvalidOption::invalidMaximumLength();
        }
    }
}
