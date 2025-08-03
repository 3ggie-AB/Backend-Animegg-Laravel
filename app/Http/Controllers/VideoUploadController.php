<?php

namespace App\Http\Controllers;

use App\Models\VideoUpload;
use Illuminate\Http\Request;
use App\Helpers\GoogleDriveHelper;
use Google\Client as GoogleClient;
use Google\Service\Drive as GoogleDrive;
use Illuminate\Support\Facades\Response;


class VideoUploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'anime_id' => 'required|exists:animes,id',
            'video' => 'required|file|mimes:mp4,avi,mov,mkv|max:512000',
            'episode' => 'required|numeric',
            'thumbnail' => 'required|image|max:5120',
            'resolution' => 'required|string|in:1080p,720p,480p,240p,144p',
            'description' => 'nullable|string',
        ]);
        $user = $request->user();
        try {
            $thumbFile = $request->file('thumbnail');
            $thumbName = 'thumb_' . $user->id . '_' . time() . '.' . $thumbFile->getClientOriginalExtension();
            $thumbnailPath = $thumbFile->storeAs('thumbnails', $thumbName, 'public');

            $url = GoogleDriveHelper::uploadVideo($request->file('video'), env('GOOGLE_DRIVE_FOLDER_ID'));
            $videoUpload = VideoUpload::create([
                'user_id' => $user->id,
                'anime_id' => $request->anime_id,
                'episode' => $request->episode,
                'video_url' => $url,
                'thumbnail' => $thumbnailPath,
                'status' => 'complete',
                'resolution' => $request->resolution,
                'description' => $request->description,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return response()->json([
                'message' => 'Video berhasil diupload.',
                'data' => $videoUpload,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal upload: ' . $e->getMessage(),
            ], 400);
        }
    }
    protected function makeDriveService(): GoogleDrive
    {
        $client = new GoogleClient();
        $path = storage_path('app/private/google-service-account.json');
        if (!file_exists($path)) {
            abort(500, 'Credential Google tidak ditemukan.');
        }
        $client->setAuthConfig($path);
        $client->addScope(GoogleDrive::DRIVE_READONLY);
        $client->setAccessType('offline');

        return new GoogleDrive($client);
    }

    public function stream(Request $request, string $fileId)
    {
        // Validasi sederhana: fileId hanya alfanumerik, dash, underscore
        if (!preg_match('/^[a-zA-Z0-9_-]+$/', $fileId)) {
            abort(400, 'Invalid file ID.');
        }

        $drive = $this->makeDriveService();

        // Ambil metadata dulu (optional, bisa digunakan untuk content-type/size)
        try {
            $meta = $drive->files->get($fileId, ['fields' => 'id,name,mimeType,size']);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal mengambil metadata: ' . $e->getMessage()
            ], 404);
        }

        $mimeType = $meta->getMimeType() ?: 'application/octet-stream';
        $size = (int) ($meta->getSize() ?? 0);

        // Tangani Range header supaya bisa seeking
        $headers = [];
        $range = $request->header('Range');
        $statusCode = 200;
        $start = 0;
        $end = $size - 1;

        if ($range) {
            if (preg_match('/bytes=(\d+)-(\d*)/', $range, $matches)) {
                $start = intval($matches[1]);
                if ($matches[2] !== '') {
                    $end = intval($matches[2]);
                }
                if ($end >= $size) {
                    $end = $size - 1;
                }
                if ($start > $end) {
                    return response('', 416)->header('Content-Range', "bytes */{$size}");
                }
                $statusCode = 206; // partial content
                $headers['Content-Range'] = "bytes {$start}-{$end}/{$size}";
            }
        }

        $headers['Accept-Ranges'] = 'bytes';
        $headers['Content-Type'] = $mimeType;
        $headers['Content-Length'] = ($end - $start) + 1;

        // Ambil stream dari Drive dengan query alt=media dan range via HTTP stream
        $accessToken = $drive->getClient()->getAccessToken();
        $httpClient = $drive->getClient()->getHttpClient();

        $downloadUrl = "https://www.googleapis.com/drive/v3/files/{$fileId}?alt=media";

        // Tambahkan Range header ke request ke Google jika partial
        $reqHeaders = [
            'Authorization' => 'Bearer ' . $accessToken['access_token'],
        ];
        if ($range) {
            $reqHeaders['Range'] = "bytes={$start}-{$end}";
        }

        $gRes = $httpClient->request('GET', $downloadUrl, [
            'headers' => $reqHeaders,
            'stream' => true,
            'decode_content' => false,
        ]);

        // Stream kembali ke client sambil mempertahankan status & headers
        $body = $gRes->getBody();

        return Response::stream(function () use ($body) {
            while (!$body->eof()) {
                echo $body->read(1024 * 32);
                flush();
            }
        }, $statusCode, $headers);
    }
}
