<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RepeatlimitsSeeder extends Seeder
{
	public function run()
	{
		foreach (range(0, 500, 50) as $number) {
			$data = [
				'limit'	=>	$number
			];

			$this->db->table('repeat_limit')->insert($data);

		}
		foreach (range(600, 1500, 100) as $number) {
			$data = [
				'limit'	=>	$number
			];

			$this->db->table('repeat_limit')->insert($data);

		}
	}
}
