<?php

namespace App\Zaions\Enums;


enum EmailsEnum: string
{
  case defaultEmail = 'ahsan@zaions.com';
  case superAdminEmail = 'superAdmin@zaions.com';
  case adminEmail = 'admin@zaions.com';
  case managerEmail = 'manager@zaions.com';
  case employeeEmail = 'employee@zaions.com';
  case userEmail = 'user@zaions.com';
}
