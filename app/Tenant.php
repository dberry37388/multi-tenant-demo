<?php

namespace App;


use Hyn\Tenancy\Contracts\Repositories\CustomerRepository;
use Hyn\Tenancy\Contracts\Repositories\HostnameRepository;
use Hyn\Tenancy\Contracts\Repositories\WebsiteRepository;
use Hyn\Tenancy\Environment;
use Hyn\Tenancy\Models\Customer;
use Hyn\Tenancy\Models\Hostname;
use Hyn\Tenancy\Models\Website;
use Illuminate\Support\Facades\Hash;

class Tenant
{
    /**
     * Tenant constructor.
     *
     * @param \Hyn\Tenancy\Contracts\Customer $customer
     * @param \Hyn\Tenancy\Models\Website|null $website
     * @param \Hyn\Tenancy\Models\Hostname|null $hostname
     * @param \App\User|null $admin
     */
    public function __construct(Customer $customer, Website $website = null, Hostname $hostname = null, User $admin = null)
    {
        $this->customer = $customer;
        $this->website = $website ?? $customer->websites->first();
        $this->hostname = $hostname ?? $customer->hostnames->first();
        $this->admin = $admin;
    }
    
    /**
     * Deletes a Tenant.
     *
     * @return void
     */
    public function delete()
    {
        app(HostnameRepository::class)->delete($this->hostname, true);
        app(WebsiteRepository::class)->delete($this->website, true);
        app(CustomerRepository::class)->delete($this->customer, true);
    }
    
    /**
     * Creates a new Tenant from the given information.
     *
     * @param $name
     * @param $email
     * @return \App\Tenant
     */
    public static function createFrom($name, $email): Tenant
    {
        // create a customer
        $customer = new Customer;
        $customer->name = $name;
        $customer->email = $email;
        
        app(CustomerRepository::class)->create($customer);
        
        // associate the customer with a website
        $website = new Website;
        $website->customer()->associate($customer);
        
        app(WebsiteRepository::class)->create($website);
        
        // associate the website with a hostname
        $hostname = new Hostname;
        $baseUrl = config('app.url_base');
        $hostname->fqdn = "{$name}.{$baseUrl}";
        $hostname->customer()->associate($customer);
        
        app(HostnameRepository::class)->attach($hostname, $website);
        
        // make hostname current
        app(Environment::class)->hostname($hostname);
        $admin = static::makeAdmin($name, $email, str_random());
        
        return new Tenant($customer, $website, $hostname, $admin);
    }
    
    /**
     * Creates an Admin user.
     *
     * @param $name
     * @param $email
     * @param $password
     * @return \App\User
     */
    private static function makeAdmin($name, $email, $password): User
    {
        $admin = User::create(['name' => $name, 'email' => $email, 'password' => Hash::make($password)]);
        $admin->guard_name = 'web';
        $admin->assignRole('admin');
        
        return $admin;
    }
    
    /**
     * Retrieves a Tenant by the given name.
     *
     * @param $name
     * @return \App\Tenant|null
     */
    public static function retrieveBy($name): ?Tenant
    {
        if ($customer = Customer::where('name', $name)->with(['websites', 'hostnames'])->first()) {
            return new Tenant($customer);
        }
        
        return null;
    }
}
