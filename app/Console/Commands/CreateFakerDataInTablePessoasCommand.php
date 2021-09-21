<?php

namespace App\Console\Commands;

use App\Traits\PessoasTrait;
use Illuminate\Console\Command;

class CreateFakerDataInTablePessoasCommand extends Command
{

    use PessoasTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'faker:pessoas-create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cria registros de pessoas no banco aleatoriamente.';

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
     * @return int
     */
    public function handle()
    {
        $this->CommandMethodCreateRegistersFakerPessoas(1000);
    }
}
