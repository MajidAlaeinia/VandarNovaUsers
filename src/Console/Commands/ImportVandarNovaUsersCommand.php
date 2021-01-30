<?php

namespace majidalaeinia\VandarNovaUsers\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ImportVandarNovaUsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vandar:import-vandar-nova-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Vandar Nova users.';

    /**
     * @var Carbon
     */
    protected $now;



    /**
     * ImportVandarNovaUsersCommand constructor.
     *
     * @param Carbon $now
     */
    public function __construct()
    {
        parent::__construct();

        $this->now = Carbon::now();
    }



    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        if (env('APP_ENV') == 'local') {
            DB::table('users')->truncate();
            foreach ($this->getGeneratedUser() as $user) {
                DB::table('users')->insert($user);
            }

            $this->info('Users was imported successfully');
        } else {
            $this->warn("This command can be run on local environments only.");
        }
    }

    /**
     * Hash the input value and return it (by default 'password' will be hashed)
     *
     * @param  string  $password
     *
     * @return mixed
     */
    private function generateHashedPassword($password = 'password')
    {
        return Hash::make($password);
    }

    /**
     * Generate manual users and return it
     *
     * @return array[]
     */
    private function getGeneratedUser()
    {
        $users = [
            [
                'id' => 1,
                'name' => 'Mohammad Maghsoudi',
                'email' => 'maghsoudi@jamal.com',
                'password' => $this->generateHashedPassword(),
                'created_at' => $this->now,
                'updated_at' => $this->now,
            ],
            [
                'id' => 3,
                'name' => 'Mehdi Ebadi',
                'email' => 'ebadi@jamal.com',
                'password' => $this->generateHashedPassword(),
                'created_at' => $this->now,
                'updated_at' => $this->now,
            ],
            [
                'id' => 4,
                'name' => 'Amin Ahmadi',
                'email' => 'ahmadi@jamal.com',
                'password' => $this->generateHashedPassword(),
                'created_at' => $this->now,
                'updated_at' => $this->now,
            ],
        ];

        return $users;
    }
}