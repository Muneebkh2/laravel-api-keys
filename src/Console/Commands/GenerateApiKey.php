<?php

namespace Muneebkh2\ApiKeys\Console\Commands;

use Illuminate\Console\Command;
use Muneebkh2\ApiKeys\Models\ApiKey;

class GenerateApiKey extends Command
{
    /**
     * Error messages
     */
    const MESSAGE_ERROR_INVALID_NAME_FORMAT = 'Invalid name.  Must be a lowercase alphabetic characters, numbers and hyphens less than 255 characters long.';
    const MESSAGE_ERROR_NAME_ALREADY_USED   = 'Name is unavailable.';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apikey:generate {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new API key';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');

        if (!ApiKey::isValidName($name)) {
            $this->error(self::MESSAGE_ERROR_INVALID_NAME_FORMAT);
            return;
        }
        if (ApiKey::nameExists($name)) {
            $this->error(self::MESSAGE_ERROR_NAME_ALREADY_USED);
            return;
        }

        $apiKey         = new ApiKey;
        $apiKey->name   = $name;
        $apiKey->key    = ApiKey::generate();
        $apiKey->active = true;
        $apiKey->save();

        $this->info('API key created');
        $this->info('Name: ' . $apiKey->name);
        $this->info('Key: '  . $apiKey->key);
    }
}
