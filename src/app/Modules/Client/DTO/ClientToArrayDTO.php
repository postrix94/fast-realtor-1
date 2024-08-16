<?php


namespace App\Modules\Client\DTO;


use App\Modules\Client\Client;

final class ClientToArrayDTO
{
    /**
     * @param Client $client
     * @return array
     */
    public static function toArray(Client $client): array {
        $roles = $client->getRoles()->map(fn($role) => $role->getName())->toArray();
        $permissions = $client->getPermissions()->map(fn($permission) => $permission->getName())->toArray();

        return [
            "id" => $client->getId(),
            "name" => $client->getName(),
            "phone" => $client->getPhone(),
            "is_blocked" => $client->isBlocked(),
            "is_auth" => $client->isAuth(),
            "roles" => $roles,
            "permissions" => $permissions,
        ];
    }
}
