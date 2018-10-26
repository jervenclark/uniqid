<?php

namespace Jervenclark\Uniqid\Traits;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Log;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Ramsey\Uuid\Uuid;

trait HasUniqid
{

    private $column;

    /**
     * HasUniqid boot function
     *
     * @return void
     */
    public static function bootHasUniqid()
    {
        static::creating(function ($model) {
            try {
                $model->uniqid = Uuid::uuid4();
            }
            catch (UnsatisfiedDependencyException $e) {
                $log  = "Caught exception: {$e->getMessage()} \n";
                $log .= "Cannot complete generating User uuid \n";
                Log::error($log);
            }
        });
    }

    /**
     * Model route key name
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uniqid';
    }

    /**
     * Search scope for model by Uuid
     *
     * @param  string $uuid  The UUID of the model.
     * @return NULL|App\Models\User
     */
    public function scopeUuid($query, $uniqid, $first = true)
    {
        if (!is_string($uniqid) ||
            strlen($uniqid) != 36 ||
            preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/', $uniqid) !== 1) {
            throw (new ModelNotFoundException)->setModel(__CLASS__);
        }
        $search = $query->where('uniqid', $uniqid);
        return $first ? $search->firstOrFail() : $search;
    }

}
