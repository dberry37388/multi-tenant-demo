<?php

namespace App\Console\Commands;

use App\Notifications\TenantCreated;
use App\Tenant;
use Hyn\Tenancy\Models\Customer;
use Illuminate\Console\Command;

class CreateTenant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:create {name} {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a tenant with the provided name and email address e.g. php artisan tenant:create boise boise@example.com';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $name = $this->argument('name');
        $email = $this->argument('email');
        
        if ($this->tenantExists($name, $email)) {
            $this->error("A tenant with name '{$name}' and/or '{$email}' already exists.");
            return;
        }
    
        $tenant = Tenant::createFrom($name, $email);
        $this->info("Tenant '{$name}' is created and is now accessible at {$tenant->hostname->fqdn}");
    
        // invite admin
        $tenant->admin->notify(new TenantCreated($tenant->hostname));
        $this->info("Admin {$email} has been invited!");
    }
    
    /**
     * Checks to see if a tenant already exists.
     *
     * @param $name
     * @param $email
     * @return mixed
     */
    private function tenantExists($name, $email)
    {
        return Customer::where('name', $name)->orWhere('email', $email)->exists();
    }
}
