<?php

namespace App\Models;

use CodeIgniter\Model;

class Galeri extends Model
{
    protected $table            = 'publikasi_galeri';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    
    protected $allowedFields = [
        'konten_id',
        'image_path',
        'caption',
        'urutan'
    ];

    // protected $useTimestamps = false;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at'
    // protected $updatedField  = '';

    protected $validationRules = [
        'konten_id'  => 'required|integer',
        'image_path' => 'required',
        'caption'    => 'permit_empty|max_length[255]',
    ];

    protected $skipValidation = false;

    /**
     * Get images by konten_id
     */
    public function getImagesByKonten($kontenId)
    {
        return $this->where('konten_id', $kontenId)
                    ->orderBy('urutan', 'ASC')
                    ->findAll();
    }

    /**
     * Delete images by konten_id
     */
    public function deleteByKonten($kontenId)
    {
        $images = $this->getImagesByKonten($kontenId);
        
        // Delete files first
        foreach ($images as $image) {
            $filePath = FCPATH . 'uploads/publikasi/galeri/' . $image->image_path;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        
        // Delete records
        return $this->where('konten_id', $kontenId)->delete();
    }

    /**
     * Reorder images
     */
    public function reorderImages($kontenId, $imageIds)
    {
        $urutan = 1;
        foreach ($imageIds as $imageId) {
            $this->update($imageId, ['urutan' => $urutan]);
            $urutan++;
        }
        return true;
    }
}