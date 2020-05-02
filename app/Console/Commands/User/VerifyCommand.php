<?php

namespace App\Console\Commands\User;

use Illuminate\Console\Command;
use App\Services\Auth\RegisterService;
use App\Models\User;


class VerifyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:verify {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private $service;

    public function __construct(RegisterService $service)
    {
        parent::__construct();
        $this->service = $service;
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): bool
    {
        $email = $this->argument('email');

        if (!$user = User::where('email', $email)->first()) {
            $this->error('Undefined user with email ' . $email);
            return false;
        }

        $this->service->verify($user->id);
        $this->info('Success! ' . $email . 'is now active');
        return true;
    }
}
