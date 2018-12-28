<?php 

namespace Datakraf\Traits;

trait AlertMessage
{

    public function message($action, $entity)
    {
        switch ($action) {
            case 'save':
                return $entity . ' saved';
                break;
            case 'update':
                return $entity . ' updated';
                break;
            case 'delete':
                return $entity . ' deleted';
                break;
            default:
                return 'error in displaying status';
        }
    }

}