<?php

namespace App\Services;

use App\Repository\Eloquent\PharmaciesRepository;

class PharmaciesService {

    private $pharmaciesRepository;

    public function __construct(PharmaciesRepository $pharmaciesRepository) {
        $this->pharmaciesRepository = $pharmaciesRepository;
    }

    public function all() {

        return $this->pharmaciesRepository->all();
    }
    public function get($id) {

        return $this->pharmaciesRepository->find($id);
    }

    public function create($data) {

        return $this->pharmaciesRepository->create($data);
    }

    public function update($id, $data) {

        return $this->pharmaciesRepository->update($data ,$id);
    }
    public function delete($id) {

        return $this->pharmaciesRepository->delete($id);
    }

}
