<?php
namespace App\Commands;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Log;
use idoag\Repos\BrandRepositoryInterface;

class BrandCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'brand:status';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Registration details daily wise';

    /**
     * Campaign model instance.
     *
     * @var CampaignRepositoryInterface
     */
    protected $brand;

    protected $runAt = '20:00';



    /**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(BrandRepositoryInterface $brand)
	{

		parent::__construct();

        $this->timestamp = time();

        $this->brand = $brand;
    }

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $this->dailyAt('20:00', function()
        {
//                    echo 'test brand firing';
            $status = $this->brand->sendInternshipListToBrand();
            Log::info('Cron executed'. $status);
//          echo 'test brand firing completed'.$status;
        });

        $this->finish();

	}

    protected function finish()
    {
        // Write execution time and messages to the log
        $executionTime = round(((microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']) * 1000), 3);
        Log::info('Cron: execution time: ' . $executionTime.' ('.date('H:i', $this->timestamp).')');

    }

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
        return array();
	}

    protected function dailyAt($time, callable $callback)
    {
        if(date('H:i', $this->timestamp) === $time)
            call_user_func($callback);
    }

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
//        return array();
	}

}
