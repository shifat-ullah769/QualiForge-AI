<?php

namespace App;

enum UserRole: string
{
    case SYSTEM_ADMINISTRATOR = 'system_administrator';
    case COMPANY_ADMINISTRATOR = 'company_administrator';
    case QUALITY_ENGINEER = 'quality_engineer';
    case PRODUCTION_SUPERVISOR = 'production_supervisor';
    case QUALITY_MANAGER = 'quality_manager';
}