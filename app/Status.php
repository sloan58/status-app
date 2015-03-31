<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model {


    /**
     * Fillable fields for a new Status
     *
     * @var array
     */
    protected $fillable = ['body', 'user_id', 'project_id'];

    /*
     * Status belongs to Project
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    /*
     * Status belongs to User
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
