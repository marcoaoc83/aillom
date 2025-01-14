<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IndividualDocument extends Model
{
    use SoftDeletes;

    protected $table = 'individual_documents';

    protected $fillable = [
        'individual_id',
        'document_type_id',
        'description',
        'document_number',
    ];

    public function individual()
    {
        return $this->belongsTo(Individual::class, 'individual_id');
    }

    public function documentType()
    {
        return $this->belongsTo(TypesDocument::class, 'document_type_id');
    }

    public function setDocumentNumberAttribute($value)
    {
        // Remove tudo que não é número
        $this->attributes['document_number'] = preg_replace('/\D/', '', $value);
    }

    public function getDocumentNumberAttribute($value)
    {
        $documentType = $this->documentType;

        $mask = $documentType?->mask;

        if (!$mask || !$value) {
            return $value;
        }

        return $this->applyMask($value, $mask);
    }

    /**
     * Aplica a máscara ao valor fornecido.
     *
     * @param string $value O valor a ser mascarado
     * @param string $mask A máscara a ser aplicada
     * @return string O valor formatado
     */
    protected function applyMask(string $value, string $mask): string
    {
        $masked = '';
        $valueIndex = 0;

        for ($i = 0; $i < strlen($mask); $i++) {
            if ($mask[$i] === '9' && isset($value[$valueIndex])) {
                $masked .= $value[$valueIndex++];
            } elseif ($mask[$i] !== '9') {
                $masked .= $mask[$i];
            }
        }

        return $masked;
    }


}
