<?php 
	namespace Models;

	use \Illuminate\Database\Eloquent\Model;
	use Illuminate\Database\Eloquent\SoftDeletes;
	/**
	 * 
	 */
	class Reviews extends Model
	{
		use SoftDeletes;

		protected $table = "reviews";
		protected $fillable = ['user_id','booking_id','review'];
	}

 ?>