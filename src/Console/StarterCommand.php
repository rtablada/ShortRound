<?php namespace Rtablada\ShortRound;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class StarterCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';
    /**
     * @var \Illuminate\Filesystem\Filesystem
     */
    private $file;

    /**
     * Create a new command instance.
     *
     * @return StarterCommand
     */
    public function __construct(Filesystem $file)
    {
        parent::__construct();
        $this->file = $file;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->file->deleteDirectory(base_path('resources/assets/less'));
        $this->file->deleteDirectory(app_path('Http/routes.php'));
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
        ];
    }

}
