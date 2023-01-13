<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LearningLimitsSeeder extends Seeder
{
	public function run()
	{
		foreach (range(5, 30, 5) as $number) {
			$data = [
				'limit'	=>	$number
			];

			$this->db->table('learning_limit')->insert($data);

		}
		foreach (range(40, 100, 10) as $number) {
			$data = [
				'limit'	=>	$number
			];

			$this->db->table('learning_limit')->insert($data);

		}
		foreach (range(120, 200, 20) as $number) {
			$data = [
				'limit'	=>	$number
			];

			$this->db->table('learning_limit')->insert($data);

		}		
	}
}
