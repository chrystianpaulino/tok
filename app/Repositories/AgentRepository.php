<?php

namespace App\Repositories;

final class AgentRepository extends BaseUserRoleRepository
{
    public function __construct()
    {
        parent::__construct('agent');
    }
}
