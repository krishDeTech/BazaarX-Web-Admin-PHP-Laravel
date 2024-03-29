<?php 
/**
 *
 * @category zStarter
 *
 * @ref zCURD
 * @author  Defenzelite <hq@defenzelite.com>
 * @license https://www.defenzelite.com Defenzelite Private Limited
 * @version <zStarter: 1.1.0>
 * @link    https://www.defenzelite.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $guarded = ['id'];

    public function getImageAttribute($value){
        
        $img = !is_null($value) ? $value : 'https://ui-avatars.com/api/?name='.$this->title.'&background=random&v=' . rand(0, 999999);
        if(\Str::contains(request()->url(), 'api')){
          return asset('storage/backend/constant-management/sliders/'.$img);
        }
        return $img;
    }
}
