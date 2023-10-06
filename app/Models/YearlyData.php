<?
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YearlyData extends Model
{
    protected $fillable = [
        'total_titles',
        'total_volumes',
        // Other attributes
    ];

    // Add any additional relationships or methods here
}
