<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {


    /**
     * Fillable fields for a new Project
     *
     * @var array
     */
    protected $fillable = ['name', 'created_by', 'last_updated_by'];

    /*
     * A Project has many Statuses
     */
    public function status()
    {
        return $this->hasMany('App\Status');
    }

    /*
     * A Project belongs to a User
     */
    public function user()
    {
        return $this->belongsToMany('App\User');
    }

    /*
     * A Project belongs to a creator: 'App\User'
     */
    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    /*
     * A Project is updated by 'App\User'
     */
    public function lastUpdatedBy()
    {
        return $this->belongsTo('App\User', 'last_updated_by');
    }

}
