<?php 
	namespace Models;

	use \Illuminate\Database\Eloquent\Model;
	use Illuminate\Database\Eloquent\SoftDeletes;
	 /**
	  * 
	  */
	 class Booking extends Model
	 {
	 	
	 	use SoftDeletes;

		protected $table = "bookings";
		protected $fillable = ['user_id, booking_name','booking_date',
						'booking_time','booking_status','table_name'];
	 }

 ?>