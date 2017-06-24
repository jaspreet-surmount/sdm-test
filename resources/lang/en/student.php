<?php
return [
    'add_student'   => 'Add Student',

    /*
     * Student list head columns
     */
    'col_name'                          => 'Name',
    'col_dob'                           => 'DOB',
    'col_contact_number'                => 'Phone No.',
    'col_gender'                        => 'Gender',
    'col_favorite_subjects'             => 'Favorite Subjects',
    'col_other_activities'              => 'Other Activities',
    'col_program' => 'Program',
    'col_by' => 'Created/Updated By',
    'col_at' => 'At',
    'col_actions' => 'Action',

    'full_name' => 'Full Name',

    'gender' => array_combine(\Config::get('constants.GENDER'), ['Male', 'Female',]),

    'favourite_subjects' => array_combine(
        \Config::get('constants.FAVORITE_SUBJECTS'),
        ['Mathematics', 'Physics', 'Biology', 'Chemistry', 'Programming', 'English',]
    ),
    'created_success'   => 'New Student data added successfully.',
    'update_success'    => 'Student \':name\' data updated successfully.',
    'delete_success'    => 'Student \':name\' data deleted successfully.',
    'data_approved_success' => 'Student \':name\' data approved successfully.',
    'edit' => 'Edit',
    'edit_student'  => 'Edit Student - :name',
    'approve_data'  => 'Approve',
];
