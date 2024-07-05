<?php

namespace App\Repositories\Contest;

use App\Repositories\Interfaces\RepositoryInterface;

interface ContestRepositoryInterface extends RepositoryInterface {
    public function getAllContest();
    public function joinContest($contest_id);
    public function getExamAndQuestion($exam_id);

}


?>
