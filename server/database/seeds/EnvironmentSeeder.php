<?php

use App\Models\Environment;
use Illuminate\Database\Seeder;

class EnvironmentSeeder extends Seeder
{
    private $environments;

    public function run()
    {
        Environment::truncate();

        $this->environments = [
            'cozinha',
            'quarto',
            'sala',
            'banheiro',
            'lavanderia',
            'escritorio',
        ];

        $this->createEnvironments();
        $this->command->info('Environments created');
    }

    private function createEnvironments() {
        foreach ($this->environments as $environment) {
            Environment::create(['name' => $environment]);
        }
    }

}