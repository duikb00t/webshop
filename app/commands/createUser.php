<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class createUser extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'user:add';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Add a user to the users table.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$user 	  = $this->argument('name');
		$pass 	  = $this->argument('password');
		$company  = $this->argument('company');
		$street   = $this->argument('street');
		$postcode = $this->argument('postcode');
		$city 	  = $this->argument('city');
		$email	  = $this->argument('email');
		$admin 	  = $this->argument('admin');

		DB::table('users')->insert(
			array(
				'login' 	=> $user, 
				'company'	=> $company,
				'street'	=> $street,
				'postcode' 	=> $postcode,
				'city'		=> $city,
				'email'		=> $email,
				'active' 	=> 1,
				'isAdmin' 	=> $admin, 
				'password' 	=> Hash::make($pass), 
				)
			);

	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('name', 		InputArgument::REQUIRED, '(Required) String'),
			array('password', 	InputArgument::REQUIRED, '(Required) String'),
			array('company', 	InputArgument::REQUIRED, '(Required) String'),
			array('street', 	InputArgument::REQUIRED, '(Required) String'),
			array('postcode', 	InputArgument::REQUIRED, '(Required) String'),
			array('city', 		InputArgument::REQUIRED, '(Required) String'),
			array('email', 		InputArgument::REQUIRED, '(Required) String'),
			array('admin', 		InputArgument::OPTIONAL, '(Optional) Boolean [Default: false]', false)
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
		);
	}

}
