<?php

namespace App\Helpers;

use Google\Client as GoogleClient;
use Google\Service\Drive as GoogleDrive;
use Google\Service\Drive\DriveFile;
use Google\Service\Drive\Permission;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class GoogleDriveHelper
{
    // ekstensi video yang diizinkan
    protected static array $allowedExtensions = ['mp4', 'avi', 'mov', 'mkv'];

    /**
     * Upload video ke Google Drive dan set permission supaya bisa dilihat siapa pun yang punya link.
     *
     * @param UploadedFile $file
     * @param string|null $targetFolderId (opsional) ID folder di Drive, kalau null => root
     * @return string URL shareable
     * @throws \Exception
     */
    public static function uploadVideo(UploadedFile $file, ?string $targetFolderId = null): string
    {
        // validasi ekstensi
        $ext = strtolower($file->getClientOriginalExtension());
        if (!in_array($ext, self::$allowedExtensions)) {
            throw new \Exception("Tipe file tidak didukung: .{$ext}. Hanya " . implode(', ', self::$allowedExtensions) . " yang diizinkan.");
        }

        // inisialisasi Google Client dengan service account
        $serviceAccountPath = storage_path('app/private/google-service-account.json');
        if (!file_exists($serviceAccountPath)) {
            throw new \Exception("File credential tidak ditemukan di: {$serviceAccountPath}");
        }

        $client = new GoogleClient();
        $client->setAuthConfig($serviceAccountPath);
        $client->addScope(GoogleDrive::DRIVE);
        $client->setAccessType('offline');

        $driveService = new GoogleDrive($client);

        // siapkan metadata file
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeName = Str::slug($originalName) . '-' . Str::random(6) . '.' . $ext;

        $driveFile = new DriveFile([
            'name' => $safeName,
            // jika ingin simpan di folder tertentu
            'parents' => $targetFolderId ? [$targetFolderId] : null,
        ]);

        // upload (stream) file
        $fileStream = fopen($file->getRealPath(), 'r');
        try {
            $created = $driveService->files->create($driveFile, [
                'data' => stream_get_contents($fileStream),
                'uploadType' => 'multipart',
                'fields' => 'id,name',
            ]);
        } finally {
            if (is_resource($fileStream)) {
                fclose($fileStream);
            }
        }

        if (empty($created->id)) {
            throw new \Exception("Gagal mengupload ke Google Drive.");
        }

        $fileId = $created->id;

        // set permission: anyone with link can view
        $permission = new Permission([
            'type' => 'anyone',
            'role' => 'reader',
        ]);

        $driveService->permissions->create($fileId, $permission, ['fields' => 'id']);

        // return shareable URL
        return "https://drive.google.com/file/d/{$fileId}/view?usp=sharing";
    }
}
