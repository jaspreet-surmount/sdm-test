<?php namespace App;

/**
 * @package App
 */

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'students';

    /**
     * The Primary key for table model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'dob', 'contact_number', 'gender', 'favorite_subjects', 'other_activities',
        'program_id', 'is_active', 'created_by', 'last_updated_by',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function program()
    {
        return $this->belongsTo('App\Program');
    }

    /**
     * @param array|null $value
     */
    public function setFavoriteSubjectsAttribute($value)
    {
        $this->attributes['favorite_subjects'] = implode(',', $value);
    }

    /**
     * @param int $isActive
     * @return mixed
     */
    public function getData($isActive = 1)
    {
        return $this->where('is_active', '=', $isActive)
            ->leftJoin('users', 'users.id', '=', 'students.created_by')
            ->leftJoin('users AS userMirror', 'userMirror.id', '=', 'students.last_updated_by')
            ->leftJoin('programs', 'programs.id', '=', 'students.program_id')
            ->select([
                'students.id', 'full_name', 'dob', 'contact_number', 'gender', 'favorite_subjects', 'other_activities',
                'programs.name AS program',
                'users.name AS created_by_user', 'userMirror.name AS updated_by_user',
                'students.updated_at', 'students.created_by',
            ]);
    }
}
