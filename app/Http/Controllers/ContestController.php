<?php

namespace App\Http\Controllers;

use App\Repositories\Contest\ContestRepositoryInterface;
use Illuminate\Http\Request;

class ContestController extends Controller
{
    private $contestRepo;

    public function __construct(ContestRepositoryInterface $contestRepo)
    {
        $this->contestRepo = $contestRepo;
    }

    public function getAllContest()
    {
        return $this->contestRepo->getAllContest();
    }

    public function joinContest($contest_id)
    {
        return $this->contestRepo->joinContest($contest_id);
    }
}
