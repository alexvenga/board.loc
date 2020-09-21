<?php

namespace App\Console\Commands\User;

use App\Http\UseCases\Auth\RegisterService;
use App\Models\User;
use Illuminate\Console\Command;

class VeryifyCommand extends Command
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
    protected $description = 'Verify user by email';

    /**
     * @var RegisterService
     */
    private $service;

    /**
     * Create a new command instance.
     *
     * @param RegisterService $service
     */
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
    public function handle()
    {

        $email = $this->argument('email');

        if (!$user = User::whereEmail($email)->first()) {
            $this->error('Can`t find user with email ' . $email);
            return false;
        }

        try {
            $this->service->verify($user->id);
        } catch (\DomainException $e) {
            $this->error($e->getMessage());
            return false;
        }

        $this->info('Success!');

        return true;
    }
}
