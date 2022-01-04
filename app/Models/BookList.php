<?php

namespace App\Models;

use Carbon\Carbon;
use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class BookList extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public const LANGUAGE_SELECT = [
        '1' => 'Chinese',
        '2' => 'English',
        '3' => 'Malay',
    ];

    public const STATUS_SELECT = [
        '1' => '图书馆里',
        '2' => '外借中',
        '3' => '被预约',
        '4' => '外借回来了还没有处理',
    ];

    public $table = 'book_lists';

    protected $appends = [
        'image',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'uid',
        'title',
        'description',
        'book_category_id',
        'language',
        'year',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function book_category()
    {
        return $this->belongsTo(BookCategory::class, 'book_category_id');
    }

    public function book_tags()
    {
        return $this->belongsToMany(BookTag::class);
    }

    public function getImageAttribute()
    {
        $file = $this->getMedia('image')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public static function generateUID()
    {
        $now = Carbon::now()->format('ymd');
        $randNum1 = substr(str_shuffle("0123456789"), 0, 4);
        $randNum2 = substr(str_shuffle("0123456789"), 0, 4);

        $UID = 'BOOK_'.$now.'_'.$randNum1.'_'.$randNum2;

        return $UID;
    }
}
