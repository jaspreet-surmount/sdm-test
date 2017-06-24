<?php
use App\User;

/**
 * @param string $routeParams
 * @param bool $iconInside
 * @param string $style
 *
 * @param bool $noText
 * @return string
 */
function deleteForm($routeParams, $iconInside = false, $style = "", $noText = false)
{
    /**
     * If @var: iconInside is set true,
     * then using label & submit button id unique (in case of two forms on same view)
     */
    $uniqId = uniqid();
    $form = Form::open([
        'method' => 'DELETE',
        'url' => URL::to($routeParams),
    ]);
    $buttonText = (true === $noText) ? '' : \Lang::get('common.delete');
    if (true === $iconInside) {
        $form .= '<label for="' . $uniqId . '" data-message="' . Lang::get("common.confirm_submit") . '" onclick="return confirmBox(this)" class="btn btn-xs btn-danger ' . $style . ' ">
        <i class="glyphicon glyphicon-trash"></i> ' . $buttonText . '</label>';
        $form .= Form::submit(\Lang::get('common.delete'), ['class' => 'hide ', 'id' => $uniqId]);
    } else {
        $form .= Form::submit(
            \Lang::get('common.delete'),
            ['class' => 'btn btn-xs btn-danger ' . $style . '', 'onclick' => "return confirmBox(this)"]
        );
    }
    $form .= Form::close();

    return $form;
}

/**
 * @param int $id
 * @param string $fullName
 * @param int $createdBy
 * @return string
 */
function getStudentActions($id, $fullName, $createdBy)
{
    $actions = '';
    $user = (new User);
    if ($user->hasPermission('student.edit')
        && (\Config::get('constants.DEFAULT_ROLES.level_one') == \Auth::user()->role->name
        || \Auth::id() == $createdBy)
    ) {
        $actions = Html::link('javascript:void(0)', Lang::get('student.edit'), [
            'class' => 'btn btn-warning btn-xs formModal',
            'data-route' => URL::route('student.edit', ['id' => $id]),
            'data-width' => '750px',
            'data-name' => Lang::get('student.edit_student', ['name' => $fullName])
        ]);
    }

    if ($user->hasPermission('student.destroy')) {
        $actions .= deleteForm('student/' . $id, false);
    }

    return $actions;
}

