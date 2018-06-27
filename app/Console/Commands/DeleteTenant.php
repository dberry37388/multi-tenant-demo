<?php

namespace App\Console\Commands;

use App\Tenant;
use Illuminate\Console\Command;

class DeleteTenant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:delete {name} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes a tenant of the provided name. Only available on the local environment e.g. php artisan tenant:delete boise';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // because this is a destructive command, we'll only allow to run this command
        // if you are on the local environment
        if (! (app()->isLocal() || app()->runningUnitTests()) || ! $this->option('force') === true) {
            $this->error('This command is only available on the local environment.');
        
            return;
        }
    
        $name = $this->argument('name');
        
        if ($tenant = Tenant::retrieveBy($name)) {
            $tenant->delete();
            $this->info("Tenant {$name} successfully deleted.");
        } else {
            $this->error("Could not find tenant {$name}");
        }
    }
}
