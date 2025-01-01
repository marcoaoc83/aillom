<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
class TypesContact extends Model implements AuditableContract {

    use Auditable;
    protected $fillable = ['description', 'regex'];
    protected $table = 'types_contact';
}
