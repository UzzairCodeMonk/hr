<?php 

namespace Datakraf\Traits;

trait AlertMessage
{

    public function message($action, $entity)
    {
        switch ($action) {
            case 'save':
                return $entity . ' has been saved';
                break;
            case 'update':
                return $entity . ' has been updated';
                break;
            case 'delete':
                return $entity . ' has been deleted';
                break;
            default:
                return 'error in displaying status';
        }
    }

}