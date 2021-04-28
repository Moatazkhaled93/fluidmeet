<?php

namespace App\Helpers\Imports;

use App\Models\Entity;
use App\Models\JobHistory;
use App\Models\User;
use App\Repository\Eloquent\UserTypeRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class UsersImport implements ToCollection, WithHeadingRow, WithChunkReading, ShouldQueue, WithEvents
{
    private $entity, $user, $updateDuplicates, $uniqueFields, $jobHistory, $userTypeRepository;

    public function __construct(Entity $entity, User $user, array $uniqueFields, string $updateDuplicates, JobHistory $jobHistory, UserTypeRepository $userTypeRepository)
    {
        $this->entity = $entity;
        $this->user = $user;
        $this->updateDuplicates = $updateDuplicates;
        $this->uniqueFields = $uniqueFields;
        $this->jobHistory = $jobHistory;
        $this->userTypeRepository = $userTypeRepository;
    }

    public function collection(Collection $rows) {

        foreach ($rows as $row) {
            $data = $row->toArray();
            array_walk($data, array($this, 'parseData'));
        }
    }

    public function chunkSize(): int
    {
        return 10000;
    }

    public function registerEvents(): array
    {
        return [];
    }

    private function parseData(&$value, $field)
    {
        switch ($field) {
            case 'user_type_id':
                $value = $this->userTypeRepository->findByAttribute(['name' => $value, 'entity_id' => $this->entity->id])->id;
                break;
        }
    }

}
