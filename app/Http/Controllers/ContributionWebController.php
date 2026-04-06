<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Illuminate\Support\Facades\File;

class ContributionWebController extends Controller
{
    public function pendingIndex()
    {
        $groupedContributions = Contribution::where('status', 'pending')
            ->orderBy('label_name')
            ->latest()
            ->get()
            ->groupBy('label_name');
            
        return view('contributions.pending', compact('groupedContributions'));
    }

    public function approvedIndex()
    {
        $groupedContributions = Contribution::where('status', 'approved')
            ->orderBy('label_name')
            ->latest()
            ->get()
            ->groupBy('label_name');
            
        return view('contributions.approved', compact('groupedContributions'));
    }

    public function approve($id)
    {
        $contribution = Contribution::findOrFail($id);

        $currentPath = $contribution->image_path; 
        
        $fileName = basename($contribution->image_path);
        // clean up label_name to make sure it's valid for folder name
        $safeLabel = preg_replace('/[^A-Za-z0-9\-]/', '_', strtolower($contribution->label_name));
        $newPath = 'dataset/valid/' . $safeLabel . '/' . $fileName;

        if (Storage::disk('public')->exists($currentPath)) {
            if (!Storage::disk('public')->exists('dataset/valid/' . $safeLabel)) {
                Storage::disk('public')->makeDirectory('dataset/valid/' . $safeLabel);
            }
            Storage::disk('public')->move($currentPath, $newPath);

            $contribution->update([
                'status' => 'approved',
                'image_path' => $newPath
            ]);

            return redirect()->route('contributions.pending')->with('success', 'Kontribusi berhasil disetujui.');
        }

        return redirect()->route('contributions.pending')->with('error', 'File gambar tidak ditemukan. Pastikan proses sinkronisasi telah selesai.');
    }

    public function reject($id)
    {
        $contribution = Contribution::findOrFail($id);

        $currentPath = $contribution->image_path;
        if (Storage::disk('public')->exists($currentPath)) {
            Storage::disk('public')->delete($currentPath);
        }

        $contribution->update(['status' => 'rejected']);

        return redirect()->route('contributions.pending')->with('success', 'Kontribusi ditolak.');
    }

    public function rejectAll(Request $request)
    {
        $contributions = Contribution::where('status', 'pending')->get();
        
        foreach ($contributions as $contribution) {
            $currentPath = $contribution->image_path;
            if (Storage::disk('public')->exists($currentPath)) {
                Storage::disk('public')->delete($currentPath);
            }
            $contribution->update(['status' => 'rejected']);
        }

        return redirect()->route('contributions.pending')->with('success', 'Semua antrean pending berhasil ditolak dan file fisiknya telah dihapus.');
    }

    public function revert($id)
    {
        $contribution = Contribution::findOrFail($id);

        if ($contribution->status !== 'approved') {
            return redirect()->route('contributions.approved')->with('error', 'Data ini tidak berstatus Approved.');
        }

        $currentPath = $contribution->image_path; 
        $fileName = basename($contribution->image_path);
        // Kembalikan ke folder penampungan awal
        $newPath = 'contributions/' . $fileName; 

        if (Storage::disk('public')->exists($currentPath)) {
            Storage::disk('public')->move($currentPath, $newPath);

            $contribution->update([
                'status' => 'pending',
                'image_path' => $newPath
            ]);

            return redirect()->route('contributions.approved')->with('success', 'Dataset berhasil dikembalikan ke antrean Pending.');
        }

        return redirect()->route('contributions.approved')->with('error', 'File gambar tidak ditemukan di folder validasi.');
    }

    public function downloadDataset()
    {
        $datasetPath = storage_path('app/public/dataset/valid');
        
        if (!File::exists($datasetPath)) {
            return redirect()->route('contributions.approved')->with('error', 'Dataset kosong atau belum ada.');
        }

        $zipFileName = 'dataset_valid_' . date('Y_m_d_His') . '.zip';
        $zipFilePath = storage_path('app/public/' . $zipFileName);

        $zip = new ZipArchive;
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            
            $files = File::allFiles($datasetPath);
            foreach ($files as $file) {
                // Gunakan getRelativePathname dan paksa '/' agar format ZIP terbaca folder di Linux/Colab
                $relativePath = str_replace('\\', '/', $file->getRelativePathname());
                $zip->addFile($file->getPathname(), $relativePath);
            }
            $zip->close();

            return response()->download($zipFilePath)->deleteFileAfterSend(true);
        }

        return redirect()->route('contributions.approved')->with('error', 'Gagal membuat zip file. Pastikan ekstensi php-zip telah aktif di php.ini Anda.');
    }
}
