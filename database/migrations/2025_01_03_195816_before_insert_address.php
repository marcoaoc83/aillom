<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::unprepared("
            CREATE TRIGGER before_insert_address
            BEFORE INSERT ON addresses
            FOR EACH ROW
            BEGIN
                DECLARE parent_hierarchical_code VARCHAR(255);
                DECLARE last_hierarchical_code VARCHAR(255);
                DECLARE next_suffix INT;

                -- Se o parent_id for nulo, significa que é o registro principal (ex: Planeta Terra)
                IF NEW.parent_id IS NULL THEN
                    SET NEW.hierarchical_code = '1'; -- Primeiro nível, sem pai
                ELSE
                    -- Obter o hierarchical_code do pai
                    SELECT hierarchical_code INTO parent_hierarchical_code
                    FROM addresses
                    WHERE id = NEW.parent_id;

                    -- Obter o último código hierárquico para o mesmo parent_id
                    SELECT hierarchical_code INTO last_hierarchical_code
                    FROM addresses
                    WHERE parent_id = NEW.parent_id
                    ORDER BY CAST(SUBSTRING_INDEX(hierarchical_code, '.', -1) AS UNSIGNED) DESC
                    LIMIT 1;

                    -- Calcular o próximo sufixo
                    IF last_hierarchical_code IS NOT NULL THEN
                        SET next_suffix = CAST(SUBSTRING_INDEX(last_hierarchical_code, '.', -1) AS UNSIGNED) + 1;
                    ELSE
                        SET next_suffix = 1; -- Primeiro filho do parent_id
                    END IF;

                    -- Atualizar o hierarchical_code do novo registro
                    SET NEW.hierarchical_code = CONCAT(parent_hierarchical_code, '.', next_suffix);
                END IF;
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS before_insert_address");
    }
};
