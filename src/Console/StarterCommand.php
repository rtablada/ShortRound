<?php namespace Rtablada\ShortRound\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class StarterCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'shortround:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffolds new ShortRound CMS.';

    /**
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $file;

    protected $starterBlueprintPath;

    /**
     * Create a new command instance.
     *
     * @return StarterCommand
     */
    public function __construct(Filesystem $file)
    {
        parent::__construct();
        $this->file = $file;

        $this->starterBlueprintPath = __DIR__ . '/../../blueprints/starter';
    }

    protected $blueprintFiles = [
        'bower.json',
        'resources/templates/admin',
    ];

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->file->deleteDirectory(base_path('resources/assets/less'));
        $this->file->deleteDirectory(app_path('Http/Controllers/Auth'));
        $this->file->delete([app_path('Http/Controllers/HomeController.php'), app_path('Http/Controllers/WelcomController.php')]);

        $this->file->put(app_path('Http/routes.php'), "<?php\n");

        $this->file->append(base_path('.gitignore'), "bower_components\n.vagrant\n.idea\nnode_modules\n");

        foreach ($this->blueprintFiles as $blueprint) {
            $this->copyBlueprint($blueprint);
        }
    }

    protected function copyBlueprint($file)
    {
        $blueprintPath = $this->getBlueprint($file);

        if ($this->file->isDirectory($blueprintPath)) {
            $this->file->copyDirectory($this->getBlueprint($file), base_path($file));
        } else {
            $this->file->copy($this->getBlueprint($file), base_path($file));
        }
    }

    protected function getBlueprint($file)
    {
        return $this->starterBlueprintPath . '/' . $file;
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected
    function getArguments()
    {
        return [
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected
    function getOptions()
    {
        return [
        ];
    }

}
