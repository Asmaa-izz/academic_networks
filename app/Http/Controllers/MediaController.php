<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    use AuthorizesRequests;

    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('media'), $fileName);
            $path = 'media/' . $fileName;

            return response()->json(['success' => true, 'fileName' => $fileName, 'path' => $path, 'type' => $file->getClientMimeType()]);
        }
    }
}
