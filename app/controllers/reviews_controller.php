<?php 
	namespace Controllers;
	use Models\Reviews;


	/**
	 * 
	 */
	class ReviewsController 
	{
		
		public static function show(){
			$reviews = Reviews::all();
			return $reviews;
		}

		public static function create($user_id,$booking_id,$review){
			$review = Reviews::create(["user_id"=>$user_id,"booking_id"=>$booking_id,"review"=>$review]);
			return $review;
		}

		public static function update($review_id,$review){
			$review = Reviews::where("id",$id)->first();
			$review->review = $review;
			$res = $review->save();
			return $res;
		}

		public static function delete ($id){
			$review = Reviews::where("id",$id)->first();
			$res = $review->delete();
			return $res;
		}
	}


 ?>