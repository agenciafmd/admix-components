<?php

namespace Agenciafmd\Components\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
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
                $mediaCollection = $mediaCollection->singleFile();
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

        if ($this->isImage($collection)) {
            $contents = $this->resizeImage($contents, $collection);
        }

        $this->addMediaFromString($contents)
            ->usingName($name)
            ->usingFileName($fileName)
            ->withCustomProperties(array_merge(['uuid' => Str::orderedUuid()], $customProperties))
            ->toMediaCollection($collection);
    }

    public function syncMedia(array $media, array $meta): void
    {
        collect($media)->each(function ($files, $collection) use ($meta) {
            if ($this->isSingleMedia($collection)) {
                $files = [end($files)];
            }
            collect($files)->each(function ($file, $key) use ($collection, $meta) {
                if ($file instanceof TemporaryUploadedFile) {
                    $file = $file->store('tmp');
                }
                if (is_string($file)) {
                    $this->attachMedia($file, $collection, $meta[$collection][$key] ?? []);
                }
            });
        });

        if (!count($media) && count($meta)) {
            collect($meta)->each(function ($files, $collection) {
                collect($files)->each(function ($file, $uuid) use ($collection) {
                    $media = $this->getMedia($collection)
                        ->where('uuid', $uuid)
                        ->first();
                    if ($media) {
                        $media->custom_properties = $file;
                        $media->save();
                    }
                });
            });
        }
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
//            if ($file['single']) {
//                $media[$collection] = $this->getFirstMedia($collection);
//            } else {
            $media[$collection] = $this->getMedia($collection)
                ->toArray();
//            }
        });

        return $media;
    }

    public function loadMappedMeta(): array
    {
        $meta = [];
        collect($this->mappedMedia)->each(function ($file, $collection) use (&$meta) {
//            if ($file['single']) {
//                $media[$collection] = $this->getFirstMedia($collection);
//            } else {
            $meta[$collection] = $this->getMedia($collection)
                ->mapWithKeys(function ($item) {
                    return [
                        $item->uuid => $item->custom_properties,
                    ];
                })
                ->toArray();
//            }
        });

        return $meta;
    }

    public function loadMappedMediaRules(mixed $media): array
    {
        /* todo */
        $rules = [];
        collect($this->mappedMedia)->each(function ($mappedMedia, $collection) use ($media, &$rules) {
//            if ($mappedMedia['single']) {
//                $rules["media.{$collection}"] = $mappedMedia['rules'];
//            } else {
            $rules["media.{$collection}.*"] = $mappedMedia['rules'];
//            }
//            $media[$collection] instanceof TemporaryUploadedFile
//                ? $rules["media.{$collection}"] = $mappedMedia['rules']
//                : $rules["media.{$collection}"] = [
//                'nullable',
//                'array',
//            ];
        });

        $rules['meta'] = [
            'array',
        ];

        return $rules;
    }

    public function initMappedMedia(): array
    {
        $media = [];
        collect($this->mappedMedia)->each(function ($file, $collection) use (&$media) {
//            if ($file['single']) {
//                $media[$collection] = null;
//            } else {
            $media[$collection] = [];
//            }
        });

        return $media;
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
                    return $this->imageExtensions();
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
        $dimensions = $this->extractDimensionsFromRules($collection);
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

    private function extractDimensionsFromRules(string $collection): Collection
    {
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
            ->first();
        if ($dimensions) {
            return $dimensions->explode(',')
                ->mapWithKeys(function ($dimension) {
                    $localDimension = Str::of($dimension)
                        ->explode('=');
                    return [
                        $localDimension[0] => $localDimension[1],
                    ];
                });
        }

        return collect();
    }

    private function isImage(string $collection): bool
    {
        return in_array('image', $this->mappedMedia[$collection]['rules'], true);
    }

    private function resizeImage(string $contents, string $collection): string
    {
        $dimensions = $this->extractDimensionsFromRules($collection);
        if (!$dimensions->count()) {
            return $contents;
        }

        $width = $dimensions['max_width'] ?? $dimensions['min_width'] ? $dimensions['min_width'] * 2 : null;
        $height = $dimensions['max_height'] ?? $dimensions['min_height'] ? $dimensions['min_height'] * 2 : null;

        return Image::make($contents)
            ->fit($width, $height, function ($constraint) {
                $constraint->upsize();
            })
            ->encode()
            ->__toString();
    }

    public function isSingleMedia(string $collection): bool
    {
        return $this->mappedMedia[$collection]['single'];
    }

    public function imageExtensions(): array
    {
        return [
            'jpeg',
            'jpg',
            'png',
            'gif',
        ];
    }
}