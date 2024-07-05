<?php

namespace App\Repositories\Interfaces;

interface RepositoryInterface {
    public function index();
    public function create();
    public function store($data);
    public function show($slug);
    public function edit($id);
    public function update($data, $id);
    public function destroy($id);
}
