<?php

namespace Modules\Leave\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Datakraf\User;

class CalculateUserLeaveBalance extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'leave:calculate-balance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset and calculate leave balance';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::get();

        foreach ($users as $user) {

            $approved_leaves = [];

            foreach ($user->leaves as $leave) {
                if ($leave->status == 'approved') {
                    $approved_leaves[] = $leave;
                }
            }

            $leaves = collect($approved_leaves);

            $leaves->mapToGroups(function($item, $key){

                return [$item['leavetype_id'] => $item['name']];

            });

        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['example', InputArgument::REQUIRED, 'An example argument.'],
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
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
