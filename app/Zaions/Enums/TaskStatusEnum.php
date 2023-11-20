<?php

namespace App\Zaions\Enums;


enum TaskStatusEnum: string
{
  case todo = 'Todo';
  case inProgress = 'In progress';
  case requireInfo = 'Require info';
  case availableForReview = 'Available for review';
  case done = 'Done';
  case closed = 'Closed';
  case other = 'Other';
}
