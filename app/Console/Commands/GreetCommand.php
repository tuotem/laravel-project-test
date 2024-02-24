<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GreetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'greet {user?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A simple command for greet a user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->confirm('Are you sure ?'))
        {
            $argument = $this->argument("user");

            if ($argument)
                $user_name = $argument;
            else
                $user_name = $this->ask("What is your name ?");
                
            $password = $this->secret("What is your password ?");

            return $this->info("Hello, How are you => $user_name with $password");
        }
        return $this->info("Sorry");
    }
}
