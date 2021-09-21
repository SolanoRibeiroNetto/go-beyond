<?php

namespace App\Console\Commands;

use App\Traits\PessoasTrait;
use Illuminate\Console\Command;

class CleanTablePessoaCommand extends Command
{

    use PessoasTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean-table:pessoa';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando que limpa a tabela de pessoa';

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
        $this->CommandMethodCleanTablePessoas();
    }
}
