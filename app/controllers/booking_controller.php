<?php 
	namespace Controllers;

	use Models\Booking;

	/**
	 * 
	 */
	class BookingController
	{
		
		public static function show(){
			$bookings = Booking::all();
			return $bookings;
		}

		public static function create($user_id,$booking_name,$booking_date,$booking_time,$booking_status,$table_no){
			$booking = Booking::create(["user_id"=>$user_id,"booking_name"=>$booking_name,"table_no"=>$table_no,"booking_date"=>$booking_date,"booking_time"=>$booking_time,"booking_status"=>$booking_status]);
			return $booking;
		}

		public static function showBooking($id){
			$booking = Booking::where("id",$id)->first();
			
			return $booking;
		}
		public static function showUserBookings($user_id){
			$bookings = Booking::where("user_id","=",$user_id)->get();
			return $bookings;
		}

		public static function update(){

		}

		public static function cancelBooking($id){
			$booking = Booking::where("id",$id)->first();
			$booking->booking_status = false;
			$res = $booking->save();
			return $res;
		}

		public static function delete ($id){
			$booking = Booking::where("id",$id)->first();
			$res = $booking->delete();
			return $res;
		}	

	}


 ?>