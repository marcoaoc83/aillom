<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'mysql') {
            DB::unprepared("
                CREATE TRIGGER before_insert_address
                BEFORE INSERT ON addresses
                FOR EACH ROW
                BEGIN
                    DECLARE parent_hierarchical_code VARCHAR(255);
                    DECLARE last_hierarchical_code VARCHAR(255);
                    DECLARE next_suffix INT;

                    IF NEW.parent_id IS NULL THEN
                        SET NEW.hierarchical_code = '1';
                    ELSE
                        SELECT hierarchical_code INTO parent_hierarchical_code
                        FROM addresses
                        WHERE id = NEW.parent_id;

                        SELECT hierarchical_code INTO last_hierarchical_code
                        FROM addresses
                        WHERE parent_id = NEW.parent_id
                        ORDER BY CAST(SUBSTRING_INDEX(hierarchical_code, '.', -1) AS UNSIGNED) DESC
                        LIMIT 1;

                        IF last_hierarchical_code IS NOT NULL THEN
                            SET next_suffix = CAST(SUBSTRING_INDEX(last_hierarchical_code, '.', -1) AS UNSIGNED) + 1;
                        ELSE
                            SET next_suffix = 1;
                        END IF;

                        SET NEW.hierarchical_code = CONCAT(parent_hierarchical_code, '.', next_suffix);
                    END IF;
                END;
            ");
        } elseif ($driver === 'pgsql') {
            DB::unprepared("
                CREATE OR REPLACE FUNCTION before_insert_address()
                RETURNS TRIGGER AS $$
                BEGIN
                    IF NEW.parent_id IS NULL THEN
                        NEW.hierarchical_code := '1';
                    ELSE
                        SELECT hierarchical_code INTO NEW.hierarchical_code
                        FROM addresses
                        WHERE id = NEW.parent_id;

                        SELECT hierarchical_code
                        INTO NEW.hierarchical_code
                        FROM addresses
                        WHERE parent_id = NEW.parent_id
                        ORDER BY hierarchical_code DESC
                        LIMIT 1;

                        IF NEW.hierarchical_code IS NOT NULL THEN
                            NEW.hierarchical_code := NEW.hierarchical_code || '.' || (substring(NEW.hierarchical_code from '[0-9]+$')::INT + 1)::TEXT;
                        ELSE
                            NEW.hierarchical_code := '1';
                        END IF;
                    END IF;
                    RETURN NEW;
                END;
                $$ LANGUAGE plpgsql;

                CREATE TRIGGER before_insert_address
                BEFORE INSERT ON addresses
                FOR EACH ROW EXECUTE FUNCTION before_insert_address();
            ");
        } elseif ($driver === 'sqlsrv') {
            DB::unprepared("
                CREATE TRIGGER before_insert_address
                ON addresses
                INSTEAD OF INSERT
                AS
                BEGIN
                    SET NOCOUNT ON;

                    DECLARE @parent_hierarchical_code NVARCHAR(255);
                    DECLARE @last_hierarchical_code NVARCHAR(255);
                    DECLARE @next_suffix INT;

                    IF (SELECT parent_id FROM inserted) IS NULL
                    BEGIN
                        INSERT INTO addresses (hierarchical_code, parent_id)
                        SELECT '1', parent_id FROM inserted;
                    END
                    ELSE
                    BEGIN
                        SELECT @parent_hierarchical_code = hierarchical_code
                        FROM addresses
                        WHERE id = (SELECT parent_id FROM inserted);

                        SELECT TOP 1 @last_hierarchical_code = hierarchical_code
                        FROM addresses
                        WHERE parent_id = (SELECT parent_id FROM inserted)
                        ORDER BY CAST(RIGHT(hierarchical_code, CHARINDEX('.', REVERSE(hierarchical_code)) - 1) AS INT) DESC;

                        IF @last_hierarchical_code IS NOT NULL
                        BEGIN
                            SET @next_suffix = CAST(RIGHT(@last_hierarchical_code, CHARINDEX('.', REVERSE(@last_hierarchical_code)) - 1) AS INT) + 1;
                        END
                        ELSE
                        BEGIN
                            SET @next_suffix = 1;
                        END

                        INSERT INTO addresses (hierarchical_code, parent_id)
                        SELECT CONCAT(@parent_hierarchical_code, '.', @next_suffix), parent_id
                        FROM inserted;
                    END
                END;
            ");
        } elseif ($driver === 'sqlite') {
            // Ajustar conforme necessário ou implemente manualmente no código PHP.
        }
    }

    public function down(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'mysql') {
            DB::unprepared("DROP TRIGGER IF EXISTS before_insert_address;");
        } elseif ($driver === 'pgsql') {
            DB::unprepared("
                DROP TRIGGER IF EXISTS before_insert_address ON addresses;
                DROP FUNCTION IF EXISTS before_insert_address();
            ");
        } elseif ($driver === 'sqlsrv') {
            DB::unprepared("DROP TRIGGER IF EXISTS before_insert_address;");
        }
    }
};
