<?php

namespace App\Enums;

enum Permission: string
{
    // office
    case ASSIGN_OFFICE = 'assign_office';
    case EDIT_OFFICE = 'edit_office';

    // user
    case VIEW_USER = 'view_user';
    case CREATE_USER = 'create_user';
    case EDIT_USER = 'edit_user';
    case DELETE_USER = 'delete_user';

    // events
    case VIEW_EVENTS = 'view_events';
    case CREATE_EVENT = 'create_event';
    case EDIT_EVENT = 'edit_event';
    case DELETE_EVENT = 'delete_event';

    // payments
    case VIEW_PAYMENT = 'view_payments';
    case CREATE_PAYMENT = 'create_payment';
    case EDIT_PAYMENT = 'edit_payment';
    case DELETE_PAYMENT = 'delete_payment';

    // clearance
    case START_CLEARANCE = 'start_clearance';
    case END_CLEARANCE = 'end_clearance';
    case VIEW_CLEARANCES = 'view_clearances';
}
