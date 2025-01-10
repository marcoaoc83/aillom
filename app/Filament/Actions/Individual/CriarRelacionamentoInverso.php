<?php

namespace App\Filament\Actions\Individual;

use App\Models\IndividualRelationship;
use App\Models\TypesIndividualRelationship;

class CriarRelacionamentoInverso
{
    public static function handle(IndividualRelationship $relationship): void
    {
        try {
            // Obtém o tipo de relacionamento inverso
            $inverseRelationshipTypeId = TypesIndividualRelationship::find($relationship->relationship_type_id)?->inverse_relationship_id;

            // Verifica se o relacionamento inverso já existe
            $existingInverseRelationship = IndividualRelationship::where('individual_id1', $relationship->individual_id2)
                ->where('individual_id2', $relationship->individual_id1)
                ->where('relationship_type_id', $inverseRelationshipTypeId)
                ->first();

            // Cria o relacionamento inverso, se necessário
            if (!$existingInverseRelationship && $inverseRelationshipTypeId) {
                IndividualRelationship::create([
                    'individual_id1' => $relationship->individual_id2,
                    'individual_id2' => $relationship->individual_id1,
                    'relationship_type_id' => $inverseRelationshipTypeId,
                    'relationship_start_date' => $relationship->relationship_start_date,
                ]);
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
