<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PharmaciesRequest;
use App\Services\PharmaciesService;
use Illuminate\Http\JsonResponse;
use App\Helpers\HttpStatusCodes;

class PharmaciesController extends Controller {

    /**
     * get All .
     * @param PharmaciesService $pharmaciesService
     * @return JsonResponse
     */
    public function index(PharmaciesService $pharmaciesService) {
        try {
            $pharmacies = $pharmaciesService->all();
        } catch (\Exception $exception) {
            return $this->response->error('', $exception->getMessage(), HttpStatusCodes::HTTP_BAD_REQUEST);
        }

        return $this->response->success($pharmacies, 'get pharmacies successfully');
    }

    /**
     * get by one .
     * @param PharmaciesService $pharmaciesService
     * @return JsonResponse
     */
    public function show($id, PharmaciesService $pharmaciesService) {
        try {
            $pharmacy = $pharmaciesService->get($id);
        } catch (\Exception $exception) {
            return $this->response->error('', $exception->getMessage(), HttpStatusCodes::HTTP_BAD_REQUEST);
        }

        return $this->response->success($pharmacy, 'get pharmacy successfully');
    }

    /**
     * insert.
     * @param PharmaciesService $pharmaciesService
     * @return JsonResponse
     */
    public function store(PharmaciesRequest $request, PharmaciesService $pharmaciesService) {
        try {
            $pharmacy = $pharmaciesService->create($request->validated());
        } catch (\Exception $exception) {
            return $this->response->error('', $exception->getMessage(), HttpStatusCodes::HTTP_BAD_REQUEST);
        }

        return $this->response->success($pharmacy, 'created pharmacy successfully');
    }

    /**
     * update .
     * @param PharmaciesService $pharmaciesService
     * @return JsonResponse
     */
    public function update($id, PharmaciesRequest $request, PharmaciesService $pharmaciesService) {
        try {
            $pharmacy = $pharmaciesService->update($id, $request->validated());
        } catch (\Exception $exception) {
            return $this->response->error('', $exception->getMessage(), HttpStatusCodes::HTTP_BAD_REQUEST);
        }

        return $this->response->success($pharmacy, 'updated pharmacy successfully');
    }

    /**
     * delete .
     * @param PharmaciesService $pharmaciesService
     * @return JsonResponse
     */
    public function destroy($id, PharmaciesService $pharmaciesService) {
        try {
            $pharmaciesService->delete($id);
        } catch (\Exception $exception) {
            return $this->response->error('', $exception->getMessage(), HttpStatusCodes::HTTP_BAD_REQUEST);
        }

        return $this->response->success('', 'deleted pharmacy successfully');
    }

}
