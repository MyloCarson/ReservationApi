<?php 
	namespace Controllers;
	use Models\User;


	/**
	 * 
	 */
	class UserController
	{

		public static function show (){
			$user = User::all();
			return $user;
		}

		public static function create ($username, $email,$password){
			$user = User::create(['username'=>$username,'email'=>$email, 'password'=>$password]);
			return $user;
		}

		public static function login ($email,$password){
			$user = User::where('email',$email)->first();
			if (strcmp($password,$user->password) == 0) {
				return $user;
			}
			return false;
		}
		
		public static function update($id,$username,$email,$password){
			$user = User::where('id',$id)->first();

			$user->email = $email;
			$user->username = $username;
			if (isset($password) && !empty($password)) {
				$user->password = $password;
			}
			$user->save();

			return $user;
		}

		public static function delete($email){
			$user = User::where('email',$email)->first();
			return $user->delete();
		}
		
	}
 ?>