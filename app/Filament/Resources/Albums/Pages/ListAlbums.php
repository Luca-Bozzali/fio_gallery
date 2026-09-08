<?php

namespace App\Filament\Resources\Albums\Pages;

use App\Enums\AlbumType;
use App\Filament\Resources\Albums\AlbumResource;
use App\Models\Album;
use App\Services\AlbumPhotoUploadService;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Icons\Heroicon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ListAlbums extends ListRecords
{
    protected static string $resource = AlbumResource::class;

    public function getBreadcrumbs(): array
    {
        return [];
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('createAlbumFromFolder')
                ->label('Crea album da cartella')
                ->icon(Heroicon::OutlinedFolderPlus)
                ->modalHeading('Crea album da cartella')
                ->modalSubmitActionLabel('Crea album')
                ->modalWidth('5xl')
                ->form([
                    FileUpload::make('photos')
                        ->label('Seleziona la cartella')
                        ->helperText('Il titolo verrà preso dal nome della cartella.')
                        ->acceptedFileTypes(AlbumPhotoUploadService::IMAGE_MIME_TYPES)
                        ->maxSize(AlbumPhotoUploadService::MAX_IMAGE_SIZE)
                        ->maxFiles(AlbumPhotoUploadService::MAX_BULK_FILES)
                        ->maxParallelUploads(2)
                        ->multiple()
                        ->appendFiles()
                        ->reorderable()
                        ->panelLayout('grid')
                        ->storeFileNamesIn('photo_file_names')
                        ->required()
                        ->extraInputAttributes([
                            'directory' => true,
                            'webkitdirectory' => true,
                        ], merge: true)
                        ->columnSpanFull(),

                    TextInput::make('title')
                        ->label('Titolo')
                        ->helperText('Se lasciato vuoto, verrà usato il nome della cartella.')
                        ->maxLength(255),
                ])
                ->action(fn (array $data) => $this->createAlbumFromFolder($data)),

            CreateAction::make()
                ->label('Crea album'),
        ];
    }

    private function createAlbumFromFolder(array $data): RedirectResponse
    {
        $uploads = $this->collectUploads($data);

        if ($uploads === []) {
            Notification::make()
                ->title('Nessuna foto selezionata')
                ->warning()
                ->send();

            return back();
        }

        $title = $this->resolveTitle($data, $uploads);

        $album = Album::query()->create([
            'title' => $title,
            'slug' => $this->uniqueSlug($title),
            'year' => now()->year,
            'type' => AlbumType::Personal,
            'is_published' => true,
        ]);

        $moved = $this->moveUploadsToAlbum($album, $uploads);

        app(AlbumPhotoUploadService::class)->uploadToAlbums([
            'photos' => array_map(fn (array $upload): string => $upload['path'], $moved),
            'photo_file_names' => array_map(fn (array $upload): string => $upload['filename'], $moved),
        ], collect([$album]));

        return redirect(EditAlbum::getUrl(['record' => $album]));
    }

    /**
     * @return array<int, array{path: string, filename: string}>
     */
    private function collectUploads(array $data): array
    {
        $paths = $data['photos'] ?? [];
        $names = $data['photo_file_names'] ?? [];

        $paths = is_array($paths) ? $paths : [$paths];
        $names = is_array($names) ? $names : [];

        $uploads = [];

        foreach ($paths as $key => $path) {
            if (! is_string($path) || blank($path)) {
                continue;
            }

            $uploads[] = [
                'path' => $path,
                'filename' => is_string($names[$key] ?? null) && filled($names[$key])
                    ? $names[$key]
                    : basename($path),
            ];
        }

        usort($uploads, fn (array $first, array $second): int => strnatcasecmp($first['filename'], $second['filename']));

        return $uploads;
    }

    /**
     * @param  array<int, array{path: string, filename: string}>  $uploads
     */
    private function resolveTitle(array $data, array $uploads): string
    {
        $title = trim((string) ($data['title'] ?? ''));

        if ($title !== '') {
            return $title;
        }

        foreach ($uploads as $upload) {
            $parts = array_values(
                array_filter(
                    explode('/', str_replace('\\', '/', $upload['filename'])),
                    fn (string $part): bool => filled($part)
                )
            );

            if ($parts === []) {
                continue;
            }

            $candidate = $parts[0];
            $extension = strtolower(pathinfo($candidate, PATHINFO_EXTENSION));
            $isPhotoName = in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'tiff', 'bmp'], true) && count($parts) === 1;

            if ($isPhotoName) {
                continue;
            }

            return (string) Str::of($candidate)
                ->replace(['_', '-'], ' ')
                ->squish()
                ->title();
        }

        return 'Album';
    }

    private function uniqueSlug(string $title): string
    {
        $slug = Str::slug($title) ?: 'album';
        $candidate = $slug;
        $counter = 2;

        while (Album::query()->where('slug', $candidate)->exists()) {
            $candidate = $slug.'-'.$counter;
            $counter++;
        }

        return $candidate;
    }

    /**
     * @param  array<int, array{path: string, filename: string}>  $uploads
     * @return array<int, array{path: string, filename: string}>
     */
    private function moveUploadsToAlbum(Album $album, array $uploads): array
    {
        $temporaryDisk = Storage::disk(
            config('livewire.temporary_file_upload.disk') ?: config('filesystems.default')
        );
        $publicDisk = Storage::disk('public');
        $directory = 'albums/'.$album->slug;

        $taken = [];
        $moved = [];

        foreach ($uploads as $upload) {
            $basename = basename(str_replace('\\', '/', $upload['filename']));

            if ($basename === '') {
                $basename = basename($upload['path']);
            }

            $destination = $directory.'/'.$basename;
            $counter = 1;

            while (isset($taken[$destination])) {
                $counter++;
                $destination = $directory.'/'.pathinfo($basename, PATHINFO_FILENAME).'-'.$counter.'.'.pathinfo($basename, PATHINFO_EXTENSION);
            }

            $taken[$destination] = true;

            try {
                $stream = $temporaryDisk->readStream($upload['path']);

                if (! is_resource($stream)) {
                    continue;
                }

                $publicDisk->writeStream($destination, $stream);

                if (is_resource($stream)) {
                    fclose($stream);
                }

                $temporaryDisk->delete($upload['path']);

                if ($temporaryDisk->exists($upload['path'].'.json')) {
                    $temporaryDisk->delete($upload['path'].'.json');
                }
            } catch (\Throwable) {
                continue;
            }

            $moved[] = [
                'path' => $destination,
                'filename' => basename($destination),
            ];
        }

        return $moved;
    }
}
