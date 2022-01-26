<?php

namespace App\Models\Packages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Packages\PackageItem
 *
 * @property int $id
 * @property int|null $package_id
 * @property string $name
 * @property int $duration
 * @property string|null $start_date
 * @property string|null $end_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Packages\Package|null $package
 * @method static \Illuminate\Database\Eloquent\Builder|PackageItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PackageItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PackageItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|PackageItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackageItem whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackageItem whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackageItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackageItem whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackageItem wherePackageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackageItem whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackageItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PackageItem extends Model
{
    use HasFactory;

    protected $fillable = ['package_id', 'name', 'duration'];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
