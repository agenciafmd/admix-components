<?php

namespace Agenciafmd\Components\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\TemporaryUploadedFile;
use Spatie\MediaLibrary\InteractsWithMedia;

trait InteractsWithMediaUploads
{
    use InteractsWithMedia;

//    public array $mappedMedia = [
//        'avatar' => [
//            'single' => true,
//            'rules' => [
//                'bail', /* usar até o livewire 3, porque a implementação do dimensions funciona somente nele */
//                'max:512',
//                'image',
//                'dimensions:min_width=400,min_height=400',
//            ],
//        ],
//    ];

    public function registerMediaCollections(): void
    {
        collect($this->mappedMedia)->each(function ($media, $collection) {
            $mediaCollection = $this->addMediaCollection($collection)
                ->withResponsiveImages();
            if ($media['single']) {
                $mediaCollection->singleFile();
            }
            if (in_array('image', $media['rules'], true)) {
                $mediaCollection->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif']);
            }
        });
    }

    public function attachMedia(string $file, string $collection = 'image', array $customProperties = []): void
    {
        $name = $this->defaultMediaName();
        $fileName = $name . '.' . Str::of(pathinfo($file)['extension'])
                ->lower();
        $contents = Storage::get($file);

        $this->addMediaFromString($contents)
            ->usingName($name)
            ->usingFileName($fileName)
            ->withCustomProperties(array_merge(['uuid' => Str::orderedUuid()], $customProperties))
            ->toMediaCollection($collection);
    }

    public function syncMedia(array $media): void
    {
        collect($media)->each(function ($file, $collection) {
            if ($file instanceof TemporaryUploadedFile) {
                $file = $file->store('tmp');
            }

            if (is_string($file)) {
                $this->attachMedia($file, $collection);
            }
        });
    }

    public function defaultMediaName(): string
    {
        return Str::of($this->attributes['name'])
                ->slug()
                ->limit(100, '')
                ->toString() . '-' . date('YmdHisv');
    }

    public function loadMappedMedia(): array
    {
        $media = [];
        collect($this->mappedMedia)->each(function ($file, $collection) use (&$media) {
            if ($file['single']) {
                $media[$collection] = $this->getFirstMedia($collection);
            } else {
                $media[$collection] = $this->getMedia($collection);
            }
        });

        return $media;
    }

    public function loadMappedMediaRules(mixed $media): array
    {
        $rules = [];
        collect($this->mappedMedia)->each(function ($mappedMedia, $collection) use ($media, &$rules) {
            $media[$collection] instanceof TemporaryUploadedFile
                ? $rules["media.{$collection}"] = $mappedMedia['rules']
                : $rules["media.{$collection}"] = [
                'nullable',
                'array',
            ];
        });

        return $rules;
    }

    public function mediaHint(string $collection): string
    {
        $hint = [
            ...$this->mediaHintAllowedExtensions($collection),
            ...$this->mediaHintMaxSize($collection),
            ...$this->mediaHintDimensions($collection),
        ];

        return implode('<br />', $hint);
    }

    public function mediaAllowedExtensions(string $collection): Collection
    {
        $rules = $this->mappedMedia[$collection]['rules'];

        return collect($rules)
            ->map(function ($rule) {
                if (Str::of($rule)
                    ->startsWith('mimes:')) {
                    return Str::of($rule)
                        ->replace('mimes:', '')
                        ->explode(',');
                }

                if ($rule === 'image') {
                    return [
                        'jpeg',
                        'jpg',
                        'png',
                        'gif',
                    ];
                }

                return null;
            })
            ->filter()
            ->flatten()
            ->unique();
    }

    private function mediaHintAllowedExtensions(string $collection): array
    {
        $hint = [];
        $allowedExtensions = $this->mediaAllowedExtensions($collection);
        if ($allowedExtensions->count()) {
            $hint[] = __('Allowed formats: :formats', [
                'formats' => $allowedExtensions->join(', ', ' ' . __('and') . ' '),
            ]);
        }

        return $hint;
    }

    private function mediaHintMaxSize(string $collection): array
    {
        $hint = [];
        $rules = $this->mappedMedia[$collection]['rules'];

        $max = collect($rules)
            ->map(function ($rule) {
                if (Str::of($rule)
                    ->startsWith('max:')) {
                    return Str::of($rule)
                        ->replace('max:', '')
                        ->__toString();
                }

                return null;
            })
            ->filter()
            ->first();
        if ($max) {
            $maxSize = $max . 'KB';
            if ($max > 1024) {
                $maxSize = round($max / 1024, 2) . 'MB';
            }

            $hint[] = __('Maximum size: :size', [
                'size' => $maxSize,
            ]);
        }

        return $hint;
    }

    private function mediaHintDimensions(string $collection): array
    {
        $hint = [];
        $rules = $this->mappedMedia[$collection]['rules'];

        $dimensions = collect($rules)
            ->map(function ($rule) {
                if (Str::of($rule)
                    ->startsWith('dimensions:')) {
                    return Str::of($rule)
                        ->replace('dimensions:', '');
                }

                return null;
            })
            ->filter()
            ->flatten()
            ->first()
            ->explode(',')
            ->mapWithKeys(function ($dimension) {
                $localDimension = Str::of($dimension)
                    ->explode('=');
                return [
                    $localDimension[0] => $localDimension[1],
                ];
            });
        if ($dimensions->count()) {
            if (isset($dimensions['min_width'], $dimensions['min_height'])) {
                $hint[] = __('Min dimensions: :dimensions', [
                    'dimensions' => $dimensions['min_width'] . 'x' . $dimensions['min_height'],
                ]);
            }

            if (isset($dimensions['max_width'], $dimensions['max_height'])) {
                $hint[] = __('Max dimensions: :dimensions', [
                    'dimensions' => $dimensions['max_width'] . 'x' . $dimensions['max_height'],
                ]);
            }
        }

        return $hint;
    }
}